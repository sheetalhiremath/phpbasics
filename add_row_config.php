<?php 
$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "phpbasics";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

if(isset($_REQUEST['action']) and $_REQUEST['action']=="addDataRow"){
    ?>
    <tr>
        <td><input type="text" name="id[]" class="form-control" required="required"></td>
        <td><input type="text" name="name[]" class="form-control" required="required"></td>
        <td><input type="email" name="salary[]" class="form-control" required="required"></td>
        <td><input type="text" name="dept[]" class="form-control" required="required"></td>
    </tr>
    <?php
    echo '|***|addmore';
}
 
//Submit data or extra rows
if(isset($_REQUEST['action']) and $_REQUEST['action']=="saveAddMore"){
    extract($_REQUEST);
     
    foreach($username as $key=>$un){
        $db->query('INSERT INTO employee (id, name, salary, dept) VALUES ("'.$id[$key].'", "'.$name[$key].'", "'.$salary[$key].'", "'.$dept[$key].'") ');
    }
    echo '<div class="alert alert-success"><i class="fa fa-fw fa-thumbs-up"></i> Record added successfully!</div>|***|add';
}