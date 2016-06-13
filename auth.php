<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if (session_status() === PHP_SESSION_ACTIVE) 
{
    session_destroy();
}

if ($username && $password)
{
    $auth = json_decode(file_get_contents('./auth.json'));
    if ($username === $auth->username && $password === $auth->password)
    {
        session_start();
        $_SESSION['username'] = $username;
        echo json_encode(['status' => true]);
        exit();
    }
}
echo json_encode(['status' => false, 'msg' => 'Not allowed']);
