<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
    text-align:center
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$categ = $_GET['categ'];
$servidor = "192.168.64.2";
$usuario = "root";
$con = mysqli_connect( $servidor, $usuario, "" , "database_host") or die('Could not connect ');

$result = mysqli_query($con,"SELECT * FROM data_cat WHERE categ = '".$categ."' ");

echo "<table>
<tr>
<th>categoria</th>
<th>fecha</th>
<th>puntuación</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['categ'] . "</td>";
    echo "<td>" . $row['dat'] . "</td>";
    echo "<td>" . $row['score'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>