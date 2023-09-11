<?php
    include '../PersonalInfo/generalPhp/dbhConnection.php';
// DB table to use
$table = 'users';
 
// Table's primary key
$primaryKey = 'id';


 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes


// id int AI PK 
// username char(225) 
// user_email varchar(255) 
// user_district varchar(255) 
// user_school varchar(255) 
// user_pass char(255) 
// type char(255)

$columns = array(
    array( 'db' => 'id', 'dt' => 0 ),
    array( 'db' => 'username',  'dt' => 1 ),
    array( 'db' => 'user_district',  'dt' => 2),
    array( 'db' => 'user_school',   'dt' => 3 ),
    array( 'db' => 'user_email',     'dt' => 4 ),
    array( 'db' => 'type',     'dt' => 5 ),
    // array(
    //     'db' => 'id',
    //     'dt' => 6,
    //     'formatter' => function( $d, $row ) {
    //         return '<div class="button-table">
    //                     <button data-toggle="modal" data-target="#editmodal" class="edit-button" type="button" data-id="'.$d.'"><i class="fa-solid fa-pen-to-square"></i></button>
    //                     <button class="delete-button" type="button" data-id="'.$d.'"><i class="fa-solid fa-trash-can"></i></button>
    //                 </div>';
    //     }
    // )
    array(
        'db' => 'id',
        'dt' => 6,
        'formatter' => function( $d, $row ) {
            global $conn;
            $superId = $row['id'];
            $sql = "SELECT * FROM users WHERE id = $superId;";
            $result = mysqli_query($conn, $sql);
            $rowType = mysqli_fetch_assoc($result);
            $buttons = '<div class="button-table">';
            $buttons .= '<button data-toggle="modal" data-target="#editmodal" class="edit-button" type="button" data-id="'.$row['id'].'"';
            if($rowType['type'] == 'admin3') {
                $buttons .= ' disabled';
            }
            $buttons .= '><i class="fa-solid fa-pen-to-square"></i></button>';
            $buttons .= '<button class="delete-button" type="button" data-id="'.$row['id'].'"';
            if($rowType['type'] == 'admin3') {
                $buttons .= ' disabled';
            }
            $buttons .= '><i class="fa-solid fa-trash-can"></i></button>';
            $buttons .= '</div>';
            return $buttons;
        }
    )
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
$whereclause = 'username <> "admin_ninja"';

echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $whereclause)
);