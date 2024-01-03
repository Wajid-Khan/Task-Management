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
                                        <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                                    </ol>
                                </div>
                                <?php if($user->role !== 'user'): ?>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <a class="btn btn-primary  dropdown-toggle" href="<?php echo base_url() ?>task/create">
                                                <i class="mdi mdi-plus"></i> Add Task
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- end page title -->
                        <form class="custom-validation" id="searchForm" >
                            <div class="row">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="col-lg-12 col-md-12 col-sm-6 col-12">

                                            <div class="row mb-3">

                                                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                                    <div class="mb-3 position_relative">
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
                                                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                                    <div class="mb-3 position_relative">
                                                        <i class="fa fa-caret-down"></i>
                                                        <select class="form-control" id="priority" name="priority" parsley-type="priority">
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
                                                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                                    <button type="button" class="btn btn-primary waves-effect waves-light me-1 searchBtn" name="save_task">
                                                        <i class="fa fa-search"></i> Search
                                                    </button>
                                                    <button type="button" class="btn btn-primary waves-effect waves-light me-1 clearText" name="save_task">
                                                        <i class="fa fa-eraser"></i> Clear
                                                    </button>
                                                </div>
                                            <!-- end form -->
                                        
                                        </div> <!-- end col -->
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->   

                                </div> <!-- end row -->
                            </div> <!-- end row -->
                        </form>
                        
                        <div class="row">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-lg-12 col-md-12 col-sm-6 col-12">
                                        <div>
                                            <!-- Search results will be displayed here -->
                                            <table id="datatable" class="table">
                                              <thead>
                                                <tr>
                                                  <th scope="col">Client</th>
                                                  <th scope="col">Title</th>
                                                  <th scope="col">Priority</th>
                                                  <th scope="col">Status</th>
                                                  <th scope="col">Create At</th>
                                                  <th scope="col">Actions</th>
                                                </tr>
                                              </thead>
                                              <tbody id="searchResults">
                                              </tbody>
                                            </table>
                                        </div>
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
        <script>
            $(document).ready(function(){
                $('.searchBtn').on('click', function() {
                    var c = $('#cli_id').val();
                    var s = $('#staff_id').val();
                    var p = $('#priority').val();
                    if(c != null || s != null || p != null){
                        if(c == null)
                        {
                            alert('Please select the client');
                        }
                        else
                        {
                            // Perform AJAX request
                            $.ajax({
                                url: '<?php echo base_url("task/search_staff_tasks"); ?>',
                                type: 'POST',
                                dataType:'json',
                                data: $('#searchForm').serialize(),
                                success: function(response) {
                                    $('#searchResults').html(response);
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            });
                        }
                        
                    } else {
                        alert('Please select the client');
                    }
                });
                $('.clearText').on('click', function(){
                    // Reset the dropdowns to their default values
                    $('#cli_id').val('');
                    $('#staff_id').val('');
                    $('#priority').val('');
                });
            });
        </script>
    </body>
</html>
