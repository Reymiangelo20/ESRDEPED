<?php
    include '../PersonalInfo/generalPhp/dbhConnection.php';
    session_start();

    if(isset($_GET['deleteId'])){
        $id = $_GET['deleteId'];

        $sql = "SELECT * FROM servicerecord WHERE empId = '$id';";
        $result = mysqli_query($conn, $sql);
        $checkResult = mysqli_num_rows($result);
        if($checkResult > 0){
            header('Location: inactiveTeachers.php?n=2');
        }else{
            $sql = "DELETE FROM emppersonalinfo WHERE id=$id;";
            $result = mysqli_query($conn, $sql);

            header('Location: inactiveTeachers.php?m=1');
        }
    }else{
        header('Location: inactiveTeachers.php');
    }