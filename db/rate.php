<?php
include("dbconnection.php");
$Rating = $_POST["rating"];
$Game_Name = $_POST["Game_Name"];
$table = $_POST["Game_Type"];
$dbNewRating = 5;
$dbNewRater_Number = 1;

$query = "SELECT * FROM $table WHERE Game_Name='$Game_Name'";
$result = mysqli_query($link, $query);
while ($row = mysqli_fetch_array($result)) {
    $dbRating = $row['Rating'];
    $dbRater_Number = $row['Rater_Number'];

    //get new average rating number & new rater number
    $dbTotalRating = $dbRating * $dbRater_Number;
    $dbNewRater_Number = $dbRater_Number + 1;
    $dbNewRating = ($dbTotalRating + $Rating)/$dbNewRater_Number;
}

$query = "UPDATE $table SET Rating='$dbNewRating', Rater_Number='$dbNewRater_Number' WHERE Game_Name='$Game_Name'";
mysqli_query($link, $query);
