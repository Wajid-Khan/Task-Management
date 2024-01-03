<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <title><?php echo $title; ?> </title>
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
                                <h5 class="text-white font-size-20"><?php echo $title; ?></h5>
                                <!-- <p class="text-white-50">Sign in to continue to Task Management</p> -->
                                <a href="<?php echo base_url() ?>" class="logo logo-admin">
                                    <img src="<?php echo base_url() ?>assets/backend/images/logo-sm.png" height="24" alt="logo">
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-4" id="sign_in_form">
                            <div class="p-3">
                                    
                                <form class="mt-4" method="post" action="<?php echo base_url() ?>forgetpassword/check_email_exists">

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
                                    <?php $this->session->unset_userdata ( 'pwd' ); } 
                                         if ($this->session->flashdata ( 'succ' )) { ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                            <strong><?php echo $this->session->flashdata('succ'); ?></strong>
                                        </div>
                                    <?php $this->session->unset_userdata ( 'succ' ); } 
                                    if ($this->session->flashdata ( 'fail' )) { ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                            <strong><?php echo $this->session->flashdata('fail'); ?></strong>
                                        </div>
                                    <?php } ?>

                                    <div class="mb-3 relative">
                                        <label class="form-label" for="role">Role</label>
                                        <i class="fa fa-caret-down absolute"></i>
                                        <select class="form-control" id="role" name="role" required>
                                            <option value="" disabled selected>Select</option>
                                            <option <?php echo set_select('role', 'admin'); ?> value="admin">Admin</option>
                                            <option <?php echo set_select('role', 'user'); ?> value="user">User</option>
                                        </select>
                                        <?php echo form_error('role'); ?>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required value="<?php echo set_value('email'); ?>">
                                        <?php echo form_error('email'); ?>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-end">
                                            <button class="btn btn-primary btn-block w-md waves-effect waves-light" type="submit">Submit</button>
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
    <script>

    </script>
</body>

</html>