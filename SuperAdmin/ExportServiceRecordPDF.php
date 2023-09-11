<?php

require_once('../Development/TCPDF-main/tcpdf.php');
include('../PersonalInfo/generalPhp/dbhConnection.php');


class MYPDF extends TCPDF
{
    public function Header()
    {
        $this->Ln(15);
        $this->setCellPaddings(0,2,0,0);
        $this->setFont('arial', 'B', 15,);
        $this->MultiCell(0, 10, 'Employee Service Record', 'B', 'C', 0, 0, '', '', true, 1, false, true, 9);
    }

    public function Footer()
    {
      
    }
}

$pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);
// $pdf->setFont('arial', '', 10);
$pdf->AddPage();
$pdf->Ln(20);

    $pdf->setX(8);
       
    $pdf->setCellPaddings(0,2,0,0);
 
    $pdf->setFont('arial', 'B', 6,);

    $pdf->MultiCell(7, 11, 'ID', 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
    $pdf->MultiCell(10, 11, 'EMPID', 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
    $pdf->MultiCell(16, 11, 'DATE-START', 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
    $pdf->MultiCell(16, 11, 'DATE-END', 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
    $pdf->MultiCell(26, 11, 'DESIGNATION', 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
    $pdf->MultiCell(14, 11, 'STATUS', 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
    $pdf->MultiCell(25, 11, 'SALARY', 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
    $pdf->MultiCell(25, 11, 'PLACE OF APPOINTMENT', 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
    $pdf->MultiCell(25, 11, 'BRANCH', 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
    $pdf->MultiCell(15, 11, 'LEAVE OF ABSSENCE', 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
    $pdf->MultiCell(12, 11, 'REMARKS', 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
   
   
    $pdf->setX(1);
    $pdf->Ln(11);
    $pdf->setCellPaddings(1,2,0,0);
    $get = "SELECT * FROM `servicerecord` ";
    $results = $conn->query($get);
    $row_count = 0;
    if (mysqli_num_rows($results)>0) {
        foreach ($results as $rows) {
            if ($row_count == 0) {
            }
            set_time_limit(0);
            $pdf->setFont('arial', '', 6, true);
            $pdf->setX(8);
            $pdf->MultiCell(7, 11, $rows['id'], 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
            $pdf->MultiCell(10, 11, $rows['empId'], 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
            $pdf->MultiCell(16, 11, $rows['dateStart'], 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
            $pdf->MultiCell(16, 11, $rows['dateEnd'], 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
            $pdf->MultiCell(26, 11, $rows['designation'], 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
            $pdf->MultiCell(14, 11, $rows['empStatus'], 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
            $pdf->MultiCell(25, 11, $rows['empSalary'], 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
            $pdf->MultiCell(25, 11, $rows['placeOfAppointment'], 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
            $pdf->MultiCell(25, 11, $rows['branch'], 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
            $pdf->MultiCell(15, 11, $rows['leaveOfAbssence'], 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
            $pdf->MultiCell(12, 11, $rows['remarks'], 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
        
            $pdf->Ln();
            $row_count++;
            if ($row_count >= 21) {
                $pdf->AddPage();
                $row_count = 0;
                $pdf->Ln(20);
            }
        }
    }

$pdf->Output('EmployeeServiceRecord.pdf', 'D');
?>