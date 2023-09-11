<?php
    include '../PersonalInfo/generalPhp/dbhConnection.php';
        $userId = $_POST['userId'];
        $userName = $_POST['userName'];
        $userEmail = $_POST['userEmail'];
        $userType = $_POST['userType'];
        // $occupation = $_POST['occupation'];

        $userDistrict = $_POST['userDistrict'];
        $sql = "SELECT districtId FROM districts WHERE districtName = '$userDistrict';";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $userDistrictId = $row['districtId'];
        }else{
            $userDistrictId = '';
        }
        
        $userSchool = $_POST['userSchool'];
        $sql = "SELECT schoolId FROM schools WHERE schoolName = '$userSchool';";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $userSchoolId = $row['schoolId'];
        }else{
            $userSchoolId = '';
        }
        
        
?>
<!-- <script src="../PersonalInfo/errorHandlerScripts/editAdminErrorHandler.js"></script> -->
<script src="../PersonalInfo/errorHandlerScripts/editAdminErrorHandlers.js"></script>

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Admin Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?php
                    // echo $userType;
                ?>
                <form id="edit_admin_form">
                <!-- <form id="edit_admin_form"> -->

                    <div class="modal-body">

                        <input type="hidden" name="userId" id="userIdEdit" value="<?php echo $userId;?>">

                        <div class="form-group">
                            <input type="text" name="userName" id="userNameEdit" class="form-control form__input"
                                placeholder=" " value="<?php echo $userName; ?>">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <div class="error"></div>
                            <label class="form__label" for="userNameEdit"> Username </label>
                        </div>

                        <div class="form-group">
                            <input type="text" name="userEmail" id="userEmailEdit" class="form-control form__input"
                                placeholder=" " value="<?php echo $userEmail; ?>">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <div class="error"></div>
                            <label class="form__label" for="userEmailEdit"> Email </label>
                        </div>
                        <div class="district-school-div">
                            <div class="form-group">
                            
                            <select name="userDistrict" id="userDistrictEdit" class="form-control">   
                                    <option value="">Select district</option>
                                    <?php
                                        $sql = "SELECT * FROM districts WHERE status = 1 ORDER BY districtId ASC"; 
                                        $result = mysqli_query($conn, $sql); 
                                        if ($result->num_rows > 0) { 
                                            while ($row = $result->fetch_assoc()) {  
                                                echo '<option value="'.$row['districtId'].'"';
                                                if ($row['districtId'] == $userDistrictId) {
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
                            <label class="select_form_label">District/Office</label>
                            </div>

                            <div class="form-group">    
                            
                            <select name="userSchool" id="userSchoolsEdit" class="form-control" >
                                <option value="">Select school</option>
                                <?php
                                if(isset($userDistrictId)){
                                    $sql = "SELECT * FROM schools WHERE status = 1 AND districtId = '$userDistrictId' ORDER BY schoolId ASC";
        
                                    $result = mysqli_query($conn, $sql); 
                                    if ($result->num_rows > 0) { 
                                        while ($row = $result->fetch_assoc()) {  
                                            echo '<option value="'.$row['schoolId'].'"';
                                            if ($row['schoolId'] == $userSchoolId) {
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
                            <label class="select_form_label"> Schools </label>
                            </div>
                        </div>
                        <div class="form-group"> 
                            
                            <select name="userType" id="userTypeEdit" class="form-control">
                                <?php if($userType == 'admin3'){
                                    ?>
                                    <option value="admin3" <?php if($userType == 'admin3') echo 'selected="selected"'; ?>>admin 3</option>
                                <?php }else { ?>
                                    <option value="">Select type</option>
                                    <option value="admin1" <?php if($userType == 'admin1') echo 'selected="selected"'; ?>>admin 1</option>
                                    <option value="admin2" <?php if($userType == 'admin2') echo 'selected="selected"'; ?>>admin 2</option>
                                    <!-- <option value="admin3" <?php if($userType == 'admin3') echo 'selected="selected"'; ?>>admin 3</option> -->
                                <?php
                                }
                                ?>
                            </select>
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <div class="error"></div>
                            <label for="gender" class="select_form_label">Type</label>
                        </div>
                        <div class="form-group"> 
                            <input type="password" name="userNewPass" id="changePass" class="form-control form__input"
                                placeholder=" " value="">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <div class="error"></div>
                            <label class="form__label" for="changePass"> Change password </label>
                            <i class="fa-regular fa-eye-slash" id="changePassEye"></i>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <!-- <input type="submit" name="updatedata" class="btn btn-primary" value="Update Data"> -->
                        <button type="submit" name="updatedata" id="update-button" class="btn btn-primary">Update Data</button>
                    </div>
                </form>
                

<script>
    
</script>                

<script src="../PersonalInfo/personalScripts.js"></script>
<script src="superAdminScripts.js"></script>
                    
<script>
    updateAdministratorData();
    showPasswordEdit();
    showDistricts();
</script>
