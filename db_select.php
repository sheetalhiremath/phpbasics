

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpbasics";

$eid = $_POST['id'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM employee where id = ". $eid;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["salary"]. " " . $row["dept"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>

 <button onclick="location.href='db_select_form.html'">Back</button>
