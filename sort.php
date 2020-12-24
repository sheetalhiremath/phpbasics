<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Insert</title>
</head>
<body>
<div class='container'>
 <table border='1' id='recordsTable' class="table" >
   <tr style='background: whitesmoke;'>
     <th class="sort-heading" id="id-desc">id</th>
     <th class="sort-heading" id="name-desc">name</th>
     <th class="sort-heading" id="salary-desc">salary</th>
     <th class="sort-heading" id="dept-desc">dept</th>
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

<script type="text/javascript">
  $(document).ready(function(){
    $(".sort-heading").click(function(){
      
      //get data-nex-order value
      var getSortHeading = $(this);
      var getNextSortOrder = getSortHeading.attr('id');
      
      
      var splitID = getNextSortOrder.split('-');
      


      var splitIDName = splitID[0];
      var splitOrder = splitID[1];
      

      
      //get current td value
      var getColumnName = getSortHeading.text();
      
      //alert(getColumnName);

      
      $.ajax({
        url:'get_employee_data.php',
        type:'post',
        data:{'column':getColumnName,'sortOrder':splitOrder},
        success: function(response){
          if(splitOrder == 'asc')
          {
            getSortHeading.attr('id',splitIDName+'-desc');
          }
          else
          {
            getSortHeading.attr('id',splitIDName+'-asc');
          } 
          
          $(".table tr:not(:first)").remove();
          $(".table").append(response);
        }
      });
      
    });
  });
</script>

