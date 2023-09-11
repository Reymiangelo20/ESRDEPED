<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Development/PHPMailer-master\src\Exception.php';
require '../Development/PHPMailer-master\src\PHPMailer.php';
require '../Development/PHPMailer-master\src\SMTP.php';
include '../PersonalInfo/generalPhp/dbhConnection.php';
session_start();
// count($_POST) > 0
// isset($_POST['updatedata'])
if(count($_POST) > 0){

    $userId = mysqli_real_escape_string($conn, $_POST['userId']);
    $userName = mysqli_real_escape_string($conn, $_POST['userName']);
    $userEmail = mysqli_real_escape_string($conn, $_POST['userEmail']);
    // $occupation = mysqli_real_escape_string($conn, $_POST['occupation']);
    $userDistrict = mysqli_real_escape_string($conn, $_POST['userDistrict']);
    $userSchool = mysqli_real_escape_string($conn, $_POST['userSchool']);
    $userType = mysqli_real_escape_string($conn, $_POST['userType']);
    $userNewPass = mysqli_real_escape_string($conn, $_POST['userNewPass']);
    // $userNewPassTemp = $userNewPass;
    if($userNewPass == ''){
        $sql = "SELECT user_pass FROM users WHERE id = $userId;";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $row['user_pass'];
        $hashNewPass = $row['user_pass'];
    }else{
        $hashNewPass = password_hash($userNewPass, PASSWORD_DEFAULT);
    }
    $sql = "SELECT districtName FROM districts WHERE districtId = '$userDistrict';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $Districtname = $row['districtName'];     
        
    $sql = "SELECT schoolName FROM schools WHERE schoolId = '$userSchool';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $Schoolname = $row['schoolName'];

    $sql = "UPDATE users SET username = '$userName',
     user_email = '$userEmail',
     user_district = '$Districtname',
     user_school = '$Schoolname',
     type = '$userType',
     user_pass = '$hashNewPass' WHERE id = $userId;";

    $result = mysqli_query($conn, $sql);






    if($result){

        $accountmessage = "<b>ADMINISTRATOR ACCOUNT</b>
        <br><br> <b>Username: </b>". $userName."
        <br> <b>Email: </b>".  $userEmail."
        <br> <b>Password: </b> first 6 digits of your Email address + @deped.  example: 123456@deped
        <br> unless you changed password
        <br> <b>Admin type: </b>".$userType."
        <br> <b>District: </b>". $Districtname."
        <br> <b>School: </b>".$Schoolname."

        <br> <br> Your administrator account has been reverted to admin type 2 (School admin).
        <br> if there are any un-updated employee information you can contact the administrator in SDO.";



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

        echo 'Success';


    }else{
        echo 'Failed';
    }

}else{
    header('Location: superAdminList.php?message=access_denied');
}

?>