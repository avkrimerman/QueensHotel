<?php

session_start();

if (!$_SESSION['username'])
{
    echo json_encode(['status' => false, 'msg' => 'Not Authorized']);
    exit();
}

$images = [];
$dir = dirname(__FILE__);
$folder = $dir . DIRECTORY_SEPARATOR . 'upload-files';

if ($handle = opendir($folder)) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {

            $images[] = '/upload-files/' . $entry;
        }
    }

    closedir($handle);

    echo json_encode($images);
    exit();
}
