<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpbasics";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['submit']))
{		
    $id = $_POST['id'];
    $name = $_POST['name'];
    $salary = $_POST['salary'];
    $dept = $_POST['dept'];
    
    $insert = mysqli_query($conn,"INSERT INTO `employee`(`id`, `name`, `salary`, `dept`) VALUES ('$id','$name','$salary','$dept')");
    if(!$insert)
    {
        echo mysqli_error();
    }
    else
    {
        echo "Records added successfully.";
    }
}
header("Location:insert_deleted.php");;
        exit();
mysqli_close($conn); // Close connection
?>
<button onclick="location.href='insert_deleted.php'">Back</button>

