<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    session_start();
    include '../bd/users.php';

    $login = $_POST['login'];
    $password = $_POST['password'];
    $error_fields = [];
    $message = [];
    $salt = "ffdfuse234";

    if ($login === '') {
        $error_fields[] = 'login';
        $message['login'] = "Обязательное поле";
    }

    if ($password === '') {
        $error_fields[] = 'password';
        $message['password'] = "Обязательное поле";
    }

    if (empty($error_fields)) {
        if (!checkLogin($login)) {
            $error_fields[] = 'login';
            $message['login'] = "Такого пользователя не существует";
        } else {
            $password = md5($password . $salt);
            if (!($user = checkUser($login, $password))) {
                $error_fields[] = 'password';
                $message['password'] = "Неверный пароль";
            }
        }
    }
    if (!empty($error_fields)) {
        $response = [
            "status" => false,
            "type" => 1,
            "message" => $message,
            "fields" => $error_fields
        ];

        echo json_encode($response);

        die();
    }



    $_SESSION['user'] = [
        "id" => $user['id'],
        "name" => $user['name'],
        "email" => $user['email']
    ];

    $response = [
        "status" => true
    ];

    echo json_encode($response);
}