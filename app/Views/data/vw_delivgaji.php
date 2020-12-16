<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<section class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="m-0 text-dark">Data Gaji</h5>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Data Muatan</a></li>
                        <li class="breadcrumb-item active">Data gaji</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-2">
                                    <select id="bk" class="form-control form-control-sm">
                                        <option value="">Status Surat jalan</option>
                                        <option value="BELUM KEMBALI">Belum Kembali</option>
                                        <option value="KEMBALI">Kembali</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select id="bg" class="form-control form-control-sm">
                                        <option value="">Status Pembayaran</option>
                                        <option value="belumterbayar">Belum terbayar</option>
                                        <option value="terbayar">Terbayar</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input id="tglgaji" placeholder="Tanggal Gaji" class="form-control tanggal form-control-sm" type="text" autocomplete="off">
                                </div>
                                <div class="col-md-4">
                                    <button type="button" id="btn-filter" class="btn btn-info btn-sm">Cari</button>
                                    <button class="btn btn-info btn-sm" onclick="refresh()"> <span>Refresh</span></button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table table-responsive table-sm" style="font-size: 14px;">
                            <table id="gaji" class="table table-bordered table-hover table-striped js-basic-example dataTable nowrap cell-border" cellspacing="0" width="100%" role="grid">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>SJ KEMBALI</th>
                                        <th>TGL GAJI</th>
                                        <th>DELIVERY</th>
                                        <th>NAMA</th>
                                        <th>NO SJ</th>
                                        <th>NOPOL</th>
                                        <th>PRODUK</th>
                                        <th>DARI</th>
                                        <th>TUJUAN</th>
                                        <th>GAJI</th>
                                        <th>OPSI</th>
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
<div class="modal fade" id="md-form-gaji">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-titl" id="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='batal()'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                <div class="form-group">
                    <form id="frm-modal-gaji">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="hidden" id="id" name="id">
                                    <input type="hidden" id="deliv_idm" name="deliv_idm">
                                    <label class="form-label">Delivery</label>
                                    <input id="tgl_deliv" name="tgl_deliv" class="form-control" type="text" readonly>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">SJ Kembali</label>
                                    <input id="sj_kembali" name="sj_kembali" class="form-control" readonly>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">NO Kendaraan</label>
                                    <input id="nopol_idm" name="nopol_idm" class="form-control" readonly>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Produk</label>
                                    <input id="produk_idm" name="produk_idm" class="form-control" readonly>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Destinasi</label>
                                    <input id="dari_idm" name="dari_idm" class="form-control" readonly>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Destinasi</label>
                                    <input id="tujuan_idm" name="tujuan_idm" class="form-control" readonly>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Shipment</label>
                                    <input id="shipment" name="shipment" class="form-control" readonly>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Tgl Gaji</label>
                                    <input id="tgl_gaji" name="tgl_gaji" class="form-control tanggal" type="text" placeholder="Tanggal Gaji" autocomplete="off">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button id='btnSaveGaji' class="btn btn-primary btn-sm float-right" onclick="simpan_gaji()">Simpan</button>
                <button onclick='batal()' type='button' class="btn btn-warning btn-sm float-right">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
    var table;
    table = $(document).ready(function() {
        table = $('#gaji').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "autowidth": true,
            "ordering": true,
            "lengthMenu": [
                [10, 100, 500, 1500],
                [10, 100, 500, 1500]
            ],
            // Load data for the table's content from an Ajax source
            ajax: {
                "url": "<?php echo site_url('deliv_gaji/ajax_list'); ?>",
                "type": "POST",
                "data": function(data) {
                    data.nopol = $('#nopoll').val();
                    data.bk = $('#bk').val();
                    data.bg = $('#bg').val();
                    data.tglgaji = $('#tglgaji').val();
                },
            },
            "columnDefs": [{
                "targets": [10],
                "className": 'text-right'
            }]
        });
    });
    $('#bk').change(function() {
        table.ajax.reload();
    });
    $('#bg').change(function() {
        table.ajax.reload();
    });
    $('#btn-filter').click(function() { //button filter event click
        table.ajax.reload(); //just reload table
    });

    function reload_table() {
        table.ajax.reload(null, false);
    }

    function refresh() {
        document.getElementById("bk").value = "";
        document.getElementById("bg").value = "";
        document.getElementById("tglgaji").value = "";
        reload_table();
    }

    function batal() {
        $('#frm-modal-gaji')[0].reset();
        $('.help-block').empty();
        $('#md-form-gaji').modal('hide');
        $('.is-invalid').removeClass('is-invalid');
    }

    function tambah_gaji(id) {
        method = 'save';
        $('#md-form-gaji').modal('show');
        $('#modal-title').text('Tambah Data Gaji');
        $('#btnSaveGaji').text('Simpan');
        $.ajax({
            url: '<?= site_url('deliv_gaji/edit_gaji/'); ?>' + id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                $('#deliv_idm').val(data.idm_deliv);
                $('#tgl_deliv').val(data.tgl);
                $('#sj_kembali').val(data.sj_kembali);
                $('#driver_idm').val(data.driver);
                $('#nopol_idm').val(data.nopol);
                $('#produk_idm').val(data.produk);
                $('#dari_idm').val(data.dari);
                $('#tujuan_idm').val(data.tujuan);
                $('#shipment').val(data.shipment);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error!');
            }
        });
    }

    function edit_gaji(id) {
        method = 'update';
        $('#md-form-gaji').modal('show');
        $('#modal-title').text('Edit Data Gaji');
        $('#btnSaveGaji').text('Update');
        $.ajax({
            url: '<?= site_url('deliv_gaji/edit_gaji/'); ?>' + id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                $('#id').val(data.idm_gaji);
                $('#deliv_idm').val(data.idm_deliv);
                $('#tgl_deliv').val(data.tgl);
                $('#sj_kembali').val(data.sj_kembali);
                $('#driver_idm').val(data.driver);
                $('#nopol_idm').val(data.nopol);
                $('#produk_idm').val(data.produk);
                $('#dari_idm').val(data.dari);
                $('#tujuan_idm').val(data.tujuan);
                $('#shipment').val(data.shipment);
                $('#tgl_gaji').val(data.tgl_gaji);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error!');
            }
        });
    }

    function simpan_gaji() {
        if (method == 'save') {
            url = '<?= site_url('deliv_gaji/simpan_gaji'); ?>';
        } else {
            url = '<?= site_url('deliv_gaji/update_gaji'); ?>';
        }
        $.ajax({
            url: url,
            type: 'POST',
            data: new FormData($('#frm-modal-gaji')[0]),
            dataType: 'JSON',
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.status) {

                    $('.help-block').empty();
                    $('.is-invalid').removeClass('is-invalid');
                    $('#frm-modal-gaji')[0].reset();
                    $("input[type=hidden]").val('');
                    $('#md-form-gaji').modal('hide');
                    alertsukses();
                    reload_table();
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').parent().addClass('has-error');
                        $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);

                    }
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error!');
            }
        });
    }

    function alertsukses() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        if (method == 'save') {
            Toast.fire({
                icon: 'success',
                title: 'Data berhasil disimpan'
            })
        } else {
            Toast.fire({
                icon: 'info',
                title: 'Data berhasil di ubah'
            })
        }
    }

    function hapus_inv(id) {
        swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: 'Anda Tidak Akan Bisa Merecover Kembali Data Yang Sudah Anda Hapus !',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((willDelete) => {
            if (willDelete.value) {
                $.ajax({
                    url: "<?php echo site_url('deliv_invoice/delete_inv') ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        swal.fire('Terhapus', 'Data Anda Sudah Dihapus', 'success');
                        reload_table();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal.fire("Gagal", "Data Anda Tidak Jadi Dihapus", "error");
                    }
                });
            } else {
                swal.fire("Batal", "Data Anda Tidak Jadi Dihapus", "warning");
            }
        });
    }
    $('.tanggal').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: "yyyy-mm-dd"
    });
</script>
<?= $this->endSection('content'); ?>
<?= $this->section('css') ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css" />
<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/tambahan/sweetalert2/dist/sweetalert2.min.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/tambahan/datepicker/dist/css/bootstrap-datepicker.min.css">
<?= $this->endSection('css') ?>

<?= $this->section('js') ?>
<!-- DataTables -->
<script src="<?= base_url(''); ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(''); ?>/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(''); ?>/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(''); ?>/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url(''); ?>/assets/tambahan/sweetalert2/dist/sweetalert2.min.js"></script>
<!-- date-picker -->
<script src="<?= base_url(''); ?>/assets/tambahan/datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<?= $this->endSection('js') ?>