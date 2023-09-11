<?php
session_start();
include '../../PersonalInfo/generalPhp/dbhConnection.php';

$school = $_SESSION['school'];
$searchTerm = $_GET['term'];
$sql = "SELECT * FROM emppersonalinfo WHERE school = '".$school."' AND email LIKE '%".$searchTerm."%'";
$result = $conn->query($sql); 
if ($result->num_rows > 0) {
  $empData = array(); 
  while($row = $result->fetch_assoc()) {

   $data['value'] = $row['email'];
   array_push($empData, $data);
} 
}
 echo json_encode($empData);

?>