<!DOCTYPE HTML>
<html>
<head>
    <title>Update Tree</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
</head>
<body>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Update Tree</h1>
        </div>
     
<?php
// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
//include database connection
include 'config/database.php';
 
// read current record's data
try {
    // prepare select query
    $query = "SELECT tree_num, tree_age, tree_desc FROM tree WHERE tree_num = ? LIMIT 0,1";
    $stmt = $con->prepare( $query );
     
    // this is the first question mark
    $stmt->bindParam(1, $id);
     
    // execute our query
    $stmt->execute();
     
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
    // values to fill up our form
    $treenum = $row['tree_num'];
    $treeage = $row['tree_age'];
    $treedesc = $row['tree_desc'];
    
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
 
<?php
 
// check if form was submitted
if($_POST){
     
    try{
     
        // write update query
        // in this case, it seemed like we have so many fields to pass and 
        // it is better to label them and not use question marks
        $query = "UPDATE tree 
                    SET tree_num=:treenum, tree_age=:treeage, tree_desc=:treedesc 
                    WHERE tree_num = :treenum";
 
        // prepare query for excecution
        $stmt = $con->prepare($query);
 
        // posted values
        $treenum=htmlspecialchars(strip_tags($_POST['treenum']));
        $treeage=htmlspecialchars(strip_tags($_POST['treeage']));
        $treedesc=htmlspecialchars(strip_tags($_POST['treedesc']));
 
        // bind the parameters
        $stmt->bindParam(':treenum', $treenum);
        $stmt->bindParam(':treeage', $treeage);
        $stmt->bindParam(':treedesc', $treedesc);
        $stmt->bindParam(':id', $id);
         
        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was updated.</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
        }
         
    }
     
    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
 
<!--we have our html form here where new record information can be updated-->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Tree Number</td>
            <td><input type='text' name='treenum' value="<?php echo htmlspecialchars($treenum, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Tree Age</td>
            <td><input type='text' name='treeage' value="<?php echo htmlspecialchars($treeage, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
       
        <tr>
            <td>Tree Description</td>
            <td><input type='text' name='treedesc' value="<?php echo htmlspecialchars($treedesc, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save Changes' class='btn btn-primary' />
                <a href='tree.php' class='btn btn-danger'>Back to tree records</a>
            </td>
        </tr>
    </table>
</form>
         
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>