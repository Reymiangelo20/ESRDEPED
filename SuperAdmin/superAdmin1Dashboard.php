<?php
    include '../PersonalInfo/generalPhp/dbhConnection.php';
    session_start();
    if(!isset($_SESSION['superAdmin'])){
      header('Location: ../index.php');
    }
    else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- <link rel="stylesheet" href="../PersonalInfo/personalInfoStyle/general.css"> -->

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/aa867b86c2.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <link rel="stylesheet" href="../PersonalInfo/personalInfoStyle/header.css">
  <link rel="stylesheet" href="../PersonalInfo/personalInfoStyle/table.css">
  <link rel="stylesheet" href="../PersonalInfo/errorHandlerStyle/errorHandler.css">
  <link rel="stylesheet" href="style.css">

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">

  <script src="../PersonalInfo/sweetalert/sweetalert2.all.min.js"></script>
  <script src="../PersonalInfo/sweetalert/sweetalert.min.js"></script>

  <link rel="shortcut icon" type="image/png" href="../PersonalInfo/images/sdo-logo.png">

  <link rel="stylesheet" href="../PersonalInfo/personalInfoStyle/general.css">

  <script src="../PersonalInfo/personalScripts.js"></script>
  <script src="superAdminScripts.js"></script>

  <title>Super Admin | Dashboard</title>
</head>
    <!-- <div class="spinner-wrapper">
        <div class="spinner-border text-info" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div> -->

    <div class="spinner-wrapper">
        <div class="spinner-text-container">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <img src="../personalInfo/images/sdo-logo.png">
            <p class="waiting-text">Wait for a moment...</p>
        </div>
    </div>

    <div class="spinner-export">
        <div class="spinner-text-container">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <img src="../personalInfo/images/sdo-logo.png">
            <p class="waiting-text">This will take a few seconds...</p>
        </div>
    </div>

    <!-- <div id="fader">

    </div> -->
<body>
<?php
    include 'importFiles.php';    
?>
<?php
  include 'addChangeDistrictSchool.php';
?>

<input type="checkbox" id="check" value="checked">
  <label for="check">
    <i class="fas fa-bars" id="btn"></i>
    <i class="fas fa-times" id="cancel"></i>
  </label>
  <div class="heads">
    <div class="title-page-div">
      <p class="page-title">Dashboard</p>
    </div>
    <div class="logout-div">
      <a class="logout-p" href="../PersonalInfo/loginPhp/logout.php"><i class="fa-solid fa-right-from-bracket"></i> LOGOUT</a>
    </div>
</div>
  <!-- <input type="checkbox" id="check">
  <label for="check">
    <i class="fas fa-bars" id="btn"></i>
    <i class="fas fa-bars" id="cancel"></i>
  </label> -->
  <div class="side-bar-div">
    <div class="website-name-div">
      <img class="insignia-img" src="../PersonalInfo/images/deped-insignia_orig.png">
      <!-- <p class="website-name">DepEd Panel</p> -->
    </div>
    <div class="side-bar-options-div">
      <div class="dashboard-option-div" style="background-color: rgb(49, 104, 255);">
        <i class="fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
        <a href="superAdmin1Dashboard">
          <span class="link"></span>
        </a>
        <!-- <div class="sidebar-hidden-div">
          Dashboard
        </div> -->
      </div>
      <div class="admin-accounts-option-div">
        <i class="fas fa-users"></i>
        <p>Administrators</p>
        <a href="superAdmin2Administrators">
            <span class="link"></span>
        </a>
      </div>
      <div class="logs-option-div">
        <i class="fas fa-history"></i>
        <p>Logs</p>
        <a href="superAdmin3Logs">
            <span class="link"></span>
        </a>
      </div>
      <div class="inactive-employee-option-div">
        <i class="fas fa-user-alt-slash"></i>
        <p>Inactive Employees</p>
        <a href="superAdmin4Inactive">
            <span class="link"></span>
        </a>
      </div>
      <div class="active-employee-option-div">
        <i class="fas fa-user"></i>
        <p>Active Employees</p>
        <a href="superAdmin5Active">
            <span class="link"></span>
        </a>
      </div>
      <div class="settings-option-div">
        <i class="fa-solid fa-gears"></i>
        <p>Settings</p>
        <a data-toggle="modal" data-target="#editSchoolDistrict">
            <span class="link"></span>
        </a>
      </div>
      <div class="export-file-option-div exporter">
        <i class="fa-solid fa-file-export"></i>
        <p>Export File</p>
        <!-- <a href="superAdmin5Active.php">
            <span class="link"></span>
        </a> -->
      </div>
        <div class="export-file-option-div export-service-record" id="export-sr">
          <i class="fa-solid fa-table"></i>
          <span>Service Record</span>
        </div>
        <div class="export-file-option-div export-service-record" id="export-emp-pdf">
          <i class="fa-solid fa-table"></i>
          <span>Personal Info</span>
        </div>
        <div class="import-file-option-div">
          <i class="fa-solid fa-file-import"></i>
          <p>Import Files</p>
          <!-- <a data-toggle="modal" data-target="#ImportModal"> -->
          <a id="importFileBtnId">
            <span class="link"></span>
        </a>
      </div>
    </div>
  </div>
  <div class="main-container-div">
      <div class="sidebar-dashboard-hidden-div sidebar-hidden-div">
            Dashboard
      </div>
      <div class="sidebar-admin-hidden-div sidebar-hidden-div">
            Administrators
      </div>
      <div class="sidebar-logs-hidden-div sidebar-hidden-div">
            Logs
      </div>
      <div class="sidebar-inactive-hidden-div sidebar-hidden-div">
            Inactive Employees
      </div>
      <div class="sidebar-active-hidden-div sidebar-hidden-div">
            Active Employees
      </div>
      <div class="sidebar-settings-hidden-div sidebar-hidden-div">
            Settings
      </div>
      <div class="sidebar-export-hidden-div sidebar-hidden-div">
            Export Files
      </div>
      <div class="sidebar-service-hidden-div sidebar-hidden-div">
            Service Record | Excel
      </div>
      <div class="sidebar-personal-hidden-div sidebar-hidden-div">
            Personal Info | Excel
      </div>
      <div class="sidebar-import-hidden-div sidebar-hidden-div">
            Import Files
      </div>
    <div class="display-status-container-div">
    <!-- <i class="fa-solid fa-user-plus"></i> -->
      <div class="admins-div-container">
        <div class="admin-title">
          <i class="fas fa-user-cog"></i>
          <?php
                $sql = "SELECT * FROM users;";
                $result = mysqli_query($conn, $sql);
                $numAdmins = mysqli_num_rows($result);
            ?>
          <p><?php echo $numAdmins;?></p>
        </div>
        <p class="status-title">Admins</p>
        
      </div>
      <div class="active-employee-div">
        <div class="admin-title">
          <i class="fas fa-user-check"></i>
          <?php
                $sql = "SELECT * FROM emppersonalinfo WHERE teacher_status = 'Active';";
                $result = mysqli_query($conn, $sql);
                $numTeachers = mysqli_num_rows($result);
            ?>
          <p><?php echo $numTeachers;?></p>
        </div>
        <p class="status-title">Active Employees</p>
        
      </div>
      <div class="inactive-employee-div">
        <div class="admin-title">
          <i class="fas fa-user-times"></i>
          <?php
                $sql = "SELECT * FROM emppersonalinfo WHERE teacher_status != 'Active';";
                $result = mysqli_query($conn, $sql);
                $numInactive = mysqli_num_rows($result);
            ?>
          <p><?php echo $numInactive;?></p>
        </div>
        <p class="status-title">Inactive Employees</p>
        
      </div>
    </div>
    <div class="recent-activities-div">
      <p class="recent-activities-title">Recent Activities</p>
      <div class="recent-activities-main-container">
        <?php
          $sql = "SELECT * FROM logs ORDER BY logId DESC LIMIT 10;";
          $result = mysqli_query($conn, $sql);
          while($row = mysqli_fetch_assoc($result)){
        ?>
        <div class="recent-activity-wrapper">
          <div class="activity-icon-div">
            <?php 
              if($row['action'] == 'Add'){
                  echo '<i class="fa-sharp fa-solid fa-plus" id="add-icon"></i>';
              }elseif($row['action'] == 'Delete'){
                  echo '<i class="fa-regular fa-trash-can" id="trash-icon"></i>';
              }else if ($row['action'] == "Request"){
                  echo '<i class="fa-solid fa-envelope-open-text" id="request-icon"></i>';  
              }else if ($row['action'] == "Add employee"){
                echo '<i class="fa-solid fa-user-plus" id="add-user-icon"></i>';
              }else if ($row['action'] == "Delete employee"){
                echo '<i class="fa-solid fa-user-minus" id="delete-user-icon"></i>';
              }else if ($row['action'] == "Update employee"){
                echo '<i class="fa-solid fa-user-pen" id="update-user-icon"></i>';
              }else if ($row['action'] == "Login"){
                echo '<i class="fa-solid fa-right-to-bracket" id="login-user-icon"></i>';
              }else{
                  echo '<i class="fa-sharp fa-solid fa-file-pen" id="edit-icon"></i>';
              }?>
          </div>
          <div class="recent-activity-content">
            <div class="recent-activity-header">
              <p><?php echo $row['date']; ?></p>
              <p><?php echo $row['time']; ?></p>
            </div>
            <div class="recent-activity-body">
              <p>
              <?php 
                if($row['admin_name'] == "Non-Admin"){
                  echo $row['email'], " ".$row['description'];
                }else if ($row['action'] == 'Add employee' || $row['action'] == 'Delete employee' || $row['action'] == 'Update employee' ){
                  echo "Admin ".$row['admin_name']." ".$row['description']." with an email of ". $row['email']."";
              }else if ($row['action'] == 'Login'){
                echo "Admin ".$row['admin_name']." "."Logged in";
              }
                else{
                  echo "Admin ".$row['admin_name']." ".$row['description']." employee with an email of ". $row['email']."";
                }
              ?>
                <!-- Admin rodel_agocoy1 Updated a employee details employee with an email of adnress@gmail.com -->
              </p>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</body>
</html>
<?php
  }
?>


<script>
  const spinnerWrapperEl = document.querySelector('.spinner-wrapper');

  loader(spinnerWrapperEl);
  hoverEffect();
  // exportFile();
  exportFileWithLoader();
  errorHandlerStyleRemover();
  showImportModalWithWarnig();
</script>