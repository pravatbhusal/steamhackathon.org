<?php 
include("dbconnection.php");
$website = "http://$_SERVER[HTTP_HOST]";
$table = "";
$Game_Name = $_POST["Game_Name"];
$Game_Type = $_POST["Game_Type"];
$Reason = $_POST["Reason"];
$Decision = $_POST["Decision"];
$Author_Email = $_POST["Author_Email"];

//get game type
if($Game_Type == "Recreational") {
    $table = "recreational_games";
} else if($Game_Type == "Informational") {
    $table = "informational_games";
} else if($Game_Type == "Educational") {
    $table = "educational_games";
}

//update the game as either denied or approved!
$query = "UPDATE $table SET Approved='$Decision' WHERE Game_Name='$Game_Name'";

//query and email the author
if(mysqli_query($link, $query)) {
	header("refresh:10;url=$website");
	if($Decision == "true") {
		$result = "approved";
		$begin = "Congratulations";
	} else {
		$result = "denied";
		$begin = "Sorry";
	}
	
	echo '<h2 style="color:green">The game '.$Game_Name.' has been '.$result.' and the review will be sent to '.$Author_Email.'!</h2>';
	echo 'Redirecting in 10 seconds...';
	
	//send an email to the creator stating that the game was denied or approved
	$subject = $Game_Name . " was " . $result . " by STEAM Achievers!";
	$message = $begin . ", the game " . $Game_Name . " was " . $result . "! Reason: " . $Reason . " ";
	$URL_Game_Name = str_replace(' ', '%20', $Game_Name);
	if($Decision == "true") {
	$message .= "Play your game here: " . $website . "/playgame.php?gameName=" . $URL_Game_Name;
	}
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: '. "steamachievers2@gmail.com" . "\r\n";
	mail($Author_Email,$subject,$message,$headers);
} else {
	header("refresh:10;url=$website");
	echo '<h2 style="color:red">Error connecting to the database...</h2>';
	echo 'Redirecting in 10 seconds...';
	exit;
}
exit;
?>