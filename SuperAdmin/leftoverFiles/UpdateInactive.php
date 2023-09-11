<?php 
    if(isset($_POST['updatedata'])){
        include '../PersonalInfo/generalPhp/dbhConnection.php';
        session_start();

        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $district = mysqli_real_escape_string($conn, $_POST['district']);
        $school = mysqli_real_escape_string($conn, $_POST['schools']);
        $lastName = mysqli_real_escape_string($conn, $_POST['lastName']); 
        $firstName = mysqli_real_escape_string($conn, $_POST['firstName']); 
        $middleName = mysqli_real_escape_string($conn, $_POST['middleName']); 
        $civilStatus = mysqli_real_escape_string($conn, $_POST['civilStatus']); 
        $gender = mysqli_real_escape_string($conn, $_POST['gender']); 
        $birthDay = mysqli_real_escape_string($conn, $_POST['birthDay']); 
        $birthPlace = mysqli_real_escape_string($conn, $_POST['placeOfBirth']); 
        $teacher_status = mysqli_real_escape_string($conn, $_POST['teacher_status']);

        // convert to string starts here

        $sql = "SELECT districtName FROM districts WHERE districtId = '$district';";
                $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                        $Districtname = $row['districtName'];     
        
        
            $sql = "SELECT schoolName FROM schools WHERE schoolId = '$school';";
                $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                        $Schoolname = $row['schoolName'];

         // convert to string ends here

        $sql = "UPDATE emppersonalinfo SET firstName = '$firstName',
        lastName = '$lastName', middleName = '$middleName', email = '$email',
        dateOfBirth = '$birthDay', place = '$birthPlace', district = '$Districtname',
        school = '$Schoolname', gender = '$gender', civilStatus = '$civilStatus', teacher_status = '$teacher_status' WHERE id = $id;";

        $result = mysqli_query($conn, $sql);

        // $sql = "UPDATE emppersonalinfo SET firstName=?, lastName=?, middleName=?, email=?, dateOfBirth=?, place=?, district=?, school=?, gender=?, civilStatus=? WHERE id=?";
        // $stmt = mysqli_prepare($conn, $sql);
        // mysqli_stmt_bind_param($stmt, "ssssssssssi", $firstName, $lastName, $middleName, $email, $birthDay, $birthPlace, $Districtname, $Schoolname, $gender, $civilStatus, $id);
        // $result = mysqli_stmt_execute($stmt);

        
        if($result){
            $_SESSION['type'] = 'edit';
            $_SESSION['status'] = 'Success!';
            $_SESSION['text'] = 'Record has been updated!';
            $_SESSION['status_code'] = 'success';
        }else{
            $_SESSION['status'] = 'Record has not been updated';
            $_SESSION['status_code'] = 'error';
        }

        header('Location: inactiveTeachers.php?updateRecord=success');
    }else{
        header('Location: inactiveTeachers.php?updateRecord=success');
    }