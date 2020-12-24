
<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "phpbasics";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
    }
	if(isset($_POST['ID']) && $_POST['ID'] !='')
	{
		$brandID = $_POST['ID'];
		$sql = "select * from model where ID = '.$brandID.'";;
		$rs = mysqli_query($conn,$sql);
		$numRows = mysqli_num_rows($rs);
		
		if($numRows == 0)
		{
			echo 'No Models Found';
		}
		else
		{
			echo '<option value="0">Select Model</option>';
			while($Model = mysqli_fetch_assoc($rs))
			{
				echo '<option value="'.$Model['Model_ID'].'">'.$Model['Model_Name'].'</option>';
			}
		}
		
	}
 
?>