<?php
set_time_limit(0);
include ('../PersonalInfo/generalPhp/dbhConnection.php');
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

$getdata = "SELECT * FROM emppersonalinfo";
$empResults = $conn->query($getdata);
$empNumRows = $empResults->num_rows;

if (mysqli_num_rows($empResults)>0) {
    $spreadsheet = new Spreadsheet();
    $activeWorksheet = $spreadsheet->getActiveSheet();
                $activeWorksheet->setCellValue('A1', 'ID');
                $activeWorksheet->setCellValue('B1', 'DEPED EMAIL');
                $activeWorksheet->setCellValue('C1', 'DISTRICT');
                $activeWorksheet->setCellValue('D1', 'SCHOOL');
                $activeWorksheet->setCellValue('E1', 'LAST NAME');
                $activeWorksheet->setCellValue('F1', 'FIRST NAME');
                $activeWorksheet->setCellValue('G1', 'MIDDLE NAME');
                $activeWorksheet->setCellValue('H1', 'MIDDLE INITIAL');
                $activeWorksheet->setCellValue('I1', 'CIVIL STATUS');
                $activeWorksheet->setCellValue('J1', 'SEX');
                $activeWorksheet->setCellValue('K1', 'MISR');
                $activeWorksheet->setCellValue('L1', 'DATE OF BIRTH');
                $activeWorksheet->setCellValue('M1', 'PLACE OF BIRTH');

        $empRowCount = 2;
        foreach($empResults as $empRows){
                $activeWorksheet->setCellValue('A'.$empRowCount, $empRows['id']);
                $activeWorksheet->setCellValue('B'.$empRowCount, $empRows['email']);
                $activeWorksheet->setCellValue('C'.$empRowCount, $empRows['district']);
                $activeWorksheet->setCellValue('D'.$empRowCount, $empRows['school']);
                $activeWorksheet->setCellValue('E'.$empRowCount, $empRows['lastName']);
                $activeWorksheet->setCellValue('F'.$empRowCount, $empRows['firstName']);
                $activeWorksheet->setCellValue('G'.$empRowCount, $empRows['middleName']);
                $activeWorksheet->setCellValue('H'.$empRowCount, $empRows['middle_initial']);
                $activeWorksheet->setCellValue('I'.$empRowCount, $empRows['civilStatus']);
                $activeWorksheet->setCellValue('J'.$empRowCount, $empRows['gender']);
                $activeWorksheet->setCellValue('K'.$empRowCount, $empRows['MISR']);
                $activeWorksheet->setCellValue('L'.$empRowCount, $empRows['dateOfBirth']);
                $activeWorksheet->setCellValue('M'.$empRowCount, $empRows['place']);

            $empRowCount++;
        }
        ob_end_clean();
        $filename = "PersonalInfo.xlsx";
        $writer = new Xlsx($spreadsheet);

        header('Content-Type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($filename).'"');
        $writer->save('php://output');

        // header('Content-Description: File Transfer');
        // header('Content-Type: application/octet-stream');
        // header('Content-Disposition: attachment; filename="'.basename($filename).'"');
        // header('Expires: 0');
        // header('Cache-Control: must-revalidate');
        // header('Pragma: public');
        // header('Content-Length: ' . filesize($filename));
        // readfile($filename);

        exit();
}

?>