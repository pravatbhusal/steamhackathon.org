<!DOCTYPE html> 
<html lang="en"> 
    <head> 
        <meta charset="utf-8"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <meta name="description" content=""> 
        <meta name="author" content=""> 
        <title>STEAM Hackathon</title>    

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
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
              </button>
              <a class="navbar-brand" href="#">S.T.E.A.M. Hackathon</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">
                <li id="recreational"><a href="index.php">Recreational Games</a></li>
                <li class="active" id="informational"><a href="informational.php">Informational Games</a></li> 
                <li id="educational"><a href="educational.php">Educational Games</a></li> 
              </ul>
              <ul class="nav navbar-nav navbar-right">
                  <li><a href="#" data-toggle="modal" data-target="#myModal" data-name="uploadGame">
                  <span class="glyphicon glyphicon-upload" id="uploadGlyph"></span>
                  Upload a Game</a></li>
              </ul>
             <form class="navbar-form navbar-left" action="searchresult.php" method="GET">
               <div class="form-group">
                 <input required type="text" name="search" class="form-control" placeholder="Search for a game...">
               </div>
               <button type="submit" class="btn btn-info glyphicon glyphicon-search"></button>
             </form>
            </div>
          </div>
        </nav>
        
        <!--container for games-->
        <div class="container-fluid"> 
            <div id="gamesList">
                <?php
                include("db/dbconnection.php");
                $games = array();
                $query = "SELECT * FROM informational_games";
                $result = mysqli_query($link, $query);
                //iterate through games within the game type (informational)
                while($row = mysqli_fetch_array($result)) {
                  $games[] = $row;
                }
                //shuffle the original array so that the program can grab games at random
                shuffle($games);
                    for($i = 0; $i < count($games); $i++) {
                    $gameName = $games[$i]['Game_Name'];
                    $gameIcon = $games[$i]['icon'];
                    $gameDescription = $games[$i]['Game_Description'];
                    $Rating = $games[$i]['Rating'];
					$Approved = $games[$i]['Approved'];
						if($Approved == "true") {
						echo '<div class="jumbotron center-block" id="gameContent">
						<h1 class="display-3">'.$gameName.'<span>
						<img src="'.$gameIcon.'" height="125px" class="img-circle" align="right" width="125px"></span></h1>
						<p class="lead">'.$gameDescription.'</p>
						<p><a class="btn btn-lg btn-info" onclick="clickPlay(event)" href="#" role="button">Play '.$gameName.'</a>
						<span style="margin-left:10px" class="glyphicon glyphicon-star">'.$Rating.'/5</span></p>
						</div>'; 
						} 
                    }
                ?> 
            </div>
        </div>
        
        <!--myModal (used for uploading games)-->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Upload a Game</h4>
              </div>
              <div class="modal-body">
                <form id="uploadForm" action="db/upload.php" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="exampleSelect1">Game Name*</label>
                    <input required type="text" name="Game_Name" class="form-control" placeholder="e.g. Rocket Bounce!">
                  </div>
                  <div class="form-group">
                      <label for="exampleSelect1">Author Name*</label>
                    <input required type="text" name="Author_Name" class="form-control" placeholder="e.g. Pravat Bhusal">
                  </div>
				  <div class="form-group">
                      <label for="exampleSelect1">Author Email*</label>
                    <input required type="email" name="Author_Email" class="form-control" placeholder="e.g. pravat.bhusal@gmail.com">
                  </div>
                  <div class="form-group">
                    <label for="exampleSelect2">Game Type*</label>
                        <select class="form-control" id="exampleSelect1" name="Game_Type">
                          <option>Recreational</option>
                          <option>Informational</option>
                          <option>Educational</option>
                        </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleTextarea">Mini Game Description* (max 250 characters)</label>
                    <textarea name="Game_Description" required class="form-control" id="exampleTextarea" rows="3" maxlength="250"></textarea>
                  </div>
				  <div class="form-group">
                    <label for="exampleTextarea">Game Instructions*</label>
                    <textarea name="Game_Instructions" required class="form-control" id="exampleTextarea" rows="3" maxlength="250"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleSelect1">Upload Game Icon* (.png, .jpg, .gif)</label>
                        <input required type="file" name="icon" accept="image/*">
                  </div>
                  <div class="form-group">
                    <label for="exampleSelect1">Upload Game File* (.swf, .sb2, etc.)</label>
                        <input required type="file" name="game">
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="uploadForm" class="btn btn-primary">Upload</button>
              </div>
            </div>
          </div>
        </div>
        
    </body>   
    
    <!--jquery and bootstrap-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <script>
        function clickPlay(e) {
            var gameName = ($(e.target).text()).replace("Play ", "");
            
            //send a GET request to the playgame.php with the gameName variable
            window.location.replace("playgame.php" + "?gameName=" + gameName);
        }
    </script>
</html>
