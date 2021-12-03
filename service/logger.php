<?php
require_once 'config.php';
class Logger {
    public static function pushLog($message): void {
        global $sql;
        $stmt = $sql->prepare("INSERT INTO logs(text) VALUES (?)");
        $stmt->bind_param('s', $message);
        @$stmt->execute();
        $stmt->close();
    }
}
