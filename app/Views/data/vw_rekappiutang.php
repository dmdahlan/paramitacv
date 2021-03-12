<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<section class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="m-0 text-dark">Rekap Invoice</h5>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Rekap</a></li>
                        <li class="breadcrumb-item active">Rekap Invoice</li>
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
                                <div class="col-md-4">
                                    <h5>Invoice</h5>
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
                                        <th>CUSTOMER</th>
                                        <th>JAN</th>
                                        <th>FEB</th>
                                        <th>MAR</th>
                                        <th>APR</th>
                                        <th>MEI</th>
                                        <th>JUN</th>
                                        <th>JUL</th>
                                        <th>AGT</th>
                                        <th>SEP</th>
                                        <th>OKT</th>
                                        <th>NOP</th>
                                        <th>DES</th>
                                        <th>TOTAL</th>
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
            <!-- bayar -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-4">
                                    <h5>Pembayaran</h5>
                                </div>
                                <div class="col-md-2">
                                    <input id="tgl_awal_bayar" placeholder="tgl awal" class="form-control tanggal form-control-sm" type="text" autocomplete="off">
                                </div>
                                <div class="col-md-2">
                                    <input id="tgl_akhir_bayar" placeholder="tgl akhir" class="form-control tanggal form-control-sm" type="text" autocomplete="off">
                                </div>
                                <div class="col-md">
                                    <button type="button" id="btn-filter" onclick="bayar()" class="btn btn-info btn-sm">Tampilkan</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div id="tabel-bayar" hidden class="card-body table table-responsive table-sm" style="font-size: 14px;">
                            <table id="tabelbayar" class="table table-bordered table-hover table-striped js-basic-example dataTable nowrap cell-border" cellspacing="0" width="100%" role="grid">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>CUSTOMER</th>
                                        <th>JAN</th>
                                        <th>FEB</th>
                                        <th>MAR</th>
                                        <th>APR</th>
                                        <th>MEI</th>
                                        <th>JUN</th>
                                        <th>JUL</th>
                                        <th>AGT</th>
                                        <th>SEP</th>
                                        <th>OKT</th>
                                        <th>NOP</th>
                                        <th>DES</th>
                                        <th>TOTAL</th>
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
    var tablebayar;

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
                "url": "<?= base_url('rekap_piutang/list') ?>",
                "type": "POST",
                "data": function(data) {
                    data.tgl_awal = tgl_awal;
                    data.tgl_akhir = tgl_akhir;
                }
            },
        });
        $('#tabel-div').prop('hidden', false);
    }

    function bayar() {
        var tgl_awal_bayar = $('#tgl_awal_bayar').val();
        var tgl_akhir_bayar = $('#tgl_akhir_bayar').val();

        $('#tabel-bayar').prop('hidden', true);
        $('#tabelbayar').DataTable().clear().destroy();
        table = $('#tabelbayar').DataTable({
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
                "url": "<?= base_url('rekap_piutang/bayar') ?>",
                "type": "POST",
                "data": function(data) {
                    data.tgl_awal = tgl_awal_bayar;
                    data.tgl_akhir = tgl_akhir_bayar;
                }
            },
        });
        $('#tabel-bayar').prop('hidden', false);
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

    var tahun_awal_bayar = date.getFullYear();
    tahun_awal_bayar = tahun_awal_bayar + "-01-01";
    var tahun_akhir_bayar = date.getFullYear();
    tahun_akhir_bayar = tahun_akhir_bayar + "-12-31";

    function addDays(date, days) {
        var result = new Date(date);
        result.setDate(result.getDate() + days);
        return result;
    }

    $("#tgl_awal").datepicker("setDate", tahun_awal);
    $("#tgl_akhir").datepicker("setDate", tahun_akhir);

    $("#tgl_awal_bayar").datepicker("setDate", tahun_awal_bayar);
    $("#tgl_akhir_bayar").datepicker("setDate", tahun_akhir_bayar);

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