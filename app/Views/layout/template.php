<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title><?= $title; ?></title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url(''); ?>/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(''); ?>/assets/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- style -->
    <link href="<?= base_url(''); ?>/img/logotitle.png" rel="shorcut icon">
    <link rel="stylesheet" href="<?= base_url(''); ?>/assets/style.css">
    <?= $this->rendersection('css') ?>

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="<?= base_url(''); ?>/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(''); ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(''); ?>/assets/dist/js/adminlte.min.js"></script>
    <?= $this->rendersection('js') ?>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <!-- Navbar -->
        <?= $this->include('layout/navbar'); ?>
        <!-- /.navbar -->
        <!-- Main content -->
        <?= $this->rendersection('content'); ?>
        <!-- /.content -->
        <!-- Main Footer -->
        <footer class="main-footer text-center">
            <!-- To the right -->
            <!-- Default to the left -->
            <strong>Copyright &copy; Muhammad Dahlan <?= date('Y'); ?></strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->
</body>

</html>