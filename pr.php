<?php
	$conn=mysqli_connect("localhost:3307","username","password","company");
	if(isset($_POST['todo'])){
		if($_POST['todo']=='getItem1'){
			$qry="SELECT concat(first_name,' ',last_name) AS name, gender, 
			floor(datediff(curdate(),birth_date)/365.25) age, 
			floor(datediff(curdate(),hire_date)/365.25) YIS 
			FROM employees ORDER BY birth_date ASC LIMIT 5;";
			$res=mysqli_query($conn, $qry);
			$item1="<tr><td>Name</td><td>Gender</td><td>Age</td><td>YIS</td></tr>";
			while($row=mysqli_fetch_assoc($res)){
				$item1.="<tr><td>".$row['name']."</td>
						<td>".($row['gender'] == 'M'? 'Male':'Female')."</td>
						<td>".$row['age']."</td>
						<td>".$row['YIS']."</td></tr>";
			}
			echo $item1;
		}else if($_POST['todo']=='getItem2'){
			$str=$_POST['search_item'];
			$qry="SELECT concat(first_name,' ',last_name) as name, dept_name, title 
					FROM employees
					INNER JOIN titles ON employees.emp_no=titles.emp_no
					INNER JOIN dept_emp ON employees.emp_no=dept_emp.emp_no
					INNER JOIN departments ON dept_emp.dept_no=departments.dept_no
					WHERE last_name LIKE '%$str%' OR first_name LIKE '%$str%' 
					AND titles.to_date = '9999-01-01' AND dept_emp.to_date = '9999-01-01'  
					ORDER BY  dept_name, last_name LIMIT 4;";
		
			$res=mysqli_query($conn, $qry);
			$item2="<table class='table'><tr><td>Name</td><td>Department</td><td>Title</td></tr>";
			while($row=mysqli_fetch_assoc($res)){
				$item2.="<tr><td>".$row['name']."</td>
						<td>".$row['dept_name']."</td>
						<td>".$row['title']."</td></tr>";
			}
			$item2.="</table>";
			echo $item2;
		}else if($_POST['todo']=='getItem3'){
			$dept=$_POST['dept'];
			if($dept=="all"){
				$qry="select distinct title from dept_emp
				inner join departments on departments.dept_no = dept_emp.dept_no
				inner join titles on titles.emp_no = dept_emp.emp_no;";
			}else{
				$qry="select distinct title from dept_emp dept_emp
				inner join departments on departments.dept_no = dept_emp.dept_no
				inner join titles on titles.emp_no = dept_emp.emp_no
				where departments.dept_no = '$dept';";
			}
			$res=mysqli_query($conn, $qry);
			$item3="";
			while($row=mysqli_fetch_assoc($res)){
				$item3=$item3."<option>".$row['title']."</option>";;
			}
			echo $item3;
		}
	}else{
		header("./exam.php");
	}
?>




