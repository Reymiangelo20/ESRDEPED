<?php
    include '../PersonalInfo/generalPhp/dbhConnection.php';
    session_start();

    if(isset($_POST['input'])){
        $input = $_POST['input'];
        //  $sql = "SELECT * FROM emppersonalinfo WHERE teacher_status = 'Active'";
        $sql = "SELECT * FROM emppersonalinfo WHERE (firstName LIKE '{$input}%' 
        OR lastName LIKE '{$input}%' OR middleName LIKE '{$input}%' OR 
        email LIKE '{$input}%' OR dateOfBirth LIKE '{$input}%' OR place LIKE '{$input}%' OR district LIKE '{$input}%' 
        OR school LIKE '{$input}%' OR gender LIKE '{$input}%' OR civilStatus LIKE '{$input}%' OR teacher_status LIKE '{$input}%' OR id LIKE '{$input}%') AND teacher_status != 'Active'";
        $result = mysqli_query($conn, $sql);
        $checkResult = mysqli_num_rows($result);

        if($checkResult > 0){?>
        <div class="num-records-container-div">
            <h2>Total Number of Records: <?php echo $checkResult;?></h2>
        </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>DEPED EMAIL</th>
                        <th>DISTRICT</th>
                        <th>SCHOOL</th>
                        <th>LAST NAME</th>
                        <th>FIRST NAME</th>
                        <th>MIDDLE NAME</th>
                        <th>CIVIL STATUS</th>
                        <th>GENDER</th>
                        <th>DATE OF BIRTH</th>
                        <th>PLACE OF BIRTH</th>
                        <th>STATUS</th>
                        <th>ACTIONS</th>
                        <!-- <th><a class="column_sort" id="id" data-order="desc">ID</a></th>
                        <th><a class="column_sort" id="email" data-order="desc">DEPED EMAIL</a></th>
                        <th><a class="column_sort" id="district" data-order="desc">DISTRICT</a></th>
                        <th><a class="column_sort" id="school" data-order="desc">SCHOOL</a></th>
                        <th><a class="column_sort" id="lastName" data-order="desc">LAST NAME</a></th>
                        <th><a class="column_sort" id="firstName" data-order="desc">FIRST NAME</a></th>
                        <th><a class="column_sort" id="middleName" data-order="desc">MIDDLE NAME</a></th>
                        <th><a class="column_sort" id="civiStatus" data-order="desc">CIVIL STATUS</a></th>
                        <th><a class="column_sort" id="gender" data-order="desc">GENDER</a></th>
                        <th><a class="column_sort" id="dateOfBirth" data-order="desc" >DATE OF BIRTH</a></th>
                        <th><a class="column_sort" id="place" data-order="desc">PLACE OF BIRTH</a></th>
                        <th>ACTIONS</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $count = 0;
                        while($row = mysqli_fetch_assoc($result)){
                                   $count += 1;
                                    ?>
                            <tr>
                                    <td><?php echo $row["id"];?></td>
                                    <td><?php echo $row["email"];?></td>
                                    <td><?php echo $row["district"];?></td>
                                    <td><?php echo $row["school"];?></td>
                                    <td><?php echo $row["lastName"];?></td>
                                    <td><?php echo $row["firstName"];?></td>
                                    <td><?php echo $row["middleName"];?></td>
                                    <td><?php echo $row["civilStatus"];?></td>
                                    <td><?php echo $row["gender"];?></td>
                                    <td><?php echo $row["dateOfBirth"];?></td>
                                    <td><?php echo $row["place"];?></td>
                                    <td><?php echo $row["teacher_status"];?></td>
                                    <td>
                                        <div class="button-table">
                                            <button class="edit-button" type="button" data-id="<?php echo $row['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <a class="delete-button" href='deleteInactive.php?deleteId=<?php echo $id;?>'><i class="fa-solid fa-trash-can"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                        }
                    ?>
                </tbody>
            </table>

            <?php
        }else{?>
        <div class="num-records-container-div">
            <h2>Total Number of Records: 0</h2>
        </div>
        <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>DEPED EMAIL</th>
                        <th>DISTRICT</th>
                        <th>SCHOOL</th>
                        <th>LAST NAME</th>
                        <th>FIRST NAME</th>
                        <th>MIDDLE NAME</th>
                        <th>CIVIL STATUS</th>
                        <th>GENDER</th>
                        <th>DATE OF BIRTH</th>
                        <th>PLACE OF BIRTH</th>
                        <th>STATUS</th>
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
        <!-- <h6 class='no-data-msg'>No Data Found</h6> -->
            <?php
        }
    }
?>

    <script>
        $(document).ready(function() {
        $("#table-search").keypress(function(event) {
            if (event.which == 13) {
            event.preventDefault();

            $('html, body').animate({
                scrollTop: $(".table-container-div").offset().top
            }, 300);
            }
        });
        });

    </script>