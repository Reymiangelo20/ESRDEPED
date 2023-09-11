<?php

include '../PersonalInfo/generalPhp/dbhConnection.php';

// session_start();

if(count($_POST) > 0){
    $districtValue = mysqli_real_escape_string($conn, $_POST['districtValue']);

    $sql = "select max(districtId) as largest from districts;";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $latestId = $row['largest'];

    $sql = "INSERT INTO districts(districtId, districtName, status) VALUES($latestId + 1, '$districtValue', 1)";
    $districtResult = mysqli_query($conn, $sql);
    if($districtResult){
        echo 'success';
    }else{
        echo 'failed';
    }

       
}else{
    echo 'unmatch_password';
}
?>