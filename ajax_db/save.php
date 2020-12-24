<?php
	$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "phpbasics";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Takes raw data from the request
$json = file_get_contents('php://input');
$arraydata = json_decode($json);

    

 //print_r($data); exit;

    foreach($arraydata as $data) {
    	$sql="INSERT INTO `employee`(`id`, `name`, `salary`, `dept`) VALUES ('$data[0]','$data[1]','$data[2]','$data[3]')";
    	echo $sql;
    	$result = mysqli_query($conn, $sql);
    }
    
 /*not allowing empty values and the row which has been removed.*/
 // $sql="INSERT INTO employee (id, name, salary,dept) VALUES ('$id[$i]','$name['i'],$salary[$i]','$dept[$i]')";
//$insert = mysqli_query($conn,"INSERT INTO `employee`(`id`, `name`, `salary`, `dept`) VALUES ('$data[0]','$data[1]','$data[2]','$data[3]')");
    

  /*$sql = "INSERT INTO employee ( `id`, `name`, `salary`, `dept`) VALUES 
  ('$id','$name','$salary','$dept')";	
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	} 

*/	mysqli_close($conn);
?>