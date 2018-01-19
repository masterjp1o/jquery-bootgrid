<?php
include("connection.php");
$query = "SELECT * FROM program";
$result = mysqli_query($connection, $query);
$output = '';

while($row = mysqli_fetch_array($result))
{
 $output .= '<option value="'.$row["program_id"].'">'.$row["program_name"].'</option>';
}


?>
<html>
 <head>
  <title>BLGD Document management System</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.js"></script>  
  <style>
   body
   {
    margin:0;
    padding:0;
    background-color:#f1f1f1;
   }
   .box
   {
    width:1270px;
    padding:20px;
    background-color:#fff;
    border:1px solid #ccc;
    border-radius:5px;
    margin-top:25px;
   }
  </style>
 </head>
 <body>
  <div class="container box">
   <h1 align="center">BLGD Document Management System</h1>
   <br />
   <div align="right">
    <button type="button" id="add_button" data-toggle="modal" data-target="#documentModal" class="btn btn-info btn-lg">Add a document</button>
   </div>
   <div class="table-responsive">
    <table id="document_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th data-column-id="document_id" data-type="numeric">ID</th>
       <th data-column-id="document_name">Document title</th>
       <th data-column-id="document_type">document type</th>
       <th data-column-id="document_image">image</th>
       <th data-column-id="document_recieved">Document type</th>
       <th data-column-id="document_date">date recieved</th>
       <th data-column-id="document_dater">recieved by</th>
       <th data-column-id="document_remarks">Remarks</th>
       <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
      </tr>
     </thead>
    </table>
   </div>
 </body>
</html>
<script type="text/javascript" language="javascript" >
$(document).ready(function(){
 $('#add_button').click(function(){
  $('#document_form')[0].reset();
  $('.modal-title').text("Add document");
  $('#action').val("Add");
  $('#operation').val("Add");
 });
 
 var documentTable = $('#document_data').bootgrid({
  ajax: true,
  rowSelect: true,
  post: function()
  {
   return{
    id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
   };
  },
  url: "fetch.php",
  formatters: {
   "commands": function(column, row)
   {
    return "<button type='button' class='btn btn-warning btn-xs update' data-row-id='"+row.document_id+"'>Edit</button>" + 
    "&nbsp; <button type='button' class='btn btn-danger btn-xs delete' data-row-id='"+row.document_id+"'>Delete</button>";
   }
  }
 });
 
 $(document).on('submit', '#document_form', function(event){
  event.preventDefault();
  var program_id = $('#program_id').val();
  var document_name = $('#document_name').val();
  var document_type = $('#document_type').val();
  var form_data = $(this).serialize();
  if(program_id != '' && document_name != '' && document_type != '')
  {
   $.ajax({
    url:"insert.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     alert(data);
     $('#document_form')[0].reset();
     $('#documentModal').modal('hide');
     $('#document_data').bootgrid('reload');
    }
   });
  }
  else
  {
   alert("All Fields are Required");
  }
 });
 
 $(document).on("loaded.rs.jquery.bootgrid", function()
 {
  documentTable.find(".update").on("click", function(event)
  {
   var document_id = $(this).data("row-id");
    $.ajax({
    url:"fetch_single.php",
    method:"POST",
    data:{document_id:document_id},
    dataType:"json",
    success:function(data)
    {
     $('#documentModal').modal('show');
     $('#program_id').val(data.program_id);
     $('#document_name').val(data.document_name);
     $('#document_type').val(data.document_type);
     $('#document_recieved').val(data.document_recieved);
     $('#document_data').val(data.document_data);
     $('#document_dater').val(data.document_dater);
     $('#document_remarks').val(data.document_remarks);
     $('.modal-title').text("Edit document");
     $('#document_id').val(document_id);
     $('#action').val("Edit");
     $('#operation').val("Edit");
    }
   });
  });
 });
 
 $(document).on("loaded.rs.jquery.bootgrid", function()
 {
  documentTable.find(".delete").on("click", function(event)
  {
   if(confirm("Are you sure you want to delete this?"))
   {
    var document_id = $(this).data("row-id");
    $.ajax({
     url:"delete.php",
     method:"POST",
     data:{document_id:document_id},
     success:function(data)
     {
      alert(data);
      $('#document_data').bootgrid('reload');
     }
    })
   }
   else{
    return false;
   }
  });
 }); 
});
</script>
<div id="documentModal" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="document_form">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">Add document</h4>
    </div>
    <div class="modal-body">
     <label>Select a Program</label>
     <select name="program_id" id="program_id" class="form-control">
      <option value="">Select program</option>
      <?php echo $output; ?>
     </select>
     <br />
     <label>Enter document Name</label>
     <input type="text" name="document_name" id="document_name" class="form-control" />
</br>
     <label>Select a Document Type</label>
     <select name="document_type" class="form-control">
      <option value="document_type" name="document_type">Memorandum</option>
      <option value="document_type" name="document_type">Department order</option>
      <option value="document_type" name="document_type">Advisory</option>
      <option value="document_type" name="document_type">Report</option>
      <option value="document_type" name="document_type">Bureau Order</option>
        
     </select>
     <label>Document Image</label>
     <input type="text" name="document_image" id="document_image" class="form-control" />
     <br />
     <label>document recieved by:</label>
     <input type="text" name="document_recieved" id="document_recieved" class="form-control" />
     <br />
     <label>date released</label>
     <input type="date" name="document_date" id="document_date" class="form-control" />
     <br />
     <label>date recieved</label>
     <input type="date" name="document_dater" id="document_dater" class="form-control" />
     <br /> 
     <label>remarks</label>
     <input type="text" name="document_remarks" id="document_remarks" class="form-control" />
     <br /> 

    </div>
    <div class="modal-footer">
     <input type="hidden" name="document_id" id="document_id" />
     <input type="hidden" name="operation" id="operation" />
     <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
    </div>
   </div>
  </form>
 </div>
</div>
