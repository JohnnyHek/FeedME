<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"  name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="FeedME.css" rel="stylesheet">

    <title>FeedME</title>
<!--Javascript function to introduce a search filter-->
<script>

  function myFunction()
  {
    var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  //hiding table rows that dont match the query
  for (i = 0; i < tr.length; i++) {
    //Getting the search element's index
    td = tr[i].getElementsByTagName("td")[1];

    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}

</script>
</head>
<body>

<div class="title-page"> <h1 id="font1" >FeedME </h1></div>
<input type="button" value="Home">

    <?php
            include("DBConnection.class.php");
    ?>
    <h1> Welcome to the Admin Page</h1>

<p></p>
<h3> EDIT FOOD</h3>
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="... Search Food By Name...">
<p></p>
<form>
  <fieldset>
    <legend><b>User Details</b></legend>
   
<table id="myTable" border='1'>
  
    <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Description</th>
    <th>Type</th>
     <th>Quantity</th>
      <th>Likes</th>
       <th>Sharer</th>
        <th>Date</th>
         <th>Location X</th>
          <th>Location Y</th>
    <th>Edit</th>
     <th>Remove</th>
</tr>
     <!--Introducing PHP into the code to display the results of the database-->   
     <?php
     $sql = "SELECT FoodID, FoodName, FoodDescription,FoodType, Quantity, Likes, SharerID, ReleaseDate, LocationX, LocationY FROM Foods";

     $result = $dbConn->query($sql);

   while($row = $result->fetch_assoc()){
    ?>
    <tr>
        <td>
      <?php
      echo $row['FoodID'];
      ?>
    </td>
    <td>
      <?php
      echo $row['FoodName'];
      ?>
    </td>
    <td>
      <?php
      echo $row['FoodDescription'];
      ?>
    </td>
    <td>
      <?php
      echo $row['FoodType'];
      ?>
    </td>
    <td>
      <?php
      echo $row['Quantity'];
      ?>
    </td>
    <td>
      <?php
      echo $row['Likes'];
      ?>
    </td>
    <td>
      <?php
      echo $row['SharerID'];
      ?>
    </td><td>
      <?php
      echo $row['ReleaseDate'];
      ?>
    </td><td>
      <?php
      echo $row['LocationX'];
      ?>
    </td><td>
      <?php
      echo $row['LocationY'];
      ?>
    </td>
    <td>
      <a href="editfood.html">Edit</a>
    </td>
    <td>
      <a href="removefood.html">Remove</a>
    </td>
    <?php
}
$dbConn->close();
?>

</table>
</fieldset>
 </form>


</body>
</html>