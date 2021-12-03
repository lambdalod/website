<?php
unset($_COOKIE['loghash']);
setcookie('loghash', null, -1, '/');
header("Location: ./");