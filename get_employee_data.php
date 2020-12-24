<?php 

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "phpbasics";
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

	
		
	if(isset($_POST['column']) && isset($_POST['sortOrder']))
	{
		$columnName = str_replace(" ","_",strtolower($_POST['column']));
		$sortOrder  = $_POST['sortOrder'];
		
		
		$sql = "select id, name, salary, dept from employee order by ".$columnName." ".$sortOrder;
		
		//echo $sql;
		$rs = mysqli_query($conn, $sql);
		
		
		
			while($rows = $rs->fetch_assoc())
			{
				echo "<tr>";
					echo "<td>".$rows['id']."</td>";
					echo "<td>".$rows['name']."</td>";
					echo "<td>".$rows['salary']."</td>";
					echo "<td>".$rows['dept']."</td>";
				echo "</tr>";
			}
		
		
	}
?>
