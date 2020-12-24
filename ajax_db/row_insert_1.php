<!DOCTYPE html>
 
<html>
<head>
    <meta name="viewport" content="width=device-width"/>
    <title>Index</title>
</head>
<body>
    <table id="tblCustomers" class="table" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th style="width:150px">id</th>
                <th style="width:150px">name</th>
                <th style="width:150px">salary</th>
                <th style="width:150px">dept</th>

                <th></th>
            </tr>
        </thead>
        <tbody>
            
                
                    <td><input type="button" value="Remove" onclick="Remove(this)"/></td>
                </tr>
            
        </tbody>
        <tfoot>
            <tr>
                <td><input type="text" id="txtid"/></td>
                <td><input type="text" id="txtname"/></td>
                <td><input type="text" id="txtsalary"/></td>
                <td><input type="text" id="txtdept"/></td>
                <td><input type="button" id="btnAdd" value="Add"/></td>
            </tr>
        </tfoot>
    </table>
    <br/>
    <input type="button" id="btnSave" value="Save All"/>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.cdnjs.com/ajax/libs/json2/20110223/json2.js"></script>
    <script type="text/javascript">
        $("body").on("click", "#btnAdd", function () {
            //Reference the Name and Country TextBoxes.
            var txtid = $("#txtid");
            var txtname = $("#txtname");
            var txtsalary = $("#txtsalary");
            var txtdept = $("#txtdept");
 
            //Get the reference of the Table's TBODY element.
            var tBody = $("#tblCustomers > TBODY")[0];
 
            //Add Row.
            var row = tBody.insertRow(-1);
 
            //Add Name cell.
            var cell = $(row.insertCell(-1));
            cell.html(txtid.val());
 
            //Add Country cell.
            cell = $(row.insertCell(-1));
            cell.html(txtname.val());

 cell = $(row.insertCell(-1));
            cell.html(txtsalary.val());

            cell = $(row.insertCell(-1));
            cell.html(txtdept.val());
            //Add Button cell.
            cell = $(row.insertCell(-1));
            var btnRemove = $("<input />");
            btnRemove.attr("type", "button");
            btnRemove.attr("onclick", "Remove(this);");
            btnRemove.val("Remove");
            cell.append(btnRemove);
 
            //Clear the TextBoxes.
            txtName.val("");
            txtCountry.val("");
        });
 
        function Remove(button) {
            //Determine the reference of the Row using the Button.
            var row = $(button).closest("TR");
            var name = $("TD", row).eq(0).html();
            if (confirm("Do you want to delete: " + name)) {
                //Get the reference of the Table.
                var table = $("#tblCustomers")[0];
 
                //Delete the Table row using it's Index.
                table.deleteRow(row[0].rowIndex);
            }
        };
 
        $("body").on("click", "#btnSave", function () {
            //Loop through the Table rows and build a JSON array.
            var customers = new Array();
            $("#tblCustomers TBODY TR").each(function () {
                var row = $(this);
                var customer = {};
                customer.id = row.find("TD").eq(0).html();
                customer.name = row.find("TD").eq(2).html();
                                customer.salary = row.find("TD").eq(3).html();
                customer.dept = row.find("TD").eq(4).html();

                customers.push(customer);
            });
 
            //Send the JSON array to Controller using AJAX.
            $.ajax({
                type: "POST",
                url: "action_form_ajax.php",
                data: JSON.stringify(customers),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function (r) {
                    alert(r + " record(s) inserted.");
                }
            });
        });
    </script>
</body>
</html>
 