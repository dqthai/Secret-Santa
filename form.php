
1
2
3
4
5
6
7
8
9
10
11
12
13
14
15
16
17
18
19
20
21
22
23
24
25
26
27
28
29
30
31
32
33
34
35
36
37
38
39
40
41
	
<html>
    <head>
        <title>Add row function</title>
        <script language='javascript'>
            function addRow(tableID) {
                var table = document.getElementByI(tableID);
                var rowCount = table.rows.length;
                var row = table.insertRow(rowCount);
                 
                var cell1 = row.insertCell(0);
                var element1 = document.createElement("input");
                element1.type = "text";
                element1.name = "txtbox[]";
                cell1.appendChild(element1);
                 
                var cell2 = row.insertCell(1);
                var element2 = document.createElement("input");
                element2.type = "text";
                element2.name = "txtbox[]";
                cell2.appendChild(element2);
                 
            }
        </script>
    </head>
    <body>
        <form method="post" action="something.php">
            <table id="dataTable" width="800px" border="1">
                <tr>
                    <td>Name</td>
                    <td>Number</td>
                </tr>
                <tr>
                    <td><input type="text" name="name"></td>
                    <td><input type="text" name="number"></td>
                </tr>
            </table>
            <input type="button" value="Add Person" onclick="addRow('dataTable')"/>
            <input type="submit" value="register" /><br />
        </form>
    </body>
</html>

