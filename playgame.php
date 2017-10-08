<!DOCTYPE html> 
<html lang="en"> 
    <head> 
        <meta charset="utf-8"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <meta name="description" content=""> 
        <meta name="author" content=""> 
        <title>Play Game</title>    

		<!--style.css, favcon, bootstrap, and rateYo!-->
        <link href="style.css" rel="stylesheet">       
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">  	
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">		
    </head>
	
    <body>
        <!--collapsable navbar with default design-->
        <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="index.php">
			  <span class="glyphicon glyphicon-chevron-left" id="uploadGlyph"></span>
			  Return Home</a>
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
					$gameInstructions = $row['Game_Instructions'];
                      
                    if(strpos(strtolower($game), "sb2") !== false) {
                    //is a scratch game (sb2)
                    echo '
                    <div align="center">
                    <h1><b>'.$gameName.', created by '.$authorName.'</b></h1>
                    <object data="Scratch.swf" type="application/x-shockwave-flash" width="687" height="570">
                    <param name="allowscriptaccess" value="always">
                    <param name="flashvars" value="project='.$game.'">
                    </object>
					<p><h3 id="rateLabel">Rate This Game!</h3></p>
					<div id="rateYo"></div>
					<button id="getRating" style="margin-top:7px">Set Rating</button>
                    <p><h3>Game Description</h3></p>
                    <h4>'.$gameDescription.'</h4>
					<p><h3>Game Instructions<h3></p>
                    <h4>'.$gameInstructions.'</h4>
					<p id="gameType" value="recreational_games" style="visbility: hidden"></p>
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
					<p><h3 id="rateLabel">Rate This Game!</h3></p>
					<div id="rateYo"></div>
					<button id="getRating" style="margin-top:7px">Set Rating</button>
                    <p><h3>Game Description</h3></p>
                    <h4>'.$gameDescription.'</h4>
					<p><h3>Game Instructions<h3></p>
                    <h4>'.$gameInstructions.'</h4>
					<p id="gameType" value="recreational_games" style="visbility: hidden"></p>
                    </div>';
                    } else {
					//unknown game format
					echo '<div align="center">
					<h1><b>'.$gameName.', created by '.$authorName.'</b></h1>
					<h3 style="color:red">Game contains an unknown file format!</h3>
					<a href="'.$game.'"><h1>Download The Game</h1></a>
					<p><h3 id="rateLabel">Rate This Game!</h3></p>
					<div id="rateYo"></div>
					<button id="getRating" style="margin-top:7px">Set Rating</button>
                    <p><h3>Game Description</h3></p>
                    <h4>'.$gameDescription.'</h4>
					<p><h3>Game Instructions<h3></p>
                    <h4>'.$gameInstructions.'</h4>
					<p id="gameType" value="recreational_games" style="visbility: hidden"></p>
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
                    <object data="Scratch.swf" type="application/x-shockwave-flash" width="687" height="570">
                    <param name="allowscriptaccess" value="always">
                    <param name="flashvars" value="project='.$game.'">
                    </object>
					<p><h3 id="rateLabel">Rate This Game!</h3></p>
					<div id="rateYo"></div>
					<button id="getRating" style="margin-top:7px">Set Rating</button>
                    <p><h3>Game Description</h3></p>
                    <h4>'.$gameDescription.'</h4>
					<p><h3>Game Instructions<h3></p>
                    <h4>'.$gameInstructions.'</h4>
					<p id="gameType" value="informational_games" style="visbility: hidden"></p>
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
					<p><h3 id="rateLabel">Rate This Game!</h3></p>
					<div id="rateYo"></div>
					<button id="getRating" style="margin-top:7px">Set Rating</button>
                    <p><h3>Game Description</h3></p>
                    <h4>'.$gameDescription.'</h4>
					<p><h3>Game Instructions<h3></p>
                    <h4>'.$gameInstructions.'</h4>
					<p id="gameType" value="informational_games" style="visbility: hidden"></p>
                    </div>';
                    } else {
					//unknown game format
					echo '<div align="center">
					<h1><b>'.$gameName.', created by '.$authorName.'</b></h1>
					<h3 style="color:red">Game contains an unknown file format!</h3>
					<a href="'.$game.'"><h1>Download The Game</h1></a>
					<p><h3 id="rateLabel">Rate This Game!</h3></p>
					<div id="rateYo"></div>
					<button id="getRating" style="margin-top:7px">Set Rating</button>
                    <p><h3>Game Description</h3></p>
                    <h4>'.$gameDescription.'</h4>
					<p><h3>Game Instructions<h3></p>
                    <h4>'.$gameInstructions.'</h4>
					<p id="gameType" value="informational_games" style="visbility: hidden"></p>
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
                    <object data="Scratch.swf" type="application/x-shockwave-flash" width="687" height="570">
                    <param name="allowscriptaccess" value="always">
                    <param name="flashvars" value="project='.$game.'">
                    </object>
					<p><h3 id="rateLabel">Rate This Game!</h3></p>
					<div id="rateYo"></div>
					<button id="getRating" style="margin-top:7px">Set Rating</button>
                    <p><h3>Game Description</h3></p>
                    <h4>'.$gameDescription.'</h4>
					<p><h3>Game Instructions<h3></p>
                    <h4>'.$gameInstructions.'</h4>
					<p id="gameType" value="educational_games" style="visbility: hidden"></p>
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
					<p><h3 id="rateLabel">Rate This Game!</h3></p>
					<div id="rateYo"></div>
					<button id="getRating" style="margin-top:7px">Set Rating</button>
                    <p><h3>Game Description</h3></p>
                    <h4>'.$gameDescription.'</h4>
					<p><h3>Game Instructions<h3></p>
                    <h4>'.$gameInstructions.'</h4>
					<p id="gameType" value="educational_games" style="visbility: hidden"></p>
                    </div>';
                    } else {
					//unknown game format
					echo '<div align="center">
					<h1><b>'.$gameName.', created by '.$authorName.'</b></h1>
					<h3 style="color:red">Game contains an unknown file format!</h3>
					<a href="'.$game.'"><h1>Download The Game</h1></a>
					<p><h3 id="rateLabel">Rate This Game!</h3></p>
					<div id="rateYo"></div>
					<button id="getRating" style="margin-top:7px">Set Rating</button>
                    <p><h3>Game Description</h3></p>
                    <h4>'.$gameDescription.'</h4>
					<p><h3>Game Instructions<h3></p>
                    <h4>'.$gameInstructions.'</h4>
					<p id="gameType" value="educational_games" style="visbility: hidden"></p>
                    </div>';
					}
                  }
                 }
	?>
    </body>   

    <!--jquery,bootstrap, and rateYo!-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
	
	<script>
	//make the scrollbar start at the middle
	  window.scrollTo(
		(document.body.offsetWidth -window.innerWidth )/2,
		(document.body.offsetHeight-window.innerHeight)/2
	  );
	  
	  function readCookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for(var i=0;i < ca.length;i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1,c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		}
		return null;
	  }
	  
	  var gameType = $("#gameType").attr("value");
	  var $_GET=[];
	  window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi,function(a,name,value){$_GET[name]=value;});
	  var gameName = $_GET['gameName'].replace("%20", " ");
	  
	  var rating = readCookie("rating" + $_GET['gameName']);
	  if(!rating) { //if we haven't rated, then allow us to rate
		  var $rateYo = $("#rateYo").rateYo({
				rating: 0,
				fullStar: true
		  });
	  } else {
		  var $rateYo = $("#rateYo").rateYo({
				rating: rating,
				readOnly: true
		  });
	  }
	  
	  if(!rating) { //only allow this function to be enabled if we haven't rated
		  $("#getRating").click(function () {
			var rateYoRating = $rateYo.rateYo("rating");
			document.cookie = "rating" + $_GET['gameName'] + "=" + rateYoRating
		    $("#getRating").remove();
		    $("#rateLabel").html("Thank you for rating!");
			$rateYo.rateYo(); //read only
			
			//send the rating via ajax
            $.ajax({
                url: 'db/rate.php',
                type: 'POST',
                data: {Game_Name: gameName, rating: rateYoRating, Game_Type: gameType},
                success: function (result) {
					alert(result);
                }
            });
		  });
	  } else {
		  $("#getRating").remove();
		  $("#rateLabel").html("Thank you for rating!");
	  }
	</script>
</html>
