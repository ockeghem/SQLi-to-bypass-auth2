<?php
$pepper = base64_encode(random_bytes(18));
file_put_contents('pepper.txt', $pepper);

$userid =  'admin';
$password = base64_encode(random_bytes(24)) . $pepper;
$email = 'admin@example.jp';
$hash = password_hash($password, PASSWORD_DEFAULT);
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
try {
    $pdo = new PDO("sqlite:./db.sqlite3", null, null, $options);
    $sql = "INSERT INTO users VALUES(NULL, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userid, $hash, $email]);
    exit(0);
} catch (Exception $e) {
    echo "Error:" . $e->getMessage() . "\n";
    exit(1);
}
