<?php
//insert.php
include("connection.php");
if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {
  $program_id = mysqli_real_escape_string($connection, $_POST["program_id"]);
  $document_name = mysqli_real_escape_string($connection, $_POST["document_name"]);
  $document_type = mysqli_real_escape_string($connection, $_POST["document_type"]);
  $document_image = mysqli_real_escape_string($connection, $_POST["document_image"]);
  $document_recieved = mysqli_real_escape_string($connection, $_POST["document_recieved"]);
  $document_date = mysqli_real_escape_string($connection, $_POST["document_date"]);
  $document_dater = mysqli_real_escape_string($connection, $_POST["document_dater"]);
  $document_remarks = mysqli_real_escape_string($connection, $_POST["document_remarks"]);



  
  $query = "
   INSERT INTO document(program_id, document_name, document_type,document_image,document_recieved,document_date,document_dater,document_remarks) 
   VALUES ('".$program_id."', '".$document_name."', '".$document_type."',".$document_image."','".$document_recieved."','".$document_date."','".$document_dater."','".$document_remarks."')
  ";
  if(mysqli_query($connection, $query))
  {
   echo 'document Inserted';
  }
 }
 if($_POST["operation"] == "Edit")
 {
    $program_id = mysqli_real_escape_string($connection, $_POST["program_id"]);
    $document_name = mysqli_real_escape_string($connection, $_POST["document_name"]);
    $document_type = mysqli_real_escape_string($connection, $_POST["document_type"]);
    $document_image = mysqli_real_escape_string($connection, $_POST["document_image"]);
    $document_recieved = mysqli_real_escape_string($connection, $_POST["document_recieved"]);
    $document_date = mysqli_real_escape_string($connection, $_POST["document_date"]);
    $document_dater = mysqli_real_escape_string($connection, $_POST["document_dater"]);
    $document_remarks = mysqli_real_escape_string($connection, $_POST["document_remarks"]);
  $query = "
   UPDATE document 
   SET program_id = '".$program_id."', 
   document_name = '".$document_name."', 
   document_price = '".$document_price."' 
   WHERE document_id = '".$_POST["document_id"]."'
  ";
  if(mysqli_query($connection, $query))
  {
   echo 'document Updated';
  }
 }
}
?>