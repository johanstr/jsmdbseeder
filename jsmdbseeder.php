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

    echo "SEEDING RECORDS FOR TABLE: $table_name".PHP_EOL;
    for($i = 0; $i < $amount; $i++) {
        $record = $factory->process($columns);
        $db->insert($table_name, $record);
        print_record($record);
        $recnum++;
        $data_tables[$table_name][] = $record;
    }
    echo 'End of seeding'.PHP_EOL.PHP_EOL;
    $recnum = 1;
}


function print_record($record)
{
    global $recnum;

    $line = '';
    $first = true;

   $line .= "RECORD NR.: $recnum | ";
    foreach($record as $column_name => $value) {
        if($first) {
            $first = false;
            $line .= "$column_name : $value";
        } else 
            $line .= ", $column_name : $value";

    }

    echo $line . PHP_EOL;
}