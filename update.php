<!DOCTYPE HTML>
<html>
<head>
    <title>Update</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
</head>
<body>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Update</h1>
        </div>
     

<?php
 
// check if form was submitted
if($_POST){
     
    try{
     
        // write update query
        // in this case, it seemed like we have so many fields to pass and 
        // it is better to label them and not use question marks
        $id = $_POST['id'];
        $fname = $_POST['emp_fname'];
        $lname = $_POST['emp_lname'];
        $mi = $_POST['emp_mi'];
        $branch = $_POST['emp_branch'];
        
        $sql = "UPDATE employee SET emp_fname='$fname',emp_lname='$lname',emp_mi='$mi',emp_branch='$branch' WHERE emp_id=$id;";
        
 
        // prepare query for excecution
        $stmt = $con->prepare($query);
 
        // posted values
        $emp_fname=htmlspecialchars(strip_tags($_POST['emp_fname']));
        $emp_lname=htmlspecialchars(strip_tags($_POST['emp_lname']));
        $emp_mi=htmlspecialchars(strip_tags($_POST['emp_mi']));
        $emp_branch=htmlspecialchars(strip_tags($_POST['emp_branch']));
 
        // bind the parameters
        $stmt->bindParam(':emp_fname', $emp_fname);
        $stmt->bindParam(':emp_lname', $emp_lname);
        $stmt->bindParam(':emp_mi', $emp_mi);
        $stmt->bindParam(':emp_branch', $emp_branch);
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
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?emp_id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>First Name</td>
            <td><input type='text' name='emp_fname' class='form-control' /></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><input type='text' name='emp_lname' class='form-control'></td>
        </tr>
        <tr>
            <td>Middle Initial</td>
            <td><input type='text' name='emp_mi' class='form-control'></td>
        </tr>
        <tr>
            <td>DENR Branch</td>
            <td>
                <form action="function dd.php" method="post">
                    <select name="emp_branch">
                    <option value="Loakan">Loakan</option>
                    <option value="Session Road">Session Road</option>
                    <option value="Pacdal">Pacdal</option>
                    </select>
                </form>
            </td>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save Changes' class='btn btn-primary' />
                <a href='create.php' class='btn btn-danger'>Back to records</a>
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