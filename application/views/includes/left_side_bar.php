<?php $user = $this->session->user_info; ?>
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <li>
                    <a href="<?php echo base_url() ?>dashboard" class="waves-effect">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Task Dashboard</span>
                    </a>
                </li>
                <?php if($user->role == 'admin'): ?>
                <li>
                    <a href="<?php echo base_url() ?>task">
                        <i class="fas fa-search"></i>
                        <span>Quick find</span>
                    </a>
                </li>
                <?php endif; ?>
                <?php if($user->role == 'user'): ?>
                <li>
                    <a href="<?php echo base_url() ?>task/search">
                        <i class="fas fa-search"></i>
                        <span>Quick search</span>
                    </a>
                </li>
                <?php endif; ?>
                <?php if($user->role == 'admin'): ?>
                <li>
                    <a href="<?php echo base_url() ?>task/create">
                        <i class="fas fa-plus" aria-hidden="true"></i>
                        <span>Create</span>
                    </a>
                </li>
                <?php endif; ?>
                <li>
                    <a href="<?php echo base_url() ?>task/today">
                        <i class="fas fa-calendar-check" aria-hidden="true"></i>
                        <span>Today</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url() ?>task/yesterday">
                        <i class="fas fa-calendar" aria-hidden="true"></i>
                        <span>Yesterday</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url() ?>task/this_week">
                        <i class="fas fa-calendar-alt" aria-hidden="true"></i>
                        <span>This Week</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url() ?>task/last_week">
                        <i class="fas fa-calendar-alt" aria-hidden="true"></i>
                        <span>Last Week</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url() ?>task/this_month">
                        <i class="fas fa-calendar-alt" aria-hidden="true"></i>
                        <span>This Month</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url() ?>task/last_month">
                        <i class="fas fa-calendar-alt" aria-hidden="true"></i>
                        <span>Last Month</span>
                    </a>
                </li>
                <?php if($user->role == 'admin'): ?>
                <li>
                    <a href="<?php echo base_url() ?>category">
                        <!-- <i class="fas fa-archive"></i> -->
                        <i class="ti-view-grid"></i>
                        <span>Category</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url() ?>staff">
                        <i class="fas fa-users-cog"></i>
                        <span>Staff</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url() ?>roles">
                        <i class="fas fa-users-cog"></i>
                        <span>Roles</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url() ?>clients">
                        <i class="fas fa-user-tie"></i>
                        <span>Clients</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url() ?>setting">
                        <i class="fas fa-cog"></i>
                        <span>Setting</span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>