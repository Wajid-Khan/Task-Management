<?php  
$this->load->view('custom_functions');
$obj = new DatabaseClass;

?>
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
                                        <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <a class="btn btn-primary" href="<?php echo base_url() ?>staff/create" >
                                                <i class="mdi mdi-plus me-2"></i> Add Staff
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
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Role</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i=1; if(!empty($staff)): foreach($staff as $row): ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row->fullname; ?></td>
                                                    <td><?php echo $row->email; ?></td>
                                                    <td><?php echo $row->phone; ?></td>
                                                    <td><?php echo $obj->get_role_name($row->role_id); ?></td>
                                                    <td><?php echo $row->status; ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url('staff/edit/') . base64_encode($row->staff_id); ?>" class="text-warning edit" >
                                                            <span class="mdi mdi-lead-pencil"></span>
                                                        </a>
                                                        <a href="<?php echo base_url('staff/delete/') . base64_encode($row->staff_id); ?>" class="text-danger delete">
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
        <div class="modal fade" id="addTaskCat">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Create Category</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="<?php echo base_url() ?>taskmanagement/tast_category_create" method="post">
                          <div class="mb-3 mt-3">
                            <label for="task_cat_name" class="form-label">Category name</label>
                            <input type="text" class="form-control" id="task_cat_name" placeholder="Enter category" name="task_cat_name" value="<?php echo set_value('task_cat_name') ?>" required>
                            <?php echo form_error('task_cat_name'); ?>
                          </div>
                          <button type="submit" class="btn btn-primary" name="addTaskCat">Submit</button>
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
                        <h4 class="modal-title">Edit Category</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="<?php echo base_url() ?>taskmanagement/tast_category_update" method="post">
                          <div class="mb-3 mt-3">
                            <label for="task_cat_name" class="form-label">Category name</label>
                            <input type="text" class="form-control" id="task_cat_name_1" placeholder="Enter category" name="task_cat_name_1" value="<?php echo set_value('task_cat_name_1') ?>" required>
                            <?php echo form_error('task_cat_name_1'); ?>
                          </div>
                          <div class="mb-3 mt-3" id="selectTag">
                            <?php echo form_error('task_cat_status_1'); ?>
                          </div>
                          <input type="hidden" name="task_cat_id" id="task_cat_id">
                          <button type="submit" class="btn btn-primary" name="editTaskCat">Update</button>
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
            });

        </script>
        <!-- Datatable init js -->
        <script src="<?php echo base_url() ?>assets/backend/js/pages/datatables.init.js"></script> 
        <script src="<?php echo base_url() ?>assets/backend/js/app.js"></script>
    </body>
</html>
