<?php
//delete.php
include("connection.php");
if(isset($_POST["document_id"]))
{
 $query = "DELETE FROM document WHERE document_id = '".$_POST["document_id"]."'";
 if(mysqli_query($connection, $query))
 {
  echo 'Data Deleted';
 }
}
?>
