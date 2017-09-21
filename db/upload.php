<?php 
include("dbconnection.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
  //UPLOAD ICON
  if (is_uploaded_file($_FILES['icon']['tmp_name'])) 
  { 
  	//First, Validate the file name
  	if(empty($_FILES['icon']['name']))
  	{
  		echo " File name is empty! ";
  		exit;
  	}
 
  	$upload_file_name = $_FILES['icon']['name'];
  	//Too long file name?
  	if(strlen ($upload_file_name)>100)
  	{
  		echo " too long file name ";
  		exit;
  	}
 
  	//replace any non-alpha-numeric cracters in th file name
  	$upload_file_name = preg_replace("/[^A-Za-z0-9 \.\-_]/", '', $upload_file_name);
 
  	//set a limit to the file upload size
  	if ($_FILES['icon']['size'] > 1000000) 
  	{
		echo " too big file ";
  		exit;        
    }
 
    //Save the file
    $dest=__DIR__.'/media/icons/'.$upload_file_name;
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
  		echo " File name is empty! ";
  		exit;
  	}
 
  	$upload_file_name = $_FILES['game']['name'];
  	//Too long file name?
  	if(strlen ($upload_file_name)>100)
  	{
  		echo " too long file name ";
  		exit;
  	}
 
  	//replace any non-alpha-numeric cracters in th file name
  	$upload_file_name = preg_replace("/[^A-Za-z0-9 \.\-_]/", '', $upload_file_name);
 
  	//set a limit to the file upload size
  	if ($_FILES['game']['size'] > 1000000) 
  	{
		echo " too big file ";
  		exit;        
    }
 
    //Save the file
    $dest=__DIR__.'/media/games/'.$upload_file_name;
    if (move_uploaded_file($_FILES['game']['tmp_name'], $dest)) 
    {
    	//success
    }
  }
}

//insert the files and game information into the database
$Game_Name = $_POST["Game_Name"];
$Author_Name = $_POST["Author_Name"];
$Game_Description = $_POST["Game_Description"];
$Game_Type = $_POST["Game_Type"];
$icon = "db/media/icons/" . $_FILES['icon']['name'];
$game = "db/media/games/" . $_FILES['game']['name'];
$table = "";

if($Game_Type == "Recreational") {
    $table = "recreational_games";
} else if($Game_Type == "Informational") {
    $table = "informational_games";
} else if($Game_Type == "Educational") {
    $table = "educational_games";   
}

$query = "INSERT INTO $table (Author_Name, Game_Name, Game_Type, Game_Description, icon, game) VALUES('$Author_Name', '$Game_Name', '$Game_Type', '$Game_Description', '$icon', '$game')";
mysqli_query($link, $query);

$link = "http://$_SERVER[HTTP_HOST]";
header("Location: $link");
die();
?>