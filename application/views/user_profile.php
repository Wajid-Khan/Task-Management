<!DOCTYPE html>
<html lang="en">

    <head>
    
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description">
        <meta content="" name="author">
        <link href="<?php echo base_url() ?>assets/backend/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css">
        <?php $this->load->view('includes/links'); ?>
        <style>
            .position_relative{
                position: relative;
            }
            .position_relative i{
                position: absolute;
                top: 10px;
                right: 12px;
            }
        </style>
    </head>

    <body data-sidebar="dark">

       
        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <?php $this->load->view('includes/navbar'); ?>

            <!-- ========== Left Sidebar Start ========== -->
            <?php $this->load->view('includes/left_side_bar'); ?>
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <h6 class="page-title"><?php echo $title; ?></h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashbaord</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                                    </ol>
                                </div>
                                <div class="col-md-9">
                                    <div id="result"></div>
                                    <?php if($msg = $this->session->flashdata('succ')): ?>
                                        <div class="alert alert-success alert-dismissible">
                                          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                          <strong><?php echo $msg; ?></strong>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($msg = $this->session->flashdata('fail')): ?>
                                        <div class="alert alert-danger alert-dismissible">
                                          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                          <strong><?php echo $msg; ?></strong>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
 

                        <div class="row">
                    <div class="col-xl-3">
                        <div class="user-sidebar">
                            <div class="card">
                                <div class="card-body">
                                    <div class="position-relative mt-1">
                                        <div class="text-center">
                                            <div id="pro_pic"></div>

                                            <div class="mt-3">
                                                <h5 class=""><?php echo $profile->fullname; ?></h5>
                                                <div>
                                                    <?php echo strtoupper($profile->role); ?>
                                                </div>

                                                <div class="mt-4">
                                                    <input type="file" id="imageInput" style="display: none;" required onchange="imageExtensionValidate(this)">
                                                    <button  class="btn btn-primary waves-effect waves-light btn-sm" id="openFileInput">Choose Image</button >
                                                    <button type="button" id="saveButton" class="btn btn-primary waves-effect waves-light btn-sm" >Upload</button>
                                                </div>
                                                <div id="imagePreview"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div> <!-- end card body -->
                            </div> <!-- end card -->
                        </div>
                    </div>

                    <div class="col-xl-9">
                        <div class="card">
                            <div class="card-body">
                                <form class="custom-validation" action="<?php echo base_url() ?>profile/update_user" method="post" >
                            <div class="row">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- <div class="col-lg-2 col-md-2 col-sm-2 col-12">&nbsp;</div> -->
                                        <div class="col-lg-12 col-md-12 col-sm-6 col-12">

                                <div class="row mb-3">

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label for="fullname">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter title" maxlength="250" required name="fullname" id="fullname" parsley-type="fullname" value="<?php echo $profile->fullname; ?>">
                                            <span class="text-danger">
                                                <?php echo form_error('fullname'); ?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label for="email">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" placeholder="Enter email" maxlength="50" required name="email" id="email" parsley-type="email" value="<?php echo $profile->email; ?>">
                                            <span class="text-danger">
                                                <?php echo form_error('email'); ?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label for="phone">Phone <span class="text-danger">*</span></label>
                                            <input type="phone" class="form-control" placeholder="Enter phone" maxlength="50" required name="phone" id="phone" parsley-type="phone" value="<?php echo $profile->phone; ?>">
                                            <span class="text-danger">
                                                <?php echo form_error('phone'); ?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label for="password">New Password </label>
                                            <input type="text" class="form-control" placeholder="Enter password" maxlength="20" name="password" id="password" value="<?php echo set_value('password'); ?>" >
                                            <span class="text-danger">
                                                <?php echo form_error('password'); ?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="mb-3">
                                            <label for="about">About me <span class="text-danger">*</span></label>
                                            <textarea class="form-control" placeholder="Enter about" maxlength="1000" required name="about" id="about" parsley-type="about" rows="4"><?php echo $profile->about; ?></textarea>
                                            <span class="text-danger">
                                                <?php echo form_error('about'); ?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="my-3">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1" name="update_profile">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                <!-- end form -->

                                </div> <!-- end col -->
                                        
                                        </div> <!-- end col -->
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->   

                            </div> <!-- end row -->
                        </form>
                            </div>
                        </div>
                    </div>
                </div>
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                
                <?php $this->load->view('includes/footer'); ?>

            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        <?php $this->load->view('includes/right_side_bar'); ?>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <?php $this->load->view('includes/scripts'); ?>

        <script src="<?php echo base_url() ?>assets/backend/libs/parsleyjs/parsley.min.js"></script>
        <script src="<?php echo base_url() ?>assets/backend/js/pages/form-validation.init.js"></script>
        <script src="<?php echo base_url() ?>assets/backend/libs/dropzone/min/dropzone.min.js"></script>
        <script src="<?php echo base_url() ?>assets/backend/js/app.js"></script>
        <script src="<?php echo base_url() ?>assets/backend/libs/tinymce/tinymce.min.js"></script>
        <script src="<?php echo base_url() ?>assets/backend/js/pages/form-editor.init.js"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.3/jquery.validate.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
        <script>
        $(document).ready(function() {
            getProfilePicture();
            // Open file input when the button is clicked
            $("#openFileInput").click(function () {
                $("#imageInput").click();
            });

            // Display selected image preview
            $("#imageInput").change(function () {
                readURL(this);
            });

            // Save button click event
            $("#saveButton").click(function () {
                var file = $("#imageInput").val();
                if(file) {
                    uploadImage();
                } else {
                    alert('Please choose file...')
                }
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("#imagePreview").html('<img src="' + e.target.result + '" width="150" height="150" />');
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        });
        function imageExtensionValidate(i) {
          var validFileExtensions = ["jpg","jpeg","png"];    
          var fileVal = i.value;
          // alert(i.value);
          if (fileVal.length > 0) {
             var blnValid = false;
              for (var j = 0; j < validFileExtensions.length; j++) {
                 var sCurExtension = validFileExtensions[j];
             if (fileVal.substr(fileVal.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }
                     
              if (!blnValid) {
                   alert("Sorry, uploaded file is invalid, allowed extensions is: " + validFileExtensions.join(", ")+' only');
                   document.getElementById('imageInput').value = "";
                    oInput.value = "";
                    return false;
                }
          }
        }
        function uploadImage() {
            var formData = new FormData();
            formData.append('profile_picture', $('#imageInput')[0].files[0]);
            // console.log(formData);return false;
            $.ajax({
                url: '<?php echo base_url() ?>profile/upload_user_image', // Change this to the actual URL
                type: 'POST',
                data: formData,
                dataType:'json',
                processData: false,
                contentType: false,
                success: function (resp) {
                    if(resp.status === 'success') {
                        $("#imagePreview").html('');
                        $('#result').html('<div class="alert alert-success alert-dismissible"><button type="button" class="btn-close" data-bs-dismiss="alert"></button>'+resp.message+'</div>');
                        getProfilePicture();
                    } else {
                        $("#imagePreview").html('');
                        $('#result').html('<div class="alert alert-danger alert-dismissible"><button type="button" class="btn-close" data-bs-dismiss="alert"></button>'+resp.message+'</div>');
                        getProfilePicture();
                    }
                    
                    // Handle the response as needed
                },
                error: function (error) {
                    console.log(error);
                    // Handle errors
                }
            });
        }
        function getProfilePicture()
        {
            $.ajax({
                url : '<?php echo base_url() ?>profile/display_profile_picture',
                type: 'get',
                dataType: 'json',
                success:function(resp){
                    var html = '<img src="<?php echo base_url() ?>uploads/profile/'+resp.profile+'" alt="'+resp.profile+'" class="avatar-xl rounded-circle img-thumbnail" >';
                    $('#pro_pic').html(html);
                }
            });
        }
        </script>

    </body>
</html>
