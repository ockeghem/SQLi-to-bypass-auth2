<?php
$pepper = file_get_contents('../pepper.txt');

$userid =  $_POST['userid'];
$password = $_POST['password'] . $pepper;
$email = $_POST['email'];
$hash = password_hash($password, PASSWORD_DEFAULT);
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
try {
    $pdo = new PDO("sqlite:../db.sqlite3", null, null, $options);
    $sql = "INSERT INTO users VALUES(NULL, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userid, $hash, $email]);
    echo "登録しました<br><a href='/'>トップ</a>";
} catch (Exception $e) {
    echo "エラー:" . htmlspecialchars($e->getMessage());
}
