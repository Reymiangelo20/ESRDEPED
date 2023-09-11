<?php
session_start();
include('../../PersonalInfo/generalPhp/dbhConnection.php');

        $id = $_POST['id'];
        $dateset = $_POST['date'];
        $eid = $_POST['eid'];
        $update = "UPDATE `servicerecord` SET `dateEnd`= '$dateset' WHERE id = '$id'";
        $stmt = mysqli_prepare($conn, $update);
        mysqli_stmt_execute($stmt);

       

        $getdata = "SELECT * FROM `emppersonalinfo` WHERE id='$eid'";
        $result = $conn->query($getdata);
        while($row = mysqli_fetch_assoc($result)){
            $email = $row['email'];
            date_default_timezone_set('Asia/Singapore');
            $date = date("M j  Y");
            $time = date("g:i A");
            $admin = $_SESSION['admin'];
            $sql = "INSERT INTO `logs`(admin_name,email,description,action,AddedData,previousData,ChangedData,date, time) VALUES ('$admin','$email','Updated a Record of','Set Date Record','-','-','$dateset','$date','$time')";
            $conn->query($sql);
    
            }
          
?>