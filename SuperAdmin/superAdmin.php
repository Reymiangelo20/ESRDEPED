
<?php
    include '../PersonalInfo/generalPhp/dbhConnection.php';
    session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="superAdminStyle/superAdmin.css"/>
    <link rel="stylesheet" href="logs.css"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/aa867b86c2.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    

    <title>Super Admin</title>
</head>
<body>
    <div class="dashboard-header-div">
        <div class="dashbaord-title-div">
            <p>Admin Dashboard</p>
        </div>

        <div class="dashboard-logout-div">
            <i class="fa-solid fa-right-from-bracket"></i>
            <a href="../PersonalInfo/loginPhp/logout.php"> LOGOUT</i></a>
        </div>
    </div>
    <div class="export-div">
         <!-- <button id="export-emp" class="export-ei btn btn-success">Export Employee Info</button> -->
        <button id="export-sr" class="export-sr btn btn-danger">Export Service Record PDF</button>
        <button id="export-emp-pdf" class="export-emp-pdf btn btn-danger">Export Employee Info PDF</button>
    </div>
   
    <div class="dashboard-sidebar-div">
        
        <div class="dashboard-sidebar-options">
            <div class="dashboard-homepage-div">
                <i class="fas fa-tachometer-alt"></i>
               
                <a style="text-decoration: underline;" href="superAdmin.php">Dashboard</a>
            </div>
            <div class="dashboard-admin-list-div">
                <i class="fas fa-users"></i>
               
                <a href="superAdminList.php">Admin accounts</a>
            </div>
            <div class="dashboard-admin-log-div">
                <i class="fas fa-history"></i>
               
                <a href="superAdminLogs.php">Logs</a>
            </div>
            <div class="dashboard-admin-inactive-div">
                <i class="fas fa-user-alt-slash"></i>
                
                <a href="inactiveTeachers.php">Inactive teachers</a>
            </div>
            <!-- <i class="fas fa-user"></i> -->
            <div class="dashboard-admin-inactive-div">
                <i class="fas fa-user"></i>
                <a href="activeTeachers.php">Active teachers</a>
            </div>
        </div>
        
        
    </div>

    <div class="dashboard-content-div">
        <div class="dashboard-display" id="dashboard-display">
            
        <div class="daschboard-admin-accounts">
            <div class="dashboard-display-icon">
                <i class="fas fa-user-cog"></i>
                <p>Admins</p>
            </div>
            <?php
                $sql = "SELECT * FROM users;";
                $result = mysqli_query($conn, $sql);
                $numAdmins = mysqli_num_rows($result);
            ?>
            <a href="superAdminList.php">
                <span class="link"></span>
            </a>
            <p class="dashboard-display-count"><?php echo $numAdmins;?></p>
        </div>

        <div class="dashboard-inactive-teachers">
            <div class="dashboard-display-icon">
                <i class="fas fa-user-check"></i>
                <p>Active teachers</p>
            </div>
            <?php
                $sql = "SELECT * FROM emppersonalinfo WHERE teacher_status = 'Active';";
                $result = mysqli_query($conn, $sql);
                $numTeachers = mysqli_num_rows($result);
            ?>
            <a href="activeTeachers.php">
                <span class="link"></span>
            </a>
            <p class="dashboard-display-count"><?php echo $numTeachers;?></p>
        </div>
        <div class="dashboard-log-history">
            <div class="dashboard-display-icon">
                <i class="fas fa-user-times"></i>
                <p>Inactive teachers</p>
            </div>
            <?php
                $sql = "SELECT * FROM emppersonalinfo WHERE teacher_status != 'Active';";
                $result = mysqli_query($conn, $sql);
                $numInactive = mysqli_num_rows($result);
            ?>
            <a href="inactiveTeachers.php">
                <span class="link"></span>
            </a>
            <p class="dashboard-display-count"><?php echo $numInactive;?></p>
        </div>
        </div>

        <div class="dashboard-registration" id="dashboard-registration">
        </div>
        
    </div>
        <?php
        // $get = "SELECT * FROM `logs`ORDER BY logId DESC LIMIT 5 ";
        // $result = $conn->query($get);
        // while ($row = $result->fetch_assoc()) {
        //     echo "Admin ". $row['admin_name']." ".$row['description']." employee with an email of ". $row['email']." on ".$row['date']." at ".$row['time'] 
        // }
    ?>

    <div class="recent-activity">
        <h4>Recent Activities</h4>
        <div class="recent-activiy-overflow-container">
            <?php
                $get = "SELECT * FROM `logs`ORDER BY logId DESC LIMIT 5 ";
                $result = $conn->query($get);
                while ($row = $result->fetch_assoc()){
            ?>
            <div class="recent-activity-container">
                <div class="recent-activity-header" 
                style="background-color: <?php if($row['action'] == 'Add'){
                    echo "#7ae582";
                }elseif($row['action'] == 'Delete'){
                    echo '#ff3c38';
                }elseif($row['action'] == 'Update'){
                    echo '#219ebc';
                }else{
                    echo '#ff9914';
                } ?>">
                    <div class="activity-type-continer">
                        Activity: <?php 
                        if($row['action'] == 'Add'){
                            echo 'Add record';
                        }elseif($row['action'] == 'Delete'){
                            echo 'Delete record';
                        }else if ($row['action'] == "Request"){
                            echo "Request Service Record";  

                        }else if ($row['action'] == "Add employee"){
                            echo 'Add Employee';
                        }
                        else if ($row['action'] == "Delete employee"){
                            echo 'Delete Employee';
                        }
                        else if ($row['action'] == "Update employee"){
                            echo 'Update Employee';
                        }
                        else{
                            echo 'Update record';
                        }?>
                    </div>
                    <div class="time-data-container">
                        <div class="recent-activity-time"><?php echo $row['time']; ?></div>
                    </div>
                </div>
                <div class="body-footer-container">
                    <div class="recent-activity-body">
                        <?php if($row['admin_name'] == "Non-Admin"){
                            echo $row['email'], " ".$row['description'];
                        }else if ($row['action'] == 'Add employee' || $row['action'] == 'Delete employee' || $row['action'] == 'Update employee' ){
                            echo "Admin ".$row['admin_name']." ".$row['description']." with an email of ". $row['email']."";
                        }
                        else{
                            echo "Admin ".$row['admin_name']." ".$row['description']." empsloyee with an email of ". $row['email']."";
                        }
                            
                        ?>
                    </div>
                    <div class="recent-activity-footer">
                        <?php echo $row['date']; ?>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
 

<script>
$(document).ready(function() {
    $('.export-sr').on('click', function(){
        window.location.href = "ExportServiceRecordPDF.php";	

    });
   });

  $(document).ready(function(){
    $("#export-emp-pdf").click(function(){
        window.location.href = "ExportEmployeePDF.php";	
    });
  });
</script>

 
</body>
</html>
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