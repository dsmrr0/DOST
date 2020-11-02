<!DOCTYPE HTML>
<html>
<head>
    <title>DOST-PCHRD</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
    <!-- custom css -->
    <style>
    .m-r-1em{ margin-right:1em; }
    .m-b-1em{ margin-bottom:1em; }
    .m-l-1em{ margin-left:1em; }
    .mt0{ margin-top:0; }
    </style>
 
</head>
<body>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>DOST</h1>
        </div>
     
        <?php
// include database connection
include 'config/database.php';
 
// delete message prompt will be here
 
// select all data
$query = "SELECT ID, DOCUMENT_TYPE, DOCUMENT_CATEGORY, DOCUMENT_TITLE, DOCUMENT_DESCRIPTION FROM DOSTPCHRD ORDER BY ID DESC";
$res = mysqli_query($query);
$stmt = $con->prepare($query);
$stmt->execute();
 
// this is how to get number of rows returned
$num = $stmt->rowCount();
 
// link to create record form
echo "<a href='create.php' class='btn btn-primary m-b-1em'>New Record</a>";
 
//check if more than 0 record found
if($num>0){
 
    echo "<table class='table table-hover table-responsive table-bordered'>";//start table
 
    //creating our table heading
    echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Document Type</th>";
        echo "<th>Document Category</th>";
        echo "<th>Document Title</th>";
        echo "<th>Document Description</th>";
        echo "<th>Attachment</th>";
        echo "<th>Created By (Name)</th>";
        echo "<th>Created By (Designation)</th>";
        echo "<th>Created By (Role)</th>";
        echo "<th>Created By (Email)</th>";
        
    
 
    echo "</tr>";
     

while ($row = $mysql_fetch_array($res)){
  
    extract($row);
     
    // creating new table row per record
    echo "<tr>";
        echo "<td>{$ID}</td>";
        echo "<td>{$DOCUMENT_TYPE}</td>";
        echo "<td>{$DOCUMENT_CATEGORY}</td>";
        echo "<td>{$DOCUMENT_TITLE}</td>";
        echo "<td>{$DOCUMENT_DESCRIPTION}</td>";
        echo "<td>{$ATTACHMENT}</td>";
        echo "<td>{$CRT_NAME}</td>";
    echo "</tr>";
}
 
// end table
echo "</table>";
}     

 
// if no records found
else{
    echo "<div class='alert alert-danger'>No records found.</div>";
}
?>
         
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
<!-- confirm delete record will be here -->
 
</body>
</html>
