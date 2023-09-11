<?php
    include '../PersonalInfo/generalPhp/dbhConnection.php';
    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\Exception;

    // require '../Development/PHPMailer-master/src/Exception.php';
    // require '../Development/PHPMailer-master/src/PHPMailer.php';
    // require '../Development/PHPMailer-master/src/SMTP.php';

    if(isset($_POST['id'])){
        $id = $_POST['id'];

        // $getemail = "SELECT user_email FROM users where id=$id";
        // $resultemail = $conn->query($getemail);
        // $row = mysqli_fetch_assoc($resultemail);
        // $email = $row['user_email'];

                    // $mail = new PHPMailer(true);
                    // $mail->isSMTP();
                    // $mail->Host='smtp.gmail.com';
                    // $mail->SMTPAuth=true;
                    // //sender username
                    // $mail ->Username = 'schoolsdivisionoffice@gmail.com';
                    // //two way pass
                    // $mail ->Password = 'povxtuiujqpsjkpe';
                    // $mail ->SMTPSecure='ssl';
                    // $mail ->Port='465';
                    // //sender
                    // $mail ->setFrom('schoolsdivisionoffice@gmail.com','Division Office CSJDM');
                    // //receiver
                    // $mail -> addAddress($email);
                    // $mail->isHTML(true);
                    // $mail->Subject='Account Deletion';
                    // $mail->Body="your account has been deleted";
                   
                    // $mail->send();



        $sql = "DELETE FROM users WHERE id=?;";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // header('Location: superAdminList.php?m=1');
        
    }else{
        // header('Location: superAdminList.php?message=access_denied');
    }
?>