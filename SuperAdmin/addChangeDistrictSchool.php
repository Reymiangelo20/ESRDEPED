<div class="modal fade" id="editSchoolDistrict" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="this"> 
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Configure Settings </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- <form id="add_admin_form"> -->
                      <div class="modal-body">
                        <div class="settings-container-div">
                        <div class="first-layer">

<!-- --------------------Adjust district-------------------------------- -->
                                <p class="setting-title">DISTRICT: </p>
                                <!-- Add district -->
                                
                                    <div class="form-group enterDistrictDiv" id="form-group">
                                        <input type="text" class="enterDistrict" id="enterDistrict" placeholder="Enter new district" autocomplete="off" required>
                                        <button class="configureButton" id="addDistrict">Add</button>  
                                          <i class="fas fa-check-circle"></i>
                                          <i class="fas fa-exclamation-circle"></i>
                                          <div class="error"></div>
                                        <label class="select_form_label">Add district</label>                        
                                    </div>
                                <!-- Edit district -->

                                <div class="editDistrictContainer">
                                    <div class="form-group" id="form-group">
                                        <select name="userDistrict" id="editSelectDistrict" class="form-control" >
                                            <option value="">Select district</option>
                                                <?php
                                                    $sql = "SELECT * FROM districts WHERE status = 1 ORDER BY districtId ASC";
                                                    $result = mysqli_query($conn, $sql);
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo '<option value="'.$row['districtName'].'">'.$row['districtName'].'</option>';
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

                                    <div class="form-group enterDistrictDiv" id="form-group" style="margin-bottom: -26px;">      
                                        <input type="text" class="enterSchool" id="enterDistrictUpdate" placeholder="Complete name of district">
                                        <button class="configureButton configEdit" id="edtiDistrict" style="height: 50px;">Edit</button>
                                        <i class="fas fa-check-circle"></i>
                                        <i class="fas fa-exclamation-circle"></i>
                                        <div class="error"></div>
                                        <label class="select_form_label" for="enterDistrictUpdate">Edit district</label>
                                    </div>
                                </div>

                                <!-- Delete district -->
                                <div class="form-group" id="form-group">
                                      <div class="enterDistrictDiv">
                                        <select name="userDistrict" id="Deletedistrict" class="form-control" >
                                                  <option value=0>Select district</option>
                                                  <?php
                                        $sql = "SELECT * FROM districts WHERE status = 1 ORDER BY districtId ASC";
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
                                          <label class="select_form_label">Delete district</label>
                                          <button class="configureButton configDelete" id="deleteDistrict">Delete</button>
                                      </div>     
                                    </div>
                                      
                                </div>

<!-- --------------------Adjust school-------------------------------- -->


                            <!-- first layer -->
                                <div class="first-layer">
<!-- Add new school -->
                                <p class="setting-title">SCHOOL: </p>
                                <div class="addSchoolContainer">
                                    <div class="form-group" id="form-group">
                                        <select name="userDistrict" id="districtForSchool" class="form-control" >
                                            <option value="">Select district</option>
                                                <?php
                                                    $sql = "SELECT * FROM districts WHERE status = 1 ORDER BY districtId ASC";
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

                                    <div class="form-group enterDistrictDiv" id="form-group">      
                                        <input type="text" class="enterSchool" id="enterSchool" placeholder="Complete name of school">
                                        <button class="configureButton" id="addSchool" style="height: 50px">Add</button>
                                        <i class="fas fa-check-circle"></i>
                                        <i class="fas fa-exclamation-circle"></i>
                                        <div class="error"></div>
                                        <label class="select_form_label" for="enterSchool">Add school</label>
                                    </div>
                                </div>
<!-- Edit School -->                         

                                <div class="editSchoolContainer">
                                    <div class="form-group" id="form-group">
                                        <select name="userDistrict" id="editSelectSchool" class="form-control" >
                                            <option value="">Select school</option>
                                                <?php
                                                    $sql = "SELECT * FROM schools WHERE status = 1 ORDER BY schoolName ASC";
                                                    $result = mysqli_query($conn, $sql);
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo '<option value="'.$row['schoolName'].'">'.$row['schoolName'].'</option>';
                                                        }
                                                    } else {
                                                        echo '<option value="">School not available</option>';
                                                    }
                                                ?>
                                        </select>
                                        <i class="fas fa-check-circle"></i>
                                        <i class="fas fa-exclamation-circle"></i>
                                        <div class="error"></div>
                                        <label class="select_form_label">School</label>
                                    </div>

                                    <div class="form-group enterDistrictDiv" id="form-group" style="margin-bottom: -26px;">      
                                        <input type="text" class="enterSchool" id="enterSchoolUpdate" placeholder="Complete name of school">
                                        <button class="configureButton configEdit" id="editSchool" style="height: 50px;">Edit</button>
                                        <i class="fas fa-check-circle"></i>
                                        <i class="fas fa-exclamation-circle"></i>
                                        <div class="error"></div>
                                        <label class="select_form_label" for="enterDistrictUpdate">Edit School</label>
                                    </div>
                                </div>

<!-- Delete School -->
                                    <div class="form-group" id="form-group">
                                      <div class="enterDistrictDiv">
                                          <select name="userSchool" id="deleteSchoolId" class="form-control" >
                                              <option value = 0>Select school</option>
                                          <?php
                                                  $sql = "SELECT * FROM schools WHERE status = 1 ORDER BY schoolId ASC";
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
                                              
                                          ?>
                                          </select>
                                          <i class="fas fa-check-circle"></i>
                                          <i class="fas fa-exclamation-circle"></i>
                                          <div class="error"></div>
                                          <label class="select_form_label">Delete school</label>
                                          <button class="configureButton configDelete" id="deleteSchool">Delete</button>
                                      </div>
                                    </div>
                                </div>
                        </div>
                                
                        </div>
        </div>
    </div>
</div>

<script>
      // add school & district
  addDistrict();
  deleteDistrict();
  editDistrict();
  addSchool();
  deleteSchool();
  editSchool()
</script>