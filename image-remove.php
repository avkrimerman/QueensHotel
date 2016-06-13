<?php

session_start();

if (!$_SESSION['username'])
{
    echo json_encode(['status' => false, 'msg' => 'Not Authorized']);
    exit();    
}

$dir = dirname(__FILE__);
$images = json_decode(file_get_contents($dir . DIRECTORY_SEPARATOR . 'images.json'), true);
$src = $_POST['src'];
$name = pathinfo($src)['basename'];
$type = $_POST['type'];

if ($type === 'all' && file_exists($dir . DIRECTORY_SEPARATOR . 'upload-files' . DIRECTORY_SEPARATOR . $name))
{
    unlink($dir . DIRECTORY_SEPARATOR . 'upload-files' . DIRECTORY_SEPARATOR . $name);
    echo json_encode(['status' => true]);
    exit();
}

if (in_array($src, $images[$type]))
{
    $images[$type] = array_diff($images[$type], [$src]);
    file_put_contents($dir . DIRECTORY_SEPARATOR . 'images.json', json_encode($images));
}

echo json_encode(['status' => true]);
exit();
