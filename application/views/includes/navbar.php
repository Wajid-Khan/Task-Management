<?php  
$this->load->view('custom_functions2');
$user = $this->session->user_info;
$noti = getNotifications($user->id);
// print_r($noti);die;
?>
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="<?php echo base_url() ?>" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="<?php echo base_url() ?>assets/backend/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo base_url() ?>assets/backend/images/affordable_logo_bg.png" alt="" width="120">
                    </span>
                </a>

                <a href="<?php echo base_url() ?>" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="<?php echo base_url() ?>assets/backend/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo base_url() ?>assets/backend/images/affordable_logo_bg.png" alt="" width="120">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="mdi mdi-menu"></i>
            </button>

        </div>

        <div class="d-flex">

            <div class="dropdown d-none d-lg-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                    <i class="mdi mdi-fullscreen"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-bell-outline"></i>
                    <span class="badge bg-danger rounded-pill"><?php echo getNotificationCount($user->id); ?></span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="m-0 font-size-16"> Notifications (<?php echo getNotificationCount($user->id); ?>) </h5>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        <?php if(!empty($noti)): foreach($noti as $n): ?>
                        <a href="#." class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1"><?php echo $n['noti_title'] ?></h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1"><?php echo $n['noti_para'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php endforeach; endif; ?>
                    </div>
                    <div class="p-2 border-top">
                        <div class="d-grid">
                            <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                View all
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="<?php echo base_url() ?>uploads/profile/<?php echo $user->profile_picture; ?>"
                        alt="Header Avatar">
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <?php if($user->role === 'admin'): ?>
                        <a class="dropdown-item" href="<?php echo base_url() ?>profile"><i class="mdi mdi-account-circle font-size-17 align-middle me-1"></i> Profile</a>
                    <?php else: ?>
                        <a class="dropdown-item" href="<?php echo base_url() ?>profile/user"><i class="mdi mdi-account-circle font-size-17 align-middle me-1"></i> Profile</a>
                    <?php endif; ?>
                    <a class="dropdown-item" href="<?php echo base_url() ?>logout">
                        <i class="fas fa-sign-out-alt font-size-17 align-middle me-1"></i>Logout</a>
                </div>
            </div>    

        </div>
    </div>
</header>