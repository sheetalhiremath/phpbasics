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
                <option value="">Select Brand</option>
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

<?php $sql2 = "select * from  Model"; 
    $result = mysqli_query($conn,$sql2); 
    while($row = $result->fetch_array()) { 
    $ModelData[] = array( 
        "Model_ID" => $row["Model_ID"], 
        "Model_Name" => $row["Model_Name"], 
        "ID" => $row["ID"], 
        "discription" => $row["discription"], 
    ); 
} 

    array_push($ModelData,$result);

    $modelvalues = $ModelData;

    echo json_encode($ModelData);
?> 

<script type="text/javascript">
    $(document).ready(function(){


        jsonData = <?php echo json_encode($ModelData); ?>; 
        $("#Brand").change(function(){ 
        //alert($("#Brand").val());
           $('#modeldropdown').empty();
            modelVals = getObjects(jsonData, 'ID', $("#Brand").val());
            //alert(modelVals);
            $.each(modelVals, function(i, v){
                //alert(i);\
                //modelarr = JSON.parse(v);
                //alert(modelarr);
                /*console.log(v);
                var selectModelAr = [];
                $.each(v, function(t, r){
                    if(t == 'Model_ID'){
                        modelid = r;
                    }
                    if(t == 'Model_Name'){
                        modelname = r;
                    }
                });*/
                optionval = "<option value='"+modelVals[i].Model_ID+"'>"+modelVals[i].Model_Name+"</option>";
                $('#modeldropdown').append(optionval);
                //alert(optionval);
            });
        });


        function getObjects(obj, key, val) {
            var objects = [];
            for (var i in obj) {
                if (!obj.hasOwnProperty(i)) continue;
                if (typeof obj[i] == 'object') {
                    objects = objects.concat(getObjects(obj[i], key, val));
                } else if (i == key && obj[key] == val) {
                    objects.push(obj);
                }
            }
            return objects;
        }
    });
</script>


    </body>
    </html>
