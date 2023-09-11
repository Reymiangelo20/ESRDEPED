<?php
    include '../PersonalInfo/generalPhp/dbhConnection.php';
    session_start();

    if(isset($_POST['input'])){
        $input = $_POST['input'];
        //  $sql = "SELECT * FROM emppersonalinfo WHERE teacher_status = 'Active'";
        $sql = "SELECT * FROM logs WHERE logId LIKE '{$input}%' OR admin_name LIKE '{$input}%' OR email LIKE '{$input}%' OR 
        action LIKE '{$input}%' OR date LIKE '{$input}%' OR time LIKE '{$input}%';";
        $result = mysqli_query($conn, $sql);
        $checkResult = mysqli_num_rows($result);

        if($checkResult > 0){?>
        <div class="num-records-container-div">
            <h2>Total Number of Records: <?php echo $checkResult;?></h2>
        </div>
            <table>
                <!-- <div class="num-records-container-div">
                    <h2>Number of Records: <?php echo $checkResult; ?></h2>
                </div> -->
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
                        $count = 0;
                        while($row = mysqli_fetch_assoc($result)){
                                   $count += 1;
                                    ?>
                                <tr>
                                    <td><?php echo $row["logId"];?></td>
                                    <td><?php echo $row["admin_name"];?></td>
                                    <td><?php echo $row["email"];?></td>
                                    <td><?php echo $row["action"];?></td>
                                    <td><?php echo $row["date"];?></td>
                                    <td><?php echo $row["time"];?></td>
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
                    <th><a class="column_sort" id="logId" data-order="desc">ID</a></th>
                    <th><a class="column_sort" id="admin_name" data-order="desc">ADMIN USERNAME</a></th>
                    <th><a class="column_sort" id="email" data-order="desc">USER EMAIL</a></th>
                    <th><a class="column_sort" id="action" data-order="desc">ACTION</a></th>
                    <th><a class="column_sort" id="date" data-order="desc">DATE</a></th>
                    <th><a class="column_sort" id="time" data-order="desc">TIME</a></th>
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