<?php
 ini_set('memory_limit','-1');
 session_start();
 include '../PersonalInfo/generalPhp/dbhConnection.php';
 require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if(isset($_FILES['import-file'])){

    $fileName = $_FILES['import-file']['name'];
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowedExt = ['xls', 'csv', 'xlsx'];
    
    if(in_array($fileExt, $allowedExt)){
        $inputFileNamePath = $_FILES['import-file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        // Clear current data
        $wipeOutSql = "TRUNCATE TABLE emppersonalinfo";
        mysqli_query($conn, $wipeOutSql);

        $count = "0";
        foreach($data as $row)
        {
            if($count == "1"){
                $id = $row['0'];
                $email = $row['1'];
                $district =  $row['2'];
                $school = $row['3'];
                $lastName = $row['4'];
                $firstName = $row['5'];
                $middleName = $row['6'];
                $middleInitial = $row['7'];
                $civilStatus = $row['8'];
                $sex = $row['9'];
                $MISR = $row['10'];
                $date = $row['11']; // $date = date('m/d/Y', $date = $row['10']);
                $place = $row['12'];
                $status = 'Active';


                set_time_limit(0);
                $sql = "INSERT INTO  emppersonalinfo(firstName, lastName, middleName, middle_initial, MISR, email, dateOfBirth, place, district, school, gender, civilStatus, teacher_status)
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?);";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, 'sssssssssssss',$firstName, $lastName, $middleName, $middleInitial, $MISR, $email, $date, $place, $district, $school, $sex, $civilStatus, $status);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                $msg = true;
            }else{
                $count = "1";
            }
        }

    if(isset($msg)) {
        // $_SESSION['type'] = 'add';
        // $_SESSION['status'] = 'Success!';
        // $_SESSION['text'] = 'Excel file has been imported';
        // $_SESSION['status_code'] = 'success';
        // header('Location: superAdmin1Dashboard.php?message=success');
        echo 'success';
    }else{
            // $_SESSION['status'] = 'Record has not been added';
            // $_SESSION['status_code'] = 'error';
            // header('Location: superAdmin1Dashboard.php?message=failed');
            echo 'failed';
        }
    }else{
        // $_SESSION['status'] = 'Invalid File';
        // $_SESSION['status_code'] = 'error';
        // $_SESSION['text'] = 'Invalid file extension or Empty file';
            // header('Location: superAdmin1Dashboard.php?message=Invalid_file_extension_or_empty_file');
            echo 'Invalid_file_extension_or_empty_file';
    }
}else{
    // $_SESSION['status'] = 'No file';
    // $_SESSION['status_code'] = 'error';
    // $_SESSION['text'] = 'You did not input anything';
    echo 'no_file';
}

?>