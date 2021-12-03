<?php
session_start();
require '../service/auth.php';
if (Auth::checkLogin() !== false) {
    header("Location: ../");
    exit;
}
if (isset($_POST['submit'])) {
    $phone = $_POST['phone'];
    $paswd = $_POST['password'];
    $remember = isset($_POST['remember']);
    try {
        $user = new User(phone: $phone);
    } catch (UserNotFound $e) {
        $_SESSION['modal'] = ["Ошибка!", "Пользователь не зарегистрирован или пароль не верен!"];
        header("Location: ./");
        exit;
    }
    $hash = $user->getHash();
    if (!password_verify($paswd, $hash)) $_SESSION['modal'] = ["Ошибка!", "Пользователь не зарегистрирован или пароль не верен."];
    else {
        // password is valid
        $len = match ($remember) {
            false => time() + 60 * 60 * 24 * 30 * 2, // Two months
            true => 0 // For current session
        };
        setcookie('loghash', Auth::createLoginHash($user->getEmail()), $len, "/");
        header("Location: ../");
        exit;
    }
    header("Location: ./");
    exit;
}
if (isset($_SESSION['modal'])) {
    $modal = $_SESSION['modal'];
    unset($_SESSION['modal']);
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>lambda_login</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>
<form method="post">
    <div id="login" class="container d-flex align-items-center justify-content-center"
         style="width: 100vw;height: 100vh;">
        <div class="col-xl-5 paper d-grid gap-3">
            <div>
                <p class="text-center subheader">Добро пожаловать!</p>
            </div>
            <div class="text-center"><input class='line-input' type="text" placeholder="Номер телефона" name="phone"></div>
            <div class="text-center"><input class='line-input' type="password" placeholder="Пароль" name="password"></div>
            <div class="d-flex justify-content-center" style="width: 250px;">
                <div class="form-check"><input class="form-check-input input-checkbox shadow-none text-center" type="checkbox" id="formCheck-1" name="remember">
                    <label class="form-check-label" for="formCheck-1">Чужой компьютер</label>
                </div>
            </div>
            <div class="text-center"><button class="btn input-button shadow-none" type="submit" name="submit">Войти</button></div>
            <div class="text-center"><a class='input-link' href="#">Не помню пароль</a></div>
        </div>
    </div>
</form>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
