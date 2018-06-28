<?php
session_start();
$use=$_GET['user'];
$id = $_GET['id'];

$servername = "localhost";
$username = "root";
$password = "";
$edit=date("Y/m/d");
try {
$conn = new PDO("mysql:host=$servername;dbname=a_database", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "UPDATE `$use` SET Complete = :task 
			WHERE id = :id";
$stmt = $conn->prepare($sql);									 
$stmt->bindParam(':task', $edit, PDO::PARAM_STR);		
$stmt->bindParam(':id', $id, PDO::PARAM_STR);	
	
$stmt->execute();
header('location: task.php?user='.$use);
}
catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}';
}

?>
