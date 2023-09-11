<?php
session_start();
include('../../PersonalInfo/generalPhp/dbhConnection.php');

     //EMPLOYEE ID
        $id = $_SESSION['id'];  
 
     //GET LAST POSITION AND TO DATE
        $result = mysqli_query($conn, "SELECT * FROM servicerecord Where empId = '$id' ORDER BY Position DESC LIMIT 2");
        $row = mysqli_fetch_assoc($result);
        $last_pos = $row['Position'];
        $lastto =$row['dateEnd'];

        if(empty($last_pos)){
             $last_pos = '1';
             $finalpos = $last_pos;
        }else{
             $finalpos = $last_pos+1;
        }
        

     //GET ADD MODAL INPUT DATA
        $StartFrom = $_POST['from'];
        $Designation = $_POST['designation'];
        $Status = $_POST['status'];
        $Salary = $_POST['salary'];
        $Station = $_POST['station'];
        $Branch = $_POST['branch'];
        $Leave = $_POST['leave'] ? $_POST['leave'] : 'N/A';
        $Remarks = $_POST['remarks'] ? $_POST['remarks'] : 'N/A';
        $resultdata = $_POST['addresult'];
        $station2 = $_POST['station2'];
        $date = date('Y-m-d', strtotime($StartFrom . ' -1 day'));
        

     //CHECK IF OUTSIDE STATION IS CHECKED
        if($resultdata == 'station1'){$finalstation = $station2;}
        else{$finalstation = $Station;}


     //ADD INPUTTED DATA TO DATABASE 
        $present = 'Present';
        $add = "INSERT INTO servicerecord (`Position`,`empId`,`dateStart`,`dateEnd`,`designation`,`empStatus`,`empSalary`,`branch`,`leaveOfAbssence`,`remarks`,`placeOfAppointment`) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $add);
        mysqli_stmt_bind_param($stmt, 'iisssssssss',$finalpos,$id, $StartFrom, $present, $Designation, $Status, $Salary, $Branch, $Leave, $Remarks, $finalstation);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);


     //CHECK IF LAST DATE TO HAS DATA. IF IT HAS IT WILL NOT UPDATE
        if($lastto == 'Present'){
            $update = "UPDATE `servicerecord` SET `dateEnd`= 'not set' WHERE Position = '$last_pos' AND empId = '$id'";
            $stmt = mysqli_prepare($conn, $update);
            mysqli_stmt_execute($stmt);     
        }else{}


     //GET SELECTED USER INFO
        $getdata = "SELECT firstName, lastName, email FROM `emppersonalinfo` WHERE id=' $id'";
        $result = $conn->query($getdata);
        while($row = mysqli_fetch_assoc($result)){
        $firstname = $row['firstName'];
        $lastname = $row['lastName'];
        $email = $row['email'];
        if(empty($email)){$email = "(".$firstname." ".$lastname.")";}
        else{$email = $row['email'];}
        }
        

     //DATE, TIME AND ADMIN USERNAME
        date_default_timezone_set('Asia/Singapore');
        $date = date("M j  Y");
        $time = date("g:i A");
        $admin = $_SESSION['admin'];


      //CHECK INPUTS IF IT HAS VALUE. IF IT HAS DATA WILL GET TO ADD ON LOGS       
        $addingdata = array('From: '.$StartFrom,'To: '.'Present','Designation: '.$Designation,'Status: '.$Status, 'Salary: '.$Salary,'Station: '. $finalstation, 'Branch: '.$Branch, 'LeaveOfAbbsence: '.$Leave, 'Remarks: '.$Remarks);
        $filtered_data = array_filter($addingdata, function ($value){return !empty($value);});
        $adddata = implode(', ', $filtered_data);


     //ADD ADDED DATA INTO LOGS
        $sql = "INSERT INTO `logs`(admin_name,email,description,action,AddedData,previousData,ChangedData,date, time) VALUES ('$admin','$email','Added a record to','Add record','$adddata','-','-','$date','$time')";
        $conn->query($sql);

?>