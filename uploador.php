<?php ob_start();?>
<?php
$use=$_GET['user'];
$id = $_GET['id'];
if(isset($_POST["submit"]) ){
echo "yes";
$imgFile = $_FILES['image']['name'];
$tmp_dir = $_FILES['image']['tmp_name'];
$imgSize = $_FILES['image']['size'];
if(!empty($imgFile)){
$upload_dir = 'user_images/';
   $imgext = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 
   $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');
   $userpic = rand(1000,1000000).".".$imgext;
   if(in_array($imgext, $valid_extensions)){
$userpic = rand(1000,1000000).".".$imgext;  
   move_uploaded_file($tmp_dir,$upload_dir.$userpic); }
$servername="localhost";
$username="id5761627_root";
$password="Arnab@3408";
try {
echo "o.k.";
$conn = new PDO("mysql:host=$servername;dbname=id5761627_a_database", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("UPDATE `$use` SET Profile=:upic WHERE id=:id"); 
$stmt->bindParam(":upic", $userpic) ;
$stmt->bindParam(":id", $id) ;
$stmt->execute();
}
catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}';
}
}
header('location: task.php?user='.$use);
}

?>
<!DOCTYPE html>
<html>
<body>

<form action="uploador.php?user=<?php echo $use?>&id=<?php echo $id?>" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="image" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>