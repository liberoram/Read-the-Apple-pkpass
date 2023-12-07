<?php

function extractPkpassInfo($pkpassPath) {
    // Change the file extension to ".zip"
    $zipPath = str_replace('.pkpass', '.zip', $pkpassPath);

    // Extract the contents of the zip file
    $zip = new ZipArchive;
    if ($zip->open($pkpassPath) === true) {
        $zip->extractTo($zipPath);
        $zip->close();
    } else {
        die('Failed to open the PKPASS file.');
    }

    // Read pass.json file
    $passJsonPath = $zipPath . '/pass.json';
    if (file_exists($passJsonPath)) {
        echo "<pre>";
        $passData = json_decode(file_get_contents($passJsonPath), true);
        print_r($passData); // Print pass.json content
    } else {
        die('pass.json file not found.');
    }

    // Clean up: Delete the extracted files (optional)
    // unlink($zipPath);
}

// Replace 'your_pkpass_file.pkpass' with the actual path to your PKPASS file
$pkpassFilePath = 'your_pkpass_file.pkpass';
extractPkpassInfo($pkpassFilePath);

?>
