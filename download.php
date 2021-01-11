<?php
//Gets the path to the file to download and calls the function to download the file.
if ($_GET['path']) {
    $filePath = $_GET['path'];
    download($filePath);
}
function download($filePath) {
    if (file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');//change your extension of your files
        header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    }
}
?>