<!doctype html>
    <html>
    <head>

        <script src="jquery.min.js"></script>

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
        </table>
    </form>     
</div>
<script>
    $(document).ready(function(e) {
        //$('.selectpicker').selectpicker();
        jsOriginalrowcount = <?php echo $rowcount-1; ?>; 
        alert(jsOriginalrowcount);
        jsrowcount = <?php echo $rowcount; ?>;
        $("#addmore").on("click", function(){  
           //alert(jsrowcount);
           newrow = '<tr class="trclass_'+jsrowcount+' newentry"><td><input type="text" name="id" class="idval_'+jsrowcount+'" placeholder="id"/></td><td><input type="text" class="name_'+jsrowcount+'" name="name" placeholder="name"/>            </td>            <td>              <input type="text" class="sal_'+jsrowcount+'" name="salary" placeholder="salary"/>            </td>            <td>              <input type="text" class="dep_'+jsrowcount+'" name="dept" placeholder="dept" />            </td>          </tr>';



                     $('.emptable tbody').append(newrow);
                     jsrowcount = jsrowcount + 1;
                        
        });
    });
         
    </script>
<script>
    $(document).ready(function(e){
        $(".submit").click(function () {

            orgRowCount = jsOriginalrowcount+1;
            updatedRowCount = jsrowcount - 1;

            var dataArr = [];
            var empArry = [];
            while(orgRowCount < updatedRowCount) {
                //dataArr['id'] = $('.idval_'+orgRowCount).val();
                dataArr.push($('.idval_'+orgRowCount).val())
                //dataArr[] = $('.name_'+orgRowCount).val();
               // dataArr[] = $('.sal_'+orgRowCount).val();
              //  dataArr[] = $('.dep_'+orgRowCount).val();

               // classVar = '.idval_'+orgRowCount;
              //  alert(classVar);
               alert($('.idval_'+orgRowCount).val());
                //alert(orgRowCount);
                alert(dataArr);
                empArry.push(dataArr);
                orgRowCount = orgRowCount + 1;              
            }

            alert(empArry);

         /*    var id=$("#id").val();
                var name=$("#name").val();
                var salary=$("#salary").val();
                var dept=$("#dept").val();
           
        
    $.ajax({
        type:'POST',
        url:'action_form_ajax.php', 
        dataType: 'json',
        data: {
                    id:id,
                    name:name,
                    salary:salary,
                    dept:dept              
                },
                cache: false,
                success: function(dataResult){
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
                        $("#submit").removeAttr("disabled");
                        $("#form").find('input:text').val('');
                                        
                    }
                    else if(dataResult.statusCode==201){
                       alert("Error occured !");
                    }
                    
                }

    });*/
    });
});

</script>
<input type="submit" name="submit" value="submit" class="submit">
</body>
</html>