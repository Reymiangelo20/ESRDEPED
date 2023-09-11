
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
    <link rel="stylesheet" href="../PersonalInfo/personalInfoStyle/header.css">
    <link rel="stylesheet" href="../PersonalInfo/personalInfoStyle/table.css">
    <link rel="stylesheet" href="../PersonalInfo/personalInfoStyle/editModal.css">
    
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

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> -->
    <link rel="stylesheet" href="superAdminStyle/superAdmin.css"/>

    <script src="https://kit.fontawesome.com/aa867b86c2.js" crossorigin="anonymous"></script>
    

    <title>Inactive Teachers</title>
</head>
<body>
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                
            </div>
        </div>
    </div>
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
            <div class="dashboard-admin-inactive-div">
                <i class="fas fa-user"></i>
                <a style="text-decoration: underline;" href="activeTeachers.php">Active teachers</a>
            </div>
        </div>
        
        <!-- <div class="dashboard-logout-div">
            <i class="fa-solid fa-right-from-bracket"></i>
            <a href="../PersonalInfo/loginPhp/logout.php">Logout</i></a>
        </div> -->
    </div>
    <div class="dashboard-content-div">
        <div class="main-table-container-div main-container-adjust">
            <div class="table-container-div" id="employee_table_2"></div>
            <div class="table-container-div" id="employee_table">
                <?php
                    $sql = "SELECT * FROM emppersonalinfo WHERE teacher_status = 'Active';";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                ?>
            <div class="num-records-container-div">
                <h2>Total Number of Records: <?php echo $resultCheck;?></h2>
            </div>
                <table>
                    <thead>
                        <tr>
                            <th><a class="column_sort" id="id" data-order="desc">ID</a></th>
                            <th><a class="column_sort" id="email" data-order="desc">DEPED EMAIL</a></th>
                            <th><a class="column_sort" id="district" data-order="desc">DISTRICT</a></th>
                            <th><a class="column_sort" id="school" data-order="desc">SCHOOL</a></th>
                            <th><a class="column_sort" id="lastName" data-order="desc">LAST NAME</a></th>
                            <th><a class="column_sort" id="firstName" data-order="desc">FIRST NAME</a></th>
                            <th><a class="column_sort" id="middleName" data-order="desc">MIDDLE NAME</a></th>
                            <th><a class="column_sort" id="civilStatus" data-order="desc">CIVIL STATUS</a></th>
                            <th><a class="column_sort" id="gender" data-order="desc">GENDER</a></th>
                            <th><a class="column_sort" id="dateOfBirth" data-order="desc" >DATE OF BIRTH</a></th>
                            <th><a class="column_sort" id="place" data-order="desc">PLACE OF BIRTH</a></th>
                            <th><a class="column_sort" id="teacher_status" data-order="desc">STATUS</a></th>
                            <!-- <th>ACTIONS</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if ($resultCheck > 0) {
                                $count = 0;
                                while($row = mysqli_fetch_assoc($result)){
                                    echo '<tr>
                                                <td>'.$row["id"].'</td>
                                                <td>'.$row["email"].'</td>
                                                <td>'.$row["district"].'</td>
                                                <td>'.$row["school"].'</td>
                                                <td>'.$row["lastName"].'</td>
                                                <td>'.$row["firstName"].'</td>
                                                <td>'.$row["middleName"].'</td>
                                                <td>'.$row["civilStatus"].'</td>
                                                <td>'.$row["gender"].'</td>
                                                <td>'.$row["dateOfBirth"].'</td>
                                                <td>'.$row["place"].'</td>
                                                <td>'.$row["teacher_status"].'</td>
                                                
                                        </tr>';
                                        // <td>
                                        //             <div class="button-table">
                                        //                 <button class="edit-button" type="button" data-id='.$row['id'].'"><i class="fa-solid fa-pen-to-square"></i></button>
                                        //                 <a class="delete-button" href="deleteInactive.php?deleteId='.$row['id'].'"><i class="fa-solid fa-trash-can"></i></a>
                                        //             </div>
                                        //         </td>
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit modal -->
    

</body>
</html>


<?php if(isset($_GET['m'])) :?>
    <div class="flash-data" data-flashdata="<?= $_GET['m'];?>"></div>
<?php endif; ?>

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
        $("#table-search").keyup(function(){
            var input = $(this).val();
            if(input != ""){
                $.ajax({
                    url:"searchActive.php",
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
                url:"sortActive.php",  
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