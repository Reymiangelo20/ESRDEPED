

<?php
include ('../../PersonalInfo/generalPhp/dbhConnection.php');

$id  = $_POST['id'];
$getstation = "SELECT placeOfAppointment FROM `servicerecord` WHERE id='$id'";
$result = $conn->query($getstation);
while($row = mysqli_fetch_assoc($result)){
  $empstation = $row['placeOfAppointment'];                   
  }

  $query = "SELECT schoolName FROM schools WHERE schoolName = ?";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, 's', $empstation); // Assuming $id is the parameter value
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
while($row = mysqli_fetch_assoc($result)){
$data = $row['schoolName']; 
                   
}
if(!empty($data)){
  $status = "match";
}elseif($empstation == '-do-'){
  $status =  "match";
}
else{
  $status ="not match";
}

echo $status;


?>