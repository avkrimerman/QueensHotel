<?php

session_start();

if (! array_key_exists('username', $_SESSION))
{
    echo json_encode(['status' => false, 'msg' => 'Not Authorized']);
    exit();
}

$dir = dirname(__FILE__);
$images = json_decode(file_get_contents($dir . DIRECTORY_SEPARATOR . 'images.json'), true);
$src = $_POST['src'];
$type = $_POST['type'];

foreach ($src as $key => $value)
{
    if (! in_array($value, $images[$type]))
    {
        $images[$type][] = str_replace('http://'.$_SERVER['HTTP_HOST'], '', $value);
    }
}

file_put_contents($dir . DIRECTORY_SEPARATOR . 'images.json', json_encode($images));
echo json_encode(['status' => true]);
exit();
