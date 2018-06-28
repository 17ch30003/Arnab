

<?php
session_start();
$use=$_GET['user'];
$id = $_GET['id'];
echo $id;
if (isset($_POST["name"])) {
  $name = test_input($_POST["name"]);


  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if(!empty($name)){
$servername = "localhost";
$username = "root";
$password = "";


$edit=$name;
try {
$conn = new PDO("mysql:host=$servername;dbname=a_database", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "UPDATE `$use` SET Task = :task 
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
}
?>
<html>
<body>
<form action="edit.php?id=<?php echo $id ?>&user=<?php echo $use?>" method="POST">
<input type="text" name="name"><input type="submit" value="submit">
</form>
</body>
</html>