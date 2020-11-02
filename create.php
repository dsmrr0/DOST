<!DOCTYPE HTML>
<html>
<head>
    <title>Employee</title>
      
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
          
</head>
<body background="treebg.jpg">
  
    <!-- container -->
    <div class="container">
   
        <div class="page-header">
            <h1>Online Re-Admission Form</h1>
        </div>
      
<?php
if($_POST){
 
    // include database connection
    include 'config/database.php';
 
    try{
     
        // insert query
        $query = "INSERT INTO employee SET emp_id=:emp_id, emp_fname=:emp_fname, emp_lname=:emp_lname, emp_mi=:emp_mi, emp_branch=:emp_branch";
 
        // prepare query for execution
        $stmt = $con->prepare($query);
 
        // posted values
        $emp_id=htmlspecialchars(strip_tags($_POST['emp_id']));
        $emp_fname=htmlspecialchars(strip_tags($_POST['emp_fname']));
        $emp_lname=htmlspecialchars(strip_tags($_POST['emp_lname']));
        $emp_mi=htmlspecialchars(strip_tags($_POST['emp_mi']));
        $emp_branch=htmlspecialchars(strip_tags($_POST['emp_branch']));
 
        // bind the parameters
        $stmt->bindParam(':emp_id', $emp_id);
        $stmt->bindParam(':emp_fname', $emp_fname);
        $stmt->bindParam(':emp_lname', $emp_lname);
        $stmt->bindParam(':emp_mi', $emp_mi);
        $stmt->bindParam(':emp_branch', $emp_branch);
         
         
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
            <td>Term</td>
            <td><input type='text' name='emp_mi' class='form-control'></td>
        </tr>
        <tr>
            <td>School Year</td>
            <td><input type='text' name='emp_mi' class='form-control'></td>
        </tr>
        <tr>
            <td>Failing Grade</td>
            <td>
                <form action="function dd.php" method="post">
                    <select name="emp_branch">
                    <option value="Loakan">74</option>
                    <option value="Loakan">73</option>
                        <option value="Loakan">72</option>
                        <option value="Loakan">71</option>
                        <option value="Loakan">70</option>
                    </select>
                </form>
            </td>
        </tr>
        <tr>
        <td>Unofficially Dropped</td>
        <td>
                            <input type="radio" name="yes" value="yes"> yes
                            <input type="radio" name="yes" value="no"> no<br><br> 
        </td>
            </tr>
        <table id="t01">
                                <tr id="tdfirst">
                                    <td>Courses</td>
                                    <td>Unit</td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="one" placeholder="" required /></td>
                                    <td><input type="number" name="two" placeholder="" style="height:25px; width: 190px; margin-top: -20px;" required /></td>
                                </tr>
                            </table>
                            <input type="button" name="btn" onclick="courseunit()" value="Add More">
        <tr>
            <td></td>
            <br>
            
            <br>
            <label><b>due to (reason/s)</b></label>
                            <textarea id="reason" name="reason" placeholder="Write the reasons.." style="height:100px" required></textarea>
                            
                            <label><b>I promise</b></label>
                            <textarea id="promise" name="promise" placeholder="I promise.." style="height:100px" required></textarea>
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
$query = "SELECT emp_id, emp_fname, emp_lname, emp_mi, emp_branch FROM employee ORDER BY emp_id DESC";
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
        echo "<th>First Name</th>";
        echo "<th>Last Name</th>";
        echo "<th>Middle Initial</th>";
        echo "<th>DENR Branch</th>";
 
    echo "</tr>";
     

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  
    extract($row);
     
    // creating new table row per record
    echo "<tr>";
        echo "<td>{$emp_id}</td>";
        echo "<td>{$emp_fname}</td>";
        echo "<td>{$emp_lname}</td>";
        echo "<td>{$emp_mi}</td>";
        echo "<td>{$emp_branch}</td>";
        echo "<td>";
            // read one record 
        echo "<a href='read_one.php?id={$emp_id}' class='btn btn-info m-r-1em'>Read</a>";
             
            // we will use this links on next part of this post
            echo "<a href='update1.php?id={$emp_id}' class='btn btn-primary m-r-1em'>Edit</a>";
 
            // we will use this links on next part of this post

            echo "<a href='delete.php?id={$emp_id}' class='btn btn-danger'>Delete</a>";
        echo "</td>";
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