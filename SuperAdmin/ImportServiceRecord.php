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
        $wipeOutSql = "TRUNCATE TABLE servicerecord";
        mysqli_query($conn, $wipeOutSql);

        $count = "0";
        foreach($data as $row)
        {
            if($count == "1"){                
                $empId = $row[0];
                $start = $row[1];
                $end = $row[2];
                $destination = $row[3];
                $status = $row[4];
                $salary = $row[5];
                $placeOfAppointment = $row[6];
                $brach = $row[7];
                $leaveOfAbssence = $row[8];
                $remarks = $row[9];

                $position = "1";
                set_time_limit(0);
                $sql = "INSERT INTO  servicerecord(Position,empId, dateStart, dateEnd, designation, empStatus, empSalary, placeOfAppointment, branch, leaveOfAbssence, remarks)
                VALUES(?,?,?,?,?,?,?,?,?,?,?);";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, 'sssssssssss',$position,$empId, $start, $end, $destination, $status, $salary, $placeOfAppointment, $brach, $leaveOfAbssence, $remarks);
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
            // header('Location: superAdmin1Dashboard.php?message=failed');
            echo 'failed';
    }
}else{
    // $_SESSION['status'] = 'No file';
    // $_SESSION['status_code'] = 'error';
    // $_SESSION['text'] = 'You did not input anything';
    echo 'no_file';
}

?>