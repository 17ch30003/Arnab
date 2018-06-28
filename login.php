<?php ob_start();?>
<!DOCTYPE html>
<html><link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Tangerine">
    
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
.kl {
background-color: #11720A; 
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
    padding-left:60px;padding-right:60px;
   cursor: pointer;
}
#blue{background-color: #070F7C; }
.kl:hover {}
.kl:active {
  
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
 body    {
              background-image:url('blog-signup-background.jpg');
                  background-attachment: fixed;
                  background-position: center;
                  background-repeat: no-repeat;
                  background-size: cover;
       
                  
             
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
.self{
       font-family:Tangerine;
       font-size:66px;
       color:blue;
       text-align:center;
       padding:50px;
       background: #D7C4C4;
       max-width: 360px;
       margin: 0 auto 100px;
       box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
     }

.modal {
    display: none; 
    position: fixed; 
    z-index: 1; 
    left: 0;
    top: 0;
       background-image:url('blog-signup-background.jpg');
                  background-attachment: fixed;
                  background-position: center;
                  background-repeat: no-repeat;
                  background-size: cover;
    width: 100%; 
    height: 100%; 
    overflow: auto; 
    background-color: #474e5d;
    padding-top: 50px;
}
#kl{background-color:blue;}

.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}
.sel{text-align:center;font-size:56px; text-shadow: 1px 1px 2px black, 0 0 25px pink, 0 0 5px darkred;
      color:maroon;font-family:Tangerine;}


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
label{font-size:51px; font-family:Tangerine; color:maroon;text-shadow: 1px 1px 2px black, 0 0 5px pink, 0 0 5px darkred;}

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
$username = "id5761627_root";
$password = "Arnab@3408";
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
$conn = new PDO("mysql:host=$servername;dbname=id5761627_a_database", $username, $password);
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
ob_enf_fluch();
}
else
{  
header("Location:users.php");

} 
}
catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}';
}

}

?>
<h2 class="self">Login Form</h2>
<h1 class="sel">Guys so u can login now</h1><br>
<center><button onclick="document.getElementById('id01').style.display='block'" style="width:auto;" class="kl">Login</button><a href="users.php"><button style="width:auto;" class="kl" id="blue">Sign up</button></a></center></center>

<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
  
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="container">
      <h1 style="font-family:Tangerine;color:grey;font-weight:bold;text-align:center;font-size:88px;text-shadow: 1px 1px 2px black, 0 0 15px pink, 0 0 5px darkred;">Login Page</h1>
      <p style="font-family:Tangerine;color:grey;font-weight:bold;font-size:28px;">Please fill in this form to login.</p>
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