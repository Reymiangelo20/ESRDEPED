<?php
    include '../PersonalInfo/generalPhp/dbhConnection.php';
    session_start();

    // $sqlDisableDelete = "SELECT * FROM users";

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

  <link rel="stylesheet" href="../PersonalInfo/personalInfoStyle/header.css">
  <link rel="stylesheet" href="../PersonalInfo/personalInfoStyle/table.css">
  <link rel="stylesheet" href="../PersonalInfo/errorHandlerStyle/errorHandler.css">
  <link rel="stylesheet" href="style.css">


  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

  <script src="../PersonalInfo/sweetalert/sweetalert2.all.min.js"></script>
  <script src="../PersonalInfo/sweetalert/sweetalert.min.js"></script>
  
  <!-- Data table links  -->
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"></script>

  <link rel="stylesheet" href="../PersonalInfo/personalInfoStyle/general.css">

  <script src="../PersonalInfo/errorHandlerScripts/addAdminErrorHandler.js"></script>
  <script src="../PersonalInfo/personalScripts.js"></script>
  <script src="superAdminScripts.js"></script>

  <link rel="shortcut icon" type="image/png" href="../PersonalInfo/images/sdo-logo.png">
  <title>Super Admin | Administrators</title>
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


<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="this"> 
            </div>
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
      <p class="page-title">Administrators</p>
      <!-- Administrators -->
    </div>
    <div class="logout-div">
      <!-- <div class="table-search-div">
        <input type="text" name="table-search" id="table-search" placeholder="Search record...">
        <button disabled><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
      </div> -->
      <a class="logout-p" href="../PersonalInfo/loginPhp/logout"><i class="fa-solid fa-right-from-bracket"></i> LOGOUT</a>
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
      <div class="admin-accounts-option-div" style="background-color: rgb(49, 104, 255);">
        <i class="fas fa-users"></i>
        <p>Administrators</p>
        <a href="superAdmin2Administrators">
            <span class="link"></span>
        </a>
      </div>
      <div class="logs-option-div">
        <i class="fas fa-history"></i>
        <p>Logs</p>
        <a href="superAdmin3Logs.">
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
        <div class="submit-div">
            <button data-toggle="modal" data-target="#addModal" class="tempAdd">Add new <i class="fas fa-user-plus"></i> </button>
        </div>
        <!-- table starts here -->
        <?php
            $sql = "SELECT * FROM users ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
        ?>
        <div class="table-container-div admin-div-talble">
            <table id="example" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>USERNAME</th>
                        <th>DISTRICT</th>
                        <th>SCHOOL</th>
                        <th>EMAIL</th>
                        <th>ADMIN TYPE</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                
                <tfoot>
                </tfoot>
            </table>
        </div>
        <!-- table ends here -->
  </div>

  <!-- Admin registration modal -->
  <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Add New Admin </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="add_admin_form">
                        <div class="modal-body">
                                <!-- first layer -->
                                <div class="check-box-div">
                                    <span class="note-checkbox"><span class="note-word">Note</span>: Check the checkbox if currently employed in School Division Office</span><br>
                                    <input type="checkbox" name="School_division_office" id="SDO" value="School Division Office">
                                    <label for="SDO">School Division Office (SDO) Employee</label>
                                </div>
                                <div class="first-layer">
                                    <div class="form-group" id="form-group">
                                        <!-- <label>District</label> -->
                                        <select name="userDistrict" id="district" class="form-control" >
                                                <option value="">Select district</option>
                                                <?php
                                $sql = "SELECT * FROM districts WHERE status = 1 ORDER BY districtId ASC LIMIT 11";
                                    $result = mysqli_query($conn, $sql);
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
                                        
                                        <i class="fas fa-check-circle"></i>
                                        <i class="fas fa-exclamation-circle"></i>
                                        <div class="error"></div>
                                        <label class="select_form_label">District</label>
                                    </div>
                                    <div class="form-group" id="form-group">
                                        <!-- <label>School</label> -->
                                        <select name="userSchool" id="schools" class="form-control" >
                                            <option value="">Select school</option>
                                            <!-- <option value="11">School Division Office</option> -->
                                                                                    <?php
                                            if(isset($_GET['userSchool'])) {
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
                                        <i class="fas fa-check-circle"></i>
                                        <i class="fas fa-exclamation-circle"></i>
                                        <div class="error"></div>
                                        <label class="select_form_label">School</label>
                                    </div>
                                </div>
                                <!-- second layer -->
                                <div class="second-layer">
                                    <div class="form-group" id="form-group">
                                        <!-- <label>Username</label> -->
                                        <input type="text" name="userName" id="userName" class="form-control form__input" placeholder=" "  autocomplete=off value="<?php if(isset($_GET['userName'])) {
                                            echo $_GET['userName'];
                                        } ?>">
                                        <i class="fas fa-check-circle"></i>
                                        <i class="fas fa-exclamation-circle"></i>
                                        <div class="error"></div>
                                        <label class="form__label" for="userName">Username</label>
                                    </div>
                                    <div class="form-group" id="form-group">
                                        <!-- <label>Email</label> -->
                                        <input type="text" name="userEmail" id="userEmail" class="form-control form__input" placeholder=" "  autocomplete=off value="<?php if(isset($_GET['userEmail'])) {
                                            echo $_GET['userEmail'];
                                        } ?>">
                                        <i class="fas fa-check-circle"></i>
                                        <i class="fas fa-exclamation-circle"></i>
                                        <div class="error"></div>
                                        <label class="form__label" for="userEmail">Email</label>
                                    </div>
                                </div>
                                <div class="third-layer" id="form-group">
                                    <div class="form-group">
                                        <!-- <label>Password</label> -->
                                        <input type="password" name="userPass" id="userPass" class="form-control form__input" placeholder=" "  autocomplete=off value="<?php if(isset($_GET['userPass'])) {
                                            echo $_GET['userPass'];
                                        } ?>">
                                        <i class="fas fa-check-circle"></i>
                                        <i class="fas fa-exclamation-circle"></i>
                                        <div class="error"></div>
                                        <i class="fa-regular fa-eye-slash" id="toggleEyeIcon"></i>
                                        <label class="form__label" for="userPass">Password</label>
                                    </div>
                                    <div class="form-group" id="form-group1">
                                        <input type="password"  name="userConPass" id="userConPass" class="form-control form__input" placeholder=" "  autocomplete=off value="<?php if(isset($_GET['userConPass'])) {
                                            echo $_GET['userConPass'];
                                        } ?>">
                                        <i class="fas fa-check-circle"></i>
                                        <i class="fas fa-exclamation-circle"></i>
                                        <div class="error"></div>
                                        <i class="fa-regular fa-eye-slash" id="toggleEyeIconConf"></i>
                                        <label class="form__label" for="userConPass">Confirm Password</label>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <!-- <button type="submit" class="btn btn-primary">Register</button> -->
                            <input type="submit" class="btn btn-primary" id="registration-button" name="register" value="Register">
                        </div>
                    </form>
                </div>
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
                    Swal.fire({
                        position: 'center',
                        icon: "<?php echo $_SESSION['status_code']?>",
                        title: "<?php echo $_SESSION['status']?>",
                        text: "<?php echo $_SESSION['text'] ?>",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    history.replaceState(null, null, window.location.pathname);
                </script>  
            <?php
                unset($_SESSION['status']); 
        }
?>



<script>
  const spinnerWrapperEl = document.querySelector('.spinner-wrapper');
  const dataTableId = document.getElementById('example');
// pass text field
  const toggleIcon = document.querySelector('#toggleEyeIcon');
  const passwordInput = document.querySelector('#userPass');
// confirm pass text field
  const toggleIconConf = document.querySelector('#toggleEyeIconConf');
  const confirmPasswordInput = document.querySelector('#userConPass');
// change pass text field

  let districtId = document.getElementById('district')
  let schoolId = document.getElementById('schools')
  let fileLocation = '../PersonalInfo/personalInfoPhp/empSchools.php';


  loader(spinnerWrapperEl);

$(document).ready(function () {
      $('#example').DataTable({
        "order": [[ 0, "desc" ]],
          serverSide: true,
          ajax: 'serverSideAdministrator.php',
      });
  });

  errorHandlerFixer();
  seePass(passwordInput, toggleIcon);
  seePass(confirmPasswordInput, toggleIconConf);
  hoverEffect();
  exportFileWithLoader();
  districtToSchoolDropdown(districtId, schoolId);
  selectSDO();
  editAdministrator();
  deleteAdministrator();
  showImportModalWithWarnig();
  addAdministrator();
  errorHandlerStyleRemover();


</script>