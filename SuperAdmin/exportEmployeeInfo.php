<?php
include ('../PersonalInfo/generalPhp/dbhConnection.php');
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$getdata = "SELECT * FROM emppersonalinfo";
$result = $conn->query($getdata);
if (mysqli_num_rows($result)>0) {
    $spreadsheet = new Spreadsheet();
    $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'Id');
        $activeWorksheet->setCellValue('B1', 'FirstName');
        $activeWorksheet->setCellValue('C1', 'LastName');
        $activeWorksheet->setCellValue('D1', 'Email');
        $activeWorksheet->setCellValue('E1', 'Date of Birth');
        $activeWorksheet->setCellValue('F1', 'BirthPlace');
        $activeWorksheet->setCellValue('G1', 'Disctrict');
        $activeWorksheet->setCellValue('H1', 'School');
        $activeWorksheet->setCellValue('I1', 'Gender');
        $activeWorksheet->setCellValue('J1', 'Civil Status');
        $activeWorksheet->setCellValue('K1', 'Status');
    
        $rowcount = 2;
        foreach($result as $row){
        $activeWorksheet->setCellValue('A'.$rowcount, $row['id']);
        $activeWorksheet->setCellValue('B'.$rowcount, $row['firstName']);
        $activeWorksheet->setCellValue('C'.$rowcount, $row['lastName']);
        $activeWorksheet->setCellValue('D'.$rowcount, $row['middleName']);
        $activeWorksheet->setCellValue('E'.$rowcount, $row['dateOfBirth']);
        $activeWorksheet->setCellValue('F'.$rowcount, $row['place']);
        $activeWorksheet->setCellValue('G'.$rowcount, $row['district']);
        $activeWorksheet->setCellValue('H'.$rowcount, $row['school']);
        $activeWorksheet->setCellValue('I'.$rowcount, $row['gender']);
        $activeWorksheet->setCellValue('J'.$rowcount, $row['civilStatus']);
        $activeWorksheet->setCellValue('K'.$rowcount, $row['teacher_status']);
        $rowcount++;

        
    }
        ob_end_clean();
        $filename = "EmployeeInfo.xlsx";
        $writer = new Xlsx($spreadsheet);
        header('Content-Type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($filename).'"');
        $writer->save('php://output');
        exit();
}

?>
