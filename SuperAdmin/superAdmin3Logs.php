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

  <!-- bootstrap start -->

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
  
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/aa867b86c2.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- <link rel="stylesheet" href="style.css"> -->

  <link rel="stylesheet" href="../PersonalInfo/personalInfoStyle/header.css">
  <link rel="stylesheet" href="../PersonalInfo/personalInfoStyle/table.css">
  <link rel="stylesheet" href="../PersonalInfo/errorHandlerStyle/errorHandler.css">
  <link rel="stylesheet" href="style.css">
  <!-- <link rel="stylesheet" href="superAdminStyle/superAdmin.css"/> -->

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
  <script src="../PersonalInfo/sweetalert/sweetalert2.all.min.js"></script>
  <script src="../PersonalInfo/sweetalert/sweetalert.min.js"></script>

  
  <!-- Data table links  -->
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"></script>

  <script src="../PersonalInfo/personalScripts.js"></script>
  <script src="superAdminScripts.js"></script>

  <link rel="stylesheet" href="../PersonalInfo/personalInfoStyle/general.css">

  <link rel="shortcut icon" type="image/png" href="../PersonalInfo/images/sdo-logo.png">
  <title>Super Admin | Logs</title>
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

<body>
<?php
    include 'importFiles.php';    
?>
<?php
  include 'addChangeDistrictSchool.php';
?>
<input type="checkbox" id="check">
  <label for="check">
    <i class="fas fa-bars" id="btn"></i>
    <i class="fas fa-times" id="cancel"></i>
  </label>
  <div class="heads">
    <div class="title-page-div">
      <p class="page-title">Logs</p>
      <!-- Administrators -->
    </div>
    <div class="logout-div">
      <!-- <div class="table-search-div">
        <input type="text" name="table-search" id="table-search" placeholder="Search record...">
        <button disabled><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
      </div> -->
      <a class="logout-p" href="../PersonalInfo/loginPhp/logout.php"><i class="fa-solid fa-right-from-bracket"></i> LOGOUT</a>
    </div>
  </div>
  <div class="side-bar-div">
    <div class="website-name-div">
      <img class="insignia-img" src="../PersonalInfo/images/deped-insignia_orig.png">
      <!-- <p class="website-name">DepEd Panel</p> -->
    </div>
    <div class="side-bar-options-div">
      <div class="dashboard-option-div">
        <i class="fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
        <a href="superAdmin1Dashboard">
          <span class="link"></span>
        </a>
      </div>
      <div class="admin-accounts-option-div">
        <i class="fas fa-users"></i>
        <p>Administrators</p>
        <a href="superAdmin2Administrators">
            <span class="link"></span>
        </a>
      </div>
      <div class="logs-option-div" style="background-color: rgb(49, 104, 255);">
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
          <!-- <i class="fa-regular fa-file-pdf"></i> -->
          <i class="fa-solid fa-table"></i>
          <span>Service Record</span>
        </div>
        <div class="export-file-option-div export-service-record" id="export-emp-pdf">
          <!-- <i class="fa-regular fa-file-pdf"></i> -->
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
  <!-- table starts here -->
        <?php
          $sql = "SELECT * FROM logs ORDER BY logId DESC";
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);
        ?>
        <div class="table-container-div" style="margin-top: 20px;">
            <table id="example" style="width:100%">
                <thead>
                    <tr>
                      <th>ID</th>
                      <th>ADMIN USERNAME</th>
                      <th>USER EMAIL</th>
                      <th>ACTION</th>
                      <th>ADDED DATA</th>
                      <th>PREVIOUS DATA</th>
                      <th>CHANGED DATA</th>
                      <th>DATE</th>
                      <th>TIME</th>
                    </tr>
                </thead>
                <?php
                        foreach($result as $row){
                          // $replacefrom = array('FirstName:','LastName:','MiddleName:','MiddleInitial:','BirthDate:','BirthPlace:','District:','School:','Gender:','CivilStatus:','Status:','Email:');
                          // $replaceto = array('<b>FirstName:</b>','<b>LastName:</b>','<b>MiddleName:</b>','<b>MiddleInitial:</b>','<b>BirthDate:</b>','<b>BirthPlace:</b>','<b>District:</b>','<b>School:</b>','<b>Sex:</b>','<b>CivilStatus:</b>','<b>Status:</b>','<b>Email:</b>');
                          
                          // $changed = $row['ChangedData'];                         
                          // $changedata = nl2br(str_replace($replacefrom, $replaceto, $changed));
                          // $finalchange = nl2br(str_replace(', ','<br>', $changedata));

                          // $previous = $row['previousData'];
                          // $prevdata = nl2br(str_replace($replacefrom, $replaceto, $previous));
                          // $finalprev = nl2br(str_replace(', ','<br>', $prevdata));

                          // $added = $row['AddedData'];
                          // $addeddata = nl2br(str_replace($replacefrom, $replaceto, $added));
                          // $finaladded = nl2br(str_replace(', ','<br>', $addeddata));

                         
                    ?>
                  <?php } ?>
                
                <tfoot>
                </tfoot>
            </table>
        </div>
  <!-- table ends here -->
</body>
</html>
<?php
}
?>



<script>
  const spinnerWrapperEl = document.querySelector('.spinner-wrapper');
  const dataTableId = document.getElementById('example');

  loader(spinnerWrapperEl);
  hoverEffect();

$(document).ready(function () {
  $('#example').DataTable({
    "order": [[ 0, "desc" ]],
    serverSide: true,
    ajax: {
      url: 'serverSideLogs.php',
      dataFilter: function(data) {

        const replacefrom = ['FirstName:','LastName:','MiddleName:','MiddleInitial:','BirthDate:','BirthPlace:','District:','School:','Gender:','CivilStatus:','Status:','Email:','From:','To:','Designation','Status','Salary','Station','Branch','LeaveOfAbbsence','Remarks'];
        const replaceto = ['<b>FirstName:</b>','<b>LastName:</b>','<b>MiddleName:</b>','<b>MiddleInitial:</b>','<b>BirthDate:</b>','<b>BirthPlace:</b>','<b>District:</b>','<b>School:</b>','<b>Sex:</b>','<b>CivilStatus:</b>','<b>Status:</b>','<b>Email:</b>','<b>From:</b>','<b>To:</b>','<b>Designation</b>','<b>Status</b>','<b>Salary</b>','<b>Station</b>','<b>Branch</b>','<b>LeaveOfAbbsence</b>','<b>Remarks</b>'];
        let newData = data.replace(/, /g, '<br>'); 
        for (let i = 0; i < replacefrom.length; i++) {
          newData = newData.replace(new RegExp(replacefrom[i], 'g'), replaceto[i]);
        }
        return newData;
      }
    }
  });
});
  exportFileWithLoader();
  errorHandlerStyleRemover();
  showImportModalWithWarnig();
</script>