<!DOCTYPE html>
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
            .card-footer, .card-header{
                background-color: #9194fd29;
            }
            .bg-lightgreen{
                background-color: rgb(2,164,153, .1);
                border-bottom: #bbb;
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

                        <div class="row ">
                          <div class="col-md-12">

                            <div class="card" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                              <div class="card-header p-3">
                                <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>Task List</h5>
                              </div>
                              <div class="card-body table-responsive" >

                                <table id="datatable" class="table">
                                  <thead>
                                    <tr>
                                      <th scope="col">Client</th>
                                      <th scope="col">Title</th>
                                      <?php if($user->role !== 'user'): ?>
                                        <th scope="col">Staff</th>
                                      <?php endif; ?>
                                      <th scope="col">Priority</th>
                                      <th scope="col">Status</th>
                                      <th scope="col">Create At</th>
                                      <th scope="col">Actions</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php if(!empty($tasks)): foreach($tasks as $task): ?>
                                    <tr class="fw-normal <?php echo ($task->task_status === 'Completed') ? 'bg-lightgreen' : ''; ?>">
                                      <th>
                                        <span class=""><?php echo getClientName($task->cli_id); ?></span>
                                      </th>
                                      <td class="align-middle">
                                        <span><?php echo $task->task_title; ?></span>
                                      </td>
                                      <?php if($user->role !== 'user'): ?>
                                      <th>
                                        <span class=""><?php echo getStaffName($task->staff_id); ?></span>
                                      </th>
                                      <?php endif; ?>
                                      <td class="align-middle">
                                        <?php if($task->priority === 'High'): ?>
                                        <h6 class="mb-0"><span class="badge bg-danger"><?php echo $task->priority; ?></span></h6>
                                        <?php elseif($task->priority === 'Medium'): ?>
                                        <h6 class="mb-0"><span class="badge bg-warning"><?php echo $task->priority; ?></span></h6>
                                        <?php else: ?>
                                        <h6 class="mb-0"><span class="badge bg-primary"><?php echo $task->priority; ?></span></h6>
                                        <?php endif; ?>
                                      </td>
                                      <td class="align-middle">
                                        <span><?php echo $task->task_status; ?></span>
                                      </td>
                                      <td class="align-middle">
                                        <span><?php echo timeAgo($task->created_at); ?></span>
                                      </td>
<td class="align-middle">
    <a href="<?php echo base_url('task/detail/') . $task->task_id; ?>" data-mdb-toggle="tooltip" title="View">
        <i class="fas fa-eye text-success me-2"></i>
    </a>
    <?php if($user->role !== 'user'): ?>
    <a href="<?php echo base_url('task/edit/') . $task->task_id; ?>" data-mdb-toggle="tooltip" title="Edit">
        <i class="fas fa-edit text-warning me-2"></i>
    </a>
    <a href="javascript:void(0)" data-mdb-toggle="tooltip" task_id="<?php echo $task->task_id ?>" class="delete" title="Delete">
        <i class="fas fa-trash-alt text-danger"></i>
    </a>
    <?php endif; ?>
</td>
                                    </tr>
                                    <?php endforeach; endif; ?>
                                  </tbody>
                                </table>

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

        <!-- Required datatable js -->
        <script src="<?php echo base_url() ?>assets/backend/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url() ?>assets/backend/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Responsive examples -->
        <script src="<?php echo base_url() ?>assets/backend/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url() ?>assets/backend/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="<?php echo base_url() ?>assets/backend/js/pages/datatables.init.js"></script> 
        <script src="<?php echo base_url() ?>assets/backend/js/app.js"></script>

        <script>
            $(document).ready(function(){
                $('.delete').on('click', function(){
                    var task_id = $(this).attr('task_id');
                    var conf = confirm("Are you sure want to delete this task?");
                    if(conf) {
                        $.ajax({
                            url : '<?php echo base_url(); ?>task/delete/'+task_id,
                            type: 'post',
                            data: {task_id:task_id},
                            success:function(resp){
                                alert(resp);
                                location.reload();
                            }
                        });
                    }
                })
            });
        </script>

    </body>
</html>
