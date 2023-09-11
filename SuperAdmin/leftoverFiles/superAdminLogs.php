
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
    

    <title>Logs</title>
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
                <a style="text-decoration: underline;" href="superAdminLogs.php">Logs</a>
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
                    $sql = "SELECT * FROM logs ORDER BY logId DESC";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                ?>
            <div class="num-records-container-div">
                <h2>Total Number of Records: <?php echo $resultCheck;?></h2>
            </div>
                <table>
                    <thead>
                        <tr>
                            <th><a class="column_sort" id="logId" data-order="desc">ID</a></th>
                            <th><a class="column_sort" id="admin_name" data-order="desc">ADMIN USERNAME</a></th>
                            <th><a class="column_sort" id="email" data-order="desc">USER EMAIL</a></th>
                            <th><a class="column_sort" id="action" data-order="desc">ACTION</a></th>
                            <th><a class="column_sort" id="date" data-order="desc">DATE</a></th>
                            <th><a class="column_sort" id="time" data-order="desc">TIME</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if ($resultCheck > 0) {
                                $count = 0;
                                while($row = mysqli_fetch_assoc($result)){
                                    echo '<tr>
                                                <td>'.$row["logId"].'</td>
                                                <td>'.$row["admin_name"].'</td>
                                                <td>'.$row["email"].'</td>
                                                <td>'.$row["action"].'</td>
                                                <td>'.$row["date"].'</td>
                                                <td>'.$row["time"].'</td>
                                        </tr>';
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
        $(document).on('click', '.edit-button', function() {

        var row = $(this).closest('tr');
        
        var id = row.find('td:eq(0)').text();
        var email = row.find('td:eq(1)').text();
        var district = row.find('td:eq(2)').text();
        var school = row.find('td:eq(3)').text();
        var lastName = row.find('td:eq(4)').text();
        var firstName = row.find('td:eq(5)').text();
        var middleName = row.find('td:eq(6)').text();
        var civilStatus = row.find('td:eq(7)').text();
        var gender = row.find('td:eq(8)').text();
        var dateOfBirth = row.find('td:eq(9)').text();
        var place = row.find('td:eq(10)').text();
        var teacher_status = row.find('td:eq(11)').text();
        var id = $(this).data('id');

        $.ajax({  
                url:"inactiveModal.php",  
                method:"POST", 
                data:{
                    id:id,
                    email:email,
                    district:district,
                    school:school,
                    lastName:lastName,
                    firstName:firstName,
                    middleName:middleName,
                    civilStatus:civilStatus,
                    gender:gender,
                    dateOfBirth:dateOfBirth,
                    place:place,
                    teacher_status:teacher_status},
                success: function(data) {
						console.log('success!')
                        // console.log(teacher_status)
                        $('.modal-content').html(data);
					}
                }) 
        $('#editmodal').modal('show');
    });
});
 </script>

<script>
    $(document).on('click', '.delete-button', function(e){
            e.preventDefault();
            const href = $(this).attr('href')

            Swal.fire({
                title: 'Are You Sure?',
                text: 'Record will be deleted?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d5',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Delete Record',
            }).then((result) => {
                if(result.value){
                    document.location.href = href;
                }
            })
            })

        const flashdata = $('.flash-data').data('flashdata')
        if(flashdata){
            Swal.fire({
                icon: "success",
                title: "Success!",
                text: "Record has been Deleted"
            }).then(() => {
                $('.flash-data').remove();
                history.replaceState(null, null, window.location.pathname);
            });
        }
</script>

<script>
    $(document).ready(function(){
        $("#table-search").keyup(function(){
            var input = $(this).val();
            if(input != ""){
                $.ajax({
                    url:"searchLogs.php",
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
                url:"sortLogs.php",  
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