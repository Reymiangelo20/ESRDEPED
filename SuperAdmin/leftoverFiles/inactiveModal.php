<?php
    include '../PersonalInfo/generalPhp/dbhConnection.php';
    
        $id = $_POST['id'];
        $email = $_POST['email'];
        $lastName = $_POST['lastName'];
        $firstName = $_POST['firstName'];
        $middleName = $_POST['middleName'];
        $civilStatus = $_POST['civilStatus'];
        $gender = $_POST['gender'];
        $dateOfBirth = $_POST['dateOfBirth'];
        $place = $_POST['place'];
        $teacher_status = $_POST['teacher_status'];

        $district = $_POST['district'];
        $sql = "SELECT districtId FROM districts WHERE districtName = '$district';";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $userDistrictId = $row['districtId'];
        }else{
            $userDistrictId = '';
        }
        
        $school = $_POST['school'];
        $sql = "SELECT schoolId FROM schools WHERE schoolName = '$school';";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $userSchoolId = $row['schoolId'];
        }else{
            $userSchoolId = '';
        }
    
?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Teachers Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="UpdateInactive.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
                        <div class="firstSection">
                            <div class="form-group">
                                <label> First Name </label>
                                <input type="text" name="firstName" id="firstName" class="form-control"
                                    placeholder="First Name" value="<?php echo $firstName;?>" required>
                            </div>

                            <div class="form-group">
                                <label> Last Name </label>
                                <input type="text" name="lastName" id="lastName" class="form-control"
                                    placeholder="Last Name" value="<?php echo $lastName;?>" required>
                            </div>

                            <div class="form-group">
                                <label> Middle Name </label>
                                <input type="text" name="middleName" id="middleName" class="form-control"
                                    placeholder="Middle Name" value="<?php echo $middleName;?>" required>
                            </div>
                        </div>

                        <div class="secondSection">
                            <div class="form-group">
                                <label> Date of Birth </label>
                                <input type="date" name="birthDay" id="birthDay" class="form-control"
                                    placeholder="Data of Birth" value="<?php echo $dateOfBirth;?>" required>
                            </div>

                            <div class="form-group">
                                <label> Place of Birth </label>
                                <input type="text" name="placeOfBirth" id="placeOfBirth"  class="form-control"  
                                    placeholder="Place of Birth" value="<?php echo $place;?>" required>
                            </div>

                            <div class="form-group">
                                <label> Email </label>
                                <input type="text" name="email" id="email" class="form-control" 
                                    placeholder="Email" value="<?php echo $email;?>" required>
                            </div>
                        </div>

                        <div class="thirdSection">
                            <div class="form-group">
                            <?php
                                $sql = "SELECT * FROM districts WHERE status = 1 ORDER BY districtId ASC"; 
                                $result = mysqli_query($conn, $sql); 
                            ?>

                            <!-- new -->
                            <label>District</label>
                            <select name="district" id="district" class="form-control" required>
                                    <option value="">Select district</option>
                                    <?php
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
                            
                            </div>
                            <div class="form-group">    
                            <label> School </label>
                            <!-- new -->
                            <select name="schools" id="schools" class="form-control" required>
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
                            </div>
                        </div>
                        <div class="fourthSection">
                            <div class="form-group"> 
                                <label for="gender">Civil Status</label>
                                <select name="civilStatus" id="civilStatus" class="form-control" required>
                                    <option value="">Select civil status</option>
                                    <option value="Single" <?php if($civilStatus == 'Single') echo 'selected="selected"'; ?>>Single</option>
                                    <option value="Married" <?php if($civilStatus == 'Married') echo 'selected="selected"'; ?>>Married</option>
                                    <option value="Separated" <?php if($civilStatus == 'Separated') echo 'selected="selected"'; ?>>Separated</option>
                                    <option value="Widowed" <?php if($civilStatus == 'Widowed') echo 'selected="selected"'; ?>>Widowed</option>
                                </select>
                            </div>

                            <div class="form-group"> 
                                <label for="gender">Sex</label>
                                <select name="gender" id="gender" class="form-control" required>
                                    <option value="">Select Sex</option>
                                    <option value="Male" <?php if($gender == 'Male') echo 'selected="selected"'; ?>>Male</option>
                                    <option value="Female" <?php if($gender == 'Female') echo 'selected="selected"'; ?>>Female</option>
                                </select>
                            </div>

                            <div class="form-group"> 
                                <label for="gender">Status</label>
                                <select name="teacher_status" id="teacher_status" class="form-control" required>
                                    <option value="">Select Status</option>
                                    <!-- <option value="Active" <?php if($teacher_status == 'Active') echo 'selected="selected"'; ?>>Active</option> -->
                                    <option value="Retired" <?php if($teacher_status == 'Retired') echo 'selected="selected"'; ?>>Retired</option>
                                    <option value="Deceased" <?php if($teacher_status == 'Deceased') echo 'selected="selected"'; ?>>Deceased</option>
                                </select>
                            </div>
                        </div>

                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                    </div>
                </form>

<script>
    $(document).ready(function(){
        $('#district').on('change', function(){
            var districtID = $(this).val();
            if(districtID){
                $.ajax({
                    type:'POST',
                    url:'../PersonalInfo/PersonalInfoPhp/empSchools.php',
                    data:'districtId='+districtID,
                    success:function(html){
                        $('#schools').html(html);
                        console.log(districtID);
                        console.log(html);
                    }
                }); 
            }else{
                $('#schools').html('<option value="">Select district first</option>');
            }
        });
    });
</script>