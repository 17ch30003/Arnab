<?php ob_start();?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dancing Script:"> <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Tangerine">
</head>
<style>
 body    {
              background-image:url('blog-signup-background.jpg');
                  background-attachment: fixed;
                  background-position: center;
                  background-repeat: no-repeat;
                  background-size: cover;
       
                  
             
         }
body {
  margin: 0;
  min-width: 250px;
}

/* Include the padding and border in an element's total width and height */
* {
  box-sizing: border-box;
}
.c{float:right;}
.b{float:middle;}
.close:hover {
  background-color: #f44336;
  color: white;
}

/* Style the header */
.header {
  background-color: #f44336;
  padding: 30px 40px;
  color: white;
  text-align: center;
}

/* Clear floats after the header */
.header:after {
  content: "";
  display: table;
  clear: both;
}
#class{
  display:inline;
}

.button {
background-color: #11720A; 
    margin:auto;
justify-content: center;
    align:center;
    font-family:Tangerine;
    border: none;
    color: white;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #CBE1C9;
    padding:23px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 36px;
    width:300px;
   cursor: pointer;
}

.button:hover {}

.button:active {
  
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
/* Style the input */
input {
  margin: 0;
  border: none;
  border-radius: 0;
  width: 75%;
  padding: 10px;
  float: left;
  font-size: 16px;
}
.po{color:maroon ;text-shadow: 1px 1px 2px black, 0 0 10px pink, 0 0 5px darkred;font-family:Dancing Script;font-weight:bold;font-size:43;}
#in{width:150px;padding:10px;font-size:16px;background-color:blue; box-shadow: 0 7px #CBE1C9;}
#in:active {
  
  box-shadow: 0 3px #666;
  transform: translateY(4px);
}


/* Style the "Add" button */
.addBtn {
  padding: 10px;
  width: 25%;
  background: #d9d9d9;
  color: #555;
  float: left;
  text-align: center;
  font-size: 16px;
  cursor: pointer;
  transition: 0.3s;
  border-radius: 0;
}

.addBtn:hover {
  background-color: #bbb;
}
input[type="submit"] {
    align:center;
    margin:auto;
}
@media screen and (max-width:550px) {
   .po {
        font-size: 26px;
    }
}
#me{text-align:center;margin:auto;}
</style>
</head>
<body>

<?php
session_start();
if(isset($_POST["logout"])){unset($_SESSION["username"]);header("Location:login.php");}
if(!isset($_SESSION["username"]) || !isset($_GET["user"])){header("Location:login.php");}
$u=$_SESSION["username"];
$use=$_GET['user'];echo $use;
$name = $email = $psw= "";
$servername = "localhost";
$username = "id5761627_root";
$password = "Arnab@3408";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);


  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if(!empty($name)){
try {
$conn = new PDO("mysql:host=$servername;dbname=id5761627_a_database", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT * FROM `$use` WHERE Task=:usernameEmail"); 
$stmt->bindParam("usernameEmail", $name,PDO::PARAM_STR) ;

$stmt->execute();
$count=$stmt->rowCount();
$data=$stmt->fetch(PDO::FETCH_OBJ);

if($count==0)
{

try {
    $datae= date("Y/m/d");
    $conn = new PDO("mysql:host=$servername;dbname=id5761627_a_database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO `$use` (Task, Date)
    VALUES ('$name', '$datae')";
    // use exec() because no results are returned
    $conn->exec($sql);
     
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }}}
catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}';
}}
?>


<div id="myDIV" class="header">
  <h2 style="margin:5px">My To Do List</h2>
  <form method="post" action="task.php?user=<?php echo $use?>">
  <input type="text" id="myInput" name="name" placeholder="Title...">
  <input type="submit" class="addBtn" value="Add"></form>
</div>
<?php 

$servername = "localhost";
$username = "id5761627_root";
$password = "Arnab@3408";
$conn = new PDO("mysql:host=$servername;dbname=id5761627_a_database", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT * FROM myusers WHERE email=:email"); 
$stmt->bindParam("email", $use,PDO::PARAM_STR) ;
$stmt->execute();
$row = $stmt->fetch();
$image=$row['Profile']; 

?>
<center><h1 style='color:darkred;font-family:Dancing Script;font-weight:bold;font-size:43;text-shadow: 1px 1px 2px black, 0 0 10px pink, 0 0 5px darkred;'><?php echo "Welcome ".$use?></h1>
<img src="user_images/<?php if(!empty($image)){echo $image;} else echo "download.jpg" ?>" height="200" width="200"></center><br>
	<?php 

$servername = "localhost";
$username = "id5761627_root";
$password = "Arnab@3408";
$conn = new PDO("mysql:host=$servername;dbname=id5761627_a_database", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT * FROM `$use`"); 
$stmt->execute();
		$i = 1; while ($row = $stmt->fetch()) { ?>
			<span class="a"><?php echo  "<h1 class='po'>".$i;if($i==1){echo "&nbsp";} ?> </span>
				<span class="b"><a href="edit.php?id=<?php echo $row['id']; ?>&user=<?php echo $use ;?>"><img src="Edit-icon.png" height=30 width=30></a> 
				 <?php echo $row['Task']; ?> </center></span>
				
                                          <span class="c"><a href="delete.php?id=<?php echo $row['id']; ?>&user=<?php echo $use ;?>"><img src="delete-button-png-delete-button-png-image-689.png" height=40 width=50></a><br></h1></span>
                                <center><h1 class='po'>Created on : <?php echo $row['Date'];?></h1></center>
                                <?php if($row['Complete']!=0000-00-00)echo  "<center><h1 class='po'>Completed on : ".$row['Complete']."</h1></center>";?>
				<center><img src="user_images/<?php $image=$row['Profile'];if(!empty($image)){echo $image;} else echo "question-606955_960_720 (1).png" ?>" width="130" height="130"><br><a href="uploador.php?id=<?php echo $row['id']; ?>&user=<?php echo $use ;?>"><button class="button" id="in">Insert</button></a></center>
				<center><a href="dater.php?id=<?php echo $row['id']; ?>&user=<?php echo $use ;?>"><?php if($row['Complete']==0000-00-00){echo "<br><img src='done-button-png-hi.png' width='150' height='50'>";}?></a>	</center>
			
		<?php $i++; } ?>
<?php

if(isset($_POST["logout"])){unset($_SESSION["username"]);header("Location:login.php");}
?>
<br><br><a href="uploado.php?user=<?php echo $use ;?>"><center><button class="button">Profile photo update</button></center></a><br><br><br><br>

<form method="POST" action="task.php">	
<center><button class="button" name="logout">Log Out</button></form><br><br><br><br><br><br>

</body>
</html>
