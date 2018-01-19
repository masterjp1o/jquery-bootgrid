<?php
//fetch_single.php
include("connection.php");
if(isset($_POST["document_id"]))
{
 //$output = array();
 $query = "SELECT * FROM document WHERE document_id = '".$_POST["document_id"]."'";
 $result = mysqli_query($connection, $query);
 while($row = mysqli_fetch_array($result))
 {
  $output["program_id"] = $row["program_id"];
  $output["document_title"] = $row["document_title"];
  $output["document_type"] = $row["document_type"];
 }
 echo json_encode($output);
}
?>
