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
            .pad_65_font_13{
                padding: 6px 5px;
                font-size: 13px;
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
                                        <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <a class="btn btn-primary  dropdown-toggle" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addRole">
                                                <i class="mdi mdi-plus me-2"></i> Add Role
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

                        <?php if($msg = $this->session->flashdata('warn')): ?>
                        <div class="alert alert-warning alert-dismissible">
                          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                          <strong><?php echo $msg; ?></strong>
                        </div>
                        <?php endif; ?>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <td>Sno.</td>
                                                    <th>Role name</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i=1; if(!empty($roles)): foreach($roles as $row): ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row->role_name; ?></td>
                                                    <td><?php echo $row->role_status; ?></td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="text-warning edit" role="<?php echo $row->role_name ?>" role_id="<?php echo $row->role_id ?>" role_status="<?php echo $row->role_status ?>">
                                                            <span class="mdi mdi-lead-pencil"></span>
                                                        </a>
                                                        <a href="<?php echo base_url('roles/delete/') . base64_encode($row->role_id); ?>" class="text-danger delete">
                                                            <span class="mdi mdi-delete-forever"></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php $i++; endforeach; endif; ?>
                                            </tbody>
                                        </table>

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

        <!-- Add Category Modal -->
        <!-- The Modal -->
        <div class="modal fade" id="addRole">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Create Role</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                        <span id="success_message"></span>
                        <form action="<?php echo base_url() ?>roles/create" method="post" id="add_role">
                          <div class="mb-3 mt-3">
                            <label for="role_name" class="form-label">Role name</label>
                            <input type="text" class="form-control" id="role_name" placeholder="Enter role" name="role_name" >
                            <span id="name_error" class="text-danger"></span>
                          </div>
                          <button type="submit" class="btn btn-primary" id="submit_btn" name="addRole">Submit</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- Add Category Modal -->

        <!-- Edit Category Modal -->
        <div class="modal fade" id="editTaskCat">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Role</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <span id="success_message_edit"></span>
                        <form id="edit_role">
                          <div class="mb-3 mt-3">
                            <label for="role_name" class="form-label">Role name</label>
                            <input type="text" class="form-control" id="role_name_edit" placeholder="Enter Role" name="role_name" >
                            <span id="name_error_edit" class="text-danger"></span>
                          </div>
                          <div class="mb-3 mt-3">
                            <span id="selectTag"></span>
                            <span id="status_error_edit" class="text-danger"></span>
                          </div>
                          <input type="hidden" name="role_id" id="role_id_edit">
                          <button type="submit" class="btn btn-primary" id="update_btn">Update</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- Edit Category Modal -->
                             
        <!-- JAVASCRIPT -->
        <?php $this->load->view('includes/scripts'); ?>

        <!-- Required datatable js -->
        <script src="<?php echo base_url() ?>assets/backend/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url() ?>assets/backend/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Responsive examples -->
        <script src="<?php echo base_url() ?>assets/backend/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url() ?>assets/backend/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <script>
            $(document).ready(function(){
                $('.delete').click(function(){
                    var conf = confirm("Do you want to delete this category?");
                    if(conf == false)
                    {
                        return false;
                    }
                });
                $('.edit').click(function(){
                    var role_name = $(this).attr('role');
                    var role_id = $(this).attr('role_id');
                    var role_status = $(this).attr('role_status');
                    // var option = getSelectTag(cat_status);

                    var select1 = '<label for="role_name" class="form-label">Role Status</label><select class="form-control" name="role_status" id="role_status" required><option selected disabled value="">Select status</option><option value="Active" selected>Active</option><option value="Inactive">Inactive</option>';

                    var select2 = '<label for="role_name" class="form-label">Category Status</label><select class="form-control" name="role_status" id="role_status" required><option selected disabled value="">Select status</option><option value="Active">Active</option><option value="Inactive" selected>Inactive</option></select>';

                    if(role_status === 'Active')
                    {
                        $('#selectTag').html(select1);
                    }
                    else
                    {
                        $('#selectTag').html(select2);
                    }
                    
                    $('#role_name_edit').val(role_name);
                    $('#role_id_edit').val(role_id);
                    $('#editTaskCat').modal('show');
                });
            });

        </script>
        <!-- Datatable init js -->
        <script src="<?php echo base_url() ?>assets/backend/js/pages/datatables.init.js"></script> 
        <script src="<?php echo base_url() ?>assets/backend/js/app.js"></script>
        <script>
            $(document).ready(function(){
                $('#add_role').on("submit", function(e){
                    e.preventDefault();
                    $.ajax({
                    url:"<?php echo base_url(); ?>roles/create",
                    method:"POST",
                    data:$(this).serialize(),
                    dataType:"json",
                    beforeSend:function(){
                        $('#submit_btn').attr('disabled', 'disabled');
                    },
                    success:function(data)
                    {
                        if(data.error)
                        {
                            if(data.name_error != '')
                            {
                                $('#name_error').html(data.name_error);
                            }
                            else
                            {
                                $('#name_error').html('');
                            }
                        }
                        if(data.message)
                        {
                            $('#success_message').html(data.message);
                            $('#role_name').val('');
                            $('#name_error').html('');
                            var timeleft = 5;
                            var downloadTimer = setInterval(function(){
                            timeleft--;
                            document.getElementById("countdowntimer").textContent = timeleft;
                            if(timeleft <= 0)
                                clearInterval(downloadTimer);
                            },1000);
                            setTimeout(function(){location.reload();}, 5000);
                        }
                        $('#submit_btn').attr('disabled', false);
                    }
                    })
                })
                $('#edit_role').on("submit", function(e){
                    e.preventDefault();
                    $.ajax({
                    url:"<?php echo base_url(); ?>roles/update",
                    method:"POST",
                    data:$(this).serialize(),
                    dataType:"json",
                    beforeSend:function(){
                        $('#update_btn').attr('disabled', 'disabled');
                    },
                    success:function(data)
                    {
                        console.log(data);
                        if(data.error)
                        {
                            if(data.name_error != '')
                            {
                                $('#name_error_edit').html(data.name_error);
                            }
                            else
                            {
                                $('#name_error_edit').html('');
                            }
                            if(data.status_error != '')
                            {
                                $('#status_error_edit').html(data.status_error);
                            }
                            else
                            {
                                $('#status_error_edit').html('');
                            }
                        }
                        if(data.message)
                        {
                            $('#success_message_edit').html(data.message);
                            var timeleft = 5;
                            var downloadTimer = setInterval(function(){
                            timeleft--;
                            document.getElementById("countdowntimer").textContent = timeleft;
                            if(timeleft <= 0)
                                clearInterval(downloadTimer);
                            },1000);
                            setTimeout(function(){location.reload();}, 5000);
                        }
                        $('#update_btn').attr('disabled', false);
                    }
                    })
                })
            });
        </script>
    </body>
</html>
