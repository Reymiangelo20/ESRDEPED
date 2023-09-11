<?php
    include '../PersonalInfo/generalPhp/dbhConnection.php';
    session_start();

    if(isset($_POST['input'])){
        $input = $_POST['input'];
        $sql = "SELECT * FROM users WHERE username LIKE '{$input}%' 
        OR user_email LIKE '{$input}%' OR user_district LIKE '{$input}%' OR 
        user_school LIKE '{$input}%' OR type LIKE '{$input}%' OR id LIKE '{$input}%'";
        $result = mysqli_query($conn, $sql);
        $checkResult = mysqli_num_rows($result);

        if($checkResult > 0){?>
        <div class="num-records-container-div">
            <h2>Total Number of Admins: <?php echo $checkResult;?></h2>
        </div>
            <table>
                <!-- <div class="num-records-container-div">
                    <h2>Number of Records: <?php echo $checkResult; ?></h2>
                </div> -->
                <thead>
                    <tr>
                        <th><a class="column_sort" id="id" data-order="desc">ID</a></th>
                        <th><a class="column_sort" id="username" data-order="desc">USERNAME</a></th>
                        
                        <th><a class="column_sort" id="user_district" data-order="desc">DISTRICT</a></th>
                        <th><a class="column_sort" id="user_school" data-order="desc">SCHOOL</a></th>
                        <th><a class="column_sort" id="user_email" data-order="desc">EMAIL</a></th>
                        <th><a class="column_sort" id="user_school" data-order="desc">ADMIN TYPE</a></th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row = mysqli_fetch_assoc($result)){
                                   $id = $row["id"];
                                   $username = $row["username"];
                                   
                                   $user_distirct = $row["user_district"];
                                   $user_school = $row["user_school"];
                                   $user_email = $row["user_email"];
                                   $user_type = $row["type"];
                                    ?>
                            <tr>
                                    <td><?php echo $row["id"];?></td>
                                    <td><?php echo $row["username"];?></td>
                                    
                                    <td><?php echo $row["user_district"];?></td>
                                    <td><?php echo $row["user_school"];?></td>
                                    <td><?php echo $row["user_email"];?></td>
                                    <td><?php echo $row["type"];?></td>
                                    <td>
                                        <div class="button-table">
                                            <!-- <button data-toggle="modal" data-target="#editmodal" class="edit-button" type="button" data-id='.$row['id'].'"><i class="fa-solid fa-pen-to-square"></i></button> -->
                                            <button data-toggle="modal" data-target="#editmodal" class="edit-button" type="button" data-id="<?php echo $row['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <button class="delete-button" type="button" data-id="<?php echo $row['id']; ?>"><i class="fa-solid fa-trash-can"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                        }
                    ?>
                </tbody>
            </table>

            <?php
        }else{ ?>
            <div class="num-records-container-div">
                <h2>Total Number of Records: 0</h2>
            </div>
            <table>
                <thead>
                    <tr>
                        <th><a class="column_sort" id="id" data-order="desc">ID</a></th>
                        <th><a class="column_sort" id="username" data-order="desc">USERNAME</a></th>
                        <th><a class="column_sort" id="user_district" data-order="desc">DISTRICT</a></th>
                        <th><a class="column_sort" id="user_school" data-order="desc">SCHOOL</a></th>
                        <th><a class="column_sort" id="user_email" data-order="desc">EMAIL</a></th>
                        <th><a class="column_sort" id="user_school" data-order="desc">ADMIN TYPE</a></th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="no-record-td" colspan="12">
                            <p>
                                No records found!
                            </p>
                            <img class="no-record-bg" src="../PersonalInfo/images/8687130_ic_fluent_document_question_mark_icon.svg">
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php
        }
    }
?>

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