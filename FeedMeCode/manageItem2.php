<?php
//ManageItem has    which is addItem, updateItem, removeItem and presentItems(current&Pass)
include("DBConnection.class.php");
header('Content-Type: application/json; charset=utf-8');
session_start();
$action = $_POST['action'];

//echo "sent";
//echo $action+"action";
if($action =='addItem') {
    $sharerID = $_POST['sharerID'];
    $foodName = $_POST['foodName'];
    $foodDescription = $_POST['foodDescription'];
    $foodType = $_POST['foodType'];
    $quantity = $_POST['quantity'];

    $locationX = $_POST['locationX'];
    $locationY = $_POST['locationY'];

   if (!empty($_SESSION['photo'])) {
       $image = $_SESSION['photo'];

    }
    else{
       $image = null;
    }
    if (!empty($_SESSION['file'])) {
        $file = $_SESSION['file'];
    }
    else{
       $file = null;
    }
   // $_SESSION['file']
  //  echo "get file";
}
//allow user to change item's status at this function
if($action =='editItem'){

$foodID = $_POST['foodID'];
$foodName = $_POST['foodName'];
$foodDescription= $_POST['foodDescription'];
$foodType = $_POST['foodType'];
$quantity = $_POST['quantity'];
$status= $_POST['status'];
//$location = $_POST['location'];
    $locationX = $_POST['locationX'];
    $locationY = $_POST['locationY'];
echo $locationX;
echo $locationY;

}

if($action =='deleteItem'){
$foodID = $_POST['foodID'];
}

if($action =='viewPresentItem'){
$sharerID = $_POST['sharerID'];
}

 
if($action =='viewPastItem'){
$sharerID = $_POST['sharerID'];
}

$dbConn = new DBConnection();

switch($action){
	case 'addItem':
		addItem($dbConn,$foodName,$foodDescription,$foodType,$quantity,$sharerID,$image,$file,$locationX,$locationY);
		break;
	case 'editItem':
		editItem($dbConn,$foodID,$foodName,$foodDescription,$foodType,$quantity,$status,$locationX,$locationY);
		break;
	case 'deleteItem':
		deleteItem($dbConn,$foodID);
		break;
	case 'viewPresentItem':
		viewPresentItem($dbConn,$sharerID);
		break;
		//might not do the filter
	case 'viewPastItem':
        viewPastItem($dbConn,$sharerID);
		break;
	case 'test':
		echo 'success return';
		break;
	default:
		echo 'Incorrect action';						
		
}

function addItem($dbConn,$foodName,$foodDescription,$foodType,$quantity,$sharerID,$image,$file,$locationX,$locationY){
	$sql = "insert into Foods (FoodName,FoodDescription,FoodType,Quantity,SharerID,Status,Image,File,LocationX,LocationY) values ('{$foodName}','{$foodDescription}',{$foodType},{$quantity},{$sharerID},'1','$image','$file',{$locationX},{$locationY})";
	$result = $dbConn->query($sql);

	$sql = "select FoodID from Foods where FoodName = '{$foodName}' && SharerID = {$sharerID}";
	$result = $dbConn->query($sql);
	$m = 0;
	while($row = $result->fetch_assoc())
    {
		$resultshown[$m++] = $row["FoodID"];
        
    }
	$foodID = $resultshown[--$m];
	
	$sql = "select UserID from FavouriteFood where `{$foodType}` = 1";
	$result = $dbConn->query($sql);
	$i = 0;
	while($row = $result->fetch_assoc())
    {
		$availableUser[$i++] = $row["UserID"];
    }	

	for($j=0;$j<$i;$j++){
		$userID = $availableUser[$j];
		$sql = "insert into Notice (Notification,UserID,Status,Type,FoodID) values ('Someone just shared your favourite item',$userID,1,1,$foodID)";
		$result = $dbConn->query($sql);
	}
	        if($result){
				
				$sql = "select SharerID from Foods where FoodType = {$foodType}";
				$outcome = $dbConn->query($sql);
				$n = 0;
				while($row = $outcome->fetch_assoc())
    			{
					$availableUser[$n++] = $row["SharerID"];
    			}	
				if($n>4){
					$sql = "select TypeName from FoodType where TypeID = {$foodType}";
					$result = $dbConn->query($sql);
					$q = 0;
					while($row = $result->fetch_assoc())
    				{
						$resultshown[$q++] = $row["TypeName"];
        
    				}
					$typeName = $resultshown[0];
					$sql = "insert into Notice (Notification,UserID,Status,Type) values ('Share too much {$typeName}',$sharerID,1,2)";
					$result = $dbConn->query($sql);
                    //echo " <script> alert('Success! But try to share less of this type of item please.'); parent.location.href='guest_sign.php'; </script>";
				    echo "You Have Shared An Item! But try to share less of this type of item please";
				}
				else {
				    //echo "<script> alert('You Have Share An Item.'); parent.location.href='guest_sign.php'; </script>";
                    //echo "<script type='text/javascript'>alert('You Have Share An Item');window.location.href='mySharing2.php';</script>";
					echo "You Have Shared An Item";
				}
				
				
           }
	else{echo "fail";}
	
			
}
function editItem($dbConn,$foodID,$foodName,$foodDescription,$foodType,$quantity,$status,$locationX,$locationY){

    if(isset($locationX)&&isset($locationY)){
        $sql3 = "update Foods set LocationX = '$locationX',LocationY = '$locationY' WHERE FoodID = '$foodID'";
        $result3 = $dbConn->query($sql3);
        if($result3)
        {
            echo "location update";
        }
    }
	$sql = "update Foods set FoodName = '{$foodName}',FoodDescription = '{$foodDescription}',FoodType = {$foodType},Quantity = {$quantity}, Status = {$status} where FoodID = {$foodID}";
	$result = $dbConn->query($sql);
	if($result){
	//	$itemedited = 1;
        echo "Updated Sussessfully";
	}
	else{
        echo "Item is not Updated";
    }
	
}

function deleteItem($dbConn,$foodID){

    $sql2 = "select Status from Foods where  FoodID = {$foodID}";
    $result2 = $dbConn->query($sql2);
    $i = 0;
    while($row = $result2->fetch_assoc())
    {
        $resultshown[$i++] = $row["Status"];
    }
    $foodstatus = $resultshown[0];

 //   echo $foodstatus;
	$sql = "delete from Foods where FoodID = {$foodID}";
	$result = $dbConn->query($sql);
	if($result){

        if($foodstatus == "1"){
            $sql = "select * from Foods where SharerID = '1' && Status = '1'";
            $result = $dbConn->query($sql);
            $i = 0;
            //$arr = array();
            while($row = $result->fetch_assoc())
            {
                $resultshown[$i++] = $row;
                // $data["name"] = $row["FoodName"];
                //$data["id"] = $row["FoodID"];
                // $arr = $data;


            }
            echo  json_encode($resultshown);
        }
        else{
            $sql = "select * from Foods where SharerID = '1' && Status = '0'";
            $result = $dbConn->query($sql);
            $i = 0;
            while($row = $result->fetch_assoc())
            {
                $resultshown[$i++] = $row;

            }
            echo  json_encode($resultshown);
        }
		//echo "The Item is Removed";
	}
}

function viewPresentItem($dbConn,$sharerID){
	$sql = "select * from Foods where SharerID = '$sharerID' && Status = '1'";
	$result = $dbConn->query($sql);
	$i = 0;
	//$arr = array();
	while($row = $result->fetch_assoc())
    {
		$resultshown[$i++] = $row;
      // $data["name"] = $row["FoodName"];
       //$data["id"] = $row["FoodID"];
      // $arr = $data;

        
    }
	echo  json_encode($resultshown);
}

function viewPastItem($dbConn,$sharerID){
	$sql = "select * from Foods where SharerID = '$sharerID' && Status = '0'";
	$result = $dbConn->query($sql);
	$i = 0;
	while($row = $result->fetch_assoc())
    {
		$resultshown[$i++] = $row;
        
    }
	echo  json_encode($resultshown);
}

?>