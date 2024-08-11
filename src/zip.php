<?php

if (isset($_POST['download'])) {
    $selectedFiles = $_POST['files'];
    
    if (!empty($selectedFiles)) {
        $zip = new ZipArchive();
        $zipFileName = "download_" . time() . ".zip";
        $zipFilePath = __DIR__ . "/" . $zipFileName;

        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            foreach ($selectedFiles as $file) {
                // Přidá soubory do ZIP archivu
                $filePath = __DIR__ . '/files/' . basename($file);
                if (file_exists($filePath)) {
                    $zip->addFile($filePath, basename($file));
                }
            }
            $zip->close();

            // Stáhne ZIP soubor
            header('Content-Type: application/zip');
            header('Content-disposition: attachment; filename=' . $zipFileName);
            header('Content-Length: ' . filesize($zipFilePath));
            readfile($zipFilePath);

            // Smaže ZIP soubor ze serveru po stažení
            unlink($zipFilePath);
            exit;
        } else {
            echo 'Nelze vytvořit ZIP soubor.';
        }
    } else {
        echo 'Žádné soubory nebyly vybrány.';
    }
  }