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
            <table id="dataTable" width="800px" border="1">
                <tr>
                    <td>Name</td>
                    <td>Number</td>
                </tr>
                <tr>
                    <td><input type="text" name="name[]"></td>
                    <td><input type="text" name="number[]"></td>
                </tr>
            </table>
            <input type="button" value="Add Person" onclick="addRow('dataTable')"/>
            <input type="submit" value="register" /><br />
        </form>
    </body>
</html>

