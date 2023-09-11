<?php
     include '../PersonalInfo/generalPhp/dbhConnection.php';
     
     $userId = $_POST['userId'];

     if(count($_POST) > 0){

        $sql = "UPDATE emppersonalinfo SET teacher_status = 'Active' WHERE id = $userId";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo 'employee has been updated';
        }else{
            echo 'nothing happened';
        }
     }else{
        echo 'Access denied';
     }
?>