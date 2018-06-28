<?php ob_start();?>
<?php
$servername = "localhost";
$username = "id5761627_root";
$password = "Arnab@3408";
$id = $_GET['id'];
$use=$_GET['user'];

try {
$conn = new PDO("mysql:host=$servername;dbname=id5761627_a_database", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$id = $_GET['id'];
$sql = "DELETE FROM `$use` WHERE id=$id";
$conn->exec($sql);
header("location: task.php?user=".$use);
}
catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}';
}
?>