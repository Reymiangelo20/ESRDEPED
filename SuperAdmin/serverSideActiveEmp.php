<?php
// DB table to use
$table = 'emppersonalinfo';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes

$columns = array(
    array( 'db' => 'id', 'dt' => 0 ),
    array( 'db' => 'email',  'dt' => 1 ),
    array( 'db' => 'district',   'dt' => 2 ),
    array( 'db' => 'school',     'dt' => 3 ),
    array( 'db' => 'lastName',     'dt' => 4 ),
    array( 'db' => 'firstName',     'dt' => 5 ),
    array( 'db' => 'middleName',     'dt' => 6 ),
    array( 'db' => 'middle_initial',     'dt' => 7 ),
    array( 'db' => 'civilStatus',     'dt' => 8 ),
    array( 'db' => 'gender',     'dt' => 9 ),
    array( 'db' => 'dateOfBirth',     'dt' => 10 ),
    array( 'db' => 'place',     'dt' => 11 ),
    array( 'db' => 'teacher_status',     'dt' => 12 )
);

// $columns = array(
//     array( 'db' => 'id', 'dt' => 0 ),
//     array( 'db' => 'email',  'dt' => 1 ),
//     array( 'db' => 'district',   'dt' => 2 ),
//     array( 'db' => 'school',     'dt' => 3 ),
//     array( 'db' => 'lastName',     'dt' => 4 ),
//     array( 'db' => 'firstName',     'dt' => 5 ),
//     array( 'db' => 'middleName',     'dt' => 6 ),
//     array( 'db' => 'middle_initial',     'dt' => 7 ),
//     array( 'db' => 'civilStatus',     'dt' => 8 ),
//     array( 'db' => 'gender',     'dt' => 9 ),
//     array( 'db' => 'dateOfBirth',     'dt' => 10 ),
//     array( 'db' => 'place',     'dt' => 11 ),
//     array( 'db' => 'teacher_status',     'dt' => 12 ),
//     array(
//         'db' => 'id',
//         'dt' => 13,
//         'formatter' => function( $d, $row ) {
//             return '<button class="btn btn-sm btn-primary edit-btn" data-id="'.$d.'">Edit</button> ' .
//                    '<button class="btn btn-sm btn-danger delete-btn" data-id="'.$d.'">Delete</button>';
//         }
//     )
// );

 
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
 
require( 'ssp.class.php' );
$whereClause = 'teacher_status = "active"';
echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, null, $whereClause)
);
