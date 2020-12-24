<!DOCTYPE html>
<html>
<head>

  <title>Add Records</title>
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
	$result = mysqli_query($conn,"select * from employee");
      ?>
      <table border=2>
        <thead>
        <tr>
          <th>Employee_id</th>
          <th>Employee_Name</th>
          <th>Employee_salary</th>
          <th>Employee_dept</th>
          
          
        </tr>
         </thead>
          

        <?php
  
          while( $row = $result->fetch_assoc() ){
            $deleteURL = "delete.php?id=" . $row['id'];
            echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["salary"]. "</td><td>" .$row["dept"]. "</td></tr>";
          }
   ?>
    <tbody>
          <tr id='addr0'>
            
            <td>
              <input type="text" name='id' placeholder='id' class="form-control" />
            </td>
            <td>
              <input type="text" name='name' placeholder='name' class="form-control" />
            </td>
            <td>
              <input type="text" name='salary' placeholder='salary' class="form-control" />
            </td>
            <td>
              <input type="text" name='dept' placeholder='dept' class="form-control" />
            </td>
          </tr>
          <tr id='addr1'></tr>
        </tbody>
          <button id="add_row" class="btn btn-primary btn-lg pull-left">SUBMIT</button>

</table>
<?php echo "</table>";?>
     <?php $conn->close(); ?>

<script >
     $(document).ready(function(e) {
    $("#add_row").on("click",function(){
        $.ajax({
            type:'POST',
            url:'action_form_ajax.php',
            data:{'action':'addDataRow'},
            success: function(data){
                $('#tb').append(data);
            }
        });
    });
});

</script>
</body>


</html>