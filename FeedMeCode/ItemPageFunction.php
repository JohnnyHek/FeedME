<?php 	
include("DBConnection.class.php");


$action = $_POST['action'];

if($action =='like'){
$foodID = $_POST['foodID'];
}

if($action == 'request'){
$foodID = $_POST['foodID'];
$requesterID = $_POST['requesterID'];
}
	
$dbConn = new DBConnection();

switch($action){
	case 'like':
		likeAnItem($dbConn,$foodID);
		break;
	case 'request':
		requestAnItem($dbConn,$foodID,$requesterID);
		break;
	default:
		echo 'Incorrect action';						
}

function likeAnItem($dbConn,$foodID){
	$sql = "select Likes from Foods where FoodID = {$foodID}";
	$result = $dbConn->query($sql);
	$i = 0;
	while($row = $result->fetch_assoc())
    {
		$resultshown[$i++] = $row["Likes"];
        
    }
	$current = $resultshown[0];
	$current++;
	$sql = "update Foods set Likes = {$current} where FoodID = {$foodID}";
	$result = $dbConn->query($sql);
	if($result){
		$itemedited = 1;
		echo "You Have Like the Item";
	}
}
function requestAnItem($dbConn,$foodID,$requesterID){
	$sql = "insert into CompletedTransaction (FoodID,RequesterID) values ({$foodID},{$requesterID})";
	$result = $dbConn->query($sql);
	$sql = "update Foods set Status = 0 where FoodID = {$foodID}";
	$result = $dbConn->query($sql);
	if($result){
		$itemedited = 1;
		echo "You Have Request the Item";
	}
	else{
		echo "sth is wrong";
	}
}


?>