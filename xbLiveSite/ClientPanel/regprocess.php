<?php
session_start();
include "includes/database.php";
include "includes/settings.php";

/*ini_set is used for debugging */
//ini_set('display_errors', 1); ini_set('log_errors',1); error_reporting(E_ALL); mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);



$err ='';
/*use this if phpmailer was installed with composer */
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

$data = $_POST['confirm'];

if ($data != 'TeamXbLive') 
{
	$err .= "ERROR - invalid Security Answer";
	
}
	  
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
$usr_email = $_POST['usr_email'];
$user_name = $_POST['user_name'];

/************ USER EMAIL CHECK ************************************
This code does a second check on the server side if the email already exists. It 
queries the database and if it has any existing email it throws user email already exists
*******************************************************************/


/*Fetch UserID */
$GetInfo = mysqli_query($con, "SELECT * FROM `users` WHERE `cpu` = '$CPU_Key' LIMIT 1");
$clientinfo = mysqli_fetch_array($GetInfo);
$user_id = $clientinfo['id'];

/*Check for duplicate CPUKeys */
$CPU_Key_first = mysqli_query($con, "SELECT * FROM `users` WHERE `cpu` = '$CPU_Key'");
$CPU_Key_first = mysqli_num_rows($CPU_Key_first);

/*Check for duplicate Email */
$check_email_first = mysqli_query($con, "SELECT * FROM `users` WHERE `Email` = '$usr_email'");
$check_email_first = mysqli_num_rows($check_email_first);

/*Check for duplicate Username */
$check_username_first = mysqli_query($con, "SELECT * FROM `users` WHERE `Username` = '$user_name'");
$check_username_first = mysqli_num_rows($check_username_first);


if ($CPU_Key_first < 1)
{
$err = "ERROR - CPUKey doesn't exist. Please connect with RGH/Jtag first.<br/>";
//header("Location: register.php?msg=$err");
echo $err;
echo '<a href="register.php" class="Register" >Fill out the registration again</a>';
exit();
}


if ($check_username_first > 0)
{
$err = "ERROR - The username already exists. Please try again with different username and email.<br/>";
//header("Location: register.php?msg=$err");
echo $err;
echo '<a href="register.php" class="Register" >Fill out the registration again</a>';
exit();
}

if ($check_email_first > 0)
{
$err = "ERROR - The email already exists. Please try again with different username and email.<br/>";
//header("Location: register.php?msg=$err");
echo $err;
echo '<a href="register.php" class="Register" >Fill out the registration again</a>';
exit();
}

// TURN OFF STRICT MYSQL MODE
//$strict = "SET sql_mode = ''";
//mysqli_query($con, $strict);
/***************************************************************************/

if(empty($err))
 {


$sql_update = mysqli_query($con, "UPDATE `users` SET `cpu`='$CPU_Key' ,`Username`='$user_name',`password`='$shapass', `Email`='$usr_email',`activationcode`='$activ_code' WHERE `cpu` = '".$CPU_Key."'");
										

/*Generate Random Md5 Hash */
$md5_id = md5($user_id);
$result = mysqli_query($con, "UPDATE `users` SET `md5_id`='$md5_id' WHERE `cpu` = '".$CPU_Key."'");
		

//echo "<h3>Thank You</h3> We received your submission.";
$img = "http://$host/xbLive/ClientPanel/xbLive.png";
$to = $usr_email;
$subject = "Activation Required";
$message = '
	<html>
	<head>
	  <title>Activation Required for Site</title>
	</head>
	<body>
	  <p> Thanks for Registering with  '.$host.' <BR />
	  Once you activate you will be able to Play online!<BR /></p>
	  <BR />
	  <table>
	  <TR>
	    <td ALIGN="left">User Name</td>
	    <td> : </td>
	    <td ALIGN="left">'.$user_name.'</td>
	  </tr><tr>
	    <td ALIGN="left">Email Address: </td>
	    <td> : </td>
	    <td ALIGN="left">'.$usr_email.'</td>
	  </tr><tr>
	    <td ALIGN="left">User Password: </td>
	    <td> : </td>
	    <td ALIGN="left">'.$pass.'</td>
	  </td></table>
	  <BR /><BR />';

$message .= '<a href="http://'.$host.'/xbLive/ClientPanel/checkregistration.php?user='.$md5_id.'&activ_code='.$activ_code.'">*****ACTIVATION LINK*****<BR /><BR /></a>';
$message .= '<p>If the link does not work paste this in your browser.<BR /> http://'.$host.'/xbLive/ClientPanel/checkregistration.php?user='.$md5_id.'&activ_code='.$activ_code.'</p>';
$message .=  '<img src='.$img.'><br>'; 
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

$mail->SetFrom("noreply@silentlive.gq", "NoReply");
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

echo "<h3>Thank You</h3> We received your submission. An Activation email has been sent! Please close this window!";

} else {
   echo "<font='3'>";
   echo "<div class=\"msg\">";
   echo $err." <br>";
   echo "</div><br/>";
   echo '<a href="register.php" class="Register" >Fill out the registration again</a>';
   echo "</font>";
}

?>