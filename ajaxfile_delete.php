<?php 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "phpbasics";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

$id = $_POST['id'];

foreach($id as $id){ 
  // Delete record 
  $query = "DELETE FROM employee WHERE id=".$id; 
  mysqli_query($conn,$query);
}
echo 1;