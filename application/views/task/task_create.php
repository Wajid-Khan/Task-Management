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
                                <div class="col-md-8">
                                    <h6 class="page-title"><?php echo $title; ?></h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashbaord</a></li>
                                        <li class="breadcrumb-item"><a href="<?php echo base_url() ?>taskmanagement">Task List</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                                    </ol>
                                </div>
                                
                            </div>
                        </div>
                        <!-- end page title -->
                        <form class="custom-validation" action="<?php echo base_url() ?>task/save_task" method="post" >
                            <div class="row">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- <div class="col-lg-2 col-md-2 col-sm-2 col-12">&nbsp;</div> -->
                                        <div class="col-lg-12 col-md-12 col-sm-6 col-12">

                                            <div class="row mb-3">

                                                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                                    <div class="mb-3 position_relative">
                                                        <label for="cat_id">Caterogy <span class="text-danger">*</span></label>
                                                        <i class="fa fa-caret-down"></i>
                                                        <select name="cat_id" id="cat_id" parsley-type="cat_id" class="form-control" required>
                                                            <option value="" selected disabled>Select Category</option>
                                                            <?php if(!empty($task_cat)): foreach($task_cat as $cat): ?>
                                                            <option value="<?php echo $cat->cat_id ?>" <?php echo set_select('cat_id', $cat->cat_id); ?>><?php echo $cat->cat_name ?></option>
                                                            <?php endforeach; endif; ?>
                                                        </select>
                                                        <span class="text-danger">
                                                            <?php echo form_error('cat_id'); ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                                    <div class="mb-3 position_relative">
                                                        <label for="staff_id">Staff <span class="text-danger">*</span></label>
                                                        <i class="fa fa-caret-down"></i>
                                                        <select name="staff_id" id="staff_id" parsley-type="staff_id" class="form-control" required>
                                                            <option value="" selected disabled>Select Staff</option>
                                                            <?php if(!empty($staff)): foreach($staff as $s): ?>
                                                            <option value="<?php echo $s->staff_id ?>" <?php echo set_select('staff_id', $s->staff_id); ?>><?php echo $s->fullname ?></option>
                                                            <?php endforeach; endif; ?>
                                                        </select>
                                                        <span class="text-danger">
                                                            <?php echo form_error('staff_id'); ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                                    <div class="mb-3 position_relative">
                                                        <label for="cli_id">Client <span class="text-danger">*</span></label>
                                                        <i class="fa fa-caret-down"></i>
                                                        <select name="cli_id" id="cli_id" parsley-type="cli_id" class="form-control" required>
                                                            <option value="" selected disabled>Select Client</option>
                                                            <?php if(!empty($clients)): foreach($clients as $c): ?>
                                                            <option value="<?php echo $c->cli_id ?>" <?php echo set_select('cli_id', $c->cli_id); ?>><?php echo $c->cli_name ?></option>
                                                            <?php endforeach; endif; ?>
                                                        </select>
                                                        <span class="text-danger">
                                                            <?php echo form_error('cli_id'); ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                                    <div class="mb-3 position_relative">
                                                        <label for="priority">Priority <span class="text-danger">*</span></label>
                                                        <i class="fa fa-caret-down"></i>
                                                        <select class="form-control" id="priority" name="priority" required parsley-type="priority">
                                                            <option value="" disabled selected>Select Priority</option>
                                                            <option value="High" <?php echo set_select('priority', 'High'); ?>>High</option>
                                                            <option value="Medium" <?php echo set_select('priority', 'Medium'); ?>>Medium</option>
                                                            <option value="Low" <?php echo  set_select('priority', 'Low'); ?>>Low</option>
                                                        </select>
                                                        <span class="text-danger">
                                                            <?php echo form_error('priority'); ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 col-md-8 col-sm-6 col-12">
                                                    <div class="mb-3">
                                                        <label for="task_title">Task Title <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" placeholder="Enter title" maxlength="250" required name="task_title" id="task_title" parsley-type="task_title" value="<?php echo set_value('task_title'); ?>">
                                                        <span class="text-danger">
                                                            <?php echo form_error('task_title'); ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="mb-3">
                                                        <label for="task_desc">Task Description</label>
                                                        <textarea name="task_desc" id="elm1" rows="5" class="form-control" placeholder="Desc..." ><?php set_value('task_desc'); ?></textarea>
                                                        <span class="text-danger">
                                                            <?php echo form_error('task_desc'); ?>
                                                        </span>
                                                    </div>
                                                </div>


                                            <div class="my-3">
                                                <div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1" name="save_task">
                                                        Submit
                                                    </button>
                                                </div>
                                            </div>
                                        <!-- end form -->
                                        
                                        </div> <!-- end col -->
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->   

                            </div> <!-- end row -->
                        </form>
                        
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
        <script>
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
                       document.getElementById('store_picture').value = "";
                        oInput.value = "";
                        return false;
                    }
              }
            }
        </script>

    </body>
</html>
