<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
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
$date = $_GET['date'];
$value = $_GET['value'];
$servidor = "192.168.64.2";
$usuario = "root";
$con = mysqli_connect( $servidor, $usuario, "" , "database_host") or die('Could not connect ');

$result = mysqli_query($con,"SELECT * FROM data_cat WHERE dat='".$date."'");
$resultT = mysqli_query($con,"SELECT * FROM data_cat WHERE dat='0000-01-01'");

$valuec1 = 0;
$valuec2 = 0;
$valuec3 = 0;


if ($categ == 'CAT 1'){
    $valuec1 = $value;
} else if ($categ == 'CAT 2'){
    $valuec2 = $value;
} else if ($categ == 'CAT 3'){
    $valuec3 = $value;
}
$rows = [];

if ($result->num_rows > 0)
{
    $row = mysqli_fetch_array($result);

    $rowT = mysqli_fetch_array($resultT); 
    $row['valuec1'] = $row['valuec1'] + $valuec1;
    $row['valuec2'] = $row['valuec2'] + $valuec2;
    $row['valuec3'] = $row['valuec3'] + $valuec3;

    $rowT['valuec1'] = $rowT['valuec1'] + $valuec1;
    $rowT['valuec2'] = $rowT['valuec2'] + $valuec2;
    $rowT['valuec3'] = $rowT['valuec3'] + $valuec3;

    $sql=("UPDATE `data_cat` SET valuec1='".$row['valuec1']."',valuec2='".$row['valuec2']."',valuec3='".$row['valuec3']."'WHERE dat='".$date."'");

    if ($con->query($sql) === TRUE) {
        echo "New record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    $sql=("UPDATE `data_cat` SET valuec1='".$rowT['valuec1']."',valuec2='".$rowT['valuec2']."',valuec3='".$rowT['valuec3']."'WHERE dat='0000-01-01'");

    if ($con->query($sql) === TRUE) {
        
    } else {
        echo " Error: " . $sql . "<br>" . $conn->error;
    }


}
else{

    

    $sql=("INSERT INTO `data_cat`(`dat`, `valuec1`, `valuec2`, `valuec3`) VALUES ('".$date."','".$valuec1."','".$valuec2."','".$valuec3."')");
    if ($con->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$result = mysqli_query($con,"SELECT * FROM data_cat");

echo "<table>
<tr>
<th>date</th>
<th>cat1</th>
<th>cat2</th>
<th>cat3</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['dat'] . "</td>";
    echo "<td>" . $row['valuec1'] . "</td>";
    echo "<td>" . $row['valuec2'] . "</td>";
    echo "<td>" . $row['valuec3'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>