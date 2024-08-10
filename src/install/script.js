$(document).ready(function () {

    var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-success').addClass('btn-default');
            $item.addClass('btn-success');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function () {
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for (var i = 0; i < curInputs.length; i++) {
            if (!curInputs[i].validity.valid) {
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-success').trigger('click');
});

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

    // Funkce pro zpracování odpovědi
    function processResponse(response, type) {
        var parts = response.split(';');
        var status = parts[0].split(':')[1]; // Hodnota 1 nebo 0
        resultString += type + ':' + status + ';';
        
        if (status === '0' && parts.length > 1) {
            var error = parts[1].split(':')[1]; // Důvod chyby
            errors += type + ':' + error + ';';
        }
    }

    try {
        try {
            var databaseResponse = await sendRequest('process/database.php');
            processResponse(databaseResponse, 'database');
        } catch (error) {
            errors += 'database:request_failed;';
        }
        await delay(1000);

        try {
            var configFileResponse = await sendRequest('process/config_file.php');
            processResponse(configFileResponse, 'config_file');
        } catch (error) {
            errors += 'config_file:request_failed;';
        }
        await delay(1000);

        try {
            var tablesResponse = await sendRequest('process/tables.php');
            processResponse(tablesResponse, 'tables');
        } catch (error) {
            errors += 'tables:request_failed;';
        }
        await delay(1000);

        try {
            var userResponse = await sendRequest('process/user.php');
            processResponse(userResponse, 'user');
        } catch (error) {
            errors += 'user:request_failed;';
        }

        try {
            var settingsResponse = await sendRequest('process/settings.php');
            processResponse(settingsResponse, 'settings');
        } catch (error) {
            errors += 'settings:request_failed;';
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
