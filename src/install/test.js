document.getElementById('InstallWizzard').addEventListener('submit', async function(event) {
    event.preventDefault(); // Zabrání odeslání formuláře standardním způsobem

    var formData = new FormData(this); // Získání dat z formuláře

    // Funkce na vytvoření Promise pro AJAX požadavek
    function sendRequest(url) {
        return new Promise(function(resolve, reject) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', url, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        resolve(xhr.responseText);
                    } else {
                        reject(xhr.responseText);
                    }
                }
            };
            xhr.send(formData);
        });
    }

    // Funkce pro vytvoření zpoždění
    function delay(time) {
        return new Promise(function(resolve) {
            setTimeout(resolve, time);
        });
    }

    // Proměnné pro uložení výsledků a chyb
    var resultString = '';
    var errors = '';

    try {
        try {
            database = await sendRequest('process/database.php');
            resultString += 'database:1;';
        } catch (error) {
            resultString += 'database:0;';
            errors += 'database:' + error + ';';
        }
        await delay(1000);

        try {
            config_file = await sendRequest('process/config_file.php');
            resultString += 'config_file:1;';
        } catch (error) {
            resultString += 'config_file:0;';
            errors += 'config_file:' + error + ';';
        }
        await delay(1000);

        try {
            tables = await sendRequest('process/tables.php');
            resultString += 'tables:1;';
        } catch (error) {
            resultString += 'tables:0;';
            errors += 'tables:' + error + ';';
        }
        await delay(1000);

        try {
            user = await sendRequest('process/user.php');
            resultString += 'user:1;';
        } catch (error) {
            resultString += 'user:0;';
            errors += 'user:' + error + ';';
        }

        try {
            user = await sendRequest('process/settings.php');
            resultString += 'settings:1;';
        } catch (error) {
            resultString += 'settings:0;';
            errors += 'settings:' + error + ';';
        }

        // Přesměrování na finální stránku s výsledky a chybami
        var redirectUrl = "finish.php?result=" + encodeURIComponent(resultString);
        if (errors) {
            redirectUrl += "&errors=" + encodeURIComponent(errors);
        }

        window.location.href = redirectUrl;

    } catch (error) {
        console.error('Nastala neočekávaná chyba: ', error);
    }
});