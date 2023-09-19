<?php
session_start();
$pepper = file_get_contents('../pepper.txt');

$userid =  $_POST['userid'];
$password = $_POST['password'] . $pepper;
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
try {
    $pdo = new PDO("sqlite:../db.sqlite3", null, null, $options);
    $sql = "SELECT * FROM users WHERE userid = '$userid'";
    $stmt = $pdo->query($sql);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['id'] = $user['id'];
    } else {
        echo "ログイン失敗";
        exit;
    }
} catch (Exception $e) {
    echo "エラー:" . htmlspecialchars($e->getMessage());
    exit;
}?><body>
ログイン成功:<?php echo htmlspecialchars($user['userid']); ?><br>
<a href="mypage.php">マイページ</a>
</body>
