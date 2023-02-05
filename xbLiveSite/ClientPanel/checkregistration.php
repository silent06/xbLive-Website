<?php
include 'includes/database.php';
include 'includes/settings.php';

$checkMd5 = $_GET["user"];/*MD5 hash generated from email*/
$activ_code = $_GET["activ_code"];

$sql = "SELECT * FROM `users` WHERE `md5_id`='" . $checkMd5 . "' LIMIT 1";
$result = $con->query($sql);
            
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		echo "Activation Code: ".($row["activationcode"]). "       Confirmed!\n";
        echo "Registeration Complete! Please close window!";
	}
}else{
	echo "Not Registered";
}
?>