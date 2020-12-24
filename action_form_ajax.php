
<?php 

$idArr = json_decode($_POST["id"]);
$nameArr = json_decode($_POST["name"]);
$salaryArr = json_decode($_POST["salary"]);
$deptArr = json_decode($_POST["dept"]);

$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "phpbasics";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

/*$results = $query->fetch(PDO::FETCH_NUM);
echo json_encode($results);

if(isset($_REQUEST['action']) and $_REQUEST['action']=="addmore"){
    extract($_REQUEST);
     
    foreach($id as $key=>$un){
        $db->query('INSERT INTO employee (id, name, salary, dept) VALUES ("'.$un.'", "'.$name[$key].'", "'.$salary[$key].'", "'.$dept[$key].'") ');
    }
    echo '<div class="alert alert-success"></i> Record added successfully!</div>|***|add';
}
?>*/
for ($i = 0; $i < count($idArr); $i++) {

   
    $sql="INSERT INTO employee (id, name, salary, dept)
VALUES
('$idArr[$i]','$nameArr[$i]','$salaryArr[$i]','$deptArr[$i])')";
    if (!mysqli_query($conn,$sql))
    {
        die('Error: ' . mysqli_error($conn));
    }
    }

Print  "Data added Successfully !";
mysqli_close($con);
?>