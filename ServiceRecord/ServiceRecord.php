<?php
session_start();
include ('../../PersonalInfo/generalPhp/dbhConnection.php');
if(empty($_SESSION['admin'])){
		?>
		<head><link rel="stylesheet" href="../Styles/style2.css"></head>
		<body>
			<div class="main-div">
				<div class="second-div">
					<div class="content-div">
						<div class="icon">
							<img src="../access-denied.png">
						</div>
						<div >
						<p class="title">ACCESS DENIED!!!<br><br>
						You need to login to access to this page. otherwise you cannot enter</p>
						</div>
						<div class="btn-div">
						<button class="loginbtn">LOGIN</button>
						<button class="bck">BACK</button>
						</div>
					</div>
				</div>
			</div>
			
		</body>
		<?php
}
else{
//access to website 

//admin school
$adminschool = $_SESSION['school'];

if(isset($_POST['listempbtn'])){
	
	$clickedid = $_POST['eid'];
	$get = "SELECT * FROM `emppersonalinfo` WHERE id='$clickedid'";
	$result = $conn->query($get);
		if (mysqli_num_rows($result)>0){
			$row = $result->fetch_assoc();
			$id= $row['id'];
			$empStatus = $row['teacher_status'];
			$_SESSION['id'] = $id;
		}else{
	

		}
}

//check search email in database
if (isset($_POST['search'])) {

    $email=$_POST['email'];

    $get = "SELECT * FROM `emppersonalinfo` WHERE email='$email' AND school = '$adminschool'";
    $result = $conn->query($get);
		if (mysqli_num_rows($result)>0){
			$row = $result->fetch_assoc();
			$id= $row['id'];
			$empStatus = $row['teacher_status'];
			$_SESSION['id'] = $id;
		} 
		else{
			$get = "SELECT * FROM `emppersonalinfo` WHERE email='$email'";
			$result = $conn->query($get);
			if (mysqli_num_rows($result)>0){	
			?><script>
			window.addEventListener('load', function(){
				swal("Record exists in other school", "You cannot access record from the other schools.", "warning");});</script><?php
			} 
			else{
				?><script>window.addEventListener('load', function(){swal("No record found", "", "error");});
			</script><?php
				}
			}
		}



		
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="../../PersonalInfo/images/sdo-logo.png">
    <title>Service Record</title>
    <link rel="stylesheet" href="../ServiceRecord.css">
	
	<!-- --- -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
	<!-- --- -->

    <link rel="stylesheet" href="../../PersonalInfo/personalInfoStyle/general.css">
    <link rel="stylesheet" href="../../PersonalInfo/personalInfoStyle/header.css">
    <link rel="stylesheet" href="../../PersonalInfo/personalInfoStyle/table.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../../PersonalInfo/errorHandlerStyle/errorHandler.css">
	<script src="../../Development/sweetalert.js"></script>
    
    <script defer src="../../PersonalInfo/errorHandlerScripts/ajaxConnect.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../PersonalInfo/sweetalert/sweetalert2.all.min.js"></script>
    <script src="../../PersonalInfo/sweetalert/sweetalert.min.js"></script>
    <script src="https://kit.fontawesome.com/aa867b86c2.js" crossorigin="anonymous"></script>

<!-- temporary -->

	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <!-- <script type="text/javascript" src="frontend-script.js"></script> -->
		
	<!-- ------------------------------------ -->
		
</head>
<body>
    <header>
        <div class="header">
            <div class="title">  
				<i class="fa-solid fa-right-from-bracket"></i><a href="../../PersonalInfo/loginPhp/logout.php">LOGOUT</a>
			</div>
        </div>
    </header>
    <div class="main-service-record-container">
		<?php
			$adminUserName = $_SESSION['admin'];
			$sql = "SELECT * FROM users WHERE username = '$adminUserName';";
			$sqlResult = mysqli_query($conn, $sql);
			if($sqlResult){
				$userRow = mysqli_fetch_assoc($sqlResult);
				$user_email = $userRow['user_email'];
				$user_school = $userRow['user_school'];
				$user_district = $userRow['user_district'];
				$_SESSION['searchedemail'] = $user_email;
			}else{
				echo 'none';
			}?>

		<div class="user-information">
			<div class="profile-pic-div">
				<i class="fa-solid fa-user-tie"></i>
			</div>
			<div class="admin-info-div">
				<div class="username-email-div">
					<p class="adminUsername-p"> <?php echo $adminUserName;?></p>
					<p class="adminEmail-p"><i class="fa-sharp fa-solid fa-envelope"></i> <?php echo $user_email;?></p>
				</div>
				<div class="school-district-div">
					<p class="adminSchool-p"><i class="fa-solid fa-school"></i> <?php echo $user_school;?></p>
					<p class="adminDistrict-p"><i class="fa-solid fa-city"></i> <?php echo $user_district;?></p>
				</div>
			</div>
		</div>
        <div class="pesonal-display-container-div">
            <div class="add-serch-div-container">
                <div class="add-new-record-div">
                <?php
                if (isset($id)) {?>
                    <button id="add_record"  <?php if($empStatus != 'Active'){ echo 'disabled';} ?>><i class="fas fa-plus-square"></i>ADD NEW RECORD</button>
                <?php
				
                }
				?>
				<button  id="" data-toggle="modal" data-target="#listmodal" ><i class="fas fa-book"></i>EMPLOYEE LIST</button>
				<button  id="addAO"  ><i class="fas fa-users"></i>CHANGE CONSIGNEE</button>
								<?php
									if(isset($empStatus) && $empStatus != 'Active'){
								?>
									<div class="retiredOrDeceasedDiv">
										<p>Employee is either retired or deceased</p>
											<ul>
												<li>Add functionality is permanently disabled for this employee.</li>
												<li>The administrator will not be able to delete nor update any information of a retired or deceased employee.</li>
												<li>Records will remain visible.</li>
											</ul>
									</div>
								<?php
									}
								?>


	<!-- Import service record -->
				<!-- <form action="ImportServiceRecord.php" method="post" enctype="multipart/form-data">
					<label for="import-file" class="import-file-label">
						Upload <span style="color: green;">Excel</span> file
						<input type="file" name="import-file" id="import-file">
					</label>
					<button type="submit" name="save-excel-data">
						<i class="fa-solid fa-file-export"></i> 
						Import
					</button>
				</form> -->
                </div>
				

                <form method="POST" action="ServiceRecord.php">
                    <div class="search-div">
                        <button type="submit" name="search" id="search"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
                        <input type="email" name="email" id="email" placeholder="Enter email address" value="" required>
                    </div>
                </form>
            </div>
            <div class="name-section-div">
                <div class="text-box-div">
                    <input type="text" class="form__input" name="firstName" id="firstName" placeholder=""  value="<?php if (isset($row)) {
					    echo $row['firstName'];
					}?>" autocomplete="off" disabled>
                    <label for="firstName" class="form__label">FIRST NAME</label>
                </div>
                <div class="text-box-div">
                    <input type="text" class="form__input" name="lastName" id="lastName" placeholder=""  value="<?php if (isset($row)) {
					    echo $row['lastName'];
					}?>" disabled>
                    <label for="lastName" class="form__label">LAST NAME</label>
                </div>
                <div class="text-box-div">
                    <input type="text" class="form__input" name="middleName" id="middleName" placeholder=""  value="<?php if (isset($row)) {
					    echo $row['middleName'];
					}?>" disabled>
                    <label for="middleName" class="form__label">MIDDLE NAME</label>
                </div>
            </div>
            <div class="date-place-email-section-div">
                <div class="calendar-div"> 
                    <input type="text" class="form__input" name="birthDay" id="birthDay"  value="<?php if (isset($row)) {
					    echo $row['dateOfBirth'];
					}?>" disabled>
                    <label for="birthDay" class="form__label">BIRTHDATE</label>
                </div>
                <div class="text-box-div">
                    <input type="text" class="form__input" name="placeOfBirth" id="placeOfBirth" placeholder=""  value="<?php if (isset($row)) {
					    echo $row['place'];
					}?>" disabled>
                    <label for="placeOfBirth" class="form__label">PLACE OF BIRTH</label>
                </div>
            </div>
        </div>
		<div class="main-table-container-div">
			<div class="table-container-div">
				<table>
					<thead>
						<tr>
							<th class = 'check'><input type='checkbox' class="appendchx" id="appendchx"></input></th>
							<th>FROM</th>
							<th>TO</th>
							<th>DESIGNATION</th>
							<th>STATUS</th>
							<th>SALARY</th>
							<th>STATION/PLACE OF APPOINTMENT</th>
							<th>BRANCH</th>
							<th>LEAVE OF ABSENCE WITHOUT PAY</th>
							<th>REMARKS</th>
							<?php
								if (isset($id) && $empStatus == 'Active') {
							?>
								<th>ACTIONS</th>
							<?php
								}
							?>
							
						</tr>
					</thead>
					<tbody>
					<?php
					
					if(empty($_SESSION['id'])){
						$lid = '';
					}else{
						$lid = $_SESSION['id'];
						$result = mysqli_query($conn, "SELECT * FROM servicerecord Where empId = '$lid' ORDER BY Position DESC LIMIT 1");
						if ($result->num_rows > 0) {
							while($rows = $result->fetch_assoc()) {
								$last_id = $rows['Position'];
							}
						  }
					}
					
						if (isset($id)) {
							$getdata = "SELECT * FROM `servicerecord` WHERE empId='$id' ORDER BY Position DESC";
							$result = $conn->query($getdata);
							if (mysqli_num_rows($result)>0) {
								while ($row = $result->fetch_assoc()) {
									$cid = $row['Position'];
								
									$datestart_format= date("m/d/y", strtotime($row['dateStart']));
							
									// if($row['dateEnd'] == "not set"){
									// 	$dateend_format = $row['dateEnd'];?><?php
									// }
									// else if($row['dateEnd'] == "Present"){$dateend_format = $row['dateEnd'];}
									// else{$dateend_format= date("m/d/y", strtotime($row['dateEnd']));}

									if($cid != $last_id){	
										if($row['dateEnd'] == "Present"){
											$dateend_format = "not set";
										}
										else if($row['dateEnd'] == "not set"){
											$dateend_format = $row['dateEnd'];
										}
										else if($row['dateEnd'] == "Present"){$dateend_format = $row['dateEnd'];}
										else if ($cid != $last_id && $row['dateEnd'] =="Present"){$dateend_format ='';}
										else{$dateend_format= date("m/d/y", strtotime($row['dateEnd']));}
									}else{
										$dateend_format = $row['dateEnd'];
									}
									
							
									?>

								<tr class="data">
									<td class = 'appdentd'><button class="append" id="append" data-id='<?php echo $row["Position"];?>'><i class="fa-sharp fa-regular fa-square-plus"></i></button>
								</td>
									<td><?php echo $datestart_format;?>
									</td>
									<td><?php if($dateend_format == 'not set'){
										?>
										<button class="setdate" id="setdate" data-id="<?php echo $row["id"];?>">SET</button>
										<input type="hidden" id="employid" value="<?php echo $row["empId"];?>">
										<?php
									}else{
										echo $dateend_format;
									}
									?>
									</td>
									<td><?php echo $row['designation'];?>
									</td>
									<td><?php echo $row['empStatus'];?>
									</td>
									<td><?php echo $row['empSalary'];?>
									</td>
									<td><?php echo $row['placeOfAppointment'];?>
									</td>
									<td><?php echo $row['branch'];?>
									</td>
									<td><?php echo $row['leaveOfAbssence'];?>
									</td>
									<td><?php echo $row['remarks'];?>
									</td>
									<?php
										if (isset($id) && $empStatus == 'Active') {
									?>
									<td>
										<div class="button-table">
											<button class='edit-btn btn edit-button'
												data-id='<?php echo $row["id"];?>'><i class="fa-solid fa-pen-to-square"></i></button>
											<button class='delete-btn btn delete-button'
												data-id='<?php echo $row["id"];?>'><i class="fa-solid fa-trash-can"></i></button>
										</div>
									</td>
									<?php
										}
									?>
								</tr>
								<?php
								}
							}else {
								?>
								<th colspan="10" class="norecord">
									NO SERVICE RECORD
								</th>
								<?php
							}
						}?>  
					</tbody>
				</table>
			</div>
		</div>
        

	<!-- ADDRECORD-Modal -->
	<div class="modal fade" id="addrecordmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">ADD RECORD</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="formsubmit">
					<div class="firstSection">
								<div class="form-group">
									<input name="dateFrom" type="date" class="form-control form__input" id="From" autocomplete=off>
										<i class="fas fa-check-circle"></i>
										<i class="fas fa-exclamation-circle"></i>
										<div class="error"></div>
									<label class="select_form_label" for="From"> From </label>
								</div>

								<div class="form-group">
									<input name="dateTo" type="text" class="form-control" id="To" value="Present"
										disabled>
										<i class="fas fa-check-circle"></i>
										<i class="fas fa-exclamation-circle"></i>
										<div class="error"></div>
										<label class="select_form_label" from="To"> To </label>
								</div>
							</div>

							<div class="secondSection">
								<div class="form-group">
									<input name="designation" type="text" class="form-control form__input" id="Designation"
										placeholder=" " autocomplete=off>
										<i class="fas fa-check-circle"></i>
										<i class="fas fa-exclamation-circle"></i>
										<div class="error"></div>
										<label class="form__label" for="Designation"> Designation </label>
								</div>
								<div class="form-group">
										<select class="form-control" style="height: 50px;"
											id="Status" name="status">
											<option value="" selected disabled>Status</option>
											<option>R(P)</option>
											<option>Contractual</option>
											<option>Substitute</option>
											<option>Temporary</option>
											<option>Provisional</option>
											<option>Casual</option>
											<option>-do-</option>
										</select>
										<i class="fas fa-check-circle"></i>
										<i class="fas fa-exclamation-circle"></i>
										<div class="error"></div>
										<label class="select_form_label" for="Status"> Status </label>
								</div>

								<div class="form-group">
									<input name="salary" type="text" class="form-control form__input" id="Salary"
											placeholder=" " autocomplete=off>
										<i class="fas fa-check-circle"></i>
										<i class="fas fa-exclamation-circle"></i>
										<div class="error"></div>
										<label class="form__label" for="Salary"> Salary </label>
								</div>
							</div>

							<div class="thirdSection">
								<div class="form-group">
										
										<select class="select form-control"  style="height: 50px;"
											id="Station" name="stationPlaceOfAppointment" onchange="datamapperADD()">
											<option value="" selected disabled>Station</option>
											<option>-do-</option>
											<?php
											$get = "SELECT schoolName FROM `schools` ORDER BY schoolName";
											$result = $conn->query($get);
											while($row = mysqli_fetch_assoc($result)){
												$data = $row['schoolName'];
												?>
											<option><?php echo $data;?></option>
											<?php }?>
											<input class="select form-control" style="display: none" type="" id="station2" placeholder="Specify Station"></input>
										</select>
										<i class="fas fa-check-circle"></i>
										<i class="fas fa-exclamation-circle"></i>
										<div class="error"></div>
										<label class="select_form_label" for="Station"> Station </label>
								</div>
								
								<div class="form-group">
								
								<select class="select form-control" style="height: 50px;"
										id="Branch" name="branch">
										<option value="" selected disabled>Branch</option>
										<option>-do-</option>
										<option>N(M)</option>
										<option>Local</option>
										<option>National</option>
										<option>N/A</option>
								</select>
								<i class="fas fa-check-circle"></i>
								<i class="fas fa-exclamation-circle"></i>
								<div class="error"></div>
								<label class="select_form_label" for="Branch">Branch</label>
								</div>
								<div class="chkbx-div">
								<input  class="chkbx" type="checkbox" name="" id="addcb"></input>
								<label class="chkbxlabel" for="Branch">Others (Check if Station is not on the list)</label>
								</div>
							</div>

							<div class="fourthSection">
								<div class="form-group">    
									<input name="leaveOfAbssence" type="text" class="form-control form__input" id="LeaveOfAbssence"
											placeholder=" " autocomplete=off>
									<i class="fas fa-check-circle"></i>
									<i class="fas fa-exclamation-circle"></i>
									<div class="error"></div>
									<label class="form__label" for="LeaveOfAbssence"> Leave of abssence </label>
								</div>
								<div class="form-group"> 
									<input name="remarks" type="text" class="form-control form__input" id="Remarks"
										placeholder=" " autocomplete=off>
										<i class="fas fa-check-circle"></i>
										<i class="fas fa-exclamation-circle"></i>
										<div class="error"></div>
									<label for="Remarks" class="form__label">Remarks</label>

								<input name="empId" type="hidden" class="form-control" id="add_empId">
								</div>
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button id="addreq" name="addreq" type="submit" class="btn btn-success">Add Record</button>
								<button id="insertreq" name="insertreq" type="submit" class="btn btn-success">Insert below</button>
							</div>
						</form>						
				</div>
		</div>
	</div>
	</div>

	<!-- EDIT-Modal -->
	<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">EDIT RECORD</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="">
							<div class="firstSection">
								<div class="form-group">
									<input name="dateFrom" type="date" class="form-control form__input" id="editfrom" autocomplete=off>
										<i class="fas fa-check-circle"></i>
										<i class="fas fa-exclamation-circle"></i>
										<div class="error"></div>
									<label class="select_form_label" for="editfrom"> From </label>
								</div>

								<div class="form-group">
									<input name="dateTo" type="text" class="form-control" id="editto" value="Present"
										disabled>
										<i class="fas fa-check-circle"></i>
										<i class="fas fa-exclamation-circle"></i>
										<div class="error"></div>
										<label class="select_form_label" for="editto"> To </label>
								</div>
							</div>

							<div class="secondSection">
								<div class="form-group">
									<input name="designation" type="text" class="form-control form__input" id="editdesignation"
										placeholder=" " autocomplete=off>
										<i class="fas fa-check-circle"></i>
										<i class="fas fa-exclamation-circle"></i>
										<div class="error"></div>
										<label class="form__label" for="editdesignation"> Designation </label>
								</div>
								<div class="form-group">
										<select class="form-control" style="height: 50px;"
											id="editstatus" name="status">
											<option value="" selected disabled>Status</option>
											<option>R(P)</option>
											<option>Contractual</option>
											<option>Substitute</option>
											<option>Temporary</option>
											<option>Provisional</option>
											<option>Casual</option>
											<option>-do-</option>
										</select>
										<i class="fas fa-check-circle"></i>
										<i class="fas fa-exclamation-circle"></i>
										<div class="error"></div>
										<label class="select_form_label" for="editstatus"> Status </label>
								</div>

								<div class="form-group">
									<input name="salary" type="text" class="form-control form__input" id="editsalary"
											placeholder=" " autocomplete=off>
										<i class="fas fa-check-circle"></i>
										<i class="fas fa-exclamation-circle"></i>
										<div class="error"></div>
										<label class="form__label" for="editsalary"> Salary </label>
								</div>
							</div>

							<div class="thirdSection">
							
								<div class="form-group">
										
										<select class="select form-control"  style="height: 50px;"
											id="editstation" name="stationPlaceOfAppointment" onchange="datamapperADD()">
											<option value="" selected disabled>Station</option>
											<option>-do-</option>
											<option>Others</option>
											<?php
											$get = "SELECT schoolName FROM `schools` ORDER BY schoolName";
											$result = $conn->query($get);
											while($row = mysqli_fetch_assoc($result)){
												$data = $row['schoolName'];
												?>
											<option><?php echo $data;?></option>
											<?php }?>
											<input class="select form-control" style="display: none" type="" id="otherstation" placeholder="Specify Station"></input>
										</select>
										<i class="fas fa-check-circle"></i>
										<i class="fas fa-exclamation-circle"></i>
										<div class="error"></div>
										<label class="select_form_label" for="editstation"> Station </label>
										
								</div>
								<div class="form-group">
								
								<select class="select form-control" style="height: 50px;"
										id="editbranch" name="branch">
										<option value="" selected disabled>Branch</option>
										<option>-do-</option>
										<option>N(M)</option>
										<option>Local</option>
										<option>National</option>
										<option>N/A</option>
								</select>
								<i class="fas fa-check-circle"></i>
								<i class="fas fa-exclamation-circle"></i>
								<div class="error"></div>
								<label class="select_form_label">Branch</label>
								</div>
								<div class="chkbx-div">
								<input  class="chkbx" type="checkbox" name="" id="cb"></input>
								<label class="chkbxlabel" for="editbranch">Others (Check if Station is not on the list)</label>
								</div>

								
								
								<!-- Check if stations is not on the list -->
								
								
								
							</div>

							<div class="fourthSection">
								<div class="form-group">    
									<input name="leaveOfAbssence" type="text" class="form-control form__input" id="editleaveofabssence"
											placeholder=" " autocomplete=off>
									<i class="fas fa-check-circle"></i>
									<i class="fas fa-exclamation-circle"></i>
									<div class="error"></div>
									<label class="form__label" for="editleaveofabssence"> Leave of abssence </label>
								</div>
								<div class="form-group"> 
									<input name="remarks" type="text" class="form-control form__input" id="editremarks"
										placeholder=" " autocomplete=off>
										<i class="fas fa-check-circle"></i>
										<i class="fas fa-exclamation-circle"></i>
										<div class="error"></div>
									<label class="form__label" for="editremarks" >Remarks</label>
								</div>
								<input name="id" type="hidden" class="form-control" id="id">
								<input name="empId" type="hidden" class="form-control" id="empId">
							</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button id="updatebtn" name="updatebtn" type="submit" class="updatebtn btn btn-primary">Update Record</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	</div>

	<!-- employeelist -->
	<div class="modal fade" id="listmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">LIST OF EMPLOYEES</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				
				<div class="modal-body">
					<table class="tb">
						<thead class="thead-dark">
							<tr>
								<th>NAME</th>
								<th>EMAIL</th>
								<th>STATUS</th>
								<th></th>
								</tr>
							</thead>
							<tbody>
					<?PHP
					$list = "SELECT * FROM emppersonalinfo WHERE school = '$adminschool'ORDER BY lastName ASC";
					$result = $conn->query(($list));
					if (mysqli_num_rows($result)>0){
						while($row = $result->fetch_assoc()){
						?>
						
						
								<tr>
									<td><?php echo $row['lastName'].', '.$row['firstName'].' '.$row['middleName'];?></td>
									<td><?php echo $row['email']?></td>
									<td><?php echo $row['teacher_status']?></td>
									<form method="POST" action="ServiceRecord">
									<td>
										<input name="eid" type="hidden" class="form-control" id="eid" value="<?php echo $row['id'];?>">
										<button class="btn btn-success" name="listempbtn" >VIEW</button>
									</td>
									</form>								
								</tr>
						<?php
						}					
					} 
					?>
							</tbody>
						</table>	
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					
				</div>
				
			</div>
			
		</div>
	</div>
	</div>


	<script>
			var checkbox = document.getElementById('cb');
		var checkboxadd = document.getElementById('addcb');
		var addresult;
		checkboxadd.addEventListener("click", function() {
			if(checkboxadd.checked){
				$("#Station").css("display", 'none');
				$("#station2").css("display", 'block');
				addresult = "station1";
				
			}else{
				$("#Station").css("display", 'block');
				$("#station2").css("display", 'none');
				addresult = "station2";
				
			}
		});
		var validate = "";
		$(document).ready(function(){
			
			$('.setdate').click(function(){
				swal({
				title: "SET DATE",
				content: {
					element: "input",
					attributes: {
					type: "date",
					},
				},	
				icon: "",
				buttons: true,
				dangerMode: true,						
			})
			.then((setdate)=>{
				if(setdate){
				var date = (`${setdate}`);
				var id = $(this).data('id');
				var eid = document.getElementById('employid').value;
				$.ajax({
					method: 'post',
					url: 'setEndDate.php',
					data:{
						date:date,
						id: id,
						eid: eid
						},
					success: function(response){
					swal("Set date successfully", "", "success")
					.then(() =>{location.reload()});
					}
					});					
				}
				});
			});
		});


		var position;
		$(document).ready(function(){
			
			$('.append').click(function(){
				position = $(this).data('id');
				var result;
				// console.log(position);
				$('#addrecordmodal').modal('show');
					$("#insertreq").css("display", 'block');
				$("#addreq").css("display", 'none');
				$("#To").attr("disabled", false);
				$("#To").val('');
				$("#To").attr("type", 'date');
				console.log(position);			
			});	
		});	

		
		$(document).ready(function(){
			const formsubmit = document.getElementById('formsubmit');
			const From = document.getElementById('From');
			const To = document.getElementById('To');
			const Designation = document.getElementById('Designation');
			const Status = document.getElementById('Status');
			const Salary = document.getElementById('Salary');
			const Station = document.getElementById('Station');
			const Branch = document.getElementById('Branch');
			const LeaveOfAbssence = document.getElementById('LeaveOfAbssence');
			const Remarks = document.getElementById('Remarks');
			
				$('#insertreq').click(function(){
					event.preventDefault();
					validateInputs();	
			});
const setError = (element, message) => {
			const inputControl = element.parentElement;
			const errorDisplay = inputControl.querySelector('.error');

			errorDisplay.innerText = message;
			inputControl.classList.add('error');
			inputControl.classList.remove('success');
		}

			const setSuccess = element => {
			const inputControl = element.parentElement;
			const errorDisplay = inputControl.querySelector('.error');

			errorDisplay.innerText = '';
			inputControl.classList.add('success');	
			inputControl.classList.remove('error');
		}

		const validateInputs = () =>{
		const FromValue = From.value.trim();
		const ToValue = To.value.trim();
		const DesignationValue = Designation.value.trim();
		const StatusValue = Status.value.trim();
		const SalaryValue = Salary.value.trim();
		const StationValue = Station.value.trim();
		const BranchValue = Branch.value.trim();
		const LeaveOfAbssenceValue = LeaveOfAbssence.value.trim();
		const RemarksValue = Remarks.value.trim();
		
		let isValid = true;
		// check if from is empty
		if(FromValue === ''){
			setError(From, 'Date started is required');
			isValid = false;
		}else{
			setSuccess(From);
		}
		// check if To is empty
		if(ToValue === ''){
			setError(To, 'Date ended is required');
			isValid = false;
		}else{
			setSuccess(To);
		}
		// check if Designation is empty
		if(DesignationValue === ''){
			setError(Designation, 'Designation is required');
			isValid = false;
		}else{
			setSuccess(Designation);
		}
		// check if Status is empty
		if(StatusValue === ''){
			setError(Status, 'Status is required');
			isValid = false;
		}else{
			setSuccess(Status);
		}
		// check if Salary is empty
		if(SalaryValue === ''){
			setError(Salary, 'Salary is required');
			isValid = false;
		}else{
			setSuccess(Salary);
		}
		// check if Station is empty
		// if(StationValue === ''){
		// 	setError(Station, 'Station is required');
		// 	isValid = false;
		// }else{
		// 	setSuccess(Station);
		// }
		// check if Branch is empty
		if(BranchValue === ''){
			setError(Branch, 'Branch is required');
			isValid = false;
		}else{
			setSuccess(Branch);
		}
		// check if LeaveOfAbssence is empty
		if(LeaveOfAbssenceValue === '' || LeaveOfAbssenceValue !== ''){
			setSuccess(LeaveOfAbssence);
		}
		// check if Remarks is empty
		if(RemarksValue === '' || RemarksValue !== '' ){
			setSuccess(Remarks);
		}

		if(isValid){
			if(checkboxadd.checked){result = "station1";}
			else{result = "station2";}
				var from = document.getElementById('From').value;
				var to = document.getElementById('To').value;
				var designation = document.getElementById('Designation').value;
				var status = document.getElementById('Status').value;
				var salary = document.getElementById('Salary').value;
				var station = document.getElementById('Station').value;
				var branch = document.getElementById('Branch').value;
				var leave = document.getElementById('LeaveOfAbssence').value;
				var remarks = document.getElementById('Remarks').value;
				var station2 = document.getElementById('station2').value;
						
				$.ajax({
					url: 'InsertInTable',
					type: 'POST',
					data:{
						from: from,
						to: to,
						designation: designation,
						status: status,
						salary: salary,
						station: station,
						branch: branch,
						leave: leave,
						remarks: remarks,
						station2: station2,
						result: result,
						position: position
						
					},
					success:function(response){						
						console.log(response);
						swal("Record Inserted", "", "success").then(() => {
							location.reload();
						});
					}
				})
		}
	};

		});






		var insertcheckbox = document.getElementById('appendchx');
		insertcheckbox.addEventListener("click", function() {
			if(insertcheckbox.checked){
				$(".append").css("display", 'block');
			}else{
				$(".append").css("display", 'none');
				}
			});
	

		$(document).ready(function(){
			$('#addAO').click(function(){
				swal({
				title: "CHANGE ADMINISTRATIVE OFFICER CONSIGNEE",
				content: {
					element: "input",
					attributes: {
					placeholder: "Full Name (Given/MI/Surname) Example: MA. JIMA T. CADIZ",
					type: "text",
					},
				},	
				icon: "",
				buttons: true,
				dangerMode: true,						
			})
			.then((consignee)=>{
				if(consignee){
				var data = (`${consignee}`);
				$.ajax({
					method: 'post',
					url: 'addconsignee.php',
					data:{data:data},
					success: function(response){
					swal("Change successfully", "", "success");
					}
					});					
				}
				});
			});
		});

		 $( function() {
			$( "#email" ).autocomplete({
			source: 'autoComplete.php'  
			});
		});
	</script>

	<script>
		var inactivityTime = 0;
					var logoutTime = 300; 

					document.addEventListener('mousemove', function() {
						inactivityTime = 0;
					});
					document.addEventListener('keypress', function() {
						inactivityTime = 0;
					});
					function startLogoutTimer() {
						setInterval(function() {
							inactivityTime += 1;
							if (inactivityTime >= logoutTime) {
									window.location.href = "../../Development/autologout.php";
							}
						}, 1000);
					}
					startLogoutTimer();
					
	
		 
	

		$(document).ready(function(){
		$('#add_record').click(function(){
			

		});
		});
		

		let salaryInput = document.getElementById("Salary");
		let editsalary = document.getElementById("editsalary");

		salaryInput.addEventListener("input", function() {
    	let salary = salaryInput.value.replace(/\D/g, ""); 
    	let formattedSalary = parseInt(salary).toLocaleString();
    	if (formattedSalary !== "") {
        salaryInput.value = formattedSalary;
    	}
		});

		salaryInput.addEventListener("blur", function() {
    	let salary = salaryInput.value.replace(/\D/g, ""); 
    	let formattedSalary = parseInt(salary).toLocaleString();
    	if (formattedSalary !== "") {
        formattedSalary += ".00"; 
        salaryInput.value = formattedSalary;
    	}
		});

		editsalary.addEventListener("input", function() {
		let salary = editsalary.value.replace(/\D/g, ""); 
		let formattedSalary = parseInt(salary).toLocaleString();
		if (formattedSalary !== "") {
			editsalary.value = formattedSalary;
		}
		});
		editsalary.addEventListener("blur", function() {
		let salary = editsalary.value.replace(/\D/g, ""); 
		let formattedSalary = parseInt(salary).toLocaleString();
		if (formattedSalary !== "") {
			formattedSalary += ".00"; 
			editsalary.value = formattedSalary;
		}
		});
	
		
		function datamapperADD(){
			var select = document.getElementById('Station').value;
				if (select == '-do-'){
					document.getElementById('Branch').value = "-do-"
				}
				else{
					document.getElementById('Branch').value = "San jose East"
				}
			};

		function datamapperEDIT(){
			var select = document.getElementById('editstation').value;
				if (select == '-do-'){
					document.getElementById('editbranch').value = "-do-"
				}
				else{
					document.getElementById('editbranch').value = "San jose East"
				}
			};



			$(document).ready(function() {
			$('.edit-btn').on('click', function() {
				
				var id = $(this).data('id');
				$("#editto").attr("disabled", true);
				$("#editto").attr("type", 'text');
				var result;

				$.ajax({
					type: 'POST',
					url: 'tester.php',
					data:{id:id}
					,success: function (data){
						if($.trim(data)  == "not match"){
							$("#editstation").css("display", 'none');
							$("#otherstation").css("display", 'block');
							checkbox.checked = true;
							result = data;
							
							
							
						}else{
							$("#editstation").css("display", 'block');
							$("#otherstation").css("display", 'none');
							checkbox.checked = false;
							result = data;
								 
						}
						$.ajax({
					type: 'POST',
					url: 'GetData.php',
					dataType: 'json',
					data: {id: id},
					success: function(response){
						$('#editfrom').val(response[0]['dateStart']);
						$('#editto').val(response[0]['dateEnd']);
						$('#editdesignation').val(response[0]['designation']);
						$('#editstatus').val(response[0]['empStatus']);
						$('#editsalary').val(response[0]['empSalary']);
						$('#editbranch').val(response[0]['branch']);
						$('#editleaveofabssence').val(response[0]['leaveOfAbssence']);
						$('#editremarks').val(response[0]['remarks']);
						if($.trim(data)  == "not match"){
							$('#otherstation').val(response[0]['placeOfAppointment']);
							// $('#editstation').val('');		
							
						}else{
							$('#editstation').val(response[0]['placeOfAppointment']);
							// $('#otherstation').val('');	
						}

						
						$('#id').val(response[0]['id']);
						$('#empId').val(response[0]['empId']);
						$('#editmodal').modal("show")
						
						
						var edit = document.getElementById('editto').value;
				
						if(edit == 'Present'){
							$("#editto").attr("type", 'text');
							$("#editto").attr("disabled", true);
						}
						else{
							$("#editto").attr("type", 'date');
							$("#editto").attr("disabled", false);
						}
						// $("#updatebtn").attr("disabled", true);
						var start = document.getElementById("editfrom");
						var end = document.getElementById("editto");
						var designation = document.getElementById("editdesignation");
						var status = document.getElementById("editstatus");
						var salary = document.getElementById("editsalary");
						var branch = document.getElementById("editbranch");
						var leaveofabssence = document.getElementById("editleaveofabssence");
						var remarks = document.getElementById("editremarks");
						var station = document.getElementById("editstation");
						var otherstation = document.getElementById("otherstation");
					

						
						checkbox.addEventListener("click", function() {
						if(!checkbox.checked){
						validate = 'not checked';
						$("#otherstation").css("display", 'none');
						$("#editstation").css("display", 'block');
						// $('#otherstation').val('');
						
									
						
					}else{
						validate = 'checked';
						$("#editstation").css("display", 'none');
						$("#otherstation").css("display", 'block');
						// $('#editstation').val('');
						
					}
					});
						
						
						// [ start, end, designation, status,salary,branch,leaveofabssence,remarks,station,otherstation].forEach(function(element) {
						// element.addEventListener("input", function() {
						// 	if(start.value ==response[0]['dateStart'] && end.value == response[0]['dateEnd']
						// 	&& designation.value == response[0]['designation'] && status.value == response[0]['empStatus']
						// 	&& salary.value == response[0]['empSalary'] && branch.value == response[0]['branch']
						// 	&& leaveofabssence.value == response[0]['leaveOfAbssence'] && remarks.value == response[0]['remarks']
						// 	&& otherstation.value == response[0]['placeOfAppointment']){
						// 	$("#updatebtn").attr("disabled", true);
							
						// }
						// else{
						// 	$("#updatebtn").attr("disabled", false);
						// }
						// });
						// });
					
						
					}
				});
					}
				
				});

				
			});
		});	




			//update data

			$(document).ready(function() {
				// Remove error handlers
				if ($('#editmodal').length > 0) {
                $('#editmodal').on('hidden.bs.modal', function () {
                    const parentElems = document.querySelectorAll('.form-group');
                        parentElems.forEach((parentElem) => {
                        const errorDisplay = parentElem.querySelector('.error');
                            
                        errorDisplay.innerText = '';
                        parentElem.classList.remove('error');
                        parentElem.classList.remove('success');
                    });
                });
            }
				const editFrom = document.getElementById('editfrom');
				const editTo = document.getElementById('editto');
				const editDesignation = document.getElementById('editdesignation');
				const editStatus = document.getElementById('editstatus');
				const editSalary = document.getElementById('editsalary');
				const editStation = document.getElementById('editstation');
				const editOtherStation = document.getElementById('otherstation');
				const editBranch = document.getElementById('editbranch');
				const editLeaveOfAbssence = document.getElementById('editleaveofabssence');
				const editRemarks = document.getElementById('editremarks');
			$('.updatebtn').on('click', function(event) {
				event.preventDefault();
				
				validateInputs();
			});

			const setError = (element, message) => {
			const inputControl = element.parentElement;
			const errorDisplay = inputControl.querySelector('.error');

			errorDisplay.innerText = message;
			inputControl.classList.add('error');
			inputControl.classList.remove('success');
		}

			const setSuccess = element => {
			const inputControl = element.parentElement;
			const errorDisplay = inputControl.querySelector('.error');

			errorDisplay.innerText = '';
			inputControl.classList.add('success');	
			inputControl.classList.remove('error');
		}

		const validateInputs = () =>{
		const editFromValue = editFrom.value.trim();
		const editToValue = editTo.value.trim();
		const editDesignationValue = editDesignation.value.trim();
		const editStatusValue = editStatus.value.trim();
		const editSalaryValue = editSalary.value.trim();
		const editStationValue = editStation.value.trim();
		const editBranchValue = editBranch.value.trim();
		const editLeaveOfAbssenceValue = editLeaveOfAbssence.value.trim();
		const editRemarksValue = editRemarks.value.trim();
		const editOtherStationValue = editOtherStation.value.trim();
		
		let isValid = true;
		// check if from is empty
		if(editFromValue === ''){
			setError(editFrom, 'Date started is required');
			isValid = false;
		}else{
			setSuccess(editFrom);
		}
		// check if To is empty
		if(editToValue === ''){
			setError(editTo, 'Date ended is required');
			isValid = false;
		}else{
			setSuccess(editTo);
		}
		// check if Designation is empty
		if(editDesignationValue === ''){
			setError(editDesignation, 'Designation is required');
			isValid = false;
		}else{
			setSuccess(editDesignation);
		}
		// check if Status is empty
		if(editStatusValue === ''){
			setError(editStatus, 'Status is required');
			isValid = false;
		}else{
			setSuccess(editStatus);
		}
		// check if Salary is empty
		if(editSalaryValue === ''){
			setError(editSalary, 'Salary is required');
			isValid = false;
		}else{
			setSuccess(editSalary);
		}
		// check if Station is empty
		// if(editStationValue === ''){
		// 	setError(editStation, 'Station is required');
		// 	isValid = false;
		// }else{
		// 	setSuccess(editStation);
		// }
		// check if Branch is empty
		if(editBranchValue === ''){
			setError(editBranch, 'Branch is required');
			isValid = false;
		}else{
			setSuccess(editBranch);
		}
		// check if LeaveOfAbssence is empty
	if(editLeaveOfAbssenceValue === '' || editLeaveOfAbssenceValue !== ''){
			setSuccess(editLeaveOfAbssence);
		}
		// check if Remarks is empty
		if(editRemarksValue === '' || editRemarksValue !== '' ){
			setSuccess(editRemarks);
		}
		if(checkbox.checked){
			if(editOtherStationValue === ''){
			setError(editStation, '');
			isValid = false;
		}else{
			setSuccess(editStation);
		}
		}else{
			if(editStationValue === ''){
			setError(editStation, '');
			isValid = false;
		}else{
			setSuccess(editStation);
		}

		}
		editOtherStation

		if(isValid){
				var start = document.getElementById("editfrom").value;
				var end = document.getElementById("editto").value;
				var designation = document.getElementById("editdesignation").value;
				var status = document.getElementById("editstatus").value;
				var salary = document.getElementById("editsalary").value;
				var branch = document.getElementById("editbranch").value;
				var leaveofabssence = document.getElementById("editleaveofabssence").value;
				var remarks = document.getElementById("editremarks").value;
				var station = document.getElementById("editstation").value;
				var otherstation = document.getElementById("otherstation").value;
				var id = document.getElementById("id").value;
				var empId = document.getElementById("empId").value;

				if(checkbox.checked){
					var finalstation = otherstation;
				}else{
					var finalstation = station;
				}
				
	
				$.ajax({
					type: 'POST',
					url: 'UpdateData.php',
					data: {
						start: start,
						end: end,
						designation: designation,
						status: status,
						salary: salary,
						branch: branch,
						leaveofabssence: leaveofabssence,
						remarks: remarks,
						finalstation: finalstation,
						id: id,
						empId: empId
					},
					success: function(response){
						$('#editmodal').modal('hide');
						swal("Data updated!", "", "success").then(() =>{
							location.reload()
						});
					},
					error: function(xhr, status, error) {
						swal("Update record error", "", "error")
					}
				});
		}
	};

		});
		
		//fetch record then map into inputs of update modal
		


		//delete record
		$(document).ready(function() {
			$('.delete-btn').on('click', function(){
				var id = $(this).data('id');
				swal({
						title: "WARNING!!",
						text: "Are you sure? Once deleted, you will not be able to recover this record",
						icon: "warning",
						buttons: true,
						dangerMode: true,
					})
					.then((willDelete) => {
						if (willDelete){
							$.ajax({
								type: 'POST',
								url: 'DeleteData.php',
								data: {id: id},
								success: function(response){
									$('#editmodal').modal('hide');
									swal("Record has been deleted!", "", "success").then(() =>{
									location.reload()
									});
								}
							});
						} 
						else{}
					});
			});
		});



		$(document).ready(function(){
			$('#add_record').click(function(){
				$('#addrecordmodal').modal('show');
				$("#insertreq").css("display", 'none');
				$("#addreq").css("display", 'block');
				$("#To").attr("disabled", true);
				$("#To").attr("type", 'text');
				$("#To").val('Present');
			});
		});
		

		//add record to database
		$(document).ready(function(){
			const formsubmit = document.getElementById('formsubmit');
			const From = document.getElementById('From');
			const To = document.getElementById('To');
			const Designation = document.getElementById('Designation');
			const Status = document.getElementById('Status');
			const Salary = document.getElementById('Salary');
			const Station = document.getElementById('Station');
			const Branch = document.getElementById('Branch');
			const LeaveOfAbssence = document.getElementById('LeaveOfAbssence');
			const Remarks = document.getElementById('Remarks');
			
			$("#addreq").click(function(event){
				event.preventDefault();
				validateInputs();
			});

			const setError = (element, message) => {
			const inputControl = element.parentElement;
			const errorDisplay = inputControl.querySelector('.error');

			errorDisplay.innerText = message;
			inputControl.classList.add('error');
			inputControl.classList.remove('success');
		}

			const setSuccess = element => {
			const inputControl = element.parentElement;
			const errorDisplay = inputControl.querySelector('.error');

			errorDisplay.innerText = '';
			inputControl.classList.add('success');	
			inputControl.classList.remove('error');
		}

		const validateInputs = () =>{
		const FromValue = From.value.trim();
		const ToValue = To.value.trim();
		const DesignationValue = Designation.value.trim();
		const StatusValue = Status.value.trim();
		const SalaryValue = Salary.value.trim();
		const StationValue = Station.value.trim();
		const BranchValue = Branch.value.trim();
		const LeaveOfAbssenceValue = LeaveOfAbssence.value.trim();
		const RemarksValue = Remarks.value.trim();
		
		let isValid = true;
		// check if from is empty
		if(FromValue === ''){
			setError(From, 'Date started is required');
			isValid = false;
		}else{
			setSuccess(From);
		}
		// check if To is empty
		if(ToValue === ''){
			setError(To, 'Date ended is required');
			isValid = false;
		}else{
			setSuccess(To);
		}
		// check if Designation is empty
		if(DesignationValue === ''){
			setError(Designation, 'Designation is required');
			isValid = false;
		}else{
			setSuccess(Designation);
		}
		// check if Status is empty
		if(StatusValue === ''){
			setError(Status, 'Status is required');
			isValid = false;
		}else{
			setSuccess(Status);
		}
		// check if Salary is empty
		if(SalaryValue === ''){
			setError(Salary, 'Salary is required');
			isValid = false;
		}else{
			setSuccess(Salary);
		}
		// check if Station is empty
		// if(StationValue === ''){
		// 	setError(Station, 'Station is required');
		// 	isValid = false;
		// }else{
		// 	setSuccess(Station);
		// }
		// check if Branch is empty
		if(BranchValue === ''){
			setError(Branch, 'Branch is required');
			isValid = false;
		}else{
			setSuccess(Branch);
		}
		// check if LeaveOfAbssence is empty
		if(LeaveOfAbssenceValue === '' || LeaveOfAbssenceValue !== ''){
			setSuccess(LeaveOfAbssence);
		}
		// check if Remarks is empty
		if(RemarksValue === '' || RemarksValue !== '' ){
			setSuccess(Remarks);
		}

		if(isValid){
			var from = document.getElementById('From').value;
			var to = document.getElementById('To').value;
			var designation = document.getElementById('Designation').value;
			var status = document.getElementById('Status').value;
			var salary = document.getElementById('Salary').value;
			var station = document.getElementById('Station').value;
			var branch = document.getElementById('Branch').value;
			var leave = document.getElementById('LeaveOfAbssence').value;
			var remarks = document.getElementById('Remarks').value;
			var station2 = document.getElementById('station2').value;
			$.ajax({
					type: "POST",
					url: "AddData.php",
					data:{
						from: from,
						to: to,
						designation: designation,
						status: status,
						salary: salary,
						station: station,
						branch: branch,
						leave: leave,
						remarks: remarks,
						addresult: addresult,
						station2: station2
					},
					success: function(response) {
						// addrecordmodal
						$('#addrecordmodal').modal('hide');
						$('#formsubmit')[0].reset();
						swal("Record added", "", "success").then(() => {
							location.reload();
						});
					},
					error: function(xhr, status, error) {
						swal("eRROR ", "", "WARNING")
					}
				});
		}
	};
		});

		


	</script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
		integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
	</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
		integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
	</script>

</body>

</html>
<?php
}
?>