<!DOCTYPE HTML>
<html>
<head>
    <title>Read</title>
 
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
 
</head>
<body background="tbg.png">
 
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Employee Details</h1>
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
    $query = "SELECT emp_id, emp_fname, emp_lname, emp_mi, emp_branch FROM employee WHERE emp_id = ? LIMIT 0,1";
    $stmt = $con->prepare( $query );
 
    // this is the first question mark
    $stmt->bindParam(1, $id);
 
    // execute our query
    $stmt->execute();
 
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // values to fill up our form
    $emp_fname = $row['emp_fname'];
    $emp_lname = $row['emp_lname'];
    $emp_mi = $row['emp_mi'];
    $emp_branch = $row['emp_branch'];
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
 
     <!--we have our html table here where the record will be displayed-->
<table class='table table-hover table-responsive table-bordered'>
    <tr>
        <td>First Name</td>
        <td><?php echo htmlspecialchars($emp_fname, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Last Name</td>
        <td><?php echo htmlspecialchars($emp_lname, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Middle Initial</td>
        <td><?php echo htmlspecialchars($emp_mi, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>DENR Branch</td>
        <td><?php echo htmlspecialchars($emp_branch, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <a href='create.php' class='btn btn-danger'>Back to Records</a>
        </td>
    </tr>
</table>
 
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>