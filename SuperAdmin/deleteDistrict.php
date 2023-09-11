<?php
    include '../PersonalInfo/generalPhp/dbhConnection.php';

    if(count($_POST) > 0){
        $id = $_POST['districtDeleteId'];


        $sql = "DELETE FROM districts WHERE districtId=?;";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // header('Location: superAdminList.php?m=1');
        
    }else{
        // header('Location: superAdminList.php?message=access_denied');
    }
?>