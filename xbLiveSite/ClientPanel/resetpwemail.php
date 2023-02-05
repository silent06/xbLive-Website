<?php
session_start();
include "includes/database.php";
include "includes/settings.php";

/*ini_set is used for debugging */
//ini_set('display_errors', 1); ini_set('log_errors',1); error_reporting(E_ALL); mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);



$err ='';
require '/var/www/composer/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


/*Exception class, PHPMailer class & SMTP class are for if you set up phpmailer manually */

/* Exception class. */
//require 'C:\LAMP\APACHE\htdocs\phpmailer\src\Exception.php';

/* The main PHPMailer class. */
//require 'C:\LAMP\APACHE\htdocs\phpmailer\src\PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
//require 'C:\LAMP\APACHE\htdocs\phpmailer\src\SMTP.php';

$mail = new PHPMailer(TRUE);

//$data = $_POST['confirm'];

	  
$user_ip = $_SERVER['REMOTE_ADDR'];


$pass = mysqli_real_escape_string($con, htmlspecialchars($_POST['pwd']));

// stores 512 of password
$shapass = openssl_digest($pass, "SHA512");


// Automatically collects the hostname or domain  like example.com) 
$host  = $_SERVER['HTTP_HOST'];
$host_upper = strtoupper($host);

// Generates activation code simple 4 digit number
$activ_code = rand(1000,9999);
$CPU_Key = $_POST['CPU_Key'];

/************ USER EMAIL CHECK ************************************
This code does a second check on the server side if the email already exists. It 
queries the database and if it has any existing email it throws user email already exists
*******************************************************************/


/*Fetch UserInfo */
$GetInfo = mysqli_query($con, "SELECT * FROM `users` WHERE `cpu` = '$CPU_Key' LIMIT 1");
$clientinfo = mysqli_fetch_array($GetInfo);
$user_id = $clientinfo['id'];
$usr_Name = $clientinfo['Username'];
$usr_email = $clientinfo['Email'];

/*Check for duplicate CPUKeys */
$CPU_Key_first = mysqli_query($con, "SELECT * FROM `users` WHERE `cpu` = '$CPU_Key'");
$CPU_Key_first = mysqli_num_rows($CPU_Key_first);



if ($CPU_Key_first < 1)
{
$err = "ERROR - CPUKey doesn't exist. Please connect with RGH/Jtag first.<br/>";
//header("Location: register.php?msg=$err");
echo $err;
echo '<a href="register.php" class="Register" >Fill out the registration here</a>';
exit();
}


// TURN OFF STRICT MYSQL MODE
//$strict = "SET sql_mode = ''";
//mysqli_query($con, $strict);
/***************************************************************************/

if(empty($err))
 {


$sql_update = mysqli_query($con, "UPDATE `users` SET `cpu`='$CPU_Key',`activationcode`='$activ_code' WHERE `cpu` = '".$CPU_Key."'");
										

/*Generate Random Md5 Hash */
$md5_id = md5($user_id);
$result = mysqli_query($con, "UPDATE `users` SET `md5_id`='$md5_id' WHERE `cpu` = '".$CPU_Key."'");								

//,`password`='$shapass'		

//echo "<h3>Thank You</h3> We received your submission.";
$img = "http://$host/xbLive/ClientPanel/xbLive.png";
$to = $usr_email;
$subject = "Password Reset";
$message = '
	<html>
	<head>
	  <title>Password Reset for '.$host.'</title>
	</head>
	<body>
	  <p> Reset Request for User: '.$usr_Name.' <BR />
	  Your Password Has been updated! If this wasnt you please contact admin right away! <BR /></p>
	  <BR />
	  <table>
        <tr>
	    <td ALIGN="left">New User Password: </td>
	    <td> : </td>
	    <td ALIGN="left">'.$pass.'</td>
	  </td></table>
	  <BR /><BR />';

$message .= '<a href="http://'.$host.'/xbLive/ClientPanel/checkpwreset.php?user='.$md5_id.'&pwcheck='.$shapass.'&activ_code='.$activ_code.'">*****ACTIVATION LINK*****<BR /><BR /></a>';
$message .= '<p>If the link does not work paste this in your browser.<BR /> http://'.$host.'/xbLive/ClientPanel/checkpwreset.php?user='.$md5_id.'&pwcheck='.$shapass.'&activ_code='.$activ_code.'</p>';
$message .=  '<img src='.$img.'><br>'; 
//$message .= "<a href='$img'>Can't see the image? Click Here.</a>";
$message .='
	  <p>Thank You

	     Administrator<BR/>
	     '.$host.'<BR/>
	     ______________________________________________________<BR/>
	     THIS IS AN AUTOMATED RESPONSE. <BR/>
	     ***DO NOT RESPOND TO THIS EMAIL****<BR/>
	  </p>
	</body>
	</html>
	';
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = "localhost";
$mail->Port = 25;
$mail->SMTPSecure = "tls";
//$mail->SMTPAuth= true;
//$mail->Host = '127.0.0.1';
//$mail->Port = 25;
//$mail->Username = '';
//$mail->Password = '';
$mail->SMTPOptions = array
  (
    'ssl' => array
    (
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
    )
  );

$mail->SetFrom("noreply@$host", "NoReply");
$mail->Subject = $subject;
$mail->Body = $message;
$mail->AddAddress($to);
$mail->IsHTML(true);
$mail->Send();
//$mail->Send();/*this is here cause my mail server does greylisted protocals disable if greylisted isn't setup */


/*Used for debuggging. */
//if ($mail->send())
	// SMTP message send success
//{
// Put success logic here
//} 
//else
// SMTP message send failure
//{
	// Put failure logic here
	//echo "Failed to send email. Please check mail settings!";
//}

echo "<h3>Thank You</h3> Confirmation email has been sent! Please close window!";

} else {
   echo "<font='3'>";
   echo "<div class=\"msg\">";
   echo $err." <br>";
   echo "</div><br/>";
   echo '<a href="resetpassword.php" class="Register" >Error, try again</a>';
   echo "</font>";
}

?>