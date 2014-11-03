<html>
    <head>
        <title>Add row function</title>
        <script language='javascript'>
            function addRow(tableID) {
                var table = document.getElementById(tableID);
                var rowCount = table.rows.length;
                var row = table.insertRow(rowCount);
                
                var colCount = table.rows[0].cells.length;
                for(var i = 0; i<colCount; i++) {
                	var newcell = row.insertCell(i);
                	newcell.innterHTML = table.rows[0].cells[i].innerHTML;
                }
              
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
                    	<label>Number</label>
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

