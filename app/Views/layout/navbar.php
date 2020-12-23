<!-- Nav Login -->
<?php if (logged_in()) : ?>
    <nav class="main-header navbar navbar-expand-md navbar-dark navbar-danger fixed-top">
        <div class="container-fluid">
            <a href="<?= base_url(''); ?>" class="navbar-brand">
                <img src="<?= base_url(''); ?>/img/logotitle.png" alt="AdminLTE Logo" class="brand-image">
            </a>

            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="<?= base_url(''); ?>" class="nav-link">Home</a>
                    </li>
                    <?php

                    $db = \Config\Database::connect();
                    $request = \Config\Services::request();
                    $menuaktif = explode('_', $request->uri->getSegment(1))[0];

                    $grup_id = $db->table('auth_groups_users')->getWhere(['user_id' => user()->id])->getRowArray();
                    $role = $grup_id['group_id'];

                    $menu = $db->table('auth_groups_permissions')
                        ->join('auth_permissions', 'auth_permissions.id=auth_groups_permissions.permission_id', 'left')
                        ->where('auth_permissions.parent_id', 0)
                        ->where('auth_permissions.is_active', 1)
                        ->where('auth_groups_permissions.group_id', $role)
                        ->orderBy('auth_permissions.sort_menu', 'ASC')->get()->getResultArray();
                    ?>
                    <?php foreach ($menu as $m) : ?>
                        <li <?php if ($menuaktif == $m['name']) {
                                echo ' class="nav-item dropdown active" ';
                            } ?>class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><?= $m['description']; ?></a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <?php
                                $menuid = $m['id'];
                                $parent = $db->table('auth_groups_permissions')
                                    ->join('auth_permissions', 'auth_permissions.id=auth_groups_permissions.permission_id', 'left')->where('auth_permissions.parent_id', $menuid)
                                    ->where('auth_permissions.is_active', 1)
                                    ->where('auth_groups_permissions.group_id', $role)
                                    ->orderBy('auth_permissions.sort_menu', 'asc')->get()->getResultArray();
                                ?>
                                <?php foreach ($parent as $p) : ?>
                                    <li><a href="<?= base_url($p['name']); ?>" class="dropdown-item"><?= $p['description']; ?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
            <!-- Right navbar links -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header"></span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <!-- user menu -->
                <li class="nav-item dropdown user user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="/assets/dist/img/avatar5.png" class="user-image img-circle elevation-2 alt=" User Image">
                        <span class="hidden-xs"><?= user()->username; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-white">
                            <img src="/assets/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
                            <p>
                                <?= user()->username; ?>
                                <small><?= date('d F Y', strtotime(user()->created_at)) ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?= base_url(); ?>/profile" class="btn btn-default btn-flat float-left">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?= base_url('logout'); ?>" class="btn btn-default btn-flat float-right">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Nav Sebelum Login -->
<?php else : ?>
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white fixed-top">
        <div class="container-fluid">
            <a href="<?= base_url(''); ?>" class="navbar-brand">
                <img src="<?= base_url(''); ?>/img/logotitle.png" alt="AdminLTE Logo" class="brand-image">
            </a>

            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="<?= base_url(''); ?>" class="nav-link">Home</a>
                    </li>
                </ul>
            </div>
            <!-- Right navbar links -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <!-- Notifications fa sign -->
                <a class="nav-link" href="<?= base_url('login'); ?>">
                    <i class="fas fa-sign-in-alt"></i>
                </a>
            </ul>
        </div>
    </nav>
<?php endif; ?>
<br><br>