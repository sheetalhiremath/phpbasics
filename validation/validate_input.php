<!DOCTYPE html>
<html>
<head>

  <title>Add Records</title>
  </head>
<body>

<form action="db_insert.php" method="POST">
  ID : <input type="text" name="id" placeholder="Enter employee ID">
  <br/>
  Name : <input type="text" name="name" placeholder="Enter Name">
  <br/>
  Salary :<input type="text" name="salary" placeholder="Enter salary">
  <br/>
  Department :<input type="text" name="dept" placeholder="Enter Department">
  <br/>
  <input type="submit" name="submit" value="Submit">

  
</form>


<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "phpbasics";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	$result = mysqli_query($conn,"select * from employee");
      ?>
      <table border=2>
        <thead>
        <tr>
          <th>Employee_id</th>
          <th>Employee_Name</th>
          <th>Employee_salary</th>
          <th>Employee_dept</th>
          <th>Delete</th>
          
        </tr>
         </thead>
        <?php
        
          while( $row = $result->fetch_assoc() ){
            $deleteURL = "delete.php?id=" . $row['id'];
            echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["salary"]. "</td><td>" .$row["dept"]. "</td><td><a href='$deleteURL'>Delete</a></td></tr>";
          }

    echo "</table>";?>


     <?php $conn->close(); ?>


</body>


</html>