<?php
$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "phpbasics";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
$id=$_POST['id'];
$name=$_POST['name'];
$salary=$_POST['salary'];
$dept=$_POST['dept'];
$sql="INSERT INTO `employee` (`id`, `name`, `salary`, `dept`) VALUES ('$id', '$name', '$salary', '$dept')";
if ($conn->query($sql) === TRUE) {
    echo "data inserted";
}
else 
{
    echo "failed".$conn->query($sql);
}

?>