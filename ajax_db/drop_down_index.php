<!DOCTYPE html>
<html>
<head>
	<title>Insert data in MySQL database using Ajax</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
        $sql = "select * from brand";
        $rs = mysqli_query($conn,$sql);
   ?>
    <form id="carbrand" action="" method="post">
        <label>Country: </label>
            <select id="Brand" name="brand_name">
                <option value="">Select Model</option>
                <?php 
                    while($rows = mysqli_fetch_assoc($rs))
                    {
                        echo '<option value="'.$rows['ID'].'">'.$rows['Name'].'</option>';
                    }
                ?>
            </select>
            <div id="carmodel">
                <label>Model: </label>
                <select name="modeldropdown" id="modeldropdown">
                </select>
            </div>
            
            <div id="message"></div>
    </form> 


    <script type="text/javascript">
    $(document).ready(function(){
    $("#Brand").change(function(){
    var getBrandID = $(this).val();
    
    if(getBrandID !='')
    {
        //$("#loader").show();
        $(".cities-container").html("");
        
        $.ajax({
            type:'post',
            data:{ID:getBrandID},
            url: 'drop_down_db.php',
            success:function(returnData){
                //$("#loader").hide();    
                $("#modeldropdown").html(returnData);
            }
        }); 
    }
    else
    {
        $("#modeldropdown").html("");
    }
    
});
});

  </script>

   <script type="text/javascript">
    $(document).ready(function(){
    $("#modeldropdown").change(function(){
    var getModelID = $(this).val();
    
    if(getModelID !='')
    {
        //$("#loader").show();
        $(".cities-container").html("");
        
        $.ajax({
            type:'post',
            data:{Model_ID:getModelID},
            url: 'drop_down_disc.php',
            success:function(returnData){
                //$("#loader").hide();  
                $("#message").html(returnData);
            }
        }); 
    }
    else
    {
        $("#message").html("");
    }
    
});
});

  </script>
    </body>
    </html>
