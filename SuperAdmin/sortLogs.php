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

 $query = "SELECT * FROM logs ORDER BY ".$_POST["column_name"]." ".$_POST["order"]."";  
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
                <th><a class="column_sort" id="logId" data-order="'.$order.'">ID<span class="arrow"></span></a></th>
                <th><a class="column_sort" id="admin_name" data-order="'.$order.'">ADMIN USERNAME<span class="arrow"></span></a></th>
                <th><a class="column_sort" id="email" data-order="'.$order.'">USER EMAIL<span class="arrow"></span></a></th>
                <th><a class="column_sort" id="action" data-order="'.$order.'">ACTION<span class="arrow"></span></a></th>
                <th><a class="column_sort" id="date" data-order="'.$order.'">DATE<span class="arrow"></span></a></th>
                <th><a class="column_sort" id="time" data-order="'.$order.'">TIME<span class="arrow"></span></a></th>
          </tr>
     </thead>
 ';  
 while($row = mysqli_fetch_array($result))  
 {
     $count += 1;  
      $output .= '
          <tr>
               <td>'.$row["logId"].'</td>
               <td>'.$row["admin_name"].'</td>
               <td>'.$row["email"].'</td>
               <td>'.$row["action"].'</td>
               <td>'.$row["date"].'</td>
               <td>'.$row["time"].'</td>
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