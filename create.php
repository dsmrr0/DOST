<!DOCTYPE HTML>
<html>
<head>
    <title>DOST=PCHRD</title>
      
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
          
</head>
<body background="treebg.jpg">
  
    <!-- container -->
    <div class="container">
   
        <div class="page-header">
            <h1>DOST-PCHRD</h1>
        </div>
      
<?php
if($_POST){
 
    // include database connection
    include 'config/database.php';
 
    try{
     
        // insert query
        $query = "INSERT INTO DOSTPCHRD SET ID=:ID, DOCUMENT_TYPE=:DOCUMENT_TYPE, DOCUMENT_CATEGORY=:DOCUMENT_CATEGORY, DOCUMENT_TITLE=:DOCUMENT_TITLE, DOCUMENT_DESCRIPTION=:DOCUMENT_DESCRIPTION, ATTACHMENT=:ATTACHMENT, CRT_NAME=:CRT_NAME, CRT_DES=:CRT_DES, CRT_ROLE=:CRT_ROLE, CRT_EMAIL=:CRT_EMAIL";
 
        // prepare query for execution
        $stmt = $con->prepare($query);
 
        // posted values
        $ID=htmlspecialchars(strip_tags($_POST['ID']));
        $DOCUMENT_TYPE=htmlspecialchars(strip_tags($_POST['DOCUMENT_TYPE']));
        $DOCUMENT_CATEGORY=htmlspecialchars(strip_tags($_POST['DOCUMENT_CATEGORY']));
        $DOCUMENT_TITLE=htmlspecialchars(strip_tags($_POST['DOCUMENT_TITLE']));
        $DOCUMENT_DESCRIPTION=htmlspecialchars(strip_tags($_POST['DOCUMENT_DESCRIPTION']));
        $ATTACHMENT=htmlspecialchars(strip_tags($_POST['ATTACHMENT']));
        $CRT_NAME=htmlspecialchars(strip_tags($_POST['CRT_NAME']));
        $CRT_DES=htmlspecialchars(strip_tags($_POST['CRT_DES']));
        $CRT_ROLE=htmlspecialchars(strip_tags($_POST['CRT_ROLE']));
        $CRT_EMAIL=htmlspecialchars(strip_tags($_POST['CRT_EMAIL']));

 
        // bind the parameters
        $stmt->bindParam(':ID', $ID);
        $stmt->bindParam(':DOCUMENT_TYPE', $DOCUMENT_TYPE);
        $stmt->bindParam(':DOCUMENT_CATEGORY', $DOCUMENT_CATEGORY);
        $stmt->bindParam(':DOCUMENT_TITLE', $DOCUMENT_TITLE);
        $stmt->bindParam(':DOCUMENT_DESCRIPTION', $DOCUMENT_DESCRIPTION);
        $stmt->bindParam(':ATTACHMENT', $ATTACHMENT);
        $stmt->bindParam(':CRT_NAME', $CRT_NAME);
        $stmt->bindParam(':CRT_DES', $CRT_DES);
        $stmt->bindParam(':CRT_ROLE', $CRT_ROLE);
        $stmt->bindParam(':CRT_EMAIL', $CRT_EMAIL);

         
         
        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was saved.</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to save record.</div>";
        }
         
    }
     
    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
 
<!-- html form here where the product information will be entered -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
       
 
        <tr>
            <td>Document Type</td>
            <td><input type='text' name='DOCUMENT_TYPE' class='form-control'></td>
        </tr>
        <tr>
            <td>Document Category</td>
            <td><input type='text' name='DOCUMENT_CATEGORY' class='form-control'></td>
        </tr>
        <tr>
            <td>Document Title</td>
            <td><input type='text' name='DOCUMENT_TITLE' class='form-control'></td>
        </tr>
        <tr>
            <td>Document Description</td>
            <td><input type='text' name='DOCUMENT_DESCRIPTION' class='form-control'></td>
        </tr>
         <tr>
            <td>Attachment</td>
            <td><input type='text' name='ATTACHEMENT' class='form-control'></td>
        </tr>
        <tr>
            <td>Created By (Name)</td>
            <td><input type='text' name='CRT_NAME' class='form-control'></td>
        </tr>
        <tr>
            <td>Created By (Designation)</td>
            <td><input type='text' name='CRT_DES' class='form-control'></td>
        </tr>
        <tr>
            <td>Created By (Role)</td>
            <td><input type='text' name='CRT_ROLE' class='form-control'></td>
        </tr>
        <tr>
            <td>Created By (Email)</td>
            <td><input type='text' name='CRT_EMAIL' class='form-control'></td>
        </tr>
        <tr>
            <td>Updated By (Name)</td>
            <td><input type='text' name='' class='form-control'></td>
        </tr>
        <tr>
            <td>Updated By (Desigantion)</td>
            <td><input type='text' name='emp_mi' class='form-control'></td>
        </tr>
        <tr>
            <td>Updated By (Role)</td>
            <td><input type='text' name='emp_mi' class='form-control'></td>
        </tr>
        <tr>
            <td>Updated By (Email)</td>
            <td><input type='text' name='emp_mi' class='form-control'></td>
        </tr>

                          
        <tr>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
            </td>
        </tr>
    </table>
</form>


       <?php
// include database connection
include 'config/database.php';
 
$action = isset($_GET['action']) ? $_GET['action'] : "";
 
// if it was redirected from delete.php
if($action=='deleted'){
    echo "<div class='alert alert-success'>Record was deleted.</div>";
}
 
// select all data
$query = "SELECT ID, DOCUMENT_TYPE, DOCUMENT_CATEGORY, DOCUMENT_TITLE, DOCUMENT_DESCRIPTION FROM DOSTPCHRD ORDER BY ID DESC";
$stmt = $con->prepare($query);
$stmt->execute();
 
// this is how to get number of rows returned
$num = $stmt->rowCount();
 
// link to create record form
 
//check if more than 0 record found
if($num>0){
 
    echo "<table class='table table-hover table-responsive table-bordered'>";//start table
 
    //creating our table heading
    echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>DOCUMENT TYPE</th>";
        echo "<th>DOCUMENT CATEGORY</th>";
        echo "<th>DOCUMENT TITLE</th>";
        echo "<th>DOCUMENT DESCRIPTION</th>";
        echo "<th>ATTACHMENT</th>";
        echo "<th>CREATED BY (NAME)</th>";
        echo "<th>CREATED BY (DESIGNATION)</th>";
        echo "<th>CREATED BY (ROLE)</th>";
        echo "<th>CREATED BY (EMAIL)</th>";
  
    
 
    echo "</tr>";
     

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  
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
        echo "<td>{$CRT_DES}</td>";
        echo "<td>{$CRT_ROLE}</td>";
        echo "<td>{$CRT_EMAIL}</td>";
        
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



  
</body>
</html>
