<?php
echo "Testing PDO...<br>";

$dsn  = "mysql:host=localhost;dbname=YOUR_DB_NAME;charset=utf8";
$user = "YOUR_DB_USER";
$pass = "YOUR_DB_PASSWORD";

try {
    $pdo = new PDO($dsn, $user, $pass);
    echo "PDO Connected Successfully!";
} catch (PDOException $e) {
    echo "PDO Error: " . $e->getMessage();
}
?>
