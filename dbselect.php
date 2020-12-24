 <!doctype html>
    <html>
    <head>
      <title>database connections</title>
    </head>
    <body>
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

      //execute the SQL query and return records
      $result = mysqli_query($conn,"select * from employee");
      ?>
      <table border=2>
        <thead>
      
        <tr>
          <th>Employee_id</th>
          <th>Employee_Name</th>
          <th>Employee_salary</th>
          <th>Employee_dept</th>
          <th>Delete</th>
          
        </tr>
         </thead>
        <?php
  
          while( $row = $result->fetch_assoc() ){
            $deleteURL = "delete.php?id=" . $row['id'];
            echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["salary"]. "</td><td>" .$row["dept"]. "</td><td><a href='$deleteURL'>Delete</a></td></tr>";
          }
    echo "</table>";?>
      

     
    </body>
    </html>