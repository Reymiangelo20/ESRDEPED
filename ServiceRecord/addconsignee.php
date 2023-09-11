<?php
session_start();
include ('../../PersonalInfo/generalPhp/dbhConnection.php');

$data = strtoupper(mysqli_real_escape_string($conn, $_POST['data']));
$AOStation = $_SESSION['school'];


$sql="SELECT * FROM administrativeofficer WHERE AOStation = '$AOStation' ORDER BY AOId DESC";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$currentao = $row['AOName'];

$consignee = "INSERT  INTO `administrativeofficer`(`AOStation`,`AOName`) VALUES ('$AOStation','$data')";
$conn->query($consignee);

date_default_timezone_set('Asia/Singapore');
$date = date("M j  Y");
$time = date("g:i A");
$admin = $_SESSION['admin'];

$sql = "INSERT INTO `logs`(admin_name,email,description,action,AddedData,previousData,ChangedData,date, time) VALUES ('$admin','-','Changed a consignee','Changed Consignee','-','$currentao','$data','$date','$time')";
$logsResut = $conn->query($sql);






?>