<?php 
include("dbconnection.php");
$website = "http://$_SERVER[HTTP_HOST]";
$table = "";
$Game_Name = $_POST["Game_Name"];
$Author_Name = $_POST["Author_Name"];
$Game_Description = $_POST["Game_Description"];
$Game_Type = $_POST["Game_Type"];
$icon = "db/media/$Game_Name/" . $_FILES['icon']['name'];
$game = "db/media/$Game_Name/" . $_FILES['game']['name'];

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
if($result = mysqli_query($link, $queryRecreational)) {
	if(mysqli_num_rows($result)) {
	header("refresh:5;url=$website");
	echo '<h2 style="color:red">Error, the game name '.$Game_Name.' has already been taken! <br> Please re-upload with a different name...</h2>';
	echo 'Redirecting in 5 seconds...';
	exit;
	}
} else if($result = mysqli_query($link, $queryInformational)) {
	if(mysqli_num_rows($result)) {
	header("refresh:5;url=$website");
	echo '<h2 style="color:red">Error, the game name '.$Game_Name.' has already been taken! <br> Please re-upload with a different name...</h2>';
	echo 'Redirecting in 5 seconds...';
	exit;
	}
} else if($result = mysqli_query($link, $queryEducational)) {
	if(mysqli_num_rows($result)) {
	header("refresh:5;url=$website");
	echo '<h2 style="color:red">Error, the game name '.$Game_Name.' has already been taken! <br> Please re-upload with a different name...</h2>';
	echo 'Redirecting in 5 seconds...';
	exit;
	}
}

//all else is successfull, input the game into the database and file system!
$query = "INSERT INTO $table (Author_Name, Game_Name, Game_Type, Game_Description, icon, game) VALUES('$Author_Name', '$Game_Name', '$Game_Type', '$Game_Description', '$icon', '$game')";
if(mysqli_query($link, $query)) {
	header("refresh:5;url=$website");
	echo '<h2 style="color:green">Success, the game '.$Game_Name.' has been uploaded!</h2>';
	echo 'Redirecting in 5 seconds...';
	mkdir("./media/$Game_Name/"); //create directory
} else {
	header("refresh:5;url=$website");
	echo '<h2 style="color:red">Error connecting to the database...</h2>';
	echo 'Redirecting in 5 seconds...';
	exit;
}

//UPLOADING INTO FILE SYSTEM
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
  //UPLOAD ICON
  if (is_uploaded_file($_FILES['icon']['tmp_name'])) 
  { 
  	//First, Validate the file name
  	if(empty($_FILES['icon']['name']))
  	{
		header("refresh:5;url=$website");
  		echo "The icon file name is empty!";
  		exit;
  	}
 
  	$upload_file_name = $_FILES['icon']['name'];
  	//Too long file name?
  	if(strlen ($upload_file_name)>100)
  	{
		header("refresh:5;url=$website");
  		echo "The icon file name is too long!";
  		exit;
  	}
 
  	//replace any non-alpha-numeric cracters in th file name
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
  	//First, Validate the file name
  	if(empty($_FILES['game']['name']))
  	{
		header("refresh:5;url=$website");
  		echo "The game file name is empty!";
  		exit;
  	}
 
  	$upload_file_name = $_FILES['game']['name'];
  	//Too long file name?
  	if(strlen ($upload_file_name)>100)
  	{
		header("refresh:5;url=$website");
  		echo "The game file name is too long!";
  		exit;
  	}
 
  	//replace any non-alpha-numeric cracters in th file name
  	$upload_file_name = preg_replace("/[^A-Za-z0-9 \.\-_]/", '', $upload_file_name);
 
    //Save the file
    $dest=__DIR__.'/media/'.$Game_Name.'/'.$upload_file_name;
    if (move_uploaded_file($_FILES['game']['tmp_name'], $dest)) 
    {
    	//success
    }
  }
} else {
	header("refresh:5;url=$website");
	echo '<h2 style="color:red">Error, could not upload game file...</h2>';
	echo 'Redirecting in 5 seconds...';
	exit;
}
exit;
?>