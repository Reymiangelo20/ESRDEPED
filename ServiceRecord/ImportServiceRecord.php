<?php
 ini_set('memory_limit','-1');
 session_start();
 include '../../PersonalInfo/generalPhp/dbhConnection.php';
 require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if(isset($_POST['save-excel-data'])){
    $fileName = $_FILES['import-file']['name'];
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowedExt = ['xls', 'csv', 'xlsx'];
    
    if(in_array($fileExt, $allowedExt)){
        $inputFileNamePath = $_FILES['import-file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $count = "0";
        foreach($data as $row)
        {
            $lastIndex = count($row) - 1;
            $col1 = 0; $col2 = 1; $col3 = 2; $col4 = 3; $col5 = 4; $col6 = 5; $col7 = 6; $col8 = 7; $col9 = 8; $col10 = 9;
            if($count == "0"){
                set_time_limit(0);
                    for ($i=0; $i < $lastIndex; $i++) { 
                        $sql = "INSERT INTO  servicerecord(empId, dateStart, dateEnd, designation, empStatus, empSalary, placeOfAppointment, remarks, leaveOfAbssence, branch)
                        VALUES(?,?,?,?,?,?,?,?,?,?);";
                        $stmt = mysqli_prepare($conn, $sql);
                        $emdId = $row[$col1];
                        $dateStart = $row[$col2] ? $row[$col2] : 'N/A';
                        $dateEnd = $row[$col3] ? $row[$col3] : 'N/A';
                        $designation = $row[$col4] ? $row[$col4] : 'N/A';
                        $empStatus = $row[$col5] ? $row[$col5] : 'N/A';
                        $empSalary = $row[$col6] ? $row[$col6] : 'N/A';
                        $office = $row[$col7] ? $row[$col7] : 'N/A';
                        $branch = $row[$col10] ? $row[$col10] : 'N/A';
                        $leaves = $row[$col9] ? $row[$col9] : 'N/A';
                        $remarks = $row[$col8] ? $row[$col8] : 'N/A';
                        
                        if(($dateEnd == 'N/A' && $designation == 'N/A' && $empStatus == 'N/A' && $empSalary == 'N/A' && $office == 'N/A' && $branch == 'N/A' && $leaves == 'N/A' && $remarks == 'N/A')
                         || ($dateStart == 'N/A' && $dateEnd == 'N/A' && $designation == 'N/A' && $empStatus == 'N/A' && $empSalary == 'N/A' && $office == 'N/A' && $branch == 'N/A' && $leaves == 'N/A' && $remarks == 'N/A')){
                            break;
                        }

                        // if($dateStart == 'N/A'|| $dateEnd == 'N/A'){
                        //     break;
                        // }
                        $dateStart = date('Y-m-d', strtotime($dateStart));
                        $dateEnd = date('Y-m-d', strtotime($dateEnd));
                        if($dateEnd == '1970-01-01'){
                            $dateEnd = 'Present';
                        }
// $office == 'KHS' || $office == 'KNHS' || 


                        // $office = $row[$col7];
// SJDMNHS
// no = 17792
                        if($office == 'GRACEVILLE ES' || $office == 'Graceville ES'){
                            $office = 'Graceville Elementary School';
                        }elseif($office == 'GOLDENVILLE ES' || $office == 'Goldenville ES' || $office == 'GOLDENVILLE S' || $office == 'GOLDENVILLES ES' || $office == 'GOLDENVILLE SS'){
                            $office = 'Goldenville Elementary School';
                        }elseif($office == "GUMAOK ES" || $office == 'Gumaok ES'){
                            $office = 'Gumaok Elementary School';
                        }elseif($office == 'Sapang Palay NHS' || $office ==  'SPNHS' || $office ==  'SAPANG PALAY NATIONAL HIGH SCHOOL' || $office ==  'SAPANG PALAY NHS' || $office ==  'Sapang Palay NHS - SHS' || $office == 'Sapang palay NHS' || $office == 'Sapang Play NHS' || $office == 'Sapang Palay NHS- SHS' || $office == 'spnhs-SHS'){
                            $office = 'Sapang Palay National High School';
                        }elseif($office == "CSJDM NAT'L SCIENCE HS"){
                            $office = 'City of San Jose Del Monte Science High School';
                        }elseif($office == 'Sta. Cruz (BBD) ES'){
                            $office = 'Sta. Cruz (BBD) Elementary School';
                        }elseif($office == 'BBH ES' || $office == 'BBHES'){
                            $office = 'San Rafael (BBH) Elementary School';
                        }elseif($office == 'BBC ES'){
                            $office = 'San Martin (BBC) Elementary School';
                        }elseif($office == 'HEROES VILLE ES' || $office == 'HEROESVILLE ES'){
                            $office = 'Heroesville Elementary School';
                        }elseif($office == 'STO. CRISTO ES' || $office == 'STO.CRISTO ES'){
                            $office = 'Sto. Cristo Elementary School';
                        }elseif($office == 'RICAFORT ES' || $office == 'Ricafort ES'){
                            $office = 'Ricafort Elementary School';
                        }elseif($office == 'TOWERVILLE ES'){
                            $office = 'Towerville Elementary School';
                        }elseif($office == 'Daniel A. Avena ES'){
                            $office = 'Daniel A. Avena Elementary School';
                        }elseif($office == 'SAN MANUEL ES' || $office == 'San Manuel ES'){
                            $office = 'San Manuel Elementary School';
                        }elseif($office == 'SJDM Heights ES' || $office == 'SJDM HEIGHTS ES'){
                            $office = 'San Jose Del Monte Heights Elementary School';
                        }elseif($office == 'PARTIDA ES' || $office == 'Partida ES' || $office == 'SDO-SJDMC Partida ES'){
                            $office = 'Partida Elementary School';
                        }elseif($office == 'BBF ES' || $office == 'BBFES'){
                            $office = 'Bagong Buhay F Elementary School';
                        }elseif($office == 'BBG ES'){
                            $office = 'Bagong Buhay G Elementary School';
                        }elseif($office == 'BBI ES'){
                            $office = 'Bagong Buhay I Elementary School';
                        }elseif($office == 'BBB ES' || $office == 'BBB IS'){
                            $office = 'Bagong Buhay B Elementary School';
                        }elseif($office == 'BBE ES'){
                            $office = 'Bagong Buhay E Elementary School';
                        }elseif($office == 'BENITO NIETO ES' || $office == 'Benito Nieto ES' || $office == 'BNES'){
                            $office = 'Benito Nieto Elementary';
                        }elseif($office == 'FHES' || $office == 'FHES, CSJDM' || $office == 'FRANCISCO HOMES ES'){
                            $office = 'Francisco Homes Elementary School';
                        }elseif($office == 'MARANGAL ES' || $office == 'Marangal ES'){
                            $office = 'Marangal Elementary School';
                        }elseif($office == 'Marangal ES Annex' || $office == 'MARANGAL ANNEX ES ANNEX'){
                            $office = 'Marangal Elementary School Annex';
                        }elseif($office == 'SAN ROQUE ES' || $office == 'San Roque ES'){
                            $office = 'San Roque Elementary School';
                        }elseif($office == 'SAPANG PALAY PROPER ES' || $office == 'Sapang Palay Proper ES' || $office == 'SP PROPER ES' || $office == 'SP Proper ES' || $office == 'SPPES'){
                            $office = 'Sapang Palay Proper Elementary';
                        }elseif($office == 'SAN JOSE DEL MONTE HEIGHTS ES' || $office == 'SJDMHES'){
                            $office = 'San Jose Del Monte Heights Elementary School';
                        }elseif($office == 'BBA ES'){
                            $office = 'Bagong Buhay A Elementary School';
                        }elseif($office == 'Kaypian ES'){
                            $office = 'Kaypian Elementary School';
                        }elseif($office == 'Kakawate ES' || $office == 'KAKAWATE ES'){
                            $office = 'Kakawate Elementary School';
                        }elseif($office == 'MINUYAN ES' || $office == 'MINJUYAN ES'){
                            $office = 'Minuyan Elementary School';
                        }elseif($office == 'MUZON PABAHAY ES' || $office == 'Muzon Pabahay ES' || $office == 'Muzon Pabahay 2000 ES' || $office == 'MPES' || $office == 'Muzon Elem. School'){
                            $office = 'Muzon (Pabahay 200) Elementary School';
                        }elseif($office == 'MINUYAN NHS'){
                            $office = 'Minuyan National High School';
                        }elseif($office == 'CITRUS HS' || $office == 'CITRUS NHS' || $office == 'DepEd- Citrus National High School' || $office == 'CITRUS NHS-SHS' || $office == 'CITRUS NHS - SHS' || $office == 'Citrus NHS'){
                            $office = 'Citrus National High School';
                        }elseif($office == 'GRACEVILLE NHS' || $office == 'Graceville NHS' || $office == 'Graceviile HS' || $office == 'GNHS' || $office == 'GNHS-SHS' || $office == 'Graceville NHS-SHS'){
                            $office = 'Graceville National High School';
                        }elseif($office == 'Kakawate NHS' || $office == 'KAKAWATE HS' || $office == 'Kakawate High School' || $office == 'KAKAWATE NHS' || $office == 'Kakawate NHS-SHS' || $office == 'Kakawate HS'){
                            $office = 'Kakawate National High School';
                        }elseif($office == 'KAYPIAN NHS'){
                            $office = 'Kaypian National High School';
                        }elseif($office == 'MHHHS' || $office == 'MHHS' || $office == 'Muzon Harmony Hills HS' || $office == 'MUZON HH NHS' || $office == 'MHHHS (JS)' || $office == 'Muzn Harmony Hills HS' || $office == 'DepEd City Div. of San Jose del Monte MHHHS'){
                            $office = 'Muzon Harmony Hills High School';
                        }elseif($office == 'Muzon HS' || $office == 'MUZON HS' || $office == 'Muzon High School' || $office == 'Muzon NHS' || $office == 'MHS' || $office == 'Muzon H S' || $office == 'mHS' || $office == 'MUZON NHS' || $office == 'MUZon HS' || $office == 'muzon HS' || $office == 'mUZON HS' || $office == 'MuZON HS' || $office == 'MuzON NHS' || $office == 'MuzoN HS' || $office == 'MUZON HIGH SCHOOL'){
                            $office = 'Muzon National High School';
                        }elseif($office == 'Marangal NHS' || $office == 'MARANGAL NHS'){
                            $office = 'Marangal National High School';
                        }elseif($office == 'MINUYAN HS-SHS' || $office == 'MINUYAN HS' || $office == 'Minuyan nhs' || $office == 'Minuyan NHS'){
                            $office = 'Minuyan National High School';
                        }elseif($office == 'MULAWIN NHS' || $office == 'Mulawin NHS'){
                            $office = 'Mulawin National High School';
                        }elseif($office == 'San Martin NHS' || $office == 'SAN MARTIN NHS' ||  $office == 'San Martin NHS-SHS'){
                            $office = 'San Martin National High School';
                        }elseif($office == 'SCNHS' || $office == 'STO CRISTO NHS'){
                            $office = 'Sto. Cristo National High School';
                        }elseif($office == 'SJDM HEIGHTS HS' || $office == 'SJDMHHS' || $office == 'SJDM Heights HS'){
                            $office = 'San Jose Del Monte Heights High School';
                        }elseif($office == 'TVHS' || $office == 'Towerville NHS' || $office ==  'towerville NHS' || $office ==  'TOWERVILLE HS' || $office == 'TVNHS/SHS' || $office == 'TVNHS' || $office == 'TNHS' || $office == 'TVNHS-SHS' || $office == 'T V H S' || $office == 'TVHS/SHS' || $office == 'Towerville HS' || $office == 'TowervilleHS - SHS'){
                            $office = 'Towerville National High School';
                        }elseif($office == 'San Rafael NHS'){
                            $office = 'San Rafael National High School';
                        }elseif($office == 'SAN RAFAEL BBH ES'){
                            $office = 'San Rafael (BBH) Elementary Schooll';
                        }elseif($office == 'San Rafael(BBH)ES' || $office == 'SAN RAFEL (BBH) ES'){
                            $office = 'San Rafael National High School';
                        }elseif($office == 'SJDMC' || $office == 'SJDMCS'){
                            $office = 'San Jose Del Monte Central School';
                        }elseif($office == 'SJDMNHS' || $office == 'SJDMHS' || $office == 'CSJDM NSHS' || $office == 'CSJDMNSHS' || $office == 'CSJDMNSH S' || $office == 'CSJDMNSH' || $office == 'SJDMNSHS' || $office == 'SJHS' || $office == "SJDM Nat'l HS" || $office == 'S J D M N H S' || $office == 'SJDM HS'){
                            $office = 'San Jose Del Monte National High School';
                        }elseif($office == 'STO. CRISTO HS' || $office == 'STO. CRISTO NHS' || $office == 'Sto. Cristo NHS' || $office == 'San Jose del Monte NHS' || $office == 'SJDM NHS' || $office == 'SAN JOSE DEL MONTE NHS' || $office == 'San Jose HS'){
                            $office = 'Sto. Cristo National High School';
                        }elseif($office == 'SHS-SJDMNTS' || $office == 'SJDMNTS - SHS' || $office == 'SJDMNTS' || $office == 'SJDM NTS - JHS' || $office == 'SJDM NTS' || $office == 'SJDM NTS - SHS' || $office == 'SJDMNTS - JHS' || $office == 'Sto. Cristo NHS, CSJDM Bul.' || $office == 'SCNHS - SHS'){
                            $office = 'San Jose Del Monte National Trade School';
                        }elseif($office == 'PARADISE FARMS CS' || $office == 'PFCS'){
                            $office = 'Paradise Farms Community School';
                        }elseif($office == 'Paradise Farms NHS' || $office == 'Paradise Farms NHS - SHS' || $office == 'PFNHS' || $office == 'Paradise Farm NHS' || $office == 'PFNHS-SHS'){
                            $office = 'Paradise Farms National High School';
                        }elseif($office == 'STA. CRUZ BBD ES'){
                            $office = 'Sta. Cruz (BBD) Elementary School';
                        }elseif($office == 'SAN ISIDRO ES' || $office == 'San Isidro ES'){
                            $office = 'San Isidro Elementary School';
                        }elseif($office == 'TUNGKONG MANGGA ES' || $office == 'TUNGKONG MANGGA ES' || $office == 'TMES'){
                            $office = 'Tungkong Mangga Elementary School';
                        }elseif($office == 'SAN MARTIN (BBC) ES' || $office == 'SAN MARTIN BBC ES'){
                            $office = 'San Martin (BBC) Elementary School';
                        }elseif($office == 'DIVISION OFFICE' || $office == 'Division of City Schools of CSJDM' || $office == 'DEPED, CSJDM' || $office == 'SDO CSJDM' || $office == 'DIV. OF CSJDM, BULACAN' || $office == 'Division Office' || $office == 'DepEd - CSJDM' || $office == 'DepEd - CSJDM'){
                            $office = 'SDO';
                        }
                        mysqli_stmt_bind_param($stmt, 'isssssssss', $emdId,$dateStart,$dateEnd,$designation,$empStatus,$empSalary,$office,$branch,$leaves,$remarks);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                        $col2 += 9; $col3 += 9; $col4 += 9; $col5 += 9; $col6 += 9; $col7 += 9; $col8 += 9; $col9 += 9; $col10 += 9;
                    }
                $msg = true;
            }else{
                $count = "0";
            }
        }
    if(isset($msg)) {
        $_SESSION['type'] = 'add';
        $_SESSION['status'] = 'Success!';
        $_SESSION['text'] = 'Excel file has been imported';
        $_SESSION['status_code'] = 'success';
        header('Location: ServiceRecord.php?message=success');
    }else{
            $_SESSION['status'] = 'Record has not been added';
            $_SESSION['status_code'] = 'error';
            header('Location: ServiceRecord.php?message=failed');
        }
    }else{
        $_SESSION['status'] = 'Invalid File';
        $_SESSION['status_code'] = 'error';
        $_SESSION['text'] = 'Invalid file extension or Empty file';
            header('Location: ServiceRecord.php?message=failed');
    }
}else{
    $_SESSION['status'] = 'No file';
    $_SESSION['status_code'] = 'error';
    $_SESSION['text'] = 'You did not input anything';
}

?>