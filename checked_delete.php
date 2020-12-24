<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Insert</title>
</head>
<body>
<div class='container'>
 <input type='button' value='Delete' id='delete'><br><br>
 <table border='1' id='recordsTable' >
   <tr style='background: whitesmoke;'>
     <th>&nbsp;</th>
     <th>id</th>
     <th>name</th>
     <th>sal</th>
     <th>dep</th>
   </tr>

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
   <?php 
   $query = "SELECT * FROM employee";
   $result = mysqli_query($conn,$query);

   $count = 1;
   while($row = mysqli_fetch_array($result) ){
     $id = $row['id'];
     $name = $row['name'];
     $salary= $row['salary'];
     $dept=$row['dept'];
 
   ?>
     <tr id='tr_<?= $id?>'>
       <td><input type='checkbox' id='<?php echo $id; ?>' ></td>
       <td><?= $id; ?></td>
       <td><?= $name; ?></td>
       <td><?= $salary; ?></td>
       <td><?= $dept; ?></td>
       
     </tr>
   <?php
    $count++;
  }
  ?>
 </table>
</div>

<script>

$(document).ready(function(){

  $('#delete').click(function(){

    var post_arr = [];

    // Get checked checkboxes
    $('#recordsTable input[type=checkbox]').each(function() {
      if (jQuery(this).is(":checked")) {
        var id = this.id;
        //var splitid = id.split('_');
        //var postid = splitid[1];

        post_arr.push(id);
        
      }
    });

    if(post_arr.length > 0){

        var isDelete = confirm("Do you really want to delete records?");
        if (isDelete == true) {
           // AJAX Request
           $.ajax({
              url: 'ajaxfile_delete.php',
              type: 'POST',
              data: { id: post_arr},
              success: function(response){
                 $.each(post_arr, function( i,l ){
                     $("#tr_"+l).remove();
                 });
              }
           });
        } 
    } 
  });
 
});
</script>