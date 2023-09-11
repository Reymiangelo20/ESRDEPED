<div class="modal fade" id="ImportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Import Excel File </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <div class="import-container">
                                <div class="personalinfo-import-div">
                                    <!-- Import personal info -->
                                    <form id="personalform" action="importPersonaInfo.php" method="post" enctype="multipart/form-data">
                                        <label for="import-personal-file" class="import-file-label" id="personalInfoLabel">
                                        <i class="fa-solid fa-file-arrow-up"></i>
                                            Personal Information
                                            <input type="file" name="import-file" id="import-personal-file">
                                        </label>
                                        <button type="submit" name="save-excel-data">
                                            <i class="fa-solid fa-file-export"></i> 
                                            Import
                                        </button>
                                    </form>
                                </div>
                                <div class="servicerecord-import-div">
                                    <!-- Import service record -->
                                        <form id="serviceForm" action="ImportServiceRecord.php" method="post" enctype="multipart/form-data">
                                            <label for="import-service-file" class="import-file-label"  id="serviceRecordLabel">
                                            <i class="fa-solid fa-file-arrow-up"></i>
                                                Service Record
                                                <input type="file" name="import-file" id="import-service-file">
                                            </label>
                                            <button type="submit" name="save-excel-data">
                                                <i class="fa-solid fa-file-export"></i> 
                                                Import
                                            </button>
                                        </form>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" id="registration-button" name="register" value="Register">
                        </div> -->
                </div>
            </div>
        </div>

<script>

// $('#import-personal-file').change(function() {
//     var file = $(this).val().split('\\').pop();
//     if (file) {
//         $('#personalInfoLabel').text(file);
//     }
// });

// $('#import-service-file').change(function() {
//     var file = $(this).val().split('\\').pop();
//     if (file) {
//         $('#serviceRecordLabel').text(file);
//     }
// });

$(document).ready(function (e) {
 $("#serviceForm").on('submit',(function(e) {
  e.preventDefault();
  $('.spinner-export').css('visibility', 'visible');
  $.ajax({
         url: "ImportServiceRecord.php",
   type: "POST",
   data:  new FormData(this),
   contentType: false,
         cache: false,
   processData:false,
   success: function(data)
    {
        console.log(data);
        $('.spinner-export').css('visibility', 'hidden');
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Import success',
            text: 'Data has been imported successfully!',
            showConfirmButton: false,
            timer: 2000
        }).then(() =>{location.reload()})
    },
     error: function(e) 
      {
        alert('Error');
      }          
    });
 }));
});

$(document).ready(function (e) {
 $("#personalform").on('submit',(function(e) {
  e.preventDefault();
  $('.spinner-export').css('visibility', 'visible');
  $.ajax({
         url: "importPersonaInfo.php",
   type: "POST",
   data:  new FormData(this),
   contentType: false,
         cache: false,
   processData:false,
   success: function(data)
    {
        $('.spinner-export').css('visibility', 'hidden');
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Import success',
            text: 'Data has been imported successfully!',
            showConfirmButton: false,
            timer: 2000
        }).then(() =>{location.reload()})
    },
     error: function(e) 
      {
        alert('Error');
      }          
    });
 }));
});

</script>