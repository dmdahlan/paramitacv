<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<section class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0 text-dark">Rekap Piutang</h5>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Rekap</a></li>
                        <li class="breadcrumb-item active">Rekap Piutang</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-5">

                                </div>
                                <div class="col-md-2">
                                    <input id="tgl_awal" placeholder="tgl awal" class="form-control tanggal form-control-sm" type="text" autocomplete="off">
                                </div>
                                <div class="col-md-2">
                                    <input id="tgl_akhir" placeholder="tgl akhir" class="form-control tanggal form-control-sm" type="text" autocomplete="off">
                                </div>
                                <div class="col-md">
                                    <button type="button" id="btn-filter" onclick="report()" class="btn btn-info btn-sm">Tampilkan</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div id="tabel-div" hidden class="card-body table table-responsive table-sm" style="font-size: 14px;">
                            <table id="tabel" class="table table-bordered table-hover table-striped js-basic-example dataTable nowrap cell-border" cellspacing="0" width="100%" role="grid">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NAMA PRODUK</th>
                                        <th>PIUTANG</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</section>
<script type="text/javascript">
    var table;

    function report() {
        var tgl_awal = $('#tgl_awal').val();
        var tgl_akhir = $('#tgl_akhir').val();

        $('#tabel-div').prop('hidden', true);
        $('#tabel').DataTable().clear().destroy();
        table = $('#tabel').DataTable({
            processing: true, //Feature control the processing indicator.
            serverSide: true, //Feature control DataTables' server-side processing mode.
            order: [], //Initial no order.
            autowidth: true,
            ordering: false,
            searching: false,
            paging: false,
            info: false,
            // Load data for the table's content from an Ajax source
            ajax: {
                "url": "<?php echo site_url('rekap_piutang/list') ?>",
                "type": "POST",
                "data": function(data) {
                    data.tgl_awal = tgl_awal;
                    data.tgl_akhir = tgl_akhir;

                }
            },
        });
        $('#tabel-div').prop('hidden', false);
    }
    $('.tanggal').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        defaultDate: new Date(),
    });

    var date = new Date();
    var tahun_awal = date.getFullYear();
    tahun_awal = tahun_awal + "-01-01";
    var tahun_akhir = date.getFullYear();
    tahun_akhir = tahun_akhir + "-12-31";

    function addDays(date, days) {
        var result = new Date(date);
        result.setDate(result.getDate() + days);
        return result;
    }

    $("#tgl_awal").datepicker("setDate", tahun_awal);
    $("#tgl_akhir").datepicker("setDate", tahun_akhir);

    function reload() {
        table.ajax.reload(null, false);
    }
</script>
<?= $this->endSection('content'); ?>

<?= $this->section('css') ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css" />
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/tambahan/datepicker/dist/css/bootstrap-datepicker.min.css">
<?= $this->endSection('css') ?>

<?= $this->section('js') ?>
<!-- DataTables -->
<script src="<?= base_url(''); ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(''); ?>/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(''); ?>/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(''); ?>/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- date-picker -->
<script src="<?= base_url(''); ?>/assets/tambahan/datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<?= $this->endSection('js') ?>