<?php

$this->load->view('custom_functions');
$obj = new DatabaseClass;

?>
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
            .custBtn{
                background-color: rgb(98,110,212);
                border:none;
                padding: 2px 8px;
                border-radius:4px;
                color: white;
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
                                
                                <!-- <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <a class="btn btn-primary dropdown-toggle" href="<?php echo base_url() ?>task/create">
                                                <i class="mdi mdi-arrow-left-bold"></i> Back
                                            </a>
                                        </div>
                                    </div>
                                </div> -->
                                
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
                        <div class="row ">
                          <div class="col-md-12">

                            <div class="card" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                                <div class="card-header p-3">
                                    <h5 class="mb-0">
                                        <span>&nbsp;</span>
                                        <span style="float:right;">
<div class="btn-group">
    <?php if($role === 'user'): ?>
    
        <button class="btn btn-primary start <?php echo $obj->start_task_button_status($task->task_start_time); ?>" task_id="<?php echo $task->task_id; ?>">Start Task</button>
        <button class="btn btn-primary endTask <?php echo $obj->end_task_button_status($task->task_start_time, $task->task_close_time); ?>" task_id="<?php echo $task->task_id; ?>">End Task</button>
    <?php endif; ?>
</div>
                                        </span>
                                    </h5>
                                </div>
                              <div class="card-body table-responsive" >

                                <table id="datatable" class="table">
                                  <tbody>
                                    <tr>
                                        <th width="12%">Client</th>
                                        <td width="5%">:</td>
                                        <td width="83%"><?php echo $obj->getClientName($task->cli_id); ?></td>
                                    </tr>
                                    <tr>
                                        <th width="12%">Category</th>
                                        <td width="5%">:</td>
                                        <td width="83%"><?php echo $obj->getCatName($task->cat_id); ?></td>
                                    </tr>
                                    <tr>
                                        <th width="12%">Priority</th>
                                        <td width="5%">:</td>
                                        <td width="83%">
                                            <span style="font-size: 12px;" class="<?php if($task->priority === 'Low'){ echo 'bg-primary'; } else if($task->priority === 'Medium'){ echo 'bg-warning'; } else { echo 'bg-danger'; } ?> text-white p-1 rounded">
                                                <?php echo $task->priority; ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="12%">Staff</th>
                                        <td width="5%">:</td>
                                        <td width="83%"><?php echo $obj->getStaffName($task->staff_id); ?></td>
                                    </tr>
                                    <tr>
                                        <th width="12%">Title</th>
                                        <td width="5%">:</td>
                                        <td width="83%"><?php echo $task->task_title; ?></td>
                                    </tr>
                                    <tr>
                                        <th width="12%">Task Description</th>
                                        <td width="5%">:</td>
                                        <td width="83%"><?php echo $task->task_desc; ?></td>
                                    </tr>
                                    <tr>
                                        <th width="12%">Status</th>
                                        <td width="5%">:</td>
                                        <td width="83%"><span style="font-size: 12px;" class="<?php if($task->task_status === 'Assigned'){ echo 'bg-primary'; } else if($task->task_status === 'In progress'){ echo 'bg-warning'; } else { echo 'bg-success'; } ?> text-white p-1 rounded"><?php echo $task->task_status; ?></span></td>
                                    </tr>
                                    <tr>
                                        <th width="12%">Comment</th>
                                        <td width="5%">:</td>
                                        <td width="83%"><?php echo $task->comment; ?></td>
                                    </tr>
                                    <tr>
                                        <th width="12%">Task Start</th>
                                        <td width="5%">:</td>
                                        <td width="83%"><?php if(!empty($task->task_start_time)): echo date('m-d-Y h:i:s A', strtotime($task->task_start_time));  endif; ?></td>
                                    </tr>
                                    <tr>
                                        <th width="12%">Task End</th>
                                        <td width="5%">:</td>
                                        <td width="83%"><?php if(!empty($task->task_close_time)): echo date('m-d-Y h:i:s A', strtotime($task->task_close_time)); endif; ?></td>
                                    </tr>
                                    <tr>
                                        <th width="12%">Total Time</th>
                                        <td width="5%">:</td>
                                        <td width="83%"><?php echo $complete_time; ?></td>
                                    </tr>
                                    <tr>
                                        <th width="12%">Create At</th>
                                        <td width="5%">:</td>
                                        <td width="83%"><?php echo $created_on; ?></td>
                                    </tr>
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

        <!-- The Modal -->
        <div class="modal fade" id="myModal">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Task Comment</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <form action="<?php echo base_url() ?>task/task_end" method="post">
                  <div class="mb-3">
                    <p class="mb-0">Write your comment (Optional)</p>
                    <textarea class="form-control" rows="5" id="comment" name="comment" placeholder="..."></textarea>
                  </div>
                  <input type="hidden" name="task_id" id="task_id">
                  <button type="submit" class="btn btn-primary">End Task</button>
                </form>
              </div>

            </div>
          </div>
        </div>

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
                $('.endTask').on('click', function(){
                    var task_id = $(this).attr('task_id');
                    $('#task_id').val(task_id);
                    $('#myModal').modal('show');
                });
                $('.start').on('click', function(){
                    var task_id = $(this).attr('task_id');
                    var conf = confirm("Are you sure want to start this task?");
                    if(conf) {
                        $.ajax({
                            url : '<?php echo base_url(); ?>task/task_start/'+task_id,
                            type: 'post',
                            data: {task_id:task_id},
                            success:function(resp){
                                alert(resp);
                                location.reload();
                            }
                        });
                    }
                });
            });
        </script>

    </body>
</html>
