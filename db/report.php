<?php 
include("dbconnection.php");
$website = "http://$_SERVER[HTTP_HOST]";
$Game_Name = $_POST["Game_Name"];
$Reason = $_POST["Reason"];


	//send an email to the host email with the report request
	$subject = $Game_Name . " has been reported!";
	$message = "Reason: " . $Reason . " ";
	$URL_Game_Name = str_replace(' ', '%20', $Game_Name);
	$message .= "Review the game here: " . '<a href="'.$website.'/reviewgame.php?gameName='.$URL_Game_Name.'">'.$Game_Name.'</a>';
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: '. $hostEmail . "\r\n";
	mail($hostEmail,$subject,$message,$headers);
?>