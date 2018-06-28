<!DOCTYPE html>
<html>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box}

input[type=text], input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}


input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;
}


button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
}

button:hover {
    opacity:1;
}

.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}

.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}


.container {
    padding: 16px;
}


.modal {
    display: none; 
    position: fixed; 
    z-index: 1; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    overflow: auto; 
    background-color: #474e5d;
    padding-top: 50px;
}


.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}


hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}
 

.close {
    position: absolute;
    right: 35px;
    top: 15px;
    font-size: 40px;
    font-weight: bold;
    color: #f1f1f1;
}

.close:hover,
.close:focus {
    color: #f44336;
    cursor: pointer;
}


.clearfix::after {
    content: "";
    clear: both;
    display: table;
}


@media screen and (max-width: 300px) {
    .cancelbtn, .signupbtn {
       width: 100%;
    }
}
</style>
<body>
<?php
$name = $psw ="";
$servername = "localhost";
$username = "root";
$password = "";
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" ){
  $name = test_input($_POST["username"]);
  $psw = test_input($_POST["password"]);

  



try {
$conn = new PDO("mysql:host=$servername;dbname=a_database", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT * FROM myusers WHERE email=:usernameEmail AND password=:hash_password"); 
$stmt->bindParam("usernameEmail", $name,PDO::PARAM_STR) ;
$stmt->bindParam("hash_password", $psw,PDO::PARAM_STR) ;
$stmt->execute();
$count=$stmt->rowCount();
$data=$stmt->fetch(PDO::FETCH_OBJ);

if($count)
{session_start();
$_SESSION["username"] = $name;
header( "Location:task.php?user=".$name); 
}
else
{  

header( "Location: users.php");
} 
}
catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}';
}

}

?>
<h2>Modal Signup Form</h2>

<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>

<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="container">
      <h1>Login</h1>
      <p>Please fill in this form to login.</p>
      <hr>
      <label for="username"><b>Username</b></label>
      <input type="text" placeholder="Enter Email" name="username" required>
      

      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>


      
      <label>
        <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
      </label>

  

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Login</button>
      </div>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>