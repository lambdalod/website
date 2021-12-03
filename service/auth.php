<?php
require_once 'config.php';
require_once 'logger.php';
class UserNotFound extends Exception {}
class HashExpired extends Exception {}
class Auth {
    public static function createLoginHash($email): string {
        global $sql;
        $rand = bin2hex(random_bytes(100));
        $sql->query("INSERT INTO loginhashes(email, hash) VALUES ('$email', '$rand')") or throw new Exception("Failed to create new login hash!");
        return $rand;
    }
    public static function checkLogin(): User|false {
        if (isset($_COOKIE['loghash'])) $hash = $_COOKIE['loghash'];
        else return false;
        try {
            $u = new User($hash);
        } catch (HashExpired|UserNotFound) {
            unset($_COOKIE['loghash']);
            setcookie('loghash', null, -1, '/');
            return false;
        }
        if (is_null($u->getLastTimestamp())) $u->sendNotification("У Вас новая награда - \"Новичок\"", HOST.'assets/awards/newbie.png');
        $u->updateActivity();
        return $u;
    }
}

class User {
    private int $id;
    private ?int $tg_id;
    private string $phone;
    private string $email;
    private string $hash;
    private int $role;
    private string $reg_ts;
    private string $name;
    private ?string $patr;
    private string $surname;
    private ?string $about;
    private ?string $skills;
    private ?string $hobby;
    private ?string $goals;
    private ?string $last_ts;
    function __construct(?string $hash = NULL, ?int $id = NULL, ?string $phone = NULL) {
        global $sql;
        if (!is_null($hash)) {
            $stmt = $sql->prepare("SELECT email FROM loginhashes WHERE hash = ?");
            $stmt->bind_param("s", $hash);
            $stmt->execute() or Logger::pushLog("On User construct: {$stmt->error}");
            $q = $stmt->get_result();
            $stmt->close();
            if ($q->num_rows != 1) throw new HashExpired();
            $email = $q->fetch_row()[0];
            $q = $sql->query("SELECT * FROM users WHERE email = '$email'") or Logger::pushLog("On User construct (select phase): {$sql->error}");
        } elseif (!is_null($id)) {
            $stmt = $sql->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute() or Logger::pushLog("On User construct via ID: {$stmt->error}");
            $q = $stmt->get_result();
            $stmt->close();
        } elseif (!is_null($phone)) {
            $stmt = $sql->prepare("SELECT * FROM users WHERE phone = ?");
            $stmt->bind_param("s", $phone);
            $stmt->execute() or Logger::pushLog("On User construct via phone: {$stmt->error}");
            $q = $stmt->get_result();
            $stmt->close();
        } else throw new InvalidArgumentException("Nor hash nor ID provided on User construct!");
        if ($q->num_rows != 1) throw new UserNotFound();
        $r = $q->fetch_assoc();
        $this->id = $r['id'];
        $this->tg_id = $r['telegram_id'];
        $this->phone = $r['phone'];
        $this->email = $r['email'];
        $this->hash = $r['hash'];
        $this->role = $r['role'];
        $this->reg_ts = $r['registration'];
        $this->name = $r['name'];
        $this->patr = $r['patronymic'];
        $this->surname = $r['surname'];
        $this->about = $r['about_me'];
        $this->skills = $r['skills'];
        $this->hobby = $r['hobby'];
        $this->goals = $r['goals'];
        $this->last_ts = $r['laststamp'];
    }
    public function updateActivity(): void {
        global $sql;
        $sql->query("UPDATE users SET laststamp = NOW() WHERE id = '$this->id'") or Logger::pushLog("On updateActivity: {$sql->error}");
    }
    public function getID(): int {
        return $this->id;
    }
    public function getTelegramID(): ?int {
        return $this->tg_id;
    }
    public function getPhone(): string {
        return $this->phone;
    }
    public function getEmail(): string {
        return $this->email;
    }
    public function getHash(): string {
        return $this->hash;
    }
    public function getRole(): int {
        return $this->role;
    }
    public function getRegistration(): string {
        return $this->reg_ts;
    }
    public function getName(): string {
        return $this->name;
    }
    public function getPatronymic(): ?string {
        return $this->patr;
    }
    public function getSurname(): string {
        return $this->surname;
    }
    public function getMiscData(): array {
        return [$this->about, $this->skills, $this->hobby, $this->goals];
    }
    public function getLastTimestamp(): ?string {
        return $this->last_ts;
    }
    public function updatePassword(string $password): void {
        global $sql;
        if (empty($password)) throw new InvalidArgumentException("Password cannot be empty!");
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql->query("UPDATE users SET hash = '$hash' WHERE id = '$this->id'") or Logger::pushLog("On updatePassword: {$sql->error}");
        $this->hash = $hash;
    }
    public function sendNotification(string $text, ?string $image_url = NULL): void {
        if (empty($text)) throw new InvalidArgumentException("Text is empty!");
        if (is_null($this->tg_id)) throw new Exception("Unable to send notification to empty telegram!");
        API::sendMessage($this->tg_id, $text, 1);
        if (!is_null($image_url)) API::sendPhoto($this->tg_id, $image_url, 1);
    }
}