<?php
session_start();
include('../../PersonalInfo/generalPhp/dbhConnection.php');

 //GET INPUTTED DATA IN INSERT MODAL    
      $from = $_POST['from'];
      $to = $_POST['to'];
      $designation = $_POST['designation'];
      $status = $_POST['status'];
      $salary = $_POST['salary'];
      $station = $_POST['station'];
      $branch = $_POST['branch'];
      $leave = $_POST['leave'];
      $remarks = $_POST['remarks'];
      $station = $_POST['station'];
      $station2 = $_POST['station2'];
      $position = $_POST['position'];
      $resultdata = $_POST['result'];


  //GET EMPLOYEE ID    
      $id = $_SESSION['id'];


  //CHECK IF OUTSIDE STATION IS CHECKED
      if ($resultdata == 'station1'){$finalstation = $station2;} 
      else {$finalstation = $station;}

  //FINAL POSITION TO ITERATE WHEN ADDING A DATA
      $finalposition = $position-1;

  //GET THE POSITION EMPID AND RID (id) OF DATA THAT WILL ITERATE
      $getdata = "SELECT * FROM `servicerecord` WHERE Position >'$finalposition' AND empId = '$id' ORDER BY position ASC";
      $result = $conn->query($getdata);
      if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()){
        $positions = $row['Position'];
        $empId = $row['empId'];
        $rid = $row['id'];
        $appendposition = $positions+1;
            
  //UPDATE THE POSITION + 1 OF HIGHER NUMBER THAN POSITION
      $update = "UPDATE `servicerecord` SET `Position` = '$appendposition' WHERE Position = '$positions' AND id = '$rid'";
      $asd = mysqli_query($conn, $update);
      if(!$asd){echo 'error';}
      else{echo $positions."-".$appendposition."<br>";}
     }

  //POSITION OF INSERTING DATA
      $addposition = $finalposition+1;



      $leave = $leave ? $leave : 'N/A';
      $remarks = $remarks ? $remarks : 'N/A';

  //INSERT INPUTTED DATA TO DATABASE
      $add = "INSERT INTO servicerecord (`Position`,`empId`,`dateStart`,`dateEnd`,`designation`,`empStatus`,`empSalary`,`branch`,`leaveOfAbssence`,`remarks`,`placeOfAppointment`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = mysqli_prepare($conn, $add);
      mysqli_stmt_bind_param($stmt, 'iisssssssss', $addposition, $id, $from, $to, $designation, $status, $salary, $branch, $leave, $remarks, $finalstation);
      mysqli_stmt_execute($stmt);

      
   //VALIDATION IF INSERTED OR NOT
      if (!$stmt){echo 'Error inserting record: ' . mysqli_error($conn);} 
      else {echo 'Record inserted successfully';}
      mysqli_stmt_close($stmt); 
      }

      $arraydata = array('From: '.$from,'To: '.$to,'Designation: '.$designation,'Status: '.$status, 'Salary: '.$salary,'Station: '. $finalstation, 'Branch: '.$branch, 'LeaveOfAbbsence: '.$leave, 'Remarks: '.$remarks);
      $filtered_data = array_filter($arraydata, function ($value){return !empty($value);});
      $insertdata = implode(', ', $filtered_data);

      
  //GET SELECTED USER INFO
      $getdata = "SELECT firstName, lastName, email FROM `emppersonalinfo` WHERE id=' $id'";
      $result = $conn->query($getdata);
      while($row = mysqli_fetch_assoc($result)){
        $firstname = $row['firstName'];
        $lastname = $row['lastName'];
        $email = $row['email'];
        if(empty($email)){$email = "(".$firstname." ".$lastname.")";
        }else{$email = $row['email'];}
      }

  //DATE, TIME AND ADMIN USERNAME              
      date_default_timezone_set('Asia/Singapore');
      $date = date("M j  Y");
      $time = date("g:i A");
      $admin = $_SESSION['admin'];


  //ADD INSERTED DATA INTO LOGS
      $sql = "INSERT INTO `logs`(admin_name,email,description,action,AddedData,previousData,ChangedData,date, time) VALUES ('$admin','$email','Inserted a record to','Insert record','$insertdata','-','-','$date','$time')";
      $conn->query($sql);


?>
