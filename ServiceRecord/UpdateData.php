<?php
session_start();
include ('../../PersonalInfo/generalPhp/dbhConnection.php');


    //GET EDIT FORM DATA
        $start = $_POST['start'];
        $end = $_POST['end'];
        $designation = $_POST['designation'];
        $status = $_POST['status'];
        $salary = $_POST['salary'];
        $branch = $_POST['branch'];
        $leaveofabssence = $_POST['leaveofabssence'];
        $remarks = $_POST['remarks'];
        $station = $_POST['finalstation'];
        $id = $_POST['id'];
        $empId = $_POST['empId'];;

    //GET CURRENT DATE END AND START FOR COMPARISON IN INPUTTED DATA
        // $getdate = "SELECT dateStart, dateEnd FROM servicerecord WHERE id=$id";
        // $result = $conn->query($getdate);
        // $row = $result->fetch_assoc();
        // $start_db = $row['dateStart'];
        // $dbdateend = $row['dateEnd'];


    //IF THE DATE CURRENT DATE START NOT EQUAL TO INPUTTED DATA UPDATE BELOW DATA
        // if ($start != $start_db){
        //   $enddate =  date('Y-m-d', strtotime($start . ' -1 day'));
        //   $getpreviosrow ="SELECT * FROM servicerecord WHERE id < $id AND empId='$empId' ORDER BY id DESC LIMIT 1";
        //   $result = $conn->query($getpreviosrow);
        //   $row = $result->fetch_assoc();
        //   $previosID = $row['id'];
        //   $update = "UPDATE `servicerecord` SET `dateEnd`= '$enddate' WHERE id = '$previosID'";
        //   $stmt = mysqli_prepare($conn, $update);
        //   mysqli_stmt_execute($stmt);
        // }
        // else{}

    //IF THE DATE CURRENT DATE END NOT EQUAL TO INPUTTED DATA UPDATE ABOVE DATA
        // if($end != $dbdateend){
        //    $startdate =  date('Y-m-d', strtotime($end . ' +1 day'));
        //    $getpreviosrow ="SELECT * FROM servicerecord WHERE id > $id AND empId='$empId' ORDER BY id ASC LIMIT 1";
        //    $result = $conn->query($getpreviosrow);
        //    $row = $result->fetch_assoc();
        //    $nextID = $row['id'];
        //    $update = "UPDATE `servicerecord` SET `dateStart`= '$startdate' WHERE id = '$nextID'";
        //    $stmt = mysqli_prepare($conn, $update);
        //    mysqli_stmt_execute($stmt);
        // }
        // else{}

    //GET CURRENT DATA OF SELECTED RECORD 
        $sql = "SELECT * FROM servicerecord WHERE id = '$id'";
        $resultdata = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($resultdata);
        $dbfrom = $row['dateStart'];
        $dbto = $row['dateEnd'];
        $dbdesignation = $row['designation'];
        $dbstatus = $row['empStatus'];
        $dbsalary = $row['empSalary'];
        $dbbranch = $row['branch'];
        $dbleave = $row['leaveOfAbssence'];
        $dbremarks = $row['remarks'];
        $dbstation = $row['placeOfAppointment'];

    //CHECK IF THERE IS CHANGES IN DATA IF THERE IS CHANGES DATA CHANGES WILL GET TO PUSH ON DATABASE LOGS
       if($dbfrom!=$start){$newfrom = 'From: '.$start; $prevfrom = 'From:'.$dbfrom;}
       else{ $newfrom = ""; $prevfrom = "";}
       
       if($dbto!=$end){$newto = 'To: '.$end; $prevto = 'To: '.$dbto;}
       else{ $newto = ""; $prevto = "";}

       if($dbdesignation!=$designation){$newdesignation = 'Designation: '.$designation; $prevdesignation = 'Designation: '.$dbdesignation;}
       else{ $newdesignation = ""; $prevdesignation = "";}

       if($dbstatus!=$status){$newstatus = 'Status: '.$status; $prevstatus = 'Status: '.$dbstatus;}
       else{ $newstatus = ""; $prevstatus = "";}

       if($dbsalary!=$salary){$newsalary = 'Salary: '.$salary; $prevsalary = 'Salary: '.$dbsalary;}
       else{ $newsalary = ""; $prevsalary = "";}

       if($dbbranch!=$branch){$newbranch = 'Branch: '.$branch; $prevbranch = 'Branch: '.$dbbranch;}
       else{ $newbranch = ""; $prevbranch = "";}

       if($dbleave!=$leaveofabssence){$newleave = 'LeaveOfAbbsence: '.$leaveofabssence; $prevleave = 'LeaveOfAbbsence: '.$dbleave;}
       else{ $newleave = ""; $prevleave = "";}

       if($dbremarks!=$remarks){$newremarks = 'Remarks: '.$remarks; $prevremarks = 'Remarks: '.$dbremarks;}
       else{ $newremarks = ""; $prevremarks = "";}

       if($dbstation!=$station){$newstation = 'Station: '.$station; $prevstation = 'Station: '.$dbstation;}
       else{ $newstation = ""; $prevstation = "";}


    //GET ALL DATA WITH CHANGES
       $changeddata = array($newfrom, $newto, $newdesignation,$newstatus, $newsalary,$newstation, $newbranch,$newleave, $newremarks );
       $filtered_changeddata = array_filter($changeddata, function ($value){return !empty($value);});
       $newdata = implode(', ', $filtered_changeddata);

    //GET ALL PREVIOUS DATA OF DATA THAT HAS CHANGES
       $previousdata = array($prevfrom, $prevto, $prevdesignation,$prevstatus, $prevsalary,$prevstation, $prevbranch,$prevleave, $prevremarks );
       $filtered_previousdata = array_filter($previousdata, function ($value1){return !empty($value1);});
       $prevdata = implode(', ', $filtered_previousdata);

    //IF LEAVE OF ABSENCE AND REMARKS IS BLANK PUT N/A VALUE
       $leaveofabssence = $leaveofabssence ? $leaveofabssence : 'N/A';
       $remarks = $remarks ? $remarks : 'N/A';

    //PUSH UPDATED DATA INTO DATABASE
       $update = "UPDATE servicerecord SET dateStart = ?, dateEnd = ?, designation = ?, empStatus = ?, empSalary = ?, branch = ?, leaveOfAbssence = ?, remarks = ?, placeOfAppointment = ? WHERE id = ?";
       $stmt = mysqli_prepare($conn, $update);
       mysqli_stmt_bind_param($stmt, 'sssssssssi', $start, $end, $designation, $status, $salary, $branch, $leaveofabssence, $remarks, $station, $id);
       mysqli_stmt_execute($stmt);
       mysqli_stmt_close($stmt);

    //DATE, TIME AND ADMIN USERNAME
       date_default_timezone_set('Asia/Singapore');
       $date = date("M j  Y");
       $time = date("g:i A");
       $admin = $_SESSION['admin'];

    //GET SELECTED USER INFO
       $getdata = "SELECT firstName, lastName, email FROM `emppersonalinfo` WHERE id='$empId'";
       $result = $conn->query($getdata);
       while($row = mysqli_fetch_assoc($result)){
       $firstname = $row['firstName'];
       $lastname = $row['lastName'];
       $email = $row['email'];
       }

    //IF THERE IS VALUE IN CHANGED DATA, DATA WILL BE PUSH INTO DATABASE LOGS
      if(!empty($changeddata)){
        $sql = "INSERT INTO `logs`(admin_name,email,description,action,AddedData,previousData,ChangedData,date, time) VALUES ('$admin','$email','Updated a Record of','Update Record','-','$prevdata','$newdata','$date','$time')";
        $conn->query($sql);
      }
      else{}
        

        



?>