<?php
require 'service/auth.php';
$u = Auth::checkLogin();
if ($u === false) {
    header("Location: /login");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    Hello
</body>
</html>