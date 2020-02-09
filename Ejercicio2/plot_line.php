<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="report-content">
    <div class="text-center">
       
        <p class="lead">

        </p>
    </div>
    <div class="text-center">

        <div style="margin-bottom:50px;">
    <?php

    require_once "koolreport/core/autoload.php";
    use \koolreport\widgets\google\LineChart;
    use \koolreport\widgets\google\PieChart;
    use \koolreport\widgets\google\Group;

    $servidor = "192.168.64.2";
    $usuario = "root";
    $con = mysqli_connect( $servidor, $usuario, "" , "database_host") or die('Could not connect ');

    $result = mysqli_query($con,"SELECT * FROM data_cat WHERE dat <> '0000-01-01'");
    $resultT = mysqli_query($con,"SELECT * FROM data_cat WHERE dat = '0000-01-01'");

    $rows = [];

    $values_tot = array("valuec1"=>0,"valuec2"=>0,"valuec3"=>0);

 

    while($row = mysqli_fetch_array($result)) {
        $rows[] = $row;


    }

    while($row = mysqli_fetch_array($resultT)) {

        $values_tot['valuec1'] = $row['valuec1'];
        $values_tot['valuec2'] = $row['valuec2'];
        $values_tot['valuec3'] = $row['valuec3'];

    }
    $aux_plot = array(
        array("cat"=>"CAT 1","value"=>$values_tot['valuec1']),
        array("cat"=>"CAT 2","value"=>$values_tot['valuec2']),
        array("cat"=>"CAT 3","value"=>$values_tot['valuec3'])
    );

    echo "<div>";

    LineChart::create(array(
        "title"=>"LineChart Dates and value",
        "dataSource"=>$rows,
        "columns"=>array(
            "dat",
            "valuec1"=>array(
                "label"=>"CAT 1",
                "type"=>"number",

            ),
            "valuec2"=>array(
                "label"=>"CAT 2",
                "type"=>"number",

            ),
            "valuec3"=>array(
                "label"=>"CAT 3",
                "type"=>"number",

            ),
        )
    ));

    PieChart::create(array(
        "title"=>"PieChart categories values",
        "dataSource"=>$aux_plot,
        "columns"=>array(
            "cat",
            "value"=>array(
                "type"=>"number",
            ),
        )
    ));

    echo "</div>";

    mysqli_close($con);
    ?>
    </div>
    </div>
    
</div>




