<!DOCTYPE html>
<html>
<link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Tangerine">
<style>
body {font-family: tangerine}
* {box-sizing: border-box}


input[type=text], input[type=password] {
    width: 100%;
    padding: 19px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    border-radius:5px;
    background: #f1f1f1;
    box-shadow: none;
}



input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;
box-shadow: 1px 1px 2px black, 0 0 125px pink, 0 0 25px darkred;
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
       background-image:url('blog-signup-background.jpg');
                  background-attachment: fixed;
                  background-position: center;
                  background-repeat: no-repeat;
                  background-size: cover;
    padding-top: 50px;
    align:center;
   
}


.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; 
    border: 1px solid #888;
    width: 80%; 
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
.sel{text-align:center;font-size:56px; text-shadow: 1px 1px 2px black, 0 0 25px pink, 0 0 5px darkred;
      color:maroon;}


.close:hover,
.close:focus {
    color: #f44336;
    cursor: pointer;
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
.o{font-size:36px;font-weight:bold;color:#9395AC}
body {
  background: #76b852; 
  background: -webkit-linear-gradient(right, #76b852, #8DC26F);}
 body    {
              background-image:url('blog-signup-background.jpg');
                  background-attachment: fixed;
                  background-position: center;
                  background-repeat: no-repeat;
                  background-size: cover;
       
                  
             
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
$hero="Email must be unique";
// define variables and set to empty values
$name = $email = $psw= $ps="";
$servername = "localhost";
$username = "root";
$password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $psw= test_input($_POST["psw"]);
  $Gender=test_input($_POST["Gender"]);
  $ps=test_input($_POST["pswrepeat"]);
 
  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if($psw!=$ps){$hero="Please ensure that Password and Repeat Password must match";}
if(!empty($name) && !empty($email) && !empty($psw) && $psw==$ps){
try {
$conn = new PDO("mysql:host=$servername;dbname=a_database", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT * FROM Myusers WHERE email=:usernameEmail"); 
$stmt->bindParam("usernameEmail", $email,PDO::PARAM_STR) ;

$stmt->execute();
$count=$stmt->rowCount();
$data=$stmt->fetch(PDO::FETCH_OBJ);

if($count==0)
{

session_start();
$rndno=rand(100000, 999999);//OTP generate
$message = urlencode("otp number.".$rndno);
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->IsSMTP();
$mail->CharSet="UTF-8";
$mail->SMTPSecure = 'tls';
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->Username = 'arnabdey3408@gmail.com';
$mail->Password = 'Arnab@3408';
$mail->SMTPAuth = true;

$mail->From = 'arnabdey3408@gmail.com';
$mail->FromName = 'Arnab Dey';
$mail->AddAddress($email);
$mail->AddReplyTo($email, 'Information');

$mail->IsHTML(true);
$mail->Subject    = "Email Verification";
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
$mail->Body    = "The OTP is ".$rndno." So quickly fill this up register for my app";

if(!$mail->Send())
{
  echo "Mailer Error: " . $mail->ErrorInfo;
}

$_SESSION['name']=$name;
$_SESSION['email']=$email;
$_SESSION['Gender']=$Gender;
$_SESSION['psw']=$psw;
$_SESSION['otp']=$rndno;
header( "refresh:1;url=otst.php"  ); 
}

else
{
$hero="Email is already registered";

} 
}
catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}';
}
}


?>
<h1 class ="self">Signup Form</h1><h1 class="sel"><?php echo $hero;?></h1><br><BR>

<center><button onclick="document.getElementById('id01').style.display='block'" style="width:auto;" class="kl">Sign Up</button><a href="login.php"><button style="width:auto;" class="kl" id="blue">Log In</button></a></center>

<div id="id01" class="modal">
<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
  <form method="post" autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="container">
      <h1 class="sel">Sign Up</h1>
      <p class="sel">Please fill in this form to create an account.</p>
      <hr>
      <label for="name"><b>Name</b></label>
      <input type="text" placeholder="Enter Name" name="name" required>
      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" required>
      <label for="Gender"><b>Gender</b></label><br><br>
      <input type="radio" name="Gender" value="male">  <b class="o">Male</b> <input type="radio" name="Gender" value="female"> <b class="o">Female</b> <input type="radio" name="Gender" value="Other" checked> <b class="o">Other</b>

<br><br>
      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>

      <label for="pswrepeat"><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="pswrepeat" required>
      
      <label>
        <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
      </label>

      <p class="sel">By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Sign Up</button>
      </div>
    </div>
  </form>
</div>


</body>
</html>