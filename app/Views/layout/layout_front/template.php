<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="<?= base_url(''); ?>/assets_front/img/perdanalogo.png" rel="shorcut icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url(''); ?>/assets_front/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url(''); ?>/assets_front/tambahan/fontawesome-free/css/all.min.css">
    <!-- assets -->
    <link rel="stylesheet" href="<?= base_url(''); ?>/assets_front/style.css">

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="<?= base_url(''); ?>/assets_front/node_modules/bootstrap/dist/js/jquery-3.5.1.slim.min.js"></script>
    <script src="<?= base_url(''); ?>/assets_front/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <title>Perdana | BPN</title>
</head>

<body>
    <!-- navbar -->
    <?= $this->include('layout/layout_front/navbar') ?>
    <!-- endnavbar -->
    <!-- content -->
    <?= $this->rendersection('content') ?>
    <!-- endcontent -->
    <!-- Optional JavaScript; choose one of the two! -->

</body>

</html>