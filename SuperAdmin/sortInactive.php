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

 $query = "SELECT * FROM emppersonalinfo WHERE teacher_status != 'Active' ORDER BY ".$_POST["column_name"]." ".$_POST["order"]."";  
 $result = mysqli_query($conn, $query);  
 $resultCheck = mysqli_num_rows($result);
 $count = 0; 

 $output .= '
            <div class="num-records-container-div">
                <h2>Total Number of Records: '.$resultCheck.'</h2>
            </div>  
 <table>
     <thead>  
          <tr>
               <th><a class="column_sort" id="id" data-order="'.$order.'">ID<span class="arrow"></span></a></th>
               <th><a class="column_sort" id="email" data-order="'.$order.'">DEPED EMAIL<span class="arrow"></span></a></th>
               <th><a class="column_sort" id="district" data-order="'.$order.'">DISTRICT<span class="arrow"></span></a></th>
               <th><a class="column_sort" id="school" data-order="'.$order.'">SCHOOL<span class="arrow"></span></a></th>
               <th><a class="column_sort" id="lastName" data-order="'.$order.'">LAST NAME<span class="arrow"></span></a></th>
               <th><a class="column_sort" id="firstName" data-order="'.$order.'">FIRST NAME<span class="arrow"></span></a></th>
               <th><a class="column_sort" id="middleName" data-order="'.$order.'">MIDDLE NAME<span class="arrow"></span></a></th>
               <th><a class="column_sort" id="civilStatus" data-order="'.$order.'">CIVIL STATUS<span class="arrow"></span></a></th>
               <th><a class="column_sort" id="gender" data-order="'.$order.'">GENDER<span class="arrow"></span></a></th>
               <th><a class="column_sort" id="dateOfBirth" data-order="'.$order.'">DATE OF BIRTH<span class="arrow"></span></a></th>
               <th><a class="column_sort" id="place" data-order="'.$order.'">PLACE OF BIRTH<span class="arrow"></span></a></th>
               <th><a class="column_sort" id="teacher_status" data-order="'.$order.'">STATUS<span class="arrow"></span></a></th>
               
               <th>ACTIONS</th>
          </tr>
     </thead>
 ';  
 while($row = mysqli_fetch_array($result))  
 {
     $count += 1;  
      $output .= '
          <tr>
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
               <td>
                    <div class="button-table">
                    <button class="edit-button" type="button" data-id='.$row['id'].'"><i class="fa-solid fa-pen-to-square"></i></button>
                         <a class="delete-button" href="deleteInactive.php?deleteId='.$row['id'].'"><i class="fa-solid fa-trash-can"></i></a>
                    </div>
               </td>
          </tr> 
      ';  
 }  
 $output .= "</table>";  
 echo $output;
 ?>  

     <!-- <script>
        $(document).ready(function() {
            $(".edit-button").click(function() {
              $('html, body').animate({
                  scrollTop: $(".header").offset().top
              }, 300);
            });
          });      
    </script> -->

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