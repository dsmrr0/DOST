<!DOCTYPE HTML>
<html>
<head>
    <title>Tree Management</title>
      
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
          
</head>
<body background="treebg.jpg">
  
    <!-- container -->
    <div class="container">
   
        <div class="page-header">
            <h1>Tree Management</h1>
        </div>
      
<?php
if($_POST){
 
    // include database connection
    include 'config/database.php';
 
    try{
     
        // insert query
        $qry = "INSERT INTO tree SET tree_num=:tree_num, tree_age=:tree_age, tree_desc=:tree_desc";
 
        // prepare query for execution
        $stmt = $con->prepare($qry);
 
        // posted values
        $tree_num=htmlspecialchars(strip_tags($_POST['tree_num']));
        $tree_age=htmlspecialchars(strip_tags($_POST['tree_age']));
        $tree_desc=htmlspecialchars(strip_tags($_POST['tree_desc']));
        
 
        // bind the parameters
        $stmt->bindParam(':tree_num', $tree_num);
        $stmt->bindParam(':tree_age', $tree_age);
        $stmt->bindParam(':tree_desc', $tree_desc);
        
        
         
         
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
            <td>Tree Number</td>
            <td><input type='text' name='tree_num' class='form-control' /></td>
        </tr>
        <tr>
            <td>Tree Age</td>
            <td><input type='text' name='tree_age' class='form-control' /></td>
        </tr>
        <tr>
            <td>Tree Description</td>
            <td><input type='text' name='tree_desc' class='form-control'></td>
        </tr>
    
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
            </td>
        </tr>
    </table>
</form>

<?php
// include database connection
include 'config/database.php';
 
// delete message prompt will be here
 
// select all data
$query = "SELECT tree_num, tree_age, tree_desc FROM tree ORDER BY tree_num DESC";
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
        echo "<th>Tree Number</th>";
        echo "<th>Tree Age</th>";
        echo "<th>Tree Description</th>";
 
    echo "</tr>";
     

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  
    extract($row);
     
    // creating new table row per record
    echo "<tr>";
        echo "<td>{$tree_num}</td>";
        echo "<td>{$tree_age}</td>";
        echo "<td>{$tree_desc}</td>";
         echo "<td>";
            // read one record 
        echo "<a href='read_tree.php?id={$tree_num}' class='btn btn-info m-r-1em'>Read</a>";
             
            // we will use this links on next part of this post
            echo "<a href='update_tree.php?id={$tree_num}' class='btn btn-primary m-r-1em'>Edit</a>";
 
            // we will use this links on next part of this post
            echo "<a href='delete_tree.php?id={$tree_num}' class='btn btn-danger'>Delete</a>";
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