<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "phpbasics";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	$id = $_GET['id'];
	$sql= mysqli_query($conn,"DELETE FROM employee WHERE id='$id'");
	$conn->close();
	//header("Location:insert_deleted.php");;
		//exit();
	    ?>
    
 
