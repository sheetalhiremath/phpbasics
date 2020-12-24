<!doctype html>
    <html>
    <head>
    	<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="tablesorter/jquery.tablesorter.min.js"></script>
      <title>database connections</title>
    </head>
    <body>
<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "phpbasics";
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

?>
<table id="sortTable" class="tablesorter">
<thead>
<tr>
<th>Employee Id</th>
<th>Employee Name</th>
<th>Salary</th>
<th>Dept</th>
</tr>
</thead>
<tbody>
<?php
$sql = "SELECT id, name, salary, dept
FROM employee";
$resultset = mysqli_query($conn, $sql);
while( $row = $resultset->fetch_assoc() ){
?>
<tr>
<td><?= $id; ?></td>
<td><?= $name; ?></td>
<td><?= $salary; ?></td>
<td><?= $dept; ?></td>
</tr>
<?php } ?>
</tbody>
</table>

<script>
$(document).ready(function() {
$("#sortTable").tablesorter();
}
);
</script>