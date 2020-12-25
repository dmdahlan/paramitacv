<?php if (logged_in()) : ?>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style=" background-color: #fcfcff;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="<?= base_url(''); ?>/assets_front/img/logo.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url(''); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('dashboard'); ?>">Open app</a>
                    </li>
                </ul>
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto navlogin">
                    <a class="nav-link">
                        <i class=" fas fa-envelope"> perdana_bpn@indo.net.id</i>
                    </a>
                    <a class="nav-link">
                        <i class=" fa fa-phone"> 0542 422405</i>
                    </a>
                    <a class="nav-link" href="<?= base_url('logout'); ?>">
                        Logout
                    </a>
                </ul>
            </div>
        </div>
    </nav>
<?php else : ?>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style=" background-color: #fcfcff;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="<?= base_url(''); ?>/assets_front/img/logo.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url(''); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                </ul>
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto navlogin">
                    <a class="nav-link">
                        <i class=" fas fa-envelope"> perdana_bpn@indo.net.id</i>
                    </a>
                    <a class="nav-link">
                        <i class=" fa fa-phone"> 0542 422405</i>
                    </a>
                    <a class="nav-link" href="<?= base_url('login'); ?>">
                        <!-- <i class="fas fa-sign-in-alt"></i> --> Login
                    </a>
                </ul>
            </div>
        </div>
    </nav>
<?php endif; ?>
<br><br>