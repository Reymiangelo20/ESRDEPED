<?php  
 include '../PersonalInfo/generalPhp/dbhConnection.php';
 $output = '';  
 $order = $_POST["order"];  
 if($order == 'desc')  
 {  
      $order = 'asc';  
 }  
 else  
 {  
      $order = 'desc';  
 }  
 $query = "SELECT * FROM users ORDER BY ".$_POST["column_name"]." ".$_POST["order"]."";  
 $result = mysqli_query($conn, $query);  

 $sql = "SELECT * FROM users";
 $sortResult = mysqli_query($conn, $sql);
 $resultCheck = mysqli_num_rows($sortResult);
 $output .= '
 <div class="num-records-container-div">
            <h2>Total Number of Admins: '.$resultCheck.' </h2>
        </div>  
 <table>
     <thead>  
          <tr>
                <th><a class="column_sort" id="id" data-order="'.$order.'">ID<span class="arrow"></span></a></th>
                <th><a class="column_sort" id="username" data-order="'.$order.'">USERNAME<span class="arrow"></span></a></th>
                
                <th><a class="column_sort" id="user_district" data-order="'.$order.'">DISTRICT<span class="arrow"></span></a></th>
                <th><a class="column_sort" id="user_school" data-order="'.$order.'">SCHOOL<span class="arrow"></span></a></th>
                <th><a class="column_sort" id="user_email" data-order="'.$order.'">EMAIL<span class="arrow"></span></a></th>
                <th><a class="column_sort" id="type" data-order="'.$order.'">ADMIN TYPE<span class="arrow"></span></a></th>
                <th>ACTIONS</th>
          </tr>
     </thead>
 ';  
 while($row = mysqli_fetch_array($result))  
 {  
      $output .= '
        <tr>
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
        </tr> 
      ';  
 }  
 $output .= "</table>";  
 echo $output;
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