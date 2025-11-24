<?php
// --- Database Configuration (safe placeholders for public repo) ---
$dsn  = "mysql:host=localhost;dbname=YOUR_DB_NAME";
$user = "YOUR_DB_USER";
$pass = "YOUR_DB_PASSWORD";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $query = $pdo->query("SELECT * FROM users ORDER BY id DESC");
    $records = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Stored User Records</title>
<style>
body { font-family: Arial; background:#f2f2f2; text-align:center; padding:40px; }
table { width:90%; margin:auto; border-collapse:collapse; background:#fff; box-shadow:0 4px 12px rgba(0,0,0,0.1); }
th, td { padding:12px; border:1px solid #ddd; }
th { background:#007bff; color:white; }
tr:hover { background:#f1f1f1; }
a { text-decoration:none; color:#007bff; }
</style>
</head>
<body>

<h2>📄 Stored User Records</h2>
<p><a href="index.php">⬅ Back to Home</a></p>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Birthdate</th>
    <th>Zodiac</th>
    <th>Created At</th>
</tr>

<?php foreach ($records as $row) { ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= htmlspecialchars($row['name']) ?></td>
    <td><?= htmlspecialchars($row['email']) ?></td>
    <td><?= $row['birthdate'] ?></td>
    <td><?= $row['zodiac'] ?></td>
    <td><?= $row['created_at'] ?></td>
</tr>
<?php } ?>

</table>

</body>
</html>
