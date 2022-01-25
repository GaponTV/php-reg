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
        <label>Повторите пароль</label>
        <input type="password" name="password_confirm" placeholder="повторите пароль">
        <p class="msg none" name="password_confirm"></p>
        <label>Почта</label>
        <input type="text" name="email" placeholder="Введите свою почту">
        <p class="msg none" name="email"></p>
        <label>Имя</label>
        <input type="text" name="name" placeholder="Введите своё имя" >
        <p class="msg none" name="name"></p>
        <button type="submit" class="register-btn">Зарегистрироваться</button>
        <p>
            У вас уже есть аккаунт? - <a href="/index.php">Авторизируйтесь</a>!
        </p>
    </form>
    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/main.js"></script>
    </form>
</body>
</html>