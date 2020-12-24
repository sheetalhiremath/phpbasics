<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   
</head>
<body>
     
    <script>
        $(document).ready(function(){
        $("#button1").click(function(){
        $.ajax({
            type: "GET",
            url: "ajax_db_select.php",
            //data: "{}",
            //contentType: "application/json; charset=utf-8",
            //dataType: "json",
            success: function (result) {
                    $("#tbDetails").empty();
                    $("#tbDetails").append(result);            
                }

                
        }); });
        });
</script>
    <button type="button" id="button1">Show</button>
    <button tyep="button" id="button2">Deletd</button>
    
    <div id="tbDetails"></div>
</body>
</html>