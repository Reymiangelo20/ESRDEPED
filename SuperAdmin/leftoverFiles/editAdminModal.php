
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <?php
                    include '../PersonalInfo/generalPhp/dbhConnection.php';
                    
                    if(isset($_POST['userDistrict'])) {
                        $userDistrict = $_POST['userDistrict'];
                        echo "Received userDistrict data: " . $userDistrict;
                    }else{
                        echo 'did not recieved!';
                    }
                            ?>
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Student Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="updatecode.php" method="POST">

                    <div class="modal-body">

                        <!-- <input type="hidden" name="update_id" id="update_id"> -->

                        <div class="form-group">
                            <label> Username </label>
                            <input type="text" name="userName" id="userName" class="form-control"
                                placeholder="Username">
                        </div>

                        <div class="form-group">
                            <label> Email </label>
                            <input type="text" name="userEmail" id="userEmail" class="form-control"
                                placeholder="Email">
                        </div>

                        <div class="form-group">
                        <?php
                            $sql = "SELECT * FROM districts WHERE status = 1 ORDER BY districtId ASC"; 
                            $result = mysqli_query($conn, $sql); 
                        ?>
                        <label> District </label>
                                <select name="userDistrict" id="userDistrict" class="form-control" required>
                                    <option value="">Select district</option>
                                    <?php 
                                        if($result->num_rows > 0){ 
                                            while($row = $result->fetch_assoc()){  
                                                echo '<option value="'.$row['districtName'].'">'.$row['districtName'].'</option>';
                                            } 
                                        }else{ 
                                            echo '<option value="">District not available</option>'; 
                                        }
                                    ?>
                                </select>
                        </div>
                    
                        <?php
                            $sql = "SELECT * FROM schools WHERE status = 1 ORDER BY schoolName ASC"; 
                            $result = mysqli_query($conn, $sql); 
                        ?>

                        <div class="form-group">
                            
                        <label> Schools </label>
                            <select name="userSchool" id="userSchool" class="form-control" required>
                            <option value="">Select School</option>
                                <?php 
                                    if($result->num_rows > 0){ 
                                        while($row = $result->fetch_assoc()){  
                                            echo '<option value="'.$row['schoolName'].'">'.$row['schoolName'].'</option>'; 
                                        } 
                                    }else{ 
                                        echo '<option value="">School not available</option>'; 
                                    } 
                                ?>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>