<?php
include('../../PersonalInfo/generalPhp/dbhConnection.php');
session_start();
   
        $id = $_POST['id'];

     //GET EMPID AND POSITION WITH ID OF $ID
        $getempid = "SELECT * FROM `servicerecord` WHERE id='$id'";
        $result = $conn->query($getempid);
        while($row = mysqli_fetch_assoc($result)){
        $empid = $row['empId'];
        $deletedposition = $row['Position'];
        }
        
     //UPDATE POSITION, MINUS 1 POSITION GREATER THAN $DELETEDPOSITION
        $update = "UPDATE `servicerecord` SET `position` = `position` - 1 WHERE position > $deletedposition AND empId = '$empid'";
        $asd = mysqli_query($conn, $update);

     //GET SELECTED USER INFO
        $getdata = "SELECT firstName, lastName, email FROM `emppersonalinfo` WHERE id=' $empid'";
        $result = $conn->query($getdata);
        while($row = mysqli_fetch_assoc($result)){
        $firstname = $row['firstName'];
        $lastname = $row['lastName'];
        $email = $row['email'];
        }

     //DATE, TIME AND ADMIN USERNAME
        date_default_timezone_set('Asia/Singapore');
        $date = date("M j  Y");
        $time = date("g:i A");
        $admin = $_SESSION['admin'];


     //INSERT TO LOGS 
        $sql = "INSERT INTO `logs`(admin_name,email,description,action,AddedData,previousData,ChangedData,date, time) VALUES ('$admin','$email','Deleted a Record of','Delete Record','-','-','-','$date','$time')";
        $conn->query($sql);


     //DELETE DATA WITH ID $ID
        $sql = "DELETE FROM servicerecord WHERE id = '$id'";
        mysqli_query($conn, $sql);
   
     // Close connection
        mysqli_close($conn);
?>