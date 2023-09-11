
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

    <!-- bootstrap start -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <!-- bootstrap end -->

    <!-- <link rel="stylesheet" href="../personalInfoStyle/inputs.css"> -->
    <link rel="stylesheet" href="../PersonalInfo/personalInfoStyle/general.css">
    <link rel="stylesheet" href="../PersonalInfo/personalInfoStyle/header.css">
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

    <title>Admin Accounts</title>


    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> -->
    
    <link rel="stylesheet" href="superAdminStyle/superAdmin.css"/>

    <script src="https://kit.fontawesome.com/aa867b86c2.js" crossorigin="anonymous"></script>
</head>
<body>
  <!-- <div class="loader" id="loader"></div>
  </div> -->
    <div class="dashboard-header-div">
        <div class="dashbaord-title-div">
            <p>Admin Dashboard</p>
        </div>
        <div class="search-logout">
            <div class="table-search-div">
                <input type="text" name="table-search" id="table-search" placeholder="Search record...">
                <button disabled><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
            </div>
            <div class="dashboard-logout-div">
                <i class="fa-solid fa-right-from-bracket"></i>
                <a href="../PersonalInfo/loginPhp/logout.php">Logout</i></a>
            </div>
        </div>
    </div>
    <div class="dashboard-sidebar-div">
        <div class="dashboard-sidebar-options">
            <div class="dashboard-homepage-div">
                <i class="fas fa-tachometer-alt"></i>
                <a href="superAdmin.php">Dashboard</a>
            </div>
            <!-- <div class="dashboard-admin-regitration-div">
                <i class="fas fa-user-plus"></i>
                <a href="superAdminReg.php">Register admin</a>
            </div> -->
            <div class="dashboard-admin-list-div">
                <i class="fas fa-users"></i>
                <a style="text-decoration: underline;" href="superAdminList.php">Admin accounts</a>
            </div>
            <div class="dashboard-admin-log-div">
                <i class="fas fa-history"></i>
                <a href="superAdminLogs.php">Logs</a>
            </div>
            <div class="dashboard-admin-inactive-div">
                <i class="fas fa-user-alt-slash"></i>
                <a href="inactiveTeachers.php">Inactive teachers</a>
            </div>
            <div class="dashboard-admin-inactive-div">
                <i class="fas fa-user"></i>
                <a href="activeTeachers.php">Active teachers</a>
            </div>
        </div>
        
        
    </div>
    <div class="dashboard-content-div">
        <div class="submit-div">
            <button data-toggle="modal" data-target="#addModal" class="tempAdd">Add new <i class="fas fa-user-plus"></i> </button>
            <!-- <button data-toggle="modal" data-target="#editmodal" class="edit-button">Edit <i class="fas fa-user-plus"></i> </button> -->
        </div>
        <div class="main-table-container-div">
            <div class="table-container-div" id="employee_table_2"></div>
            <div class="table-container-div" id="employee_table">
            <div class="num-records-container-div">
                <?php
                    $sql = "SELECT * FROM users ORDER BY id DESC";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                ?>
                <h2>Total Number of Admins: <?php echo $resultCheck;?></h2>
            </div>
                <table>
                    <thead>
                        <tr>
                            <th><a class="column_sort" id="id" data-order="desc">ID</a></th>
                            <th><a class="column_sort" id="username" data-order="desc">USERNAME</a></th>
                            
                            <th><a class="column_sort" id="user_district" data-order="desc">DISTRICT</a></th>
                            <th><a class="column_sort" id="user_school" data-order="desc">SCHOOL</a></th>
                            <th><a class="column_sort" id="user_email" data-order="desc">EMAIL</a></th>
                            <th><a class="column_sort" id="type" data-order="desc">ADMIN TYPE</a></th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if ($resultCheck > 0) {
                                while($row = mysqli_fetch_assoc($result)){
                                    echo '<tr>
                                                <td>'.$row["id"].'</td>
                                                <td>'.$row["username"].'</td>
                                                
                                                <td>'.$row["user_district"].'</td>
                                                <td>'.$row["user_school"].'</td>
                                                <td>'.$row["user_email"].'</td>
                                                <td>'.$row["type"].'</td>
                                                <td>
                                                    <div class="button-table">
                                                        <button data-toggle="modal" data-target="#editmodal" class="edit-button" type="button" data-id='.$row['id'].'"><i class="fa-solid fa-pen-to-square"></i></button>
                                                        <button class="delete-button"" type="button" data-id='.$row['id'].'"><i class="fa-solid fa-trash-can"></i></button>
                                                    </div>
                                                </td>
                                        </tr>';
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- <a class="delete-button" href="deleteAdmin.php?deleteId='.$row['id'].'"><i class="fa-solid fa-trash-can"></i></a> -->
    <!-- <button data-toggle="modal" data-target="#editmodal" class="edit-button" type="button" data-id='.$row['id'].'"><i class="fa-solid fa-pen-to-square"></i></button> -->
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
                    <form action="addAdmin.php" method="post" id="add_admin_form">
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
                                        <input type="text" name="userName" id="userName" class="form-control form__input" placeholder=" "  autocomplete=off value="<?php if(isset($_GET['userName'])) echo $_GET['userName']; ?>">
                                        <i class="fas fa-check-circle"></i>
                                        <i class="fas fa-exclamation-circle"></i>
                                        <div class="error"></div>
                                        <label class="form__label">Username</label>
                                    </div>
                                    <div class="form-group" id="form-group">
                                        <!-- <label>Email</label> -->
                                        <input type="text" name="userEmail" id="userEmail" class="form-control form__input" placeholder=" "  autocomplete=off value="<?php if(isset($_GET['userEmail'])) echo $_GET['userEmail']; ?>">
                                        <i class="fas fa-check-circle"></i>
                                        <i class="fas fa-exclamation-circle"></i>
                                        <div class="error"></div>
                                        <label class="form__label">Email</label>
                                    </div>
                                </div>
                                <div class="third-layer" id="form-group">
                                    <div class="form-group">
                                        <!-- <label>Password</label> -->
                                        <input type="password" name="userPass" id="userPass" class="form-control form__input" placeholder=" "  autocomplete=off value="<?php if(isset($_GET['userPass'])) echo $_GET['userPass']; ?>">
                                        <i class="fas fa-check-circle"></i>
                                        <i class="fas fa-exclamation-circle"></i>
                                        <div class="error"></div>
                                        <label class="form__label">Password</label>
                                    </div>
                                    <div class="form-group" id="form-group1">
                                        <!-- <label>Confirm Password</label> -->
                                        <input type="password"  name="userConPass" id="userConPass" class="form-control form__input" placeholder=" "  autocomplete=off value="<?php if(isset($_GET['userConPass'])) echo $_GET['userConPass']; ?>">
                                        <i class="fas fa-check-circle"></i>
                                        <i class="fas fa-exclamation-circle"></i>
                                        <div class="error"></div>
                                        <label class="form__label">Confirm Password</label>
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

        <!-- edit modal -->
        <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content this"> 
                </div>
            </div>
        </div>
</body>
</html>

<!-- <a class="delete-button" href="deletePersonalInfo.php?deleteId='.$row['id'].'"><i class="fa-solid fa-trash-can"></i></a> -->
<!--  <button class="delete-button" type="button" id='.$row['id'].'"><i class="fa-solid fa-trash-can"></i></button> -->
<!-- <script src="../PersonalInfo/generalScripts/editAdminErrorHandler.js"></script> -->

<script src="../PersonalInfo/errorHandlerScripts/addAdminErrorHandler.js"></script>


<script>
    $(document).ready(function () {
    // Ensure that the editmodal element exists on the page
        if ($('#editmodal').length > 0) {
            $('#editmodal').on('shown.bs.modal', function () {
                handleEditErrors(); // Call the function every time the modal is shown
            });
        }
    });
</script>

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
                        timer: 800
                    });
                    history.replaceState(null, null, window.location.pathname);
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

<script>
    $(document).ready(function(){
        $('.tempAdd').on('click', function(){
            var selectedDistrict = document.getElementById("district");
            var districtToHide = selectedDistrict.querySelector("option[value='11']");

            var selectedSchool = document.getElementById("schools");
            var schoolToHide = selectedSchool.querySelector("option[value='57']");
            districtToHide.style.display = "none";
            schoolToHide.style.display = "none";
        })

        $('#SDO').on('change', function(){
            var sdoId = document.getElementById('SDO')
            var districtId = document.getElementById('district')
            var schoolId = document.getElementById('schools')

            var selectedDistrict = document.getElementById("district");
            var districtToHide = selectedDistrict.querySelector("option[value='11']");

            var selectedSchool = document.getElementById("schools");
            var schoolToHide = selectedSchool.querySelector("option[value='57']");
            
            if(sdoId.checked){
                if(sdoId.value == 'School Division Office'){
                    $.ajax({
                        type:'POST',
                        url:'../PersonalInfo/personalInfoPhp/allSchools.php',
                        data:'sdoId='+sdoId,
                        success:function(html){
                            $('#schools').html(html);
                            schoolId.value = '57';
                            districtId.value = '11';
                            districtId.disabled = true;
                            schoolId.disabled = true;
                            districtToHide.style.display = "";
                            schoolToHide.style.display = "";
                        }
                    }); 
                }
            }else{
                districtId.disabled = false;
                schoolId.disabled = false;
                districtToHide.style.display = "none";
                schoolToHide.style.display = "none";
                schoolId.value = '';
                districtId.value = '';
                
            }
        });
    });
</script>

<!-- <script>
    $(document).ready(function(){
        $('#occupation_2').on('change', function(){
            console.log('change!');
            var occupationId = document.getElementById('occupation_2');
            var districtId = document.getElementById('district');
            var occupation = occupationId.value;
            if(occupation){
                console.log('true!');
                if(occupation == 'School Division Office'){
                    console.log('occupation');
                    districtId.disabled = true;
                    districtId.value = '';
                    $.ajax({
                        type:'POST',
                        url:'../PersonalInfo/personalInfoPhp/allSchools.php',
                        data:'occupationId='+occupationId,
                        success:function(html){
                            $('#schools').html(html);
                        }
                    }); 
                }else if(occupation == 'School Staff'){
                    districtId.disabled = false;
                }
            }
            
        });
    });
</script> -->

<!-- $(document).ready(function(){  
        $(document).on('click', '.delete-button', function(){  
            var deleteId = $(this).attr('id'); 

            console.log(deleteId)
                $.ajax({  
                url:"deleteAdmin.php",  
                method:"POST", 
                data:{deleteId:deleteId},
                success: function(response) {
						console.log('success!')
					}
                }) 
              
        });  
    });   -->

<script>
$(document).ready(function(){
        $('.edit-button').on('click', function() {
            var row = $(this).closest('tr');
            var userName = row.find('td:eq(1)').text();
            var userDistrict = row.find('td:eq(2)').text();
            var userSchool = row.find('td:eq(3)').text();
            var userEmail = row.find('td:eq(4)').text();
            var userType = row.find('td:eq(5)').text();
            var userId = $(this).data('id');
            
            $.ajax({  
                    url:"editModal.php",  
                    method:"POST", 
                    data:{
                        userId:userId,
                        userName:userName,
                        userEmail:userEmail,
                        userDistrict:userDistrict,
                        userSchool:userSchool,
                        userType:userType},
                    success: function(data) {
                            console.log('success!')
                            $('.this').html(data);
                            // $('#editmodal').modal('show');
                        }
                    }) 
        });
    });
</script>



    <!-- // $('#update-data').click(function(){
    //     var id = row.find('td:eq(0)').text();
    //     var userName = $('#userName').val();
    //     var userEmail = $('#userEmail').val();
    //     var userDistrict = $('#userDistrict').val();
    //     var userSchools = $('#userSchools').val();


    //     console.log(id);
    //     console.log(userName);

    //     $.ajax({  
    //             url:"update.php",  
    //             method:"POST", 
    //             data:{
    //                 id:id,
    //                 userName:userName,
    //                 userEmail:userEmail,
    //                 userDistrict:userDistrict,
    //                 userSchools:userSchools},
    //             success: function(data) {
	// 					console.log(id);
    //                     console.log(userName);
	// 				}
    //             }) 
    // }) -->
<script>
        $(document).ready(function(){
            $(document).on('click', '.delete-button', function(){
                var id = $(this).data('id');
                    Swal.fire({
                        title : 'Are You Sure?',
                        text : 'Record will be deleted?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d5',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'Delete Record',
                }).then((result) => {
                    if(result.isConfirmed){
                            $.ajax({
                            url:"deleteAdmin.php",
                            method:"POST",
                            data:{id:id},
                            success: function(response){
                                Swal.fire({
                                    position: 'top',
                                    icon: 'success',
                                    title: 'Record has been deleted',
                                    showConfirmButton: false,
                                    timer: 800
                                }).then(() =>{
                                        location.reload()})
                            }
                        })
                    }else{
                        
                    }
                })
            });
        });
</script>

<script>
    $(document).ready(function(){
        $("#table-search").keyup(function(){
            var input = $(this).val();
            if(input != ""){
                $.ajax({
                    url:"searchAdmin.php",
                    method:"POST",
                    data:{input:input},

                    success:function(data){
                        $("#employee_table_2").html(data);
                        $("#employee_table_2").css("display", "block");
                        $("#employee_table").css("display", "none");
                    }
                });
            }else{
                $("#employee_table_2").css("display", "none");
                $("#employee_table").css("display", "block");

            }
        });
    });
</script>

<script>  
 $(document).ready(function(){  
      $(document).on('click', '.column_sort', function(){  
           var column_name = $(this).attr("id");  
           var order = $(this).data("order");  
           var arrow = '';  
           $.ajax({  
                url:"sortAdmin.php",  
                method:"POST",  
                data:{column_name:column_name, order:order},  
                success:function(data)  
                {  
                    $('#employee_table').html(data);
                    $('.arrow').html('');
                    var arrow = '';
                    if(order == 'desc')  
                    {  
                        arrow = '&nbsp;<i class="fa-solid fa-arrow-down"></i>';  
                    }  
                    else  
                    {  
                        arrow = '&nbsp;<i class="fa-solid fa-arrow-up"></i>';  
                    } 
                    $('#'+column_name+' .arrow').html(arrow); 
                }  
           })  
      });  
 });  
 </script>

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<!-- <script>  
    $(document).ready(function(){  
        $(document).on('click', '.delete-button', function(){  
            var deleteId = $(this).attr('id'); 

            console.log(deleteId)
                $.ajax({  
                url:"deleteAdmin.php",  
                method:"POST", 
                data:{deleteId:deleteId},
                success: function(response) {
						console.log('success!')
					}
                }) 
              
        });  
    });  
 </script> -->


    <!-- 
        $(document).ready(function() {
			$('.delete-btn').on('click', function() {
				var id = $(this).data('id');
				swal({
						title: "WARNING!!",
						text: "Are you sure? Once deleted, you will not be able to recover this data",
						icon: "warning",
						buttons: true,
						dangerMode: true,

					})
					.then((willDelete) => {
						if (willDelete) {
							$.ajax({
								type: 'POST',
								url: 'DeleteData.php',
								data: {
									id: id
								},
								success: function(response) {
									console.log(response)
									swal("Data has been deleted!", {
										icon: "success",
									}).then(() => {
										location.reload();
									});
								}
							});
						} else {

						}
					});
			});
		});
     -->