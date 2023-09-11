<?php
    include '../PersonalInfo/generalPhp/dbhConnection.php';

    if(count($_POST) > 0){
        if(isset($_POST['newDistrict']) && isset($_POST['oldDistrict'])){
            $oldDistrict = $_POST['oldDistrict'];
            $newDistrict = $_POST['newDistrict'];

            $sql = "UPDATE districts SET districtName = '$newDistrict' WHERE districtName = '$oldDistrict'";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo 'updated';
            }else{
                echo 'not_updated';
            }

            $sql = "UPDATE emppersonalinfo SET district = '$newDistrict' WHERE district = '$oldDistrict';";
            $results = mysqli_query($conn, $sql);

            $sql = "UPDATE users SET user_district = '$newDistrict' WHERE user_district = '$oldDistrict'";
            mysqli_query($conn, $sql);
        }else if(isset($_POST['newSchool']) && isset($_POST['oldSchool'])){
            $oldSchool = $_POST['oldSchool'];
            $newSchool = $_POST['newSchool'];
            
            $sql = "UPDATE schools SET schoolName = '$newSchool' WHERE schoolName = '$oldSchool'";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo 'updated';
            }else{
                echo 'not_updated';
            }

            $sql = "UPDATE emppersonalinfo SET school = '$newSchool' WHERE school = '$oldSchool';";
            $results = mysqli_query($conn, $sql);

            $sql = "UPDATE users SET user_school = '$newSchool' WHERE user_school = '$oldSchool'";
            mysqli_query($conn, $sql);

            $sql = "UPDATE servicerecord SET placeOfAppointment = '$newSchool' WHERE placeOfAppointment = '$oldSchool'";
            mysqli_query($conn, $sql);
        }else{
            echo 'access_denied';
        }
        
    }else{
        echo 'access_denied';
    }
?>