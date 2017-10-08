<!DOCTYPE html> 
<html lang="en"> 
    <head> 
        <meta charset="utf-8"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <meta name="description" content=""> 
        <meta name="author" content=""> 
        <title>Review Game</title>    

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
            </div>
          </div>
        </nav>
		
	<?php
		//make a password enter field
		$gameName = $_GET['gameName'];
		
		if(isset($_POST['Password'])) {
			$password = $_POST['Password'];
		} else {
			$password = "";	
		}
		
		//if we got the correct password, then allow us to edit. if not, then tell the user password was incorrect or to input a password!
		if($password == "steamachieversrocks") {
		   echo '
		   <p align="center" style="margin-top: 10px">
		   <button type="button" class="btn btn-success" data-toggle="modal" data-target="#approveGame" data-name="approveGame">Approve</button>
		   <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#denyGame" data-name="denyGame">Deny</button>
		   </p> ';
		} else if($password != ""){
			echo '<form align="center" method="POST" action="reviewgame.php?gameName='.$gameName.'">
            Password: <input type="password" name="Password"></input>
            <input type="submit" name="submit" value="Submit"></input>
            </form><p style="color:red" align="center">Password was incorrect!</p>';
		} else {
			echo '<form align="center" method="POST" action="reviewgame.php?gameName='.$gameName.'">
            Password: <input type="password" name="Password"></input>
            <input type="submit" name="submit" value="Submit"></input>
            </form> ';
		}
	 ?>
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
					$authorEmail = $row['Author_Email'];
                    $gameIcon = $row['icon'];
                    $game = $row['game'];
                    $gameDescription = $row['Game_Description'];
					$gameInstructions = $row['Game_Instructions'];
                    $gameType = "Recreational";
					
                    if(strpos(strtolower($game), "sb2") !== false) {
                    //is a scratch game (sb2)
                    echo '
                    <div align="center">
                    <h1><b>'.$gameName.', created by '.$authorName.'</b></h1>
                    <object data="Scratch.swf" type="application/x-shockwave-flash" width="687" height="570">
                    <param name="allowscriptaccess" value="always">
                    <param name="flashvars" value="project='.$game.'">
                    </object>
                    <p><h3>Game Description<h3></p>
                    <h4>'.$gameDescription.'</h4>
					<p><h3>Game Instructions<h3></p>
                    <h4>'.$gameInstructions.'</h4>
                    </div>';
                    } else if(strpos(strtolower($game), "swf") !== false) {
                    //is a flash game (swf)
                    echo '
                    <div align="center">
                    <h1><b>'.$gameName.', created by '.$authorName.'</b></h1>
                    <object align="middle" width="800" height="580">
                    <param name="movie" value="'.$game.'">
                    <embed src="'.$game.'" width="1000" height="1000">
                    </embed>
                    </object>
                    <p><h3>Game Description<h3></p>
                    <h4>'.$gameDescription.'</h4>
					<p><h3>Game Instructions<h3></p>
                    <h4>'.$gameInstructions.'</h4>
                    </div>';
                    }
                  }
                }
                while($row = mysqli_fetch_array($resultInformational)) {
                  //if the search result contained a string from a Game Name row, not case-sensitive
                  if(strtolower($row['Game_Name']) == strtolower($gameName)) {
                    $gameName = $row['Game_Name'];
                    $authorName = $row['Author_Name'];
					$authorEmail = $row['Author_Email'];
                    $gameIcon = $row['icon'];
                    $game = $row['game'];
                    $gameDescription = $row['Game_Description'];
                    $gameType = "Informational";
					
                    if(strpos(strtolower($game), "sb2") !== false) {
                    //is a scratch game (sb2)
                    echo '
                    <div align="center">
                    <h1><b>'.$gameName.', created by '.$authorName.'</b></h1>
                    <object data="Scratch.swf" type="application/x-shockwave-flash" width="687" height="570">
                    <param name="allowscriptaccess" value="always">
                    <param name="flashvars" value="project='.$game.'">
                    </object>
                    <p><h3>Game Description<h3></p>
                    <h4>'.$gameDescription.'</h4>
					<p><h3>Game Instructions<h3></p>
                    <h4>'.$gameInstructions.'</h4>
                    </div>';
                    } else if(strpos(strtolower($game), "swf") !== false) {
                    //is a flash game (swf)
                    echo '
                    <div align="center">
                    <h1><b>'.$gameName.', created by '.$authorName.'</b></h1>
                    <object align="middle" width="800" height="580">
                    <param name="movie" value="'.$game.'">
                    <embed src="'.$game.'" width="1000" height="1000">
                    </embed>
                    </object>
                    <p><h3>Game Description<h3></p>
                    <h4>'.$gameDescription.'</h4>
					<p><h3>Game Instructions<h3></p>
                    <h4>'.$gameInstructions.'</h4>
                    </div>';
                    }
                  }
                }
                while($row = mysqli_fetch_array($resultEducational)) {
                  //if the search result contained a string from a Game Name row, not case-sensitive
                  if(strtolower($row['Game_Name']) == strtolower($gameName)) {
                    $gameName = $row['Game_Name'];
                    $authorName = $row['Author_Name'];
					$authorEmail = $row['Author_Email'];
                    $gameIcon = $row['icon'];
                    $game = $row['game'];
                    $gameDescription = $row['Game_Description'];
                    $gameType = "Educational";
					
                    if(strpos(strtolower($game), "sb2") !== false) {
                    //is a scratch game (sb2)
                    echo '
                    <div align="center">
                    <h1><b>'.$gameName.', created by '.$authorName.'</b></h1>
                    <object data="Scratch.swf" type="application/x-shockwave-flash" width="687" height="570">
                    <param name="allowscriptaccess" value="always">
                    <param name="flashvars" value="project='.$game.'">
                    </object>
                    <p><h3>Game Description<h3></p>
                    <h4>'.$gameDescription.'</h4>
					<p><h3>Game Instructions<h3></p>
                    <h4>'.$gameInstructions.'</h4>
                    </div>';
                    } else if(strpos(strtolower($game), "swf") !== false) {
                    //is a flash game (swf)
                    echo '
                    <div align="center">
                    <h1><b>'.$gameName.', created by '.$authorName.'</b></h1>
                    <object align="middle" width="800" height="580">
                    <param name="movie" value="'.$game.'">
                    <embed src="'.$game.'" width="1000" height="1000">
                    </embed>
                    </object>
                    <p><h3>Game Description<h3></p>
                    <h4>'.$gameDescription.'</h4>
					<p><h3>Game Instructions<h3></p>
                    <h4>'.$gameInstructions.'</h4>
                    </div>';
                    }
                  }
                 }
	?>
	
	    <!--approveGame modal-->
        <div class="modal fade" id="approveGame" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Approve a Game</h4>
              </div>
              <div class="modal-body">
                <form id="approveForm" action="db/review.php" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="exampleTextarea">Why did you approve this game?*</label>
                    <textarea name="Reason" required class="form-control" id="exampleTextarea"></textarea>
                  </div>
				  <input type="hidden" value="<?php echo($gameName); ?>" name="Game_Name"/>
				  <input type="hidden" value="<?php echo($authorEmail); ?>" name="Author_Email"/>
				  <input type="hidden" value="<?php echo($gameType); ?>" name="Game_Type"/>
				  <input type="hidden" value="true" name="Decision"/>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="approveForm" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </div>
        </div>
		
		<!--denyGame modal-->
        <div class="modal fade" id="denyGame" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Deny a Game</h4>
              </div>
              <div class="modal-body">
                <form id="denyForm" action="db/review.php" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="exampleTextarea">Why did you deny this game?*</label>
                    <textarea name="Reason" required class="form-control" id="exampleTextarea"></textarea>
                  </div>
				  <input type="hidden" value="<?php echo($gameName); ?>" name="Game_Name"/>
				  <input type="hidden" value="<?php echo($authorEmail); ?>" name="Author_Email"/>
				  <input type="hidden" value="<?php echo($gameType); ?>" name="Game_Type"/>
				  <input type="hidden" value="false" name="Decision"/>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="denyForm" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </div>
        </div>
		
    </body>   

    <!--jquery and bootstrap-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<script>
	//make the scrollbar start at the middle
	  window.scrollTo(
		(document.body.offsetWidth -window.innerWidth )/2,
		(document.body.offsetHeight-window.innerHeight)/2
	  );
	</script>
</html>
