<!DOCTYPE html> 
<html lang="en"> 
    <head> 
        <meta charset="utf-8"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <meta name="description" content=""> 
        <meta name="author" content=""> 
        <title>Play Game</title>    

		<!--style.css, favcon, bootstrap-->
        <link href="style.css" rel="stylesheet">       
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">  	
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">	
    </head>
	
    <body>
        <!--collapsable navbar with default design-->
        <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="index.php">Return Home</a>
            </div>
          </div>
        </nav>
        
	<?php 
	           //now find the gamename within the database...
                include("db/dbconnection.php");
                $gameName = $_GET["gameName"];
                $recreationalGames = array();
                $informationalGames = array();
                $educationalGames = array();
                
                //query through each table
                $queryRecreational = "SELECT * FROM recreational_games";
                $queryInformational = "SELECT * FROM informational_games";
                $queryEducational = "SELECT * FROM educational_games";
                
                $resultRecreational = mysqli_query($link, $queryRecreational);
                $resultInformational = mysqli_query($link, $queryInformational);
                $resultEducational = mysqli_query($link, $queryEducational);
                
                /* iterate through games within the game type (recreational,informational,educational) */
                while($row = mysqli_fetch_array($resultRecreational)) {
                  //if the search result contained a string from a Game Name row, not case-sensitive
                  if(strtolower($row['Game_Name']) == strtolower($gameName)) {
                    $gameName = $row['Game_Name'];
                    $authorName = $row['Author_Name'];
                    $gameIcon = $row['icon'];
                    $game = $row['game'];
                    $gameDescription = $row['Game_Description'];
                      
                    if(strpos(strtolower($game), "sb2") !== false) {
                    //is a scratch game (sb2)
                    echo '
                    <div align="center">
                    <h1><b>'.$gameName.', created by '.$authorName.'</b></h1>
                    <object data="Scratch.swf" type="application/x-shockwave-flash" width="487" height="401">
                    <param name="allowscriptaccess" value="always">
                    <param name="flashvars" value="project='.$game.'">
                    </object>
                    <p><h3>Game Description<h3></p>
                    <h4>'.$gameDescription.'</h4>
                    </div>';
                    } else if(strpos(strtolower($game), "swf") !== false) {
                    //is a flash game (swf)
                    echo '
                    <div align="center">
                    <h1><b>'.$gameName.', created by '.$authorName.'</b></h1>
                    <object align="middle" width="700" height="400">
                    <param name="movie" value="'.$game.'">
                    <embed src="'.$game.'" width="700" height="600">
                    </embed>
                    </object>
                    <p><h3>Game Description<h3></p>
                    <h4>'.$gameDescription.'</h4>
                    </div>';
                    }
                  }
                }
                while($row = mysqli_fetch_array($resultInformational)) {
                  //if the search result contained a string from a Game Name row, not case-sensitive
                  if(strtolower($row['Game_Name']) == strtolower($gameName)) {
                    $gameName = $row['Game_Name'];
                    $authorName = $row['Author_Name'];
                    $gameIcon = $row['icon'];
                    $game = $row['game'];
                    $gameDescription = $row['Game_Description'];
                      
                    if(strpos(strtolower($game), "sb2") !== false) {
                    //is a scratch game (sb2)
                    echo '
                    <div align="center">
                    <h1><b>'.$gameName.', created by '.$authorName.'</b></h1>
                    <object data="Scratch.swf" type="application/x-shockwave-flash" width="487" height="401">
                    <param name="allowscriptaccess" value="always">
                    <param name="flashvars" value="project='.$game.'">
                    </object>
                    <p><h3>Game Description<h3></p>
                    <h4>'.$gameDescription.'</h4>
                    </div>';
                    } else if(strpos(strtolower($game), "swf") !== false) {
                    //is a flash game (swf)
                    echo '
                    <div align="center">
                    <h1><b>'.$gameName.', created by '.$authorName.'</b></h1>
                    <object align="middle" width="700" height="400">
                    <param name="movie" value="'.$game.'">
                    <embed src="'.$game.'" width="700" height="600">
                    </embed>
                    </object>
                    <p><h3>Game Description<h3></p>
                    <h4>'.$gameDescription.'</h4>
                    </div>';
                    }
                  }
                }
                while($row = mysqli_fetch_array($resultEducational)) {
                  //if the search result contained a string from a Game Name row, not case-sensitive
                  if(strtolower($row['Game_Name']) == strtolower($gameName)) {
                    $gameName = $row['Game_Name'];
                    $authorName = $row['Author_Name'];
                    $gameIcon = $row['icon'];
                    $game = $row['game'];
                    $gameDescription = $row['Game_Description'];
                      
                    if(strpos(strtolower($game), "sb2") !== false) {
                    //is a scratch game (sb2)
                    echo '
                    <div align="center">
                    <h1><b>'.$gameName.', created by '.$authorName.'</b></h1>
                    <object data="Scratch.swf" type="application/x-shockwave-flash" width="487" height="401">
                    <param name="allowscriptaccess" value="always">
                    <param name="flashvars" value="project='.$game.'">
                    </object>
                    <p><h3>Game Description<h3></p>
                    <h4>'.$gameDescription.'</h4>
                    </div>';
                    } else if(strpos(strtolower($game), "swf") !== false) {
                    //is a flash game (swf)
                    echo '
                    <div align="center">
                    <h1><b>'.$gameName.', created by '.$authorName.'</b></h1>
                    <object align="middle" width="700" height="400">
                    <param name="movie" value="'.$game.'">
                    <embed src="'.$game.'" width="700" height="600">
                    </embed>
                    </object>
                    <p><h3>Game Description<h3></p>
                    <h4>'.$gameDescription.'</h4>
                    </div>';
                    }
                  }
                 }
	?>
    </body>   

    <!--jquery and bootstrap-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>
