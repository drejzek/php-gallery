document.getElementById('InstallWizzard').addEventListener('submit', function(event) {
    event.preventDefault(); // Zabrání odeslání formuláře standardním způsobem

    var formData = new FormData(this); // Získání dat z formuláře

    //Database data

    var xhrDB = new XMLHttpRequest();
    xhrDB.open('POST', 'process/database.php', true); // Zde nahraďte URL adresou vašeho serveru

    xhrDB.onreadystatechange = function() {
        if (xhrDB.readyState === XMLHttpRequest.DONE) {
            //var responseDiv = document.getElementById('response');
            if (xhrDB.status === 200) {
                // Odpověď od serveru při úspěšném požadavku
                database = xhrDB.responseText;
            } else {
                database = xhrDB.status;
            }
        }
        else{
            database = "0";
        }
    };

    xhrDB.send(formData); // Odeslání dat na server

    //Tables data

    var xhrTables = new XMLHttpRequest();
    xhrTables.open('POST', 'process/tables.php', true); // Zde nahraďte URL adresou vašeho serveru

    xhrTables.onreadystatechange = function() {
        if (xhrTables.readyState === XMLHttpRequest.DONE) {
            var responseDiv = document.getElementById('response');
            if (xhrTables.status === 200) {
                // Odpověď od serveru při úspěšném požadavku
                tables = xhrTables.responseText;
            } else {
                // Chyba při odesílání formuláře
                tables = xhrTables.status;
            }
        }
    };

    xhrTables.send(formData); // Odeslání dat na server

    //User data

    var xhrUser = new XMLHttpRequest();
    xhrUser.open('POST', 'process/user.php', true); // Zde nahraďte URL adresou vašeho serveru

    xhrUser.onreadystatechange = function() {
        if (xhrUser.readyState === XMLHttpRequest.DONE) {
            var responseDiv = document.getElementById('response');
            if (xhrUser.status === 200) {
                // Odpověď od serveru při úspěšném požadavku
                user = xhrUser.responseText;
            } else {
                // Chyba při odesílání formuláře
                user = xhrUser.status;
            }
        }
    };

    xhrUser.send(formData); // Odeslání dat na server

    //Settings data

    var xhrSettings = new XMLHttpRequest();
    xhrSettings.open('POST', 'process/settings.php', true); // Zde nahraďte URL adresou vašeho serveru

    xhrSettings.onreadystatechange = function() {
        if (xhrSettings.readyState === XMLHttpRequest.DONE) {
            var responseDiv = document.getElementById('response');
            if (xhrSettings.status === 200) {
                // Odpověď od serveru při úspěšném požadavku
                settings = xhrSettings.responseText;
            } else {
                // Chyba při odesílání formuláře
                settings = xhrSettings.status;
            }
        }
    };

    xhrSettings.send(formData); // Odeslání dat na server

    alert("Data: " + database + " " + tables + " " + user + " " + settings);
});