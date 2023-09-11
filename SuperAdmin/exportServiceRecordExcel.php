<?php
set_time_limit(0);
include ('../PersonalInfo/generalPhp/dbhConnection.php');
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

$getdata = "SELECT * FROM servicerecord";
$result = $conn->query($getdata);
$numRows = $result->num_rows;

if (mysqli_num_rows($result)>0) {
    $spreadsheet = new Spreadsheet();
    $activeWorksheet = $spreadsheet->getActiveSheet();
                $activeWorksheet->setCellValue('A1', 'ID');
                $activeWorksheet->setCellValue('B1', 'START');
                $activeWorksheet->setCellValue('C1', 'END');
                $activeWorksheet->setCellValue('D1', 'DESIGNATION');
                $activeWorksheet->setCellValue('E1', 'STATUS');
                $activeWorksheet->setCellValue('F1', 'SALARY');
                $activeWorksheet->setCellValue('G1', 'PLACE OF APPOINTMENT');
                $activeWorksheet->setCellValue('H1', 'BRANCH');
                $activeWorksheet->setCellValue('I1', 'LEAVE OF ABSSENCE');
                $activeWorksheet->setCellValue('J1', 'REMARKS');

        $empRowCount = 2;
        foreach($result as $empRows){
                $activeWorksheet->setCellValue('A'.$empRowCount, $empRows['empId']);
                $activeWorksheet->setCellValue('B'.$empRowCount, $empRows['dateStart']);
                $activeWorksheet->setCellValue('C'.$empRowCount, $empRows['dateEnd']);
                $activeWorksheet->setCellValue('D'.$empRowCount, $empRows['designation']);
                $activeWorksheet->setCellValue('E'.$empRowCount, $empRows['empStatus']);
                $activeWorksheet->setCellValue('F'.$empRowCount, $empRows['empSalary']);
                $activeWorksheet->setCellValue('G'.$empRowCount, $empRows['placeOfAppointment']);
                $activeWorksheet->setCellValue('H'.$empRowCount, $empRows['branch']);
                $activeWorksheet->setCellValue('I'.$empRowCount, $empRows['leaveOfAbssence']);
                $activeWorksheet->setCellValue('J'.$empRowCount, $empRows['remarks']);

            $empRowCount++;
        }
        ob_end_clean();
        $filename = "ServiceRecord.xlsx";
        $writer = new Xlsx($spreadsheet);
        header('Content-Type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($filename).'"');
        $writer->save('php://output');
        exit();
}

?>