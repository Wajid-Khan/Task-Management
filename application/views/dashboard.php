<!doctype html>
<html lang="en">

    <head>
    
        <meta charset="utf-8">
        <title><?php echo TITLE; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <!-- App favicon -->
        
    
        <link href="<?php echo base_url() ?>assets/libs/chartist/chartist.min.css" rel="stylesheet">
        <?php $this->load->view('includes/links'); ?>
    
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
                                    <h6 class="page-title">Dashboard</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item active">Welcome to <?php echo TITLE; ?></li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-2">
                                            <div class="float-start mini-stat-img me-4">
                                                <i class="fa fa-tasks h2" style="position: relative;top: 8px;"></i>
                                            </div>
                                            <h5 class="font-size-16 text-uppercase text-white-50">Tasks</h5>
                                            <?php if($role === 'admin'): ?>
                                            <h4 class="fw-medium font-size-24"><?php echo $task_count; ?></h4>
                                            <?php else: ?>
                                            <h4 class="fw-medium font-size-24"><?php echo $single_staff_task; ?></h4>
                                            <?php endif; ?>
                                        </div>
                                        <div class="pt-0">
                                            <div class="float-end">
                                                <a href="<?php echo base_url() ?>task/today" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>

                                            <p class="text-white-50 mb-0">
                                                <a href="<?php echo base_url() ?>task/today" class="text-white-50">View more </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Category count -->
                            <?php if($role === 'admin'): ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-2">
                                            <div class="float-start mini-stat-img me-4">
                                                <i class="ti-view-grid h2" style="position: relative;top: 8px;"></i>
                                            </div>
                                            <h5 class="font-size-16 text-uppercase text-white-50">Category</h5>
                                            <h4 class="fw-medium font-size-24"><?php echo $category_count; ?></h4>
                                        </div>
                                        <div class="pt-0">
                                            <div class="float-end">
                                                <a href="<?php echo base_url() ?>category" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>

                                            <p class="text-white-50 mb-0">
                                                <a href="<?php echo base_url() ?>category" class="text-white-50">View more </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Client count -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-2">
                                            <div class="float-start mini-stat-img me-4">
                                                <i class="fas fa-user-tie h2" style="position: relative;top: 8px;"></i>
                                            </div>
                                            <h5 class="font-size-16 text-uppercase text-white-50">Clients</h5>
                                            <h4 class="fw-medium font-size-24"><?php echo $client_count; ?> </h4>
                                        </div>
                                        <div class="pt-0">
                                            <div class="float-end">
                                                <a href="<?php echo base_url() ?>clients" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>

                                            <p class="text-white-50 mb-0">
                                                <a href="<?php echo base_url() ?>clients" class="text-white-50">View more </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Role count -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-2">
                                            <div class="float-start mini-stat-img me-4">
                                                <i class="fas fa-tags h2" style="position: relative;top: 7px;"></i>
                                            </div>
                                            <h5 class="font-size-16 text-uppercase text-white-50">Roles</h5>
                                            <h4 class="fw-medium font-size-24"><?php echo $role_count; ?> </h4>
                                        </div>
                                        <div class="pt-0">
                                            <div class="float-end">
                                                <a href="<?php echo base_url() ?>roles" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>

                                            <p class="text-white-50 mb-0">
                                                <a href="<?php echo base_url() ?>roles" class="text-white-50">View more </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Staff count -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-2">
                                            <div class="float-start mini-stat-img me-4">
                                                <i class="fas fa-users h2" style="position: relative;top: 8px;"></i>
                                            </div>
                                            <h5 class="font-size-16 text-uppercase text-white-50">Staff</h5>
                                            <h4 class="fw-medium font-size-24"><?php echo $staff_count; ?> </h4>
                                        </div>
                                        <div class="pt-0">
                                            <div class="float-end">
                                                <a href="<?php echo base_url() ?>staff" class="text-white-50">
                                                    <i class="mdi mdi-arrow-right h5"></i>
                                                </a>
                                            </div>

                                            <p class="text-white-50 mb-0">
                                                <a href="<?php echo base_url() ?>staff" class="text-white-50">View more </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <!-- end row -->


                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <!-- footer -->
                <?php $this->load->view('includes/footer'); ?>
                <!-- footer -->
                


            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        <?php $this->load->view('includes/right_side_bar'); ?>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <?php $this->load->view('includes/scripts'); ?>


        <!-- Peity chart-->
        <script src="<?php echo base_url() ?>assets/backend/libs/peity/jquery.peity.min.js"></script>

        <!-- Plugin Js-->
        <script src="<?php echo base_url() ?>assets/backend/libs/chartist/chartist.min.js"></script>
        <script src="<?php echo base_url() ?>assets/backend/libs/chartist-plugin-tooltips/chartist-plugin-tooltip.min.js"></script>
        <script src="<?php echo base_url() ?>assets/backend/js/pages/dashboard.init.js"></script>
        <script src="<?php echo base_url() ?>assets/backend/js/app.js"></script>

    </body>

</html>