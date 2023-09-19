<?php
session_start();
$id = $_SESSION['id'] ?? null;  
if (empty($id)) {
    exit("ログインしていません<br><a href='/'>トップ</a>");
}
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
try {
    $pdo = new PDO("sqlite:../db.sqlite3", null, null, $options);
    $sql = "SELECT * FROM users WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $user = $stmt->fetch();
    if (empty($user)) {
        exit("ユーザがありません");
    }
} catch (Exception $e) {
    echo "エラー:" . htmlspecialchars($e->getMessage());
    exit;
}?><body>
こんにちは<?php echo htmlspecialchars($user['userid']); ?>さん<br>
メールアドレス:<?php echo htmlspecialchars($user['email']); ?>
<form action="logout.php" method="post">
    <button>ログアウト</button>
</form>
</body>
