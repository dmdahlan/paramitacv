<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<section class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="m-0 text-dark">Data Delivery</h5>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Data Muatan</a></li>
                        <li class="breadcrumb-item active">Delivery</li>
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
                                <div class="col-md">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" onclick="tambah_deliv()">Tambah</button>
                                </div>
                                <div class="col-md-2">
                                    <input id="tglawal" placeholder="tgl awal" class="form-control tanggal form-control-sm" type="text" autocomplete="off">
                                </div>
                                <div class="col-md-2">
                                    <input id="tglakhir" placeholder="tgl akhir" class="form-control tanggal form-control-sm" type="text" autocomplete="off">
                                </div>
                                <div class="col-md-1">
                                    <input id="nopoll" placeholder="Nopol" class="form-control form-control-sm" type="text" autocomplete="off">
                                </div>
                                <div class="col-md-2">
                                    <select id="bk" class="form-control form-control-sm">
                                        <option value="">Status Surat jalan</option>
                                        <option value="BELUM KEMBALI">Belum Kembali</option>
                                        <option value="KEMBALI">Kembali</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input id="sjkembali" placeholder="SJ Kembali" class="form-control tanggall form-control-sm" type="text" autocomplete="off">
                                </div>
                                <div class="col-md">
                                    <button type="button" id="btn-filter" class="btn btn-info btn-sm">Tampilkan</button>
                                    <button type="button" class="btn btn-info btn-sm" onclick="refresh()"> <span>Refresh</span></button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table table-responsive table-sm" style="font-size: 14px;">
                            <table id="delivery" class="table table-bordered table-hover table-striped js-basic-example dataTable nowrap cell-border" cellspacing="0" width="100%" role="grid">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>DELIVERY</th>
                                        <th>SJ KEMBALI</th>
                                        <th>NO SJ</th>
                                        <th>NO KEND</th>
                                        <th>ORDER</th>
                                        <th>DRIVER</th>
                                        <th>AWAL</th>
                                        <th>DARI</th>
                                        <th>TUJUAN(GAJI)</th>
                                        <th>TUJUAN(INVOICE)</th>
                                        <th>ADDRESS</th>
                                        <th>KET LAIN2</th>
                                        <th>PRODUK</th>
                                        <th>CUSTOMER</th>
                                        <th>SHIPMENT</th>
                                        <th>QTY</th>
                                        <th>CLAIM</th>
                                        <!-- <th>ID</th> -->
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
<div class="modal fade" id="md-form-deliv">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-titl" id="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='batal()'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                <div class="form-group">
                    <form id="frm-modal-deliv" method="POST">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="hidden" id="id" name="id">
                                    <label class="form-label">Delivery</label>
                                    <input id="tgl" name="tgl" class="form-control tanggal" placeholder="Tanggal" type="text" autocomplete="off">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">NO Kendaraan</label>
                                    <select id="nopol_idm" name="nopol_idm" class="form-control select2">
                                    </select>
                                    <input type="hidden" id="kapasitas" name="kapasitas">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">Driver</label>
                                    <select id="driver_idm" name="driver_idm" class="form-control select2">
                                    </select>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">Oderan</label>
                                    <select id="orderan" name="orderan" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="CDD">CDD</option>
                                        <option value="FUSO">FUSO</option>
                                    </select>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">Lokasi Awal</label>
                                    <select id="lokasi_awal" name="lokasi_awal" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="BPN">BPN</option>
                                        <option value="SMD">SMD</option>
                                        <option value="BJM">BJM</option>
                                        <option value="BERAU">BERAU</option>
                                    </select>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">Dari</label>
                                    <select id="dari_idm" name="dari_idm" class="form-control select2">
                                    </select>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">Tujuan Gaji</label>
                                    <select id="tujuan_idm" name="tujuan_idm" class="form-control select2">
                                    </select>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">Tujuan Invoice</label>
                                    <select id="tujuaninv_idm" name="tujuaninv_idm" class="form-control select2">
                                    </select>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class=" form-group">
                                    <label class="form-label">Ket Lain2</label>
                                    <input id="outlet" name="outlet" class="form-control" placeholder="Ket Lain2" type="text">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">Produk</label>
                                    <select id="produk_idm" name="produk_idm" class="form-control select2">
                                    </select>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">Kembali SJ</label>
                                    <input id="sj_kembali" name="sj_kembali" class="form-control tanggal" placeholder="Tanggal" type="text" autocomplete="off">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">No SJ</label>
                                    <input id="no_sj" name="no_sj" class="form-control" placeholder="No Surat jalan" type="text">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">Shipment</label>
                                    <input id="shipment" name="shipment" class="form-control" placeholder="Shipment" type="text">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="form-label">Qty</label>
                                    <input id="qty" name="qty" class="form-control" placeholder="Qty" type="text">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">Claim</label>
                                    <input id="claim" name="claim" class="form-control" placeholder="Claim" type="text">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button id='btnSaveDeliv' class="btn btn-primary btn-sm float-right" onclick="simpan_deliv()">Simpan</button>
                <button onclick='batal()' type='button' class="btn btn-warning btn-sm float-right">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.end modal edit -->
<script type="text/javascript">
    var table;
    $(document).ready(function() {
        table = $('#delivery').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "autowidth": true,
            "ordering": true,
            "scrollY": 350,
            "scrollX": true,
            // "scrollCollapse": true,
            // "fixedColumns": {
            //     "leftColumns": 3
            // },
            "lengthMenu": [
                [10, 100, 500, 1500],
                [10, 100, 500, 1500]
            ],
            // Load data for the table's content from an Ajax source
            ajax: {
                "url": "deliv_order/ajax_list",
                "type": "POST",
                "data": function(data) {
                    data.nopol = $('#nopoll').val();
                    data.bk = $('#bk').val();
                    data.tgl_awal = $('#tglawal').val();
                    data.tgl_akhir = $('#tglakhir').val();
                    data.sj_kembali = $('#sjkembali').val();
                },
            },
        });
        init_select();
    });
    $('#nopoll').keyup(function() {
        table.ajax.reload();
    });
    $('#bk').change(function() {
        table.ajax.reload();
    });
    $('#sjkembali').change(function() {
        table.ajax.reload();
    });
    $('#btn-filter').click(function() { //button filter event click
        table.ajax.reload(); //just reload table
    });

    function batal() {
        $('#frm-modal-deliv')[0].reset();
        $('.help-block').empty();
        $('#md-form-deliv').modal('hide');
        $('.is-invalid').removeClass('is-invalid');
    }

    function refresh() {
        document.getElementById("tglawal").value = "";
        document.getElementById("tglakhir").value = "";
        document.getElementById("nopoll").value = "";
        document.getElementById("bk").value = "";
        document.getElementById("sjkembali").value = "";
        reload_table();
    }

    function reload_table() {

        table.ajax.reload(null, false);
    }


    function tambah_deliv() {
        method = 'save';
        $('#md-form-deliv').modal('show');
        $('#modal-title').text('Tambah Data Delivery');
        $('#btnSaveDeliv').text('Simpan');
        $(".select2").select2({
            theme: "bootstrap4"
        });

    }

    function simpan_deliv() {
        if (method == 'save') {
            url = '<?= site_url('deliv_order/simpan_deliv'); ?>';
        } else {
            url = '<?= site_url('deliv_order/update_deliv'); ?>';
        }
        $.ajax({
            url: url,
            type: 'POST',
            data: new FormData($('#frm-modal-deliv')[0]),
            dataType: 'JSON',
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.status) {

                    $('.help-block').empty();
                    $('.is-invalid').removeClass('is-invalid');
                    $('#frm-modal-deliv')[0].reset();
                    $('#md-form-deliv').modal('hide');
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

    function edit_deliv(id) {
        method = 'update';
        $('#btnSaveDeliv').text('Update');
        $(".select2").select2({
            theme: "bootstrap4"
        });
        $.ajax({
            url: '<?= site_url('deliv_order/edit_deliv/'); ?>' + id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                $('#id').val(data.idm_deliv);
                $('#tgl').val(data.tgl);
                $('#sj_kembali').val(data.sj_kembali);
                $('#no_sj').val(data.no_sj);
                $('#nopol_idm').val(data.nopol_idm).change();
                $('#driver_idm').val(data.driver_idm).change();
                $('#orderan').val(data.orderan).change();
                $('#lokasi_awal').val(data.lokasi_awal).change();
                $('#dari_idm').val(data.dari_idm).change();
                $('#tujuan_idm').val(data.tujuan_idm).change();
                $('#tujuaninv_idm').val(data.tujuaninv_idm).change();
                $('#outlet').val(data.outlet);
                $('#produk_idm').val(data.produk_idm).change();
                $('#shipment').val(data.shipment);
                $('#qty').val(data.qty);
                $('#claim').val(data.claim);
                $('#kapasitas').val(data.kapasitas);

                $('#md-form-deliv').modal('show');
                $('#modal-title').text('Edit Data Delivery');
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

    function hapus_deliv(id) {
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
                    url: "<?php echo site_url('deliv_order/delete_deliv') ?>/" + id,
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
    $('#nopol_idm,#dari_idm,#tujuan_idm,#driver_idm').change(function() {
        var data = $('#nopol_idm').val();
        $.ajax({
            url: '<?= site_url('master_unit/edit_unit/') ?>' + data,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                $('#kapasitas').val(data.kapasitas);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error!');
            }
        });
    });

    function init_select() {
        let dropdown_nopol = $('#nopol_idm');
        dropdown_nopol.empty();
        dropdown_nopol.append('<option value="">Pilih Nopol</option>');
        dropdown_nopol.prop('selectedIndex', 0);
        const url_nopol = '<?= base_url('master_unit/getnopol/') ?>';
        // Populate dropdown with list
        $.getJSON(url_nopol, function(data) {
            $.each(data, function(key, entry) {
                dropdown_nopol.append($('<option></option>').attr('value', entry.idm_nopol).text(entry.nopol));
            })
        });
        $.getJSON(url_nopol, function(data) {
            $.each(data, function(key, entry) {
                dropdown_nopoll.append($('<option></option>').attr('value', entry.idm_nopol).text(entry.nopol));
            })
        });
        let dropdown_driver = $('#driver_idm');
        dropdown_driver.empty();
        dropdown_driver.append('<option value="">Pilih Driver</option>');
        dropdown_driver.prop('selectedIndex', 0);
        const url_driver = '<?= base_url('master_driver/getdriver/') ?>';
        // Populate dropdown with list
        $.getJSON(url_driver, function(data) {
            $.each(data, function(key, entry) {
                dropdown_driver.append($('<option></option>').attr('value', entry.idm_driver).text(entry.nama));
            })
        });
        let dropdown_dari = $('#dari_idm');
        dropdown_dari.empty();
        dropdown_dari.append('<option value="">Pilih Dari</option>');
        dropdown_dari.prop('selectedIndex', 0);
        const url_dari = '<?= base_url('master_dari/getdari/') ?>';
        // Populate dropdown with list
        $.getJSON(url_dari, function(data) {
            $.each(data, function(key, entry) {
                dropdown_dari.append($('<option></option>').attr('value', entry.idm_dari).text(entry.dari));
            })
        });
        let dropdown_tujuan = $('#tujuan_idm');
        dropdown_tujuan.empty();
        dropdown_tujuan.append('<option value="">Pilih Tujuan</option>');
        dropdown_tujuan.prop('selectedIndex', 0);
        const url_tujuan = '<?= base_url('master_tujuan/gettujuan/') ?>';
        // Populate dropdown with list
        $.getJSON(url_tujuan, function(data) {
            $.each(data, function(key, entry) {
                dropdown_tujuan.append($('<option></option>').attr('value', entry.idm_tujuan).text(entry.tujuan));
            })
        });
        let dropdown_tujuaninv = $('#tujuaninv_idm');
        dropdown_tujuaninv.empty();
        dropdown_tujuaninv.append('<option value="">Pilih Tujuan</option>');
        dropdown_tujuaninv.prop('selectedIndex', 0);
        const url_tujuaninv = '<?= base_url('master_tujuan/gettujuan/') ?>';
        // Populate dropdown with list
        $.getJSON(url_tujuaninv, function(data) {
            $.each(data, function(key, entry) {
                dropdown_tujuaninv.append($('<option></option>').attr('value', entry.idm_tujuan).text(entry.tujuan));
            })
        });
        let dropdown_produk = $('#produk_idm');
        dropdown_produk.empty();
        dropdown_produk.append('<option value="">Pilih Produk</option>');
        dropdown_produk.prop('selectedIndex', 0);
        const url_produk = '<?= base_url('master_produk/getproduk/') ?>';
        // Populate dropdown with list
        $.getJSON(url_produk, function(data) {
            $.each(data, function(key, entry) {
                dropdown_produk.append($('<option></option>').attr('value', entry.idm_produk).text(entry.produk));
            })
        });
    }
    $('.tanggal').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: "dd-mm-yyyy"
    });
    $('.tanggall').datepicker({
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
<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
<!-- Select2 -->
<script src="<?= base_url(''); ?>/assets/plugins/select2/js/select2.full.min.js"></script>
<?= $this->endSection('js') ?>