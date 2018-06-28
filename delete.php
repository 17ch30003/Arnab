<?php
$servername = "localhost";
$username = "root";
$password = "";
$id = $_GET['id'];
$use=$_GET['user'];

try {
$conn = new PDO("mysql:host=$servername;dbname=a_database", $username, $password);
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