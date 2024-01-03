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
    
        <?php $this->load->view('admin/includes/links'); ?>
        <style>
            a.edit, a.delete{
                font-size: 22px;
            }
        </style>
    </head>

    <body data-sidebar="dark">
        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <?php $this->load->view('admin/includes/navbar'); ?>

            <!-- ========== Left Sidebar Start ========== -->
            <?php $this->load->view('admin/includes/left_side_bar'); ?>
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
                                            <a class="btn btn-primary  dropdown-toggle" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addArea">
                                                <i class="mdi mdi-plus me-2"></i> Add Area
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

                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <td>Sno.</td>
                                                    <th>Area Name</th>
                                                    <th>District Name</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i=1; if(!empty($areas)): foreach($areas as $row): ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo htmlentities($row->area_name); ?></td>
                                                    <td><?php echo htmlentities($row->dist_name); ?></td>
                                                    <td><?php if($row->area_status == 1): echo 'Active'; else: echo 'Inactive'; endif; ?></td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="text-warning edit">
                                                            <span class="mdi mdi-lead-pencil"></span>
                                                        </a>
                                                        <a href="javascript:void(0)" class="text-danger delete">
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

                
                <?php $this->load->view('admin/includes/footer'); ?>


            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Add Area Modal -->
        <!-- The Modal -->
        <div class="modal fade" id="addArea">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Create Area</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="<?php echo base_url() ?>admin/setting/create_area" method="post">
                          <div class="mb-3 mt-3">
                            <label for="area_name" class="form-label">District <span class="text-danger">*</span></label>
                            <select name="dist_id" id="dist_id" class="form-control" parsley-type="dist_id" required>
                                <option value="" disabled selected>Select District</option>
                                <?php if(!empty($districts)): foreach($districts as $dist): ?>
                                <option value="<?php echo $dist->dist_id ?>"><?php echo $dist->dist_name ?></option>
                                <?php endforeach; endif; ?>
                            
                            </select>
                          </div>
                          <div class="mb-3 mt-3">
                            <label for="area_name" class="form-label">Area name</label>
                            <input type="text" class="form-control" id="area_name" placeholder="Enter " name="area_name" value="<?php echo set_value('area_name') ?>" required>
                            <?php echo form_error('area_name'); ?>
                          </div>
                          <button type="submit" class="btn btn-primary" name="addArea">Submit</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- Add Category Modal -->

        <!-- Right Sidebar -->
        <?php $this->load->view('admin/includes/right_side_bar'); ?>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

                             
        <!-- JAVASCRIPT -->
        <?php $this->load->view('admin/includes/scripts'); ?>

        <!-- Required datatable js -->
        <script src="<?php echo base_url() ?>assets/backend/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url() ?>assets/backend/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="<?php echo base_url() ?>assets/backend/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url() ?>assets/backend/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="<?php echo base_url() ?>assets/backend/libs/jszip/jszip.min.js"></script>
        <script src="<?php echo base_url() ?>assets/backend/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="<?php echo base_url() ?>assets/backend/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="<?php echo base_url() ?>assets/backend/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="<?php echo base_url() ?>assets/backend/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="<?php echo base_url() ?>assets/backend/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="<?php echo base_url() ?>assets/backend/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url() ?>assets/backend/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="<?php echo base_url() ?>assets/backend/js/pages/datatables.init.js"></script> 
        <script src="<?php echo base_url() ?>assets/backend/js/app.js"></script>


    </body>
</html>
