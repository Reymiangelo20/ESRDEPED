<?php

// DB table to use
$table = 'logs';
 
// Table's primary key
$primaryKey = 'logId';


 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes


$columns = array(
    array( 'db' => 'logId', 'dt' => 0 ),
    array( 'db' => 'admin_name',  'dt' => 1 ),
    array( 'db' => 'email',  'dt' => 2),
    array( 'db' => 'action',   'dt' => 3 ),
    array( 'db' => 'AddedData',     'dt' => 4 ),
    array( 'db' => 'previousData',     'dt' => 5 ),
    array( 'db' => 'changedData',     'dt' => 6 ),
    array( 'db' => 'date',     'dt' => 7 ),
    array( 'db' => 'time',     'dt' => 8 ),
);

 
// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => 'depedcsjdmteacherdb',
    'db'   => 'deped_csjdm_db',
    'host' => '127.0.0.1'
    // ,'charset' => 'utf8' // Depending on your PHP and MySQL config, you may need this
);
 
// $sql_details = array(
//     'user' => 'root',
//     'pass' => 'rodel17',
//     'db'   => 'e_service_record',
//     'host' => '127.0.0.1'
//     // ,'charset' => 'utf8' // Depending on your PHP and MySQL config, you may need this
// );

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */



// Condition
require( 'ssp.class.php' );
$whereClause = 'teacher_status != "active"';

// $json_array = json_decode($columns, true);

echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns)
);

// Condition
// require( 'ssp.class.php' );
// $whereClause = 'teacher_status != "active"';

// echo json_encode(
//     SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns)
// );