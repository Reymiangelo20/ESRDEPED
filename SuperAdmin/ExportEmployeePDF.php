<?php
set_time_limit(0);
require_once('../Development/TCPDF-main/tcpdf.php');
include('../PersonalInfo/generalPhp/dbhConnection.php');

class MYPDF extends TCPDF
{
    public function Header()
    {
        $this->Ln(15);
        $this->setCellPaddings(0,2,0,0);
        $this->MultiCell(0, 10, 'Employee Personal Information', 'B', 'C', 0, 0, '', '', true, 1, false, true, 9);
    }

    public function Footer()
    {
      
    }
}

$pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);
// $pdf->setFont('arial', '', 10);
$pdf->AddPage();
$pdf->Ln(20);

    $pdf->setX(5);
       
    $pdf->setCellPaddings(0,2,0,0);
 
    $pdf->setFont('arial', 'B', 6,);

    $pdf->MultiCell(7, 11, 'ID', 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
    $pdf->MultiCell(19, 11, 'Firstname', 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
    $pdf->MultiCell(19, 11, 'LastName', 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
    $pdf->MultiCell(19, 11, 'MiddleName', 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
    $pdf->MultiCell(26, 11, 'Email', 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
    $pdf->MultiCell(14, 11, 'DateOfBirth', 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
    $pdf->MultiCell(25, 11, 'Place', 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
    $pdf->MultiCell(12, 11, 'District', 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
    $pdf->MultiCell(25, 11, 'School', 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
    $pdf->MultiCell(10, 11, 'Gender', 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
    $pdf->MultiCell(12, 11, 'CivilStatus', 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
    $pdf->MultiCell(12, 11, 'Status', 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
   
    $pdf->setX(1);
    $pdf->Ln(11);
    $pdf->setCellPaddings(1,2,0,0);

    $get = "SELECT * FROM `emppersonalinfo`";
    $results = $conn->query($get);
    $row_count = 0;
    if (mysqli_num_rows($results)>0) {
        foreach ($results as $rows) {
            if ($row_count == 0) {
            }
            $pdf->setFont('arial', '', 6, true);
            $pdf->setX(5);
            $pdf->MultiCell(7, 11, $rows['id'], 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
            $pdf->MultiCell(19, 11, $rows['firstName'], 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
            $pdf->MultiCell(19, 11, $rows['lastName'], 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
            $pdf->MultiCell(19, 11, $rows['middleName'], 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
            $pdf->MultiCell(26, 11, $rows['email'], 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
            $pdf->MultiCell(14, 11, $rows['dateOfBirth'], 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
            $pdf->MultiCell(25, 11, $rows['place'], 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
            $pdf->MultiCell(12, 11, $rows['district'], 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
            $pdf->MultiCell(25, 11, $rows['school'], 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
            $pdf->MultiCell(10, 11, $rows['gender'], 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
            $pdf->MultiCell(12, 11, $rows['civilStatus'], 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
            $pdf->MultiCell(12, 11, $rows['teacher_status'], 1, 'C', 0, 0, '', '', true, 0, false, true, 9);
            $pdf->Ln();
            $row_count++;
            if ($row_count >= 25) {
                $pdf->AddPage();
                $row_count = 0;
            }
        }
    }

$pdf->Output('EmployeeInformation.pdf', 'D');
?>