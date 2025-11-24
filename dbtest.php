<?php
echo "Testing PDO...<br>";

$dsn = "mysql:host=localhost;dbname=autodeploy_db;charset=utf8";
$user = "projectuser";
$pass = "deploy";

try {
    $pdo = new PDO($dsn, $user, $pass);
    echo "PDO Connected Successfully!";
} catch (PDOException $e) {
    echo "PDO Error: " . $e->getMessage();
}
