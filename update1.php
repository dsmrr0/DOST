<!DOCTYPE HTML>
<html>
<head>
    <title>Update</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
</head>
<body background="tbg.png">
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Update Employee</h1>
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
    $query = "SELECT emp_id, emp_fname, emp_lname, emp_mi, emp_branch FROM employee WHERE emp_id = '$id';";
    $stmt = $con->prepare( $query );
     
    // this is the first question mark
    $stmt->bindParam(1, $id);
     
    // execute our query
    $stmt->execute();
     
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
    // values to fill up our form
    $fname = $row['emp_fname'];
    $lname = $row['emp_lname'];
    $mi = $row['emp_mi'];
    $empbranch = $row['emp_branch'];
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
        $query = "UPDATE employee 
                    SET emp_fname=:fname, emp_lname=:lname, emp_mi=:mi, emp_branch=:empbranch 
                    WHERE emp_id = :id";
 
        // prepare query for excecution
        $stmt = $con->prepare($query);
 
        // posted values
        $fname=htmlspecialchars(strip_tags($_POST['fname']));
        $lname=htmlspecialchars(strip_tags($_POST['lname']));
        $mi=htmlspecialchars(strip_tags($_POST['mi']));
        $empbranch=htmlspecialchars(strip_tags($_POST['empbranch']));
 
        // bind the parameters
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':mi', $mi);
        $stmt->bindParam(':empbranch', $empbranch);
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
            <td>First Name</td>
            <td><input type='text' name='fname' value="<?php echo htmlspecialchars($fname, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><input type='text' name='lname' value="<?php echo htmlspecialchars($lname, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
       
        <tr>
            <td>Middle Initial</td>
            <td><input type='text' name='mi' value="<?php echo htmlspecialchars($mi, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
         <tr>
            <td>DENR Branch</td>
            <td>
                    <select name="empbranch" value="<?php echo htmlspecialchars($empbranch,ENT_QUOTES);?>" class='form-control'>   
                    <option <?php if($empbranch=="Loakan"){echo "selected value='Loakan'";} ?>>Loakan</option>
                    <option <?php if($empbranch=="Session Road"){echo "selected value='Session Road'";} ?>>Session Road</option>
                    <option <?php if($empbranch=="Pacdal"){echo "selected value='Pacdal'";} ?>>Pacdal</option>
                        
                    </select>
                
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save Changes' class='btn btn-primary' />
                <a href='create.php' class='btn btn-danger'>Back to employee records</a>
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