function hoverEffect(){
    $(document).ready(function(){
        var checker = document.querySelector('#check');
        // This function sets the visibility of 'sidbar-hidden-div' 
        // element into hidden when the checkbox is checked then brings it back to visible when unchecked
        checker.addEventListener('click', function(){
          // check if the checkbox is enabled
          if(this.checked){
            // If true the selected element will be hidded
            $('.sidebar-hidden-div').css('visibility', 'hidden');
          }else{
            // If false the selected element will be visible
            $('.sidebar-hidden-div').css('visibility', 'visible');
          }
        })
    
        // This function hides and display the given element when it was being hover
        const data = {
        // The elements selectors/names are stored in an object to be able to loop each selector
        '.dashboard-option-div a': '.sidebar-dashboard-hidden-div',
        '.admin-accounts-option-div a': '.sidebar-admin-hidden-div',
        '.logs-option-div a': '.sidebar-logs-hidden-div',
        '.inactive-employee-option-div a': '.sidebar-inactive-hidden-div',
        '.active-employee-option-div a': '.sidebar-active-hidden-div',
        '.settings-option-div': '.sidebar-settings-hidden-div',
        '.exporter': '.sidebar-export-hidden-div',
        '#export-sr': '.sidebar-service-hidden-div',
        '#export-emp-pdf': '.sidebar-personal-hidden-div',
        '.import-file-option-div': '.sidebar-import-hidden-div'
        };
    
          for (let selector in data) {
            $(selector).hover(
              function() {
                $(data[selector]).show();
              },
              function() {
                $(data[selector]).hide();
              }
            );
        }
      })
}

function exportFile(){
  $(document).ready(function(){
    $('.exporter').on('click', function(){
      $('.export-service-record').slideToggle();
    })

    $('#export-sr').on('click', function(){
        console.log("clicked");
        window.location.href = "exportServiceRecordExcel.php";	
    });
    $("#export-emp-pdf").click(function(){
        console.log('clicked');
        window.location.href = "exportPersonalInfoExcel.php";	
    });
  })
}

function exportFileWithLoader(){
  $(document).ready(function() {
    $('.exporter').on('click', function() {
      $('.export-service-record').slideToggle();
    })

    $('#export-sr').on('click', function() {
      Swal.fire({
        title : 'Warning',
        text : 'Exporting the service record may require additional time to complete. Would you like to proceed with the process? Please note that it may take a while.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d5',
        confirmButtonText: 'Export',
    }).then((result) => {
        if(result.isConfirmed){
          console.log("clicked");
          $('.spinner-export').css('visibility', 'visible');
          $.ajax({
            url: 'exportServiceRecordExcel.php',
            method: 'post',
            xhrFields: {
              responseType: 'blob'
            },
            success: function(data) {
              console.log(data);
              var a = document.createElement('a');
              var url = window.URL.createObjectURL(data);
              a.href = url;
              a.download = 'ServiceRecord.xlsx';
              document.body.append(a);
              a.click();
              a.remove();
              window.URL.revokeObjectURL(url);
              location.reload()
            }
          });
        }
    })
    });

    $("#export-emp-pdf").click(function() {
      Swal.fire({
        title : 'Warning',
        text : 'Exporting employee\'s personal information may require additional time to complete. Would you like to proceed with the process? Please note that it may take a while.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d5',
        confirmButtonText: 'Export',
    }).then((result) => {
      if(result.isConfirmed){
        console.log('clicked');
        $('.spinner-export').css('visibility', 'visible');
        $.ajax({
          url: 'exportPersonalInfoExcel.php',
          method: 'post',
          xhrFields: {
            responseType: 'blob'
          },
          success: function(data) {
            console.log(data);
            var a = document.createElement('a');
            var url = window.URL.createObjectURL(data);
            a.href = url;
            a.download = 'PersonalInfo.xlsx';
            document.body.append(a);
            a.click();
            a.remove();
            window.URL.revokeObjectURL(url);
            location.reload();
          }
        });
      }
    })
      
    });
  });
}

function seePass(input, toggleIcon){
    $(document).ready(function(){

            $(input).on('input', function() {
                if (this.value.trim() !== '') {
                    toggleIcon.style.visibility = 'visible';
                } else {
                    toggleIcon.style.visibility = 'hidden';
                }
            });
            $(toggleIcon).on("click", function(){
                
                const type = input.getAttribute("type") === "password" ? "text" : "password";
                input.setAttribute("type", type);

                this.classList.toggle('fa-eye');
            })
        })
}

function selectSDO(){
    $(document).ready(function(){
        $('.tempAdd').on('click', function(){
            var selectedDistrict = document.getElementById("district");
            var districtToHide = selectedDistrict.querySelector("option[value='11']");

            var selectedSchool = document.getElementById("schools");
            var schoolToHide = selectedSchool.querySelector("option[value='57']");
            districtToHide.style.display = "none";
            schoolToHide.style.display = "none";
        })

        $('#SDO').on('change', function(){
            var sdoId = document.getElementById('SDO')
            var districtId = document.getElementById('district')
            var schoolId = document.getElementById('schools')

            var selectedDistrict = document.getElementById("district");
            var districtToHide = selectedDistrict.querySelector("option[value='11']");

            var selectedSchool = document.getElementById("schools");
            var schoolToHide = selectedSchool.querySelector("option[value='57']");
            
            if(sdoId.checked){
                if(sdoId.value == 'School Division Office'){
                    $.ajax({
                        type:'POST',
                        url:'../PersonalInfo/personalInfoPhp/allSchools.php',
                        data:'sdoId='+sdoId,
                        success:function(html){
                            $('#schools').html(html);
                            schoolId.value = '57';
                            districtId.value = '11';
                            districtId.disabled = true;
                            schoolId.disabled = true;
                            districtToHide.style.display = "";
                            schoolToHide.style.display = "";
                        }
                    }); 
                }
            }else{
                districtId.disabled = false;
                schoolId.disabled = false;
                districtToHide.style.display = "none";
                schoolToHide.style.display = "none";
                schoolId.value = '';
                districtId.value = '';
                
            }
        });
    });
}

// Add/Delete/Edit Administrator

// Add new admin
function addAdministrator(){
  $(document).ready(function(){
    var district = document.getElementById('district');
    var schools = document.getElementById('schools');
    var userName = document.getElementById('userName');
    var userEmail = document.getElementById('userEmail');
    var userPass = document.getElementById('userPass');
    var userConPass = document.getElementById('userConPass');

    $(document).on('click', '#registration-button', function(event) {
        event.preventDefault();
        validateInputs();
    });

    const isValidEmail = email => {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

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
    const districtValue = district.value.trim();
const schoolsValue = schools.value.trim();
const userNameValue = userName.value.trim();
const userEmailValue = userEmail.value.trim(); //first
const userPassValue = userPass.value.trim();
const userConPassValue = userConPass.value.trim();


let isValid = true;

if(userEmailValue === ''){
    setError(userEmail, 'Email is required');
    isValid = false;
    }else if(!isValidEmail(userEmailValue)){
        setError(userEmail, 'Provide valid email');
        isValid = false;
    }else{
        setSuccess(userEmail);
    }

if(districtValue === ''){
  setError(district, 'District is required');
  isValid = false;
}else{
  setSuccess(district);
}

    if(schoolsValue === ''){
  setError(schools, 'School is required');
  isValid = false;
}else{
  setSuccess(schools);
}

    if(userNameValue === ''){
  setError(userName, 'Username is required');
  isValid = false;
}else{
  setSuccess(userName);
}

    if(userPassValue === ''){
  setError(userPass, 'Password is required');
  isValid = false;
}else{
  setSuccess(userPass);
}

    if(userConPassValue === ''){
  setError(userConPass, 'Confirming password is required');
  isValid = false;
}else{
  setSuccess(userConPass);
}

if(isValid){
        $.ajax({  
            url:"addAdmin.php",  
            method:"POST", 
            data:{
                userName:userNameValue,
                userEmail:userEmailValue,
                userDistrict:districtValue,
                userSchool:schoolsValue,
                userPass:userPassValue,
                userConPass:userConPassValue,
                },
                success: function(response) {
                    if(response === 'Success'){
                        $('#editmodal').modal('hide');
                        Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Update Successfully',
                        text: 'Data has been updated',
                        showConfirmButton: false,
                        timer: 1500
                }).then(() =>{location.reload()})
                }else if(response === 'Already_Exist'){
                    userName.value = '';
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'Username already exist',
                        text: 'Please provide a unique username',
                        showConfirmButton: false,
                        timer: 1500
                });
                }else if(response === 'unmatch_password'){
                    userPass.value = '';
                    userConPass.value = '';
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'Unmatch Password',
                        text: 'Please make sure that enter two identical password',
                        showConfirmButton: false,
                        timer: 1500
                });
                }else{
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Unknown Error',
                        text: 'Data has not been updated due to unknown reason.',
                        showConfirmButton: false,
                        timer: 1500
                });
                }
                    
      }
            }) 
  
}
};
    
});
}

// Edit adminitrator
function editAdministrator(){
    $(document).ready(function(){
        $(document).on('click', '.edit-button', function() {
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
                            $('#this').html(data);
                            // $('#editmodal').modal('show');
                        }
                    }) 
        });
    });
}
// Delete Adminitrator
function deleteAdministrator(){
    $(document).ready(function(){
        $(document).on('click', '.delete-button', function(){
            var id = $(this).data('id');
                Swal.fire({
                    title : 'Are You Sure?',
                    text : 'Record will be deleted?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d5',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Delete Record',
            }).then((result) => {
                if(result.isConfirmed){
                        $.ajax({
                        url:"deleteAdmin.php",
                        method:"POST",
                        data:{id:id},
                        success: function(response){
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Record has been deleted',
                                showConfirmButton: false,
                                timer: 800
                            }).then(() =>{
                                    location.reload()})
                        }
                    })
                }else{
                    
                }
            })
        });
    });
}



function districtToSchoolDropdown(districtId, schoolId){
    $(document).ready(function(){
        $(districtId).on('change', function(){
            var districtID = $(this).val();
            if(districtID){
                $.ajax({
                    type:'POST',
                    url:'../PersonalInfo/personalInfoPhp/empSchools.php',
                    data:'districtId='+districtID,
                    success:function(html){
                        $(schoolId).html(html);
                    }
                }); 
            }else{
                $(schoolId).html('<option value="">Select district first</option>');
            }
        });
    });
}


// function editDropdown(userDistrictId, userSchoolId, fileLocation){
//     $(document).ready(function(){
//         $(userDistrictId).on('change', function(){
//             var districtID = $(this).val();
//             if(districtID){
//                 $.ajax({
//                     type:'POST',
//                     url: fileLocation,
//                     data:'districtId='+districtID,
//                     success:function(html){
//                         $(userSchoolId).html(html);
//                         console.log(districtID);
//                     }
//                 }); 
//             }else{
//                 $(userSchoolId).html('<option value="">Select district first</option>');
//             }
//         });
//     });
// }



//--------------------> Add/Change School and districts


function addDistrict(){
  $(document).ready(function(){
    var districtValue = document.getElementById('enterDistrict');

      $(document).on('click', '#addDistrict', function(event){
        event.preventDefault();
        validateInputs();
      })

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

    const districtRealValue = districtValue.value.trim();

    let isValid = true;

    if(districtRealValue === ''){
    setError(districtValue, 'District name is required');
      isValid = false;
    }else{
      setSuccess(districtValue);
    }

    if(isValid){
      $.ajax({
          url: 'addDistrict.php',
          method: 'post',
          data: {
            districtValue:districtRealValue
          },
          success: function(response) {
          if(response == 'success'){
            console.log('Data has been inserted');
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Success!',
                text: 'New district has been added',
                showConfirmButton: false,
                timer: 1500
            }).then(() =>{location.reload()})
          }else if(response == 'failed'){
            console.log('Failed attemt');
          }
        }
        })
    }
  }
})
}


function editDistrict(){
  $(document).ready(function(){
    $(document).ready(function () {
      var districtValue = document.getElementById("enterDistrictUpdate");
      var toBeUpdatedDistrict = document.getElementById("editSelectDistrict");
  
      let oldData;
      let newData;
      $(document).on("change", "#editSelectDistrict", function () {
        oldData = this.value;
        newData = document.getElementById("enterDistrictUpdate").value =
          this.value;
        console.log(newData);
      });
  
      $(document).on("click", "#edtiDistrict", function (event) {
        event.preventDefault();
        validateInputs();
      });
  
      const setError = (element, message) => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector(".error");
  
        errorDisplay.innerText = message;
        inputControl.classList.add("error");
        inputControl.classList.remove("success");
      };
  
      const setSuccess = (element) => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector(".error");
  
        errorDisplay.innerText = "";
        inputControl.classList.add("success");
        inputControl.classList.remove("error");
      };
  
      const validateInputs = () => {
        const districtRealValue = districtValue.value.trim();
        const toBeUpdatedDistrictValue = toBeUpdatedDistrict.value.trim();
  
        let isValid = true;
  
        if (districtRealValue === "") {
          setError(districtValue, "District name is required");
          isValid = false;
        } else {
          setSuccess(districtValue);
        }
  
        if (toBeUpdatedDistrictValue === "") {
          setError(toBeUpdatedDistrict, "Choosing district is required");
          isValid = false;
        } else {
          setSuccess(toBeUpdatedDistrict);
        }
  
        if (isValid) {
          let newestData = document.getElementById("enterDistrictUpdate").value;
          $.ajax({
            url: "updateData.php",
            method: "post",
            data: { oldDistrict: oldData, newDistrict: newestData },
            success: function (response) {
              console.log(response);
              if (response == "updated") {
                Swal.fire({
                  position: "center",
                  icon: "success",
                  title: "Updated Successfully",
                  text: "District has been updated",
                  showConfirmButton: false,
                  timer: 1000,
                }).then(() => {
                  location.reload();
                });
              }
            },
          });
        }
      };
    });
  })
}

function editSchool(){
  $(document).ready(function(){
    $(document).ready(function () {
      var schoolValue = document.getElementById("enterSchoolUpdate");
      var toBeUpdatedSchool = document.getElementById("editSelectSchool");
  
      let oldData;
      let newData;
      $(document).on("change", "#editSelectSchool", function () {
        oldData = this.value;
        newData = document.getElementById("enterSchoolUpdate").value =
          this.value;
        console.log(newData);
      });
  
      $(document).on("click", "#editSchool", function (event) {
        event.preventDefault();
        validateInputs();
      });
  
      const setError = (element, message) => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector(".error");
  
        errorDisplay.innerText = message;
        inputControl.classList.add("error");
        inputControl.classList.remove("success");
      };
  
      const setSuccess = (element) => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector(".error");
  
        errorDisplay.innerText = "";
        inputControl.classList.add("success");
        inputControl.classList.remove("error");
      };
  
      const validateInputs = () => {
        const schoolRealValue = schoolValue.value.trim();
        const toBeUpdatedSchoolValue = toBeUpdatedSchool.value.trim();
  
        let isValid = true;
  
        if (schoolRealValue === "") {
          setError(schoolValue, "School name is required");
          isValid = false;
        } else {
          setSuccess(schoolValue);
        }
  
        if (toBeUpdatedSchoolValue === "") {
          setError(toBeUpdatedSchool, "Choosing district is required");
          isValid = false;
        } else {
          setSuccess(toBeUpdatedSchool);
        }
  
        if (isValid) {
          let newestData = document.getElementById("enterSchoolUpdate").value;
          $.ajax({
            url: "updateData.php",
            method: "post",
            data: { oldSchool: oldData, newSchool: newestData },
            success: function (response) {
              console.log(response);
              if (response == "updated") {
                Swal.fire({
                  position: "center",
                  icon: "success",
                  title: "Updated Successfully",
                  text: "School has been updated",
                  showConfirmButton: false,
                  timer: 1000,
                }).then(() => {
                  location.reload();
                });
              }
            },
          });
        }
      };
    });
  })
}




function deleteDistrict(){
    var districtDeleteButton = document.getElementById('deleteDistrict');
    var districtDeleteId = document.getElementById('Deletedistrict').value;
        districtDeleteButton.disabled = true;

        document.getElementById('Deletedistrict').addEventListener('change', function() {
          districtDeleteId = this.value;
          console.log(districtDeleteId);
          if (districtDeleteId === "0") {
            districtDeleteButton.disabled = true;
          } else {
            districtDeleteButton.disabled = false;
          }
        });

  $(document).ready(function(){
      $(document).on('click', '#deleteDistrict', function(){
          var districtDeleteButton = document.getElementById('deleteDistrict');
          var districtDeleteId = document.getElementById('Deletedistrict').value;
          console.log(districtDeleteId);
          if(districtDeleteId === 0 || districtDeleteId < 1){
            districtDeleteButton.disabled = true;
          }else{
            districtDeleteButton.disabled = false;
          }
          Swal.fire({
                    title : 'Are You Sure?',
                    text : 'Record will be deleted?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d5',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Delete Record',
            }).then((result) => {
                if(result.isConfirmed){
                        $.ajax({
                        url:"deleteDistrict.php",
                        method:"POST",
                        data:{districtDeleteId:districtDeleteId},
                        success: function(response){
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'District has been deleted',
                                showConfirmButton: false,
                                timer: 800
                            }).then(() =>{
                                    location.reload()})
                        }
                    })
                }else{
                    
                }
            })
        })
    })
}

function addSchool(){
  $(document).ready(function(){
    var schoolValue = document.getElementById('enterSchool');
    var districtIdForSchool = document.getElementById('districtForSchool');

      $(document).on('click', '#addSchool', function(event){
        event.preventDefault();
        validateInputs();
      })

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

        const schoolRealValue = schoolValue.value.trim();
        const districtIdForSchoolRealValue = districtIdForSchool.value.trim();

        let isValid = true;

        if(schoolRealValue === ''){
        setError(schoolValue, 'School name is required');
          isValid = false;
        }else{
          setSuccess(schoolValue);
        }

        if(districtIdForSchoolRealValue === ''){
        setError(districtIdForSchool, 'Choosing district is required');
          isValid = false;
        }else{
          setSuccess(districtIdForSchool);
        }

        if(isValid){
          $.ajax({
          url: 'addSchool.php',
          method: 'post',
          data: {
            schoolValue:schoolRealValue,
            districtIdForSchool:districtIdForSchoolRealValue
          },
          success: function(response) {
          if(response == 'success'){
            console.log('Data has been inserted');
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Success!',
                text: 'New school has been added',
                showConfirmButton: false,
                timer: 1500
            }).then(() =>{location.reload()})
          }
          else if(response == 'failed'){
            console.log('Failed attemt');
          }
        }
        })
        }
      }
  })
}

function deleteSchool(){
  var schoolDeleteId = document.getElementById('deleteSchoolId').value;
  var schoolDeleteButton = document.getElementById('deleteSchool');
  schoolDeleteButton.disabled = true;
    document.getElementById('deleteSchoolId').addEventListener('change', function() {
        schoolDeleteId = this.value;
          console.log(schoolDeleteId)
          if (schoolDeleteId === "0") {
                schoolDeleteButton.disabled = true;
              } else {
                schoolDeleteButton.disabled = false;
              }
            });
  
    $(document).ready(function(){
  $(document).on('click', '#deleteSchool', function(){
            var schoolDeleteId = document.getElementById('deleteSchoolId').value;
            console.log(schoolDeleteId);
            Swal.fire({
                      title : 'Are You Sure?',
                      text : 'Record will be deleted?',
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d5',
                      confirmButtonColor: '#d33',
                      confirmButtonText: 'Delete Record',
              }).then((result) => {
                  if(result.isConfirmed){
                          $.ajax({
                          url:"deleteSchool.php",
                          method:"POST",
                          data:{schoolDeleteId:schoolDeleteId},
                          success: function(response){
                              Swal.fire({
                                  position: 'center',
                                  icon: 'success',
                                  title: 'School has been deleted',
                                  showConfirmButton: false,
                                  timer: 800
                              }).then(() =>{
                                      location.reload()})
                          }
                      })
                  }else{
                      
                  }
              })
          })
  
      })
}


// Removed error handler styles when modol is close
function errorHandlerStyleRemover(){
  if ($('#editSchoolDistrict').length > 0) {
    $('#editSchoolDistrict').on('hidden.bs.modal', function () {
        const parentElems = document.querySelectorAll('.form-group');
            parentElems.forEach((parentElem) => {
            const errorDisplay = parentElem.querySelector('.error');
                
            errorDisplay.innerText = '';
            parentElem.classList.remove('error');
            parentElem.classList.remove('success');
        });
    });
  }
}

// --------------- Update data | edit side

function updateAdministratorData(){
  $(document).ready(function(){
    var userIdEdit = document.getElementById('userIdEdit');
    var userNameEdit = document.getElementById('userNameEdit');
    var userEmailEdit = document.getElementById('userEmailEdit');
    var userDistrictEdit = document.getElementById('userDistrictEdit');
    var userSchoolsEdit = document.getElementById('userSchoolsEdit');
    var userTypeEdit = document.getElementById('userTypeEdit');
    var changePass = document.getElementById('changePass');

    $(document).on('click', '#update-button', function(event) {
        event.preventDefault();
        validateInputs();
    });

    const isValidEmail = email => {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

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
    const userIdEditValue = userIdEdit.value.trim();
const userNameEditValue = userNameEdit.value.trim();
const userEmailEditValue = userEmailEdit.value.trim();
const userDistrictEditValue = userDistrictEdit.value.trim();
const userSchoolsEditValue = userSchoolsEdit.value.trim();
const userTypeEditValue = userTypeEdit.value.trim();
const changePassValue = changePass.value.trim();


let isValid = true;

if(userEmailEditValue === ''){
    setError(userEmailEdit, 'Email is required');
    isValid = false;
    }else if(!isValidEmail(userEmailEditValue)){
        setError(userEmailEdit, 'Provide valid email');
        isValid = false;
    }else{
        setSuccess(userEmailEdit);
    }

if(userNameEditValue === ''){
  setError(userNameEdit, 'Username is required');
  isValid = false;
}else{
  setSuccess(userNameEdit);
}

    if(userDistrictEditValue === ''){
  setError(userDistrictEdit, 'District is required');
  isValid = false;
}else{
  setSuccess(userDistrictEdit);
}

    if(userSchoolsEditValue === ''){
  setError(userSchoolsEdit, 'School is required');
  isValid = false;
}else{
  setSuccess(userSchoolsEdit);
}

    if(userTypeEditValue === ''){
  setError(userTypeEdit, 'Admin type is required');
  isValid = false;
}else{
  setSuccess(userTypeEdit);
}

    if(changePassValue === '' || changePassValue !== '' ){
  setSuccess(changePass);
}


if(isValid){
        $.ajax({  
            url:"updateAdmin.php",  
            method:"POST", 
            data:{
                userId:userIdEditValue,
                userName:userNameEditValue,
                userEmail:userEmailEditValue,
                userDistrict:userDistrictEditValue,
                userSchool:userSchoolsEditValue,
                userType:userTypeEditValue,
                userNewPass:changePassValue,
                },
                success: function(response) {
                    if(response === 'Success'){
                        console.log(response);
                        $('#editmodal').modal('hide');
                        Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Update Successfully',
                        text: 'Data has been updated',
                        showConfirmButton: false,
                        timer: 1000
                }).then(() =>{location.reload()})
                }else{
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Error',
                        text: 'Update data unsuccessfully',
                        showConfirmButton: false,
                        timer: 1000
                })
                }
                    
      }
            }) 
  
}
};
    
});
}


//----------- Show password | edit side


function showPasswordEdit(){
  $(document).ready(function(){
    const toggleIcon = document.querySelector('#changePassEye');
    const passwordInput = document.querySelector('#changePass');
// Display and hides the eye icon
    $("#changePass").on('input', function() {
        if (this.value.trim() !== '') {
            toggleIcon.style.visibility = 'visible';
        } else {
            toggleIcon.style.visibility = 'hidden';
        }
    });
// Changes the input type of input-password element from password to text to reveal the entered text
    $("#changePassEye").on("click", function(){
        
        const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
        passwordInput.setAttribute("type", type);

        this.classList.toggle('fa-eye');
    })
})
}


//------------ Show shools through districts | edit side

function showDistricts(){
  $(document).ready(function(){
    $('#userDistrictEdit').on('change', function(){
        var districtID = $(this).val();
        if(districtID){
            $.ajax({
                type:'POST',
                url:'../PersonalInfo/PersonalInfoPhp/empSchools.php',
                data:'districtId='+districtID,
                success:function(html){
                    $('#userSchoolsEdit').html(html);
                    console.log(districtID);
                }
            }); 
        }else{
            $('#userSchoolsEdit').html('<option value="">Select district first</option>');
        }
    });
});
}


function showImportModalWithWarnig(){
    $(document).ready(function(){
    $(document).on('click', '#importFileBtnId', function(){
        Swal.fire({
            title : 'Warning',
            text : 'Importing new data will replace existing data. Proceed with caution?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d5',
            confirmButtonText: 'Proceed',
        }).then((result) => {
            if(result.isConfirmed){
                $('#ImportModal').modal('show');
            }
        })
    })
  })
}