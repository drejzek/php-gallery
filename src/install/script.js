var database, tables = "", user = "", settings = ""; 

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
                        reject(xhr.status);
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

    try {
        // Poslání prvního požadavku
        var database = await sendRequest('process/database.php');
        console.log('Database response: ', database);

        // Pauza 1 sekunda
        await delay(1000);

        // Poslání druhého požadavku
        var tables = await sendRequest('process/tables.php');
        console.log('Tables response: ', tables);

        // Pauza 1 sekunda
        await delay(1000);

        // Poslání třetího požadavku
        var user = await sendRequest('process/user.php');
        console.log('User response: ', user);

        // Pauza 1 sekunda
        await delay(1000);

        // Poslání čtvrtého požadavku
        var settings = await sendRequest('process/settings.php');
        console.log('Settings response: ', settings);

        // Výpis všech dat
        var resultString = database + tables + user + settings;

        window.location.href = "finish.php?result=" + resultString;

        // var resultString = `config_file:${configResult};db_test:${dbTestResult};tables:${tablesResult};user:${userResult}`;

    } catch (error) {
        console.error('Nastala chyba při odesílání jednoho z požadavků: ', error);
    }
});


