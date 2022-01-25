<?php
session_start();

if ($_SESSION['user']) {
    header('Location: profile.php');
}

?>

<!doctype html>
<html lang = "en">
<head>
    <meta charset="UTF-8">
    <title>Регистрация и авторизация</title>
    <link rel="stylesheet" href="assets/css/main.css"
</head>
<body>
    <form>
        <label>Логин</label>
        <input type="text" name="login" placeholder="Введите свой логин">
        <p class="msg none" name="login"></p>
        <label>Пароль</label>
        <input type="password" name="password" placeholder="Введите пароль">
        <p class="msg none" name="password"></p>
        <button type="submit" class="login-btn">Войти</button>
        <p>
            У вас нет аккаунта? - <a href="/register.php">зарегистрируйтесь</a>!
        </p>
    </form>

    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>