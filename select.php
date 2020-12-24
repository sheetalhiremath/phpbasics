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
$records = mysqli_query($conn,"select * from employee"); // fetch data from database

while($data = mysqli_fetch_array($records))
{
?>
  <tr>
    <td><?php echo $data['id']; ?></td>
    <td><?php echo $data['name']; ?></td>
    <td><?php echo $data['salary']; ?></td>
    <td><?php echo $data['dept'];?></td>
  </tr> 
<?php
}
?>
</table>
<?php mysqli_close($conn); // Close connection ?>

