<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
    
        <!-- DataTables -->
        <link href="<?php echo base_url() ?>assets/backend/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url() ?>assets/backend/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
        <!-- Responsive datatable examples -->
        <link href="<?php echo base_url() ?>assets/backend/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
    
        <?php $this->load->view('includes/links'); ?>
        <style>
            a.edit, a.delete{
                font-size: 22px;
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
                                <div class="col-md-8">
                                    <h6 class="page-title"><?php echo $title; ?></h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?php base_url() ?>dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="<?php base_url('staff'); ?>">Staff</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <a class="btn btn-primary" href="<?php echo base_url() ?>staff" >
                                                <i class="mdi mdi-arrow-left me-2"></i> Back
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
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

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <form action="<?php echo base_url() ?>staff/save_staff" method="post" id="myform">
                                            <div class="row">

                                                <!-- Full name -->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label 
                                                            for="fullname">Full Name 
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input 
                                                            type="text" 
                                                            name="fullname" 
                                                            id="fullname" 
                                                            class="form-control" 
                                                            placeholder="Enter name" 
                                                            required 
                                                            value="<?php echo set_value('fullname'); ?>">
                                                        <span class="text-danger" >
                                                            <?php echo form_error('fullname'); ?>
                                                        </span>
                                                    </div>
                                                </div>

                                                <!-- Email -->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label 
                                                            for="email">Email 
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input 
                                                            type="text" 
                                                            name="email" 
                                                            id="email" 
                                                            class="form-control" 
                                                            placeholder="Enter email" 
                                                            value="<?php echo set_value('email'); ?>" 
                                                            required>
                                                        <span class="text-danger" >
                                                            <?php echo form_error('email'); ?>
                                                        </span>
                                                    </div>
                                                </div>

                                                <!-- Phone -->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label 
                                                            for="phone">Phone 
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <input 
                                                            type="text" 
                                                            name="phone" 
                                                            id="phone" 
                                                            class="form-control" 
                                                            placeholder="Enter phone" 
                                                            value="<?php echo set_value('phone'); ?>" 
                                                            required>
                                                        <span class="text-danger" ><?php echo form_error('phone'); ?></span>
                                                    </div>
                                                </div>

                                                <!-- Password -->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="password" class="d-flex justify-content-between">
                                                            <span>
                                                                <span>Password</span> 
                                                                <span class="text-danger">*</span>
                                                            </span>  
                                                            <span>
                                                                <a href="javascript:void(0)" class="float-end text-decoration-underline" id="getPass"><i class="fas fa-recycle"></i> Generate Password</a>
                                                            </span>
                                                        </label>
                                                        <input 
                                                            type="text" 
                                                            name="password" 
                                                            id="password" 
                                                            class="form-control" 
                                                            placeholder="Enter password" 
                                                            value="<?php echo set_value('password'); ?>" required>
                                                        <span class="text-danger" ><?php echo form_error('password'); ?></span>
                                                    </div>
                                                </div>

                                                <!-- Role -->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label 
                                                            for="role_id">Role 
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select 
                                                            name="role_id" 
                                                            id="role_id" 
                                                            class="form-control" 
                                                            required>
                                                            <option value="" disabled selected>Please select</option>
                                                            <?php if(!empty($roles)): foreach($roles as $role): ?>
                                                            <option value="<?php echo $role->role_id; ?>" <?php echo set_select('role_id', $role->role_id); ?>><?php echo $role->role_name; ?></option>
                                                            <?php endforeach; endif; ?>
                                                        </select>
                                                        <?php echo form_error('role_id'); ?></span>
                                                    </div>
                                                </div>

                                                <!-- Status -->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label 
                                                            for="mem_fullname">Status 
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select 
                                                            name="status" 
                                                            id="status_id" 
                                                            class="form-control" 
                                                            required>
                                                            <option value="" disabled selected>Please select</option>
                                                            <option value="Active" <?php echo set_select('status', 'Active'); ?>>Active</option>
                                                            <option value="Inactive" <?php echo set_select('status', 'Inactive'); ?>>Inactive</option>
                                                        </select>
                                                        <?php echo form_error('status'); ?></span>
                                                    </div>
                                                </div>

                                                <!-- About staff -->
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label 
                                                            for="about">About Staff (optional)
                                                        </label>
                                                        <textarea class="form-control" name="about" id="about" placeholder="Brief..."><?php echo set_value('about'); ?></textarea>
                                                    </div>
                                                </div>
                                                
                                                <!-- Submit button -->
                                                <div class="col-12">
                                                    <input 
                                                        type="submit" 
                                                        value="Save" 
                                                        class="btn btn-primary ">
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
                <?php $this->load->view('includes/footer'); ?>


            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->
                             
        <!-- JAVASCRIPT -->
        <?php $this->load->view('includes/scripts'); ?>

        <!-- Required datatable js -->
        <script src="<?php echo base_url() ?>assets/backend/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url() ?>assets/backend/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Responsive examples -->
        <script src="<?php echo base_url() ?>assets/backend/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url() ?>assets/backend/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
        <script>
            $(document).ready(function(){
                generate_password()
                $('.delete').click(function(){
                    var conf = confirm("Do you want to delete this category?");
                    if(conf == false)
                    {
                        return false;
                    }
                });
                $('#getPass').click(function(){
                    generate_password();
                });
                $("#myform").validate({
                    submitHandler: function(form) {
                        $(form).submit();
                    }
                });
            });
            function generate_password()
            {
                $.ajax({
                    url : '<?php echo base_url() ?>staff/randomPassword',
                    type: 'get',
                    success:function(data){
                        $('#password').val(data);
                    }
                });
            }
            
        </script>
        <!-- Datatable init js -->
        <script src="<?php echo base_url() ?>assets/backend/js/pages/datatables.init.js"></script> 
        <script src="<?php echo base_url() ?>assets/backend/js/app.js"></script>
    </body>
</html>
