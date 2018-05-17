<?php
include("DBConnection.class.php");
$action = $_POST['action'];

if($action == 'searchType'){
$searchFoodType = $_POST['foodType'];
}
if($action == 'searchQuantity'){
$searchQuantity = $_POST['quantity'];
}
if($action == 'searchName'){
$searchName = $_POST['name'];
}
if($action == 'searchTypeQuantity'){
$searchFoodType = $_POST['foodType'];
$searchQuantity = $_POST['quantity'];
}
if($action == 'searchTypeName'){
$searchFoodType = $_POST['foodType'];
$searchName = $_POST['name'];
}
if($action == 'searchQuantityName'){
$searchQuantity = $_POST['quantity'];
$searchName = $_POST['name'];
}

if($action == 'searchAll'){
$searchFoodType = $_POST['foodType'];
$searchQuantity = $_POST['quantity'];
$searchName = $_POST['name'];
}

//Sort Function
if($action == 'sortByDate'){

}

if($action == 'sortByLikes'){}

//Filter Function
if($action == 'filterByType'){}

if($action == 'filterByDate'){}


$dbConn = new DBConnection();

switch($action){
	case 'searchType':
		searchType($dbConn,$searchFoodType);
		break;
	case 'searchQuantity':
		searchQuantity($dbConn,$searchQuantity);
		break;
	case 'searchName':
		searchName($dbConn,$searchName);
		break;
	case 'searchTypeQuantity':
		searchTypeQuantity($dbConn,$searchFoodType,$searchQuantity);
		break;
	case 'searchTypeName':
		searchTypeName($dbConn,$searchFoodType,$searchName);
		break;
	case 'searchQuantityName':
		searchQuantityName($dbConn,$searchQuantity,$searchName);
		break;
	case 'searchAll':
		searchAll($dbConn,$searchFoodType,$searchQuantity,$searchName);
		break;
    case 'sortDate':
        sortByDate($dbConn,$sortDate);
	case 'searchLocation':
		searchLocation($dbConn);
		break;
	default:
		echo 'Incorrect action';						
}

function searchType($dbConn,$searchFoodType){
	$sql = "select * from Foods where FoodType = {$searchFoodType} && Status = 1";
	$result = $dbConn->query($sql);
	$i = 0;
	while($row = $result->fetch_assoc())
    {
		$resultshown[$i++] = $row;
        
    }
	echo  json_encode($resultshown);
}
function searchQuantity($dbConn,$searchQuantity){
	$sql = "select * from Foods where Quantity >= {$searchQuantity} && Status = 1";
	$result = $dbConn->query($sql);
	$i = 0;
	while($row = $result->fetch_assoc())
    {
		$resultshown[$i++] = $row;
        
    }
	echo  json_encode($resultshown);
}
function searchName($dbConn,$searchName){
	$sql = "select * from Foods where FoodName like '%{$searchName}%' && Status = 1";
	$result = $dbConn->query($sql);
	$i = 0;
	while($row = $result->fetch_assoc())
    {
		$resultshown[$i++] = $row;
        
    }
	echo  json_encode($resultshown);
}
function searchTypeQuantity($dbConn,$searchFoodType,$searchQuantity){

	$sql = "select * from Foods where FoodType = {$searchFoodType} && Quantity >= {$searchQuantity} && Status = 1";
	$result = $dbConn->query($sql);
	$i = 0;
	while($row = $result->fetch_assoc())
    {
		$resultshown[$i++] = $row;
        
    }
	echo  json_encode($resultshown);
}
function searchTypeName($dbConn,$searchFoodType,$searchName){
	$sql = "select * from Foods where FoodType = {$searchFoodType} && FoodName like '%{$searchName}%' && Status = 1";
	$result = $dbConn->query($sql);
	$i = 0;
	while($row = $result->fetch_assoc())
    {
		$resultshown[$i++] = $row;
        
    }
	echo  json_encode($resultshown);
}
function searchQuantityName($dbConn,$searchQuantity,$searchName){
	$sql = "select * from Foods where Quantity >= {$searchQuantity} && FoodName like '%{$searchName}%' && Status = 1";
	$result = $dbConn->query($sql);
	$i = 0;
	while($row = $result->fetch_assoc())
    {
		$resultshown[$i++] = $row;
        
    }
	echo  json_encode($resultshown);
}
function searchAll($dbConn,$searchFoodType,$searchQuantity,$searchName){
	$sql = "select * from Foods where FoodType = {$searchFoodType} && Quantity >= {$searchQuantity} && FoodName like '%{$searchName}%' && Status = 1";
	$result = $dbConn->query($sql);
	$i = 0;
	while($row = $result->fetch_assoc())
    {
		$resultshown[$i++] = $row;
        
    }
	echo  json_encode($resultshown);

}

function searchLocation($dbConn){
	$sql = "select * from Foods where Status = 1";
	$result = $dbConn->query($sql);
	$i = 0;
	while($row = $result->fetch_assoc())
    {
		$resultshown[$i++] = $row;
        
    }
	echo  json_encode($resultshown);
}

function sortByDate($dbConn,$sortDate){
    $sql = "select * from Foods order by {$sortDate} asc";
    $result = $dbConn->query($sql);
    $i = 0;
    while($row = $result->fetch_assoc())
    {
        $resultshown[$i++] = $row;

    }
    echo  json_encode($resultshown);

}




?>