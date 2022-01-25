<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    session_start();
    include '../bd/users.php';

    $name = $_POST['name'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $salt = "ffdfuse234";
    $error_fields = [];
    $message = [];

    if ($login === '') {
        $error_fields[] = 'login';
        $message['login'] = "Обязательное поле";
    } else {
        if (!preg_match('/^\w{6,20}$/', $login)) {
            $error_fields[] = 'login';
            $message['login'] = "Использовались недопустимые символы, либо в логине содержится менее 6 символов";
        } else {
            if (checkLogin($login)) {
                $error_fields[] = 'login';
                $message['login'] = "Пользователь с таким логином уже существует";
            }
        }
    }

    if ($password === '') {
        $error_fields[] = 'password';
        $message['password'] = "Обязательное поле";
    } else {
        if (!preg_match('/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{6,22}$/', $password)) {
            $error_fields[] = 'password';
            $message['password'] = "В пароле должны быть буквы и цифры и не менее 6 символов";
        }
    }

    if ($name === '') {
        $error_fields[] = 'name';
        $message['name'] = "Обязательное поле";
    } else{
        if(!preg_match('/^[a-zA-Z]{2}$/', $name)){
            $error_fields[] = 'name';
            $message['name'] = "2 символа, только буквы";
        }
    }

    if ($email === '') {
        $error_fields[] = 'email';
        $message['email'] = "Обязательное поле";
    } else {
        if (!preg_match('/^[a-zA-Z0-9]+@\w+\.\w+$/', $email)) {
            $error_fields[] = 'email';
            $message['email'] = "Неверно введен адрес почты";
        } else {
            if (checkEmail($email)) {
                $error_fields[] = 'email';
                $message['email'] = "Пользователь с такой почтой уже существует";
            }
        }
    }

    if ($password_confirm === '') {
        $error_fields[] = 'password_confirm';
        $message['password_confirm'] = "Обязательное поле";
    } else{
        if($password != $password_confirm){
            $error_fields[] = 'password_confirm';
            $message['password_confirm'] = "Пароли не совпадают";
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

    $password = md5($password . $salt);
    $data['name'] = $name;
    $data['login'] = $login;
    $data['email'] = $email;
    $data['password'] = $password;
    createUser($data);

    $response = [
        "status" => true,
        "message" => "Регистрация прошла успешно!",
    ];
    echo json_encode($response);
}
?>
