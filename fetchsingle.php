<?php
//fetch_single.php
include("connection.php");
if(isset($_POST["product_id"]))
{
 //$output = array();
 $query = "SELECT * FROM product WHERE product_id = '".$_POST["product_id"]."'";
 $result = mysqli_query($connection, $query);
 while($row = mysqli_fetch_array($result))
 {
  $output["category_id"] = $row["category_id"];
  $output["product_name"] = $row["product_name"];
  $output["product_price"] = $row["product_price"];
 }
 echo json_encode($output);
}

?>
