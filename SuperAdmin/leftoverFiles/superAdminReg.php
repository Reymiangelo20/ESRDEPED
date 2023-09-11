<?php
session_start();
    if(isset($_SESSION['superAdmin'])){
        header('Location: ../index.php');
    }else{?>
<?php
    include '../PersonalInfo/generalPhp/dbhConnection.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap start -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <!-- bootstrap end -->

    <!-- <link rel="stylesheet" href="../personalInfoStyle/inputs.css"> -->
    <link rel="stylesheet" href="../PersonalInfo/personalInfoStyle/general.css">
    <!-- <link rel="stylesheet" href="../personalInfoStyle/header.css"> -->
    <link rel="stylesheet" href="../PersonalInfo/personalInfoStyle/table.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../PersonalInfo/errorHandlerStyle/errorHandler.css">

    <!-- <script defer src="PersonalInfo/personalInfoScripts/addErrorHandler.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../PersonalInfo/sweetalert/sweetalert2.all.min.js"></script>
    <script src="../PersonalInfo/sweetalert/sweetalert.min.js"></script>
    <script src="https://kit.fontawesome.com/aa867b86c2.js" crossorigin="anonymous"></script>

    <!-- new link starts here -->


    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <!-- new link ends here -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="superAdminStyle/superAdmin.css"/>

    <script src="https://kit.fontawesome.com/aa867b86c2.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Super Admin</title>
</head>
<body>
    <div class="dashboard-header-div">
        <div class="dashbaord-title-div">
            <p>Admin Dashboard</p>
        </div>
    </div>
    <div class="dashboard-sidebar-div">
        <div class="dashboard-sidebar-options">
            <div class="dashboard-homepage-div">
                <i class="fas fa-tachometer-alt"></i>
                <!-- <p class="dashboard-home" id="dashboard-home">Dashboard</p> -->
                <a href="superAdmin.php">Dashboard</a>
            </div>
            <div class="dashboard-admin-regitration-div">
                <i class="fas fa-user-plus"></i>
                <!-- <p class="dashboard-register" id="dashboard-register">Register admin</p> -->
                <a style="text-decoration: underline;" href="superAdminReg.php">Register admin</a>
            </div>
            <div class="dashboard-admin-list-div">
                <i class="fas fa-users"></i>
                <a href="superAdminList.php">Admin accounts</a>
            </div>
            <div class="dashboard-admin-log-div">
                <i class="fas fa-history"></i>
                <a href="#">Logs</a>
            </div>
            <div class="dashboard-admin-inactive-div">
                <i class="fas fa-user-alt-slash"></i>
                <a href="inactiveTeachers.php">Inactive teachers</a>
            </div>
        </div>
        
        <div class="dashboard-logout-div">
            <i class="fa-solid fa-right-from-bracket"></i>
            <a href="PersonalInfo/loginPhp/logout.php">Logout</i></a>
        </div>
    </div>
    <div class="dashboard-content-div">

        <div class="dashboard-registration" id="dashboard-registration">
        <div class="dashboard-registration-title">
            <h2>Admin Registration Form</h2>
            </div>
            <form action="addAdmin.php" method="post">
                <div class="dashboard-input-registration">
                    <div class="dashboard-select">
                        <select name="userType" id="userType" required>
                            <option value="">Select type</option>
                            <option value="admin1" <?php if(isset($_GET['userType']) && $_GET['userType'] == 'admin1') echo 'selected="selected"'; ?>>admin 1</option>
                            <option value="admin2" <?php if(isset($_GET['userType']) && $_GET['userType'] == 'admin2') echo 'selected="selected"'; ?>>admin 2</option>
                        </select>
                        <label>Type</label>
                    </div>
                    <?php
                        $sql = "SELECT * FROM districts WHERE status = 1 ORDER BY districtId ASC"; 
                        $result = mysqli_query($conn, $sql); 
                    ?>
                    <div class="dashboard-select">
                        <select name="userDistrict" id="district" required>
                            <option value="">Select district</option>
                            <?php
                                if ($result->num_rows > 0) { 
                                    while ($row = $result->fetch_assoc()) {  
                                        echo '<option value="'.$row['districtId'].'"';
                                        if (isset($_GET['userDistrict']) && $row['districtId'] == $_GET['userDistrict']) {
                                            echo ' selected';
                                        }
                                        echo '>'.$row['districtName'].'</option>';
                                    } 
                                } else { 
                                    echo '<option value="">District not available</option>'; 
                                } 
                            ?>
                        </select>
                        <label>District</label>
                    </div>
                    <div class="dashboard-select">
                        <select name="userSchool" id="schools" required>
                            <option value="">Select school</option>
                            <?php
                            if(isset($_GET['userSchool'])){
                                $sql = "SELECT * FROM schools WHERE status = 1 AND districtId = ".$_GET['userDistrict']." ORDER BY schoolId ASC";
    
                                $result = mysqli_query($conn, $sql); 
                                if ($result->num_rows > 0) { 
                                    while ($row = $result->fetch_assoc()) {  
                                        echo '<option value="'.$row['schoolId'].'"';
                                        if (isset($_GET['userSchool']) && $row['schoolId'] == $_GET['userSchool']) {
                                            echo ' selected';
                                        }
                                        echo '>'.$row['schoolName'].'</option>';
                                    } 
                                } else { 
                                    echo '<option value="">School not available</option>'; 
                                } 
                            }
                        ?>
                        </select>
                        <label>School</label>
                    </div>
                    <div class="dashboard-input">
                        <input type="text" name="userName" class="form__input" placeholder="Username" required autocomplete=off value="<?php if(isset($_GET['userName'])) echo $_GET['userName']; ?>">
                        <label class="form__label">Username</label>
                    </div>
                    <div class="dashboard-input">
                        <input type="text" name="userEmail" class="form__input" placeholder="Email" required autocomplete=off value="<?php if(isset($_GET['userEmail'])) echo $_GET['userEmail']; ?>">
                        <label class="form__label">Email</label>
                    </div>
                    <div class="dashboard-input">
                        <input type="password" name="userPass" class="form__input" placeholder="Password" required autocomplete=off value="<?php if(isset($_GET['userPass'])) echo $_GET['userPass']; ?>">
                        <label class="form__label">Password</label>
                    </div>
                    <div class="dashboard-input">
                        <input type="password"  name="userConPass" class="form__input" placeholder="Username" required autocomplete=off value="<?php if(isset($_GET['userConPass'])) echo $_GET['userConPass']; ?>">
                        <label class="form__label">Confirm Password</label>
                    </div>
                    <div class="dashboard-register-btn">
                        <button type="submit" name="register">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
    }
?>

<?php
        if( isset($_SESSION['status']) && ($_SESSION['type'] == 'add' || $_SESSION['type'] == 'edit') && isset($_SESSION['status']) && $_SESSION['status'] != '')
        {
            ?>
                <script>
                    swal({
                        title: "<?php echo $_SESSION['status']?>",
                        text: "<?php echo $_SESSION['text'] ?>",
                        icon: "<?php echo $_SESSION['status_code']?>",
                        button: "Okay",
                    });
                </script>  
            <?php
                unset($_SESSION['status']); 
        }
    ?>

<script>
    $(document).ready(function(){
        $('#district').on('change', function(){
            var districtID = $(this).val();
            if(districtID){
                $.ajax({
                    type:'POST',
                    url:'../PersonalInfo/personalInfoPhp/empSchools.php',
                    data:'districtId='+districtID,
                    success:function(html){
                        $('#schools').html(html);
                    }
                }); 
            }else{
                $('#schools').html('<option value="">Select district first</option>');
            }
        });
    });
</script>



<!-- <script>  
    $(document).ready(function(){  
        $(document).on('click', '.dashboard-register', function(){  
            var id = $(this).attr("id");   
            $.ajax({  
                    url:"dashbaordRegistration.php",  
                    method:"POST",  
                    data:{id:id},  
                    success:function(data)  
                    {  
                        $('#dashboard-registration').html(data);
                        $("#dashboard-registration").css("display", "block");
                        $("#dashboard-display").css("display", "none");
                    }  
            })  
        });  
    });  
    $(document).ready(function(){  
        $(document).on('click', '.dashboard-home', function(){  
            var id = $(this).attr("id");   
            $('#dashboard-display').css("display", "grid");
            $("#dashboard-registration").css("display", "none");
        });  
    });
 </script> -->