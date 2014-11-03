<html>
    <head>
        <title>Add row function</title>
        <script language='javascript'>
            function addRow(tableID) {
                var table = document.getElementById(tableID);
                var rowCount = table.rows.length;
                var row = table.insertRow(rowCount);
                 
                var cell1 = row.insertCell(0);
                var element1 = document.createElement("input");
                element1.type = "text";
                element1.name = "name[]";
                cell1.appendChild(element1);
                 
                var cell2 = row.insertCell(1);
                var element2 = document.createElement("input");
                element2.type = "text";
                element2.name = "number[]";
                cell2.appendChild(element2);
                 
            }
        </script>
    </head>
    <body>
        <form method="post" action="process.php">
            <table id="dataTable" class="form" width="800px" border="1">
            	  <tbody>
                <tr>
                    <td>
                    	<label>Name</label>
                    	<input type="text" name="name[]">
                    </td>
                    <td>
                    	<label for="number">Number</label>
                    	<input type="text" name="number[]">
                    </td>
                </tr>
                </tbody>
            </table>
            <input type="button" value="Add Person" onclick="addRow('dataTable')"/>
            <input type="submit" value="register" /><br />
        </form>
    </body>
</html>

