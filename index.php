<?php

@include "./vendor/autoload.php";


$config = include './config/dbconnection.php';
$tables = include './config/database.php';

$db = new App\Database\Database($config);
$factory = new App\FactoryProcessor\FactoryProcessor();

$data_tables = [];
$recnum = 1;

foreach($tables as $table => $columns) {
    
    $table_info = explode(':', $table);
    $table_name = $table_info[0];
    $amount = intval($table_info[1]);

    echo "<h4 style='color: green;'>INSERTED RECORDS FOR TABLE: <span style='font-size: 50px;'>$table_name</span></h4>";
    echo '<table border="1" style="border-collapse: collapse; width: 100%;">';
    for($i = 0; $i < $amount; $i++) {
        $record = $factory->process($columns);
        //$db->insert($table_name, $record);
        print_record($record);
        $recnum++;
        $data_tables[$table_name][] = $record;
    }
    echo '</table><hr />';
    $recnum = 1;
}


function print_record($record)
{
    global $recnum;

    $line = '';
    $first = true;
    $rowspan = count($record);

    foreach($record as $column_name => $value) {
        if($first) {
            $first = false;
            $line .= "<tr><td rowspan='$rowspan' style='min-width: 5%; max-width: 5%; text-align: center;'><span style='font-size: 32px; font-weight: bold; color: red;'>$recnum</span></td><td style='padding: 5px; color: blue; min-width: 20%; max-width: 20%;'>$column_name</td><td style='padding: 5px; min-width: 75%; max-width: 75%;'>$value</td></tr>";
        } else 
            $line .= "<tr><td style='padding: 5px; color: blue; min-width: 20%; max-width: 20%;'>$column_name</td><td style='padding: 5px; min-width: 75%; max-width: 75%;'>$value</td></tr>";

    }

    echo $line;
}