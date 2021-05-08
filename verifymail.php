<?php 
 include 'connection.php';
session_start();
$stid=$_GET['artid'];
$sql2="UPDATE `stud_reg` SET `status`='approved' WHERE `stid`='$stid'";
$ap=mysqli_query($connection,"SELECT * from `stud_reg` WHERE `stid`='$stid'");

// Import PHPMailer classes into the global namespace 
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
 
require 'PHPMailer/Exception.php'; 
require 'PHPMailer/PHPMailer.php'; 
require 'PHPMailer/SMTP.php'; 
 
$mail = new PHPMailer; 
 
$mail->isSMTP();                      // Set mailer to use SMTP 
$mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers 
$mail->SMTPAuth = true;               // Enable SMTP authentication 
$mail->Username = '<Senders email address>';   // SMTP username 
$mail->Password = '<Emailpassword>';   // SMTP password 
$mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted 
$mail->Port = 587;                    // TCP port to connect to 
 
// Sender info 
$mail->setFrom('sender@emagazine.com', 'E-Magazine'); 
$mail->addReplyTo('reply@emagazine.com', 'E-Magazine'); 
while($rw = mysqli_fetch_array($ap))
   {
   	$emailId=$rw['email'];
   	$name=$rw['firstname'];
   	$pswd=$rw['password'];
   }
// Add a recipient 
$mail->addAddress($emailId); 
 
//$mail->addCC('cc@example.com'); 
//$mail->addBCC('bcc@example.com'); 
 
// Set email format to HTML 
$mail->isHTML(true); 
 
// Mail subject 
$mail->Subject = 'Email from E-Magazine System'; 
 
// Mail body content 
$bodyContent .= '<html>
<head>
<meta charset="utf-8">
</head>

<body background="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS4hVvyxHSVWVWGu8Uqq1bOi0x7KAhUG22svA&usqp=CAU" style="background-size: cover;">
    <center>
<h1 style="margin-top: 50px;">Welcome to <b style="color:crimson;">E-Magazine System</b></h1>
<p>Hai '.$name.',</p>
<p>Your account opening is Complete.. (Let us have some cheers for that)</p>
Now you can Upload your works and also View the completed works of your Friends.. <br>
Below are your credentials to access the website. Enjoy using our Website
<table border="1" style="margin-top:30px">
  <tr>
    <th scope="row">Mail From</th>
    <td>E-Magazine Admin</td>
  </tr>
  <tr>
    <th scope="row">Username</th>
    <td>'.$emailId.'</td>
  </tr>
  <tr>
    <th scope="row">Password</th>
    <td>'.$pswd.'</td>
  </tr>
</table>
<div style="margin-top:30px">
Explore from here--->> <a href="localhost\magazine\index1.html"> E-Magazine Website</a></div>
</center>
</body>
</html>'; 
$mail->Body    = $bodyContent; 
 
// Send email 
if(!$mail->send()) { 
    echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
} else { 
    echo 'Message has been sent.'; 
} 

if(mysqli_query($connection,$sql2))
{
    header("location:Vdashboard.php");
}
?>

