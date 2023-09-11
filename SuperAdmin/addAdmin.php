<?php

include '../PersonalInfo/generalPhp/dbhConnection.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Development/PHPMailer-master/src/Exception.php';
require '../Development/PHPMailer-master/src/PHPMailer.php';
require '../Development/PHPMailer-master/src/SMTP.php';
session_start();
// count($_POST) > 0
// isset($_POST['register'])
if(count($_POST) > 0){
    $userName = mysqli_real_escape_string($conn, $_POST['userName']);
    $userEmail = mysqli_real_escape_string($conn, $_POST['userEmail']);
    $userType = 'admin2';
    if(!isset($_POST['userDistrict'])){
        $userDistrict = 11;
        $userSchool = 57;
    }else{
        $userDistrict = mysqli_real_escape_string($conn, $_POST['userDistrict']);
        $userSchool = mysqli_real_escape_string($conn, $_POST['userSchool']);
    }
    $userPass = mysqli_real_escape_string($conn, $_POST['userPass']);
    $userConPass = mysqli_real_escape_string($conn, $_POST['userConPass']);

    $sql = "SELECT max(id) AS largest FROM users;";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $latestId = $row['largest'];

    $sql = "SELECT districtName FROM districts WHERE districtId = '$userDistrict';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $Districtname = $row['districtName'];     
        
        
    $sql = "SELECT schoolName FROM schools WHERE schoolId = '$userSchool';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $Schoolname = $row['schoolName']; 

    if($userPass == $userConPass){
        $sql = "SELECT username FROM users WHERE username = '$userName';";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            echo 'Already_Exist';
        }else{
            // $_SESSION['type'] = 'add';
            // $_SESSION['status'] = 'Success!';
            // $_SESSION['text'] = 'Record has been added';
            // $_SESSION['status_code'] = 'success';

            echo 'Success';

            $hasdedPass = password_hash($userPass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users(id, username, user_email, user_district, user_school, user_pass, type) 
            VALUES($latestId + 1, '$userName', '$userEmail', '$Districtname', '$Schoolname', '$hasdedPass', '$userType');";
            mysqli_query($conn, $sql);
        }

                    $accountmessage = "<b>ADMINISTRATOR ACCOUNT</b>
                    <br><br> <b>Username: </b>". $userName."
                    <br> <b>Email: </b>".  $userEmail."
                    <br> <b>Password: </b>". $userPass."
                    <br> <b>District: </b>". $Districtname."
                    <br> <b>School: </b>".$Schoolname;

                    $mail = new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host='smtp.gmail.com';
                    $mail->SMTPAuth=true;
                    //sender username
                    $mail ->Username = 'schoolsdivisionoffice@gmail.com';
                    //two way pass
                    $mail ->Password = 'dohbihlwmzwlzobk';
                    $mail ->SMTPSecure='ssl';
                    $mail ->Port='465';
                    //sender
                    $mail ->setFrom('schoolsdivisionoffice@gmail.com','Division Office CSJDM');
                    //receiver
                    $mail -> addAddress($userEmail);
                    $mail->isHTML(true);
                    $mail->Subject='Account Credentials';
                    $mail->Body=$accountmessage;
                   
                    // $mail->send();



}else{
    echo 'unmatch_password';
}
}else{
    header('Location: superAdminList.php?message=access_denied!');
}