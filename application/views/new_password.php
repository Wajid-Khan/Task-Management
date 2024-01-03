<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <title>Login </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        
        <?php $this->load->view('includes/links'); ?> 
        <style>
            .relative{
                position: relative;
            }
            .absolute{
                position: absolute;
                top: 38px;
                right: 10px;
            }
            .error, #errorMessages{
                font-size: 14px;
                color: red;
                margin-bottom: 15px;
            }
        </style>
    </head>

<body>

    <!-- <div class="home-btn d-none d-sm-block">
        <a href="index.html" class="text-dark"><i class="fas fa-home h2"></i></a>
    </div> -->
    <div class="account-pages my-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="card overflow-hidden">
                        <div class="bg-primary">
                            <div class="text-primary text-center p-4">
                                <h5 class="text-white font-size-20">Update New Password</h5>
                                <!-- <p class="text-white-50">Sign in to continue to Task Management</p> -->
                                <a href="<?php echo base_url() ?>" class="logo logo-admin">
                                    <img src="<?php echo base_url() ?>assets/backend/images/logo-sm.png" height="24" alt="logo">
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-4" id="sign_in_form">
                            <div class="p-3">
                                    
                                <form class="mt-4" id="updatePasswordForm">
                                    <!-- Display Errors -->
                                    <div id="errorMessages"></div>
                                    <?php if ($this->session->flashdata ( 'email' )) { ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                            <strong><?php echo $this->session->flashdata('email'); ?></strong>
                                        </div>
                                    <?php $this->session->unset_userdata ( 'email' ); 
                                    } else if ($this->session->flashdata ( 'pwd' )) { ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                            <strong><?php echo $this->session->flashdata('pwd'); ?></strong>
                                        </div>
                                    <?php $this->session->unset_userdata ( 'pwd' ); } ?>
                                    <?php if ($this->session->flashdata ( 'succ' )) { ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                            <strong><?php echo $this->session->flashdata('succ'); ?></strong>
                                        </div>
                                    <?php $this->session->unset_userdata ( 'succ' ); 
                                    } ?>

                                    <input type="hidden" name="role" id="role" value="<?php echo base64_decode($_GET['role']); ?>">
                                    <input type="hidden" name="email" id="email" value="<?php echo base64_decode($_GET['email']); ?>">

                                    <div class="mb-3">
                                        <label class="form-label" for="newPassword">New Password</label>
                                        <input type="password" class="form-control" id="newPassword" name="newPassword" maxlength="20" placeholder="Enter new password" required value="<?php echo set_value('newPassword'); ?>">
                                        <?php echo form_error('newPassword'); ?>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="confirmPassword">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" maxlength="20" placeholder="Enter confirm password" required value="<?php echo set_value('confirmPassword'); ?>">
                                        <?php echo form_error('confirmPassword'); ?>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-end">
                                            <button class="btn btn-primary btn-block w-md waves-effect waves-light" id="updatePasswordBtn" type="button">Update Password</button>
                                        </div>
                                    </div>

                                    <div class="mt-2 mb-0 row">
                                        <div class="col-12 mt-4">
                                            <div class="d-flex justify-content-between">
                                                <a href="<?php echo base_url() ?>/login"><i class="mdi mdi-lock"></i> Login?</a>
                                                <a href="pages-register.html" class="fw-medium text-primary"> </a>
                                            </div>
                                                
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                        
                    </div>

                    <div class="mt-3 text-center">
                        <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Task Management. Developed by <b>Wajid Khan</b></p>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('includes/scripts'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function () {
            // Add validation rules to the form fields
            $("#updatePasswordForm").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    role: {
                        required: true
                    },
                    newPassword: {
                        required: true,
                        minlength: 6 // Adjust the minimum length as needed
                    },
                    confirmPassword: {
                        required: true,
                        equalTo: "#newPassword"
                    }
                },
                messages: {
                    confirmPassword: {
                        equalTo: "Passwords do not match."
                    }
                }
            });

            // Handle form submission using AJAX
            $("#updatePasswordBtn").click(function () {
                if ($("#updatePasswordForm").valid()) {
                    // Form is valid, proceed with AJAX submission
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('forgetpassword/update_new_password') ?>",
                        data: $("#updatePasswordForm").serialize(),
                        dataType:'json',
                        success: function (resp) {
                            if(resp.status === 'success') {
                                alert('New password has been updated...');
                                window.location = '<?php echo base_url() ?>login';
                            } else {
                                $('#errorMessages').html(response.message);
                            }
                            
                        },
                        error: function (xhr, status, error) {
                            // Handle error response
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>