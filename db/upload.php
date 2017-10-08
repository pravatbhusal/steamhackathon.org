<?php 
include("dbconnection.php");
$website = "http://$_SERVER[HTTP_HOST]";
$table = "";
$Game_Name = $_POST["Game_Name"];
$Author_Name = $_POST["Author_Name"];
$Author_Email = $_POST["Author_Email"];
$Game_Description = $_POST["Game_Description"];
$Game_Type = $_POST["Game_Type"];
$Game_Instructions = $_POST["Game_Instructions"];
$icon = "db/media/$Game_Name/" . preg_replace("/[^A-Za-z0-9 \.\-_]/", '', $_FILES['icon']['name']);
$game = "db/media/$Game_Name/" . preg_replace("/[^A-Za-z0-9 \.\-_]/", '', $_FILES['game']['name']);

//get game type
if($Game_Type == "Recreational") {
    $table = "recreational_games";
} else if($Game_Type == "Informational") {
    $table = "informational_games";
} else if($Game_Type == "Educational") {
    $table = "educational_games";
}

//check if the game name has not already been used...
$queryRecreational = "SELECT * FROM recreational_games WHERE Game_Name='$Game_Name'";
$queryInformational = "SELECT * FROM informational_games WHERE Game_Name='$Game_Name'";
$queryEducational = "SELECT * FROM educational_games WHERE Game_Name='$Game_Name'";
if($resultRecreational = mysqli_query($link, $queryRecreational)) {
	if(mysqli_num_rows($resultRecreational)) {
	header("refresh:10;url=$website");
	echo '<h2 style="color:red">Error, the game name '.$Game_Name.' has already been taken! <br> Please re-upload with a different name...</h2>';
	echo 'Redirecting in 10 seconds...';
	exit;
	}
} 
if($resultInformational = mysqli_query($link, $queryInformational)) {
	if(mysqli_num_rows($resultInformational)) {
	header("refresh:10;url=$website");
	echo '<h2 style="color:red">Error, the game name '.$Game_Name.' has already been taken! <br> Please re-upload with a different name...</h2>';
	echo 'Redirecting in 10 seconds...';
	exit;
	}
} 
if($resultEducational = mysqli_query($link, $queryEducational)) {
	if(mysqli_num_rows($resultEducational)) {
	header("refresh:10;url=$website");
	echo '<h2 style="color:red">Error, the game name '.$Game_Name.' has already been taken! <br> Please re-upload with a different name...</h2>';
	echo 'Redirecting in 10 seconds...';
	exit;
	}
}

//all else is successfull, input the game into the database and file system!
$query = "INSERT INTO $table (Author_Name, Author_Email, Game_Name, Game_Type, Game_Description, Game_Instructions, icon, game) VALUES('$Author_Name', '$Author_Email', '$Game_Name', '$Game_Type', '$Game_Description', '$Game_Instructions', '$icon', '$game')";
if(mysqli_query($link, $query)) {
	header("refresh:10;url=$website");
	echo '<h2 style="color:green">Success, the game '.$Game_Name.' has been sent for review! <br> An e-mail will be sent to '.$Author_Email.' in a while regarding the decision.</h2>';
	echo 'Redirecting in 10 seconds...';
	mkdir("./media/$Game_Name/"); //create directory
	
	//send an email to the host to ask them to approve the game
	$to = $hostEmail;
	$subject = "Game Review Request For: " . $Game_Name;
	$URL_Game_Name = str_replace(' ', '%20', $Game_Name);
	$message = "Request for game review: " . '<a href="'.$website.'/playgame.php?gameName='.$URL_Game_Name.'">'.$Game_Name.'</a>';
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: '. $Author_Email . "\r\n";
	mail($to,$subject,$message,$headers);
} else {
	header("refresh:10;url=$website");
	echo '<h2 style="color:red">Error connecting to the database...</h2>';
	echo 'Redirecting in 10 seconds...';
	exit;
}

//UPLOADING INTO FILE SYSTEM
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
  //UPLOAD ICON
  if (is_uploaded_file($_FILES['icon']['tmp_name'])) 
  { 
  	$upload_file_name = $_FILES['icon']['name'];
 
  	//replace any non-alpha-numeric cracters in the file name
  	$upload_file_name = preg_replace("/[^A-Za-z0-9 \.\-_]/", '', $upload_file_name);
 
    //Save the file
    $dest=__DIR__.'/media/'.$Game_Name.'/'.$upload_file_name;
    if (move_uploaded_file($_FILES['icon']['tmp_name'], $dest)) 
    {
    	//success
    }
  }
  
  //UPLOAD GAME
  if (is_uploaded_file($_FILES['game']['tmp_name'])) 
  { 
  	$upload_file_name = $_FILES['game']['name'];
 
  	//replace any non-alpha-numeric cracters in the file name
  	$upload_file_name = preg_replace("/[^A-Za-z0-9 \.\-_]/", '', $upload_file_name);
 
    //Save the file
    $dest=__DIR__.'/media/'.$Game_Name.'/'.$upload_file_name;
    if (move_uploaded_file($_FILES['game']['tmp_name'], $dest)) 
    {
    	//success
    }
  }
} else {
	header("refresh:10;url=$website");
	echo '<h2 style="color:red">Error, could not upload game file...</h2>';
	echo 'Redirecting in 10 seconds...';
	exit;
}
exit;
?>