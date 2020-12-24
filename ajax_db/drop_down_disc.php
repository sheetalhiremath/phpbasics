<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "phpbasics";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
    }
	if(isset($_POST['Model_ID']) && $_POST['Model_ID'] !='')
	{
		$brandID = $_POST['Model_ID'];
		
		$sql = "select * from model";
		$rs = mysqli_query($conn,$sql);
		$numRows = mysqli_num_rows($rs);
		
		if($numRows == 0)
		{
			echo 'No Models Found';
		}
		else
		{
			while($Model = mysqli_fetch_assoc($rs))
			{
				echo ($Model['discription']);
			}
		}
		
	}
 $conn->close();
?>