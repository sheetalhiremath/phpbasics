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

            echo "<tr>
            <td>" . $row["id"]. "</td>
            <td>" . $row["name"]. "</td>
            <td>" . $row["salary"]. "</td>
            <td>" .$row["dept"]. "</td>
            <td><input type='checkbox' name='delete[]' value='<?php= $id ?>' ></td>
            </tr>"
            ;
          }
          ?>
          
    <?php echo "</table>";?>


     <?php $conn->close(); ?>