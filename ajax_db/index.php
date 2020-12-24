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
    ?>
<!--<div style="margin: auto;width: 60%;">
	<div class="alert alert-success alert-dismissible" id="success" style="display:none;">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	</div>
	<form id="fupForm" name="form1" method="post">
		<div class="form-group">
			<label for="email">ID:</label>
			<input type="text" class="form-control" id="id" placeholder="id" name="id">
		</div>
		<div class="form-group">
			<label for="pwd">Name:</label>
			<input type="email" class="form-control" id="name" placeholder="name" name="name">
		</div>
		<div class="form-group">
			<label for="pwd">salary:</label>
			<input type="text" class="form-control" id="salary" placeholder="salary" name="salary">
		</div>
		<div class="form-group" >
			<label for="pwd">dept:</label>
			<input type="text" class="form-control" id="dept" placeholder="dept" name="dept">
		</div>
		<input type="button" name="save" class="btn btn-primary" value="Save to database" id="butsave">
	</form>
</div>-->
 <div id="msg"></div>
    <form id="form" method="post" onSubmit="return false;">
        <input type="hidden" name="action" value="saveAddMore">

        <table class="emptable" border='1'  id="sortable">
            <thead>
                <tr>
                    <th width="20">id</th>
                    <th> Name</th>
                    <th>salary</th>
                    <th>dept</th>
                </tr>
            </thead>
            <tbody id="tb">
                <?php
                $result =   $conn->query("SELECT * FROM employee ORDER BY name ASC ");
                if($result->num_rows>0){
                    $s  =   '';
                    $rowcount = 1;
                    while($val  =   $result->fetch_assoc()){
                        $s++;  ?>
                    <tr class="trclass_<?php echo $rowcount; ?>">
                        <td><?php echo $val['id']; ?></td>
                        <td><?php echo $val['name']; ?></td>
                        <td><?php echo $val['salary']; ?></td>
                        <td><?php echo $val['dept']; ?></td>
                    </tr>
                    <?php
                    $rowcount++;
                    }
                }else{ ?>
                <tr>
                    <td colspan="6" class="bg-light text-center"><strong>No Record(s) Found!</strong></td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6">
                        <a href="javascript:;" id="addmore"> add More</a>
                       
                    </td>
                </tr>
            </tfoot>
            <input type="button" name="save" class="btn btn-primary" value="Save to database" id="butsave">
        </table>

    </form>     
</div>
<script>
    $(document).ready(function(e) {
        //$('.selectpicker').selectpicker();
        jsOriginalrowcount = <?php echo $rowcount-1; ?>; 
       // alert(jsOriginalrowcount);
        jsrowcount = <?php echo $rowcount; ?>;
        $("#addmore").on("click", function(){  
           //alert(jsrowcount);
           newrow = '<tr class="trclass_'+jsrowcount+' newentry"><td><input type="text" required="true" name="id" class="idval_'+jsrowcount+'" placeholder="id"/></td><td><input type="text" class="name_'+jsrowcount+'" name="name" placeholder="name"/>            </td>            <td>              <input type="text" class="sal_'+jsrowcount+'" name="salary" placeholder="salary" />            </td>            <td>              <input type="text" class="dep_'+jsrowcount+'" name="dept" placeholder="dept" id="depid"/>            </td>          </tr>';



                     $('.emptable tbody').append(newrow);
                     jsrowcount = jsrowcount + 1;
		//alert(jsOriginalrowcount);
        });
    });
         
    </script>

<script>
$(document).ready(function() {
	$('#butsave').on('click', function() {
		/*var id = $('#idval').val();
		var name = $('#nameval').val();
		var salary = $('#salval').val();
		var dept = $('#deptval').val(); */
       
        errorOrSuccess = validateBoxes();

        if(errorOrSuccess == "success") {
    		var multiDimArr = [];
    		 for (var i = jsOriginalrowcount+1; i < jsrowcount; i++) {
    		 	alert(i);			
                var dataArr = [];
                dataArr.push($('.idval_'+i).val());
                dataArr.push($('.name_'+i).val());
                dataArr.push($('.sal_'+i).val());
                dataArr.push($('.dep_'+i).val());
            

                multiDimArr.push(dataArr)
            }
            jsonData = JSON.stringify(multiDimArr);
            alert(jsonData);
    			$.ajax({
    				url: "save.php",
    				type: "POST",
    				dataType: 'json',
    				data: jsonData,
     					success: function(dataResult){
    					var dataResult = JSON.parse(dataResult);
    					if(dataResult.statusCode==200){
    						$("#butsave").removeAttr("disabled");
    						//$('#form').find('input:text').val('');
    						$("#success").show();
    						$('#success').html('Data added successfully !'); 						
    					}
    				}

    				
    				
    	    });
        }
	});


    function validateBoxes() {
        alert("validate----fields");

        for (var i = jsOriginalrowcount+1; i < jsrowcount; i++) {        
            id = $('.idval_'+i).val();
            name = $('.name_'+i).val();
            salary = $('.sal_'+i).val();
            dept = $('.dep_'+i).val();  

            alert('id value== ' + id);
            alert($.isNumeric(id));


            if(!$('.idval_'+i).is(':empty')) {
                //continue;
                alert("true");
            }  else {
                $('.id_error').remove();
                $('.idval_'+i).parent().append('<span class="id_error" style="color:red;">id is required</span>');
                $('.idval_'+i).focus();
                alert("false");
                return 'error';
            }


            if($.isNumeric(id)) {
                //continue;
                alert("true");
            }  else {
                $('.id_error').remove();
                $('.idval_'+i).parent().append('<span class="id_error" style="color:red;">id shoule be number</span>');
                $('.idval_'+i).focus();
                alert("false");
                return 'error';
            }
        
            
             var name_regex=/^[a-zA-Z]+$/;
             if(!(name.match(name_regex))){
                $('.name_error').remove();
                $('.name_'+i).parent().append('<span class="name_error"style="color:red;">Name should conatian only alphabets</span>');
                $('.name_'+i).focus();
                alert("false");
                return 'false';
        }
            if($.isNumeric(salary)) {
                //continue;
                alert("true");
            }  else {
                $('.sal_error').remove();
                $('.sal_'+i).parent().append('<span class="sal_error" style="color:red;">salary should conatin only didgits</span>');
                $('.sal_'+i).focus();
                alert("false");
                return 'error';
            }

            var dept_regex=/^[a-zA-Z]+$/;
             if(!(dept.match(name_regex))){
                $('.dep_error').remove();
                $('.dep_'+i).parent().append('<span class="dep_error" style="color:red;">Dept should conatian only alphabets</span>');
                $('.dep_'+i).focus();
                alert("false");
                return 'false';
        }
            }
        return 'success';
    }
		
});

</script>
</body>
</html>
  