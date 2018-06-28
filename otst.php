<?php
session_start();
$name = $email = $psw= "";
$servername = "localhost";
$username = "id5761627_root";
$password = "Arnab@3408";
if(!isset($_SESSION['otp'])){
header( "Location: login.php");}
if(isset($_POST['save']))
{
$rno=$_SESSION['otp'];
$urno=$_POST['otpvalue'];
if(!strcmp($rno,$urno))
{
$name=$_SESSION['name'];
$email=$_SESSION['email'];
$Gender=$_SESSION['Gender'];
$psw=$_SESSION['psw'];
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
$mail->Subject    = "Welcome ".$email;
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
$mail->Body    = "Thanks ".$name." for registering. I am Arnab and u can get in touch with me through this mail-id. Hope u will enjoy the services of my to do list";

if(!$mail->Send())
{
  echo "Mailer Eror: " . $mail->ErrorInfo;
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=id5761627_a_database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO myusers (Name, email, Gender, password)
    VALUES ('$name','$email', '$Gender', '$psw')";
    $conn->exec($sql);

     
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
    $conn = new PDO("mysql:host=$servername;dbname=id5761627_a_database", $username, $password);
$sql="CREATE TABLE `$email` (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    Task VARCHAR(30) NOT NULL, Profile BLOB NOT NULL, Date DATE NOT NULL,  Complete DATE NOT NULL)";
   $conn->exec($sql);

unset($_SESSION['name']);
session_destroy();
header("Location:login.php");
}
else{

$message="<p ><b>Invalid OTP</b></p>";
}
}
//resend OTP
if(isset($_POST['resend']))
{
$email=$_SESSION['email'];
$message="<p>Sucessfully send OTP to your mail.</p>";
$rno=$_SESSION['otp'];
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
$mail->Body    = "Ur OTP IS ".$rno." Its a request don't press the resend button frequently";

if(!$mail->Send())
{
  echo "Mailer Eror: " . $mail->ErrorInfo;
}
$message="<p ><b>Sucessfully resend OTP to your mail.</b></p>";
}
?>
<!DOCTYPE html>
<html>

<title>OTP</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Tangerine">
<style>

a{
text-decoration:none;
}

input[type=text], input[type=password] {
    width: 40%;
    margin:auto;
    padding: 25px;
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
.form {
  position: relative;
  z-index: 1;
  color:blue;
  font-size:33;
  font-family:Tangerine;
  background: grey;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 15px;
  padding-left:0px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
h2{font-size:53px;}

button {
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
    width:40%;
   cursor: pointer;
}

button:hover {}

button:active {
  
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
body {
  background: #76b852; 
  background: -webkit-linear-gradient(right, #76b852, #8DC26F);}

</style>
<header>
<body>
<br>
<div class="w3-row">
<div class="login-page">
<div class="form">
<h2>Email &nbsp Verify</h2>
</div>
<form class="register-form" method="post" action="">
<center><input type="password" placeholder="OTP" name="otpvalue">
<p class="w3-center"><center><button name="save">Submit</button></p>
<p class="w3-center"><button name="resend">Resend</button></p>
</form>
<div><?php if(isset($message)) { echo $message; } ?>
</div>
<br>

</div>
<div class="w3-half">
</div>
</div>
</body>
</html>