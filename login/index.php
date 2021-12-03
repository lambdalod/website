<?php
session_start();
require '../service/auth.php';
$back = $_GET['back'] ?? "";
$fback = match ($back) {
    "" => "",
    default => "?back={$back}",
};
if (Auth::checkLogin() !== false) {
    header("Location: ../{$back}");
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
        header("Location: ./{$fback}");
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
        header("Location: ../{$back}");
        exit;
    }
    header("Location: ./{$fback}");
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
    <style>
        .alert-light {
            background-color: #FFE6E6;
            border-radius: 2px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);

        }
    </style>
</head>

<body>
<form method="post">
    <div id="login" class="container d-flex align-items-center justify-content-center"
         style="width: 100vw;height: 100vh;">
        <div class="col-xl-5 paper d-grid gap-3">
            <div>
                <p class="text-center subheader">Добро пожаловать!</p>
                <?php if (isset($modal)): ?>
                <div class='alert-light d-flex align-items-center'>
                    <div class='alert-light-logo' style="margin-left:2em;margin-right:1em;">
                        <svg width="40" height="40" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle r="6.33333" transform="matrix(1 8.74228e-08 8.74228e-08 -1 8.49996 8.49992)" stroke="#FF3C3C" stroke-width="1.5"/>
                            <path d="M8.96983 8.49994L11.0589 6.41087C11.1887 6.28119 11.1887 6.07078 11.0589 5.94109C10.9291 5.8113 10.7189 5.8113 10.5891 5.94109L8.50006 8.03017L6.41087 5.94109C6.28108 5.8113 6.07089 5.8113 5.94109 5.94109C5.8113 6.07078 5.8113 6.28119 5.94109 6.41087L8.03028 8.49994L5.94109 10.589C5.8113 10.7187 5.8113 10.9291 5.94109 11.0588C6.00599 11.1236 6.09104 11.156 6.17598 11.156C6.26092 11.156 6.34597 11.1236 6.41087 11.0587L8.50006 8.96961L10.5891 11.0587C10.654 11.1236 10.7391 11.156 10.824 11.156C10.909 11.156 10.994 11.1236 11.0589 11.0587C11.1887 10.929 11.1887 10.7186 11.0589 10.5889L8.96983 8.49994Z" fill="#FF3C3C" stroke="#FF3C3C" stroke-width="0.3"/>
                        </svg>
                    </div>
                    <p class='alert-light-text my-3'><?= $modal[1] ?></p>
                </div>
                <?php endif; ?>
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
