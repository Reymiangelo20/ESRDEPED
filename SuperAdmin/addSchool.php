<?php

include '../PersonalInfo/generalPhp/dbhConnection.php';

// session_start();

if(count($_POST) > 0){
    $schoolValue = mysqli_real_escape_string($conn, $_POST['schoolValue']);
    $districtId = mysqli_real_escape_string($conn, $_POST['districtIdForSchool']);

    $sql = "select max(schoolId) as largest from schools;";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $latestId = $row['largest'];

    $sql = "INSERT INTO schools(schoolId, districtId, schoolName, status) VALUES($latestId + 1, $districtId, '$schoolValue', 1)";
    $schoolResult = mysqli_query($conn, $sql);
    if($schoolResult){
        echo 'success';
    }else{
        echo 'failed';
    } 
}
?>