<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<section class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="m-0 text-dark">Data SAP CCDI</h5>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">SAP</a></li>
                        <li class="breadcrumb-item active">SAP CCDI</li>
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
                                <div class="col-md-6">
                                    <a href="" class="btn btn-info btn-sm" data-toggle="modal" onclick="tambah_form()">Tambah</a>
                                </div>
                                <div class="col-md-2">
                                    <select id="ketok" class="form-control form-control-sm">
                                        <option value="">OK/BATAL</option>
                                        <option value="OK">OK</option>
                                        <option value="BATAL">BATAL</option>
                                        <option value="KOSONG">KOSONG</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input id="tglsap" placeholder="Tanggal SAP" class="form-control tanggall form-control-sm" type="text" autocomplete="off">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" id="btn-filter" class="btn btn-info btn-sm">Cari</button>
                                    <button class="btn btn-info btn-sm" onclick="refresh()">
                                        <span>Refresh</span></button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table table-responsive table-sm" style="font-size: 14px;">
                            <table id="tb_sap" class="table table-bordered table-hover table-striped js-basic-example dataTable nowrap cell-border" cellspacing="0" width="100%" role="grid">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tgl SAP</th>
                                        <th>No FO</th>
                                        <th>Driver</th>
                                        <th>Nopol</th>
                                        <th>Dari</th>
                                        <th>Tujuan</th>
                                        <th>Produk</th>
                                        <th>Orderan</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                        <th>Opsi</th>
                                        <th>Outlet</th>
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
<div class="modal fade" id="md-form-sap">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='batal()'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                <div class="form-group">
                    <form id="frm-modal-sap">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="hidden" id="id" name="id">
                                    <label class="form-label">TGL</label>
                                    <input id="tgl_sap" name="tgl_sap" class="form-control tanggal" placeholder="Tanggal" type="text" autocomplete="off">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">NO FO</label>
                                    <input id="fo" name="fo" class="form-control" placeholder="No FO" type="text">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <!-- <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">NO FRFQ</label>
                                    <input id="fr" name="fr" class="form-control" placeholder="No RFRQ" type="text">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div> -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Driver</label>
                                    <select id="driver_idm" name="driver_idm" class="form-control select2">
                                    </select>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">NO Kendaraan</label>
                                    <select id="nopol_idm" name="nopol_idm" class="form-control select2">
                                    </select>
                                    <input type="hidden" name="kapasitas" id="kapasitas">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Dari</label>
                                    <select id="dari_idm" name="dari_idm" class="form-control select2">
                                    </select>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Tujuan</label>
                                    <select id="tujuan_idm" name="tujuan_idm" class="form-control select2">
                                    </select>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Produk</label>
                                    <select id="produk_idm" name="produk_idm" class="form-control select2">
                                    </select>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
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
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-label">Outlet</label>
                                    <input id="outlet" name="outlet" class="form-control" placeholder="Outlet" type="text">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select id="keterangan" name="keterangan" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="OK">OK</option>
                                        <option value="BATAL">BATAL</option>
                                    </select>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-label">Keterangan</label>
                                    <input id="ket_sap" name="ket_sap" class="form-control" placeholder="Keterangan" type="text">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button id='btnSavesap' class="btn btn-primary btn-sm float-right" onclick="simpan_sap()">Simpan</button>
                <button onclick='batal()' type='button' class="btn btn-warning btn-sm float-right">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- modal detil -->
<div class="modal fade" id="md-detil">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="judul"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="batal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        NAMA : <label id="supir"></label>
                    </div>
                    <div class="row pertama">
                        NO HP : <label id="nohp"></label>
                    </div>
                    <div class="row kedua">
                        NO KEUR : <label id="keur"></label>
                    </div>
                    <div class="row kedua">
                        KERB WIGHT : <label id="weight"></label>
                    </div>
                    <div class="row kedua">
                        JBB : <label id="jbbb"></label>
                    </div>
                    <div class="row kedua">
                        JBI : <label id="jbii"></label>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button onclick='keluar()' type='button' class="btn btn-warning btn-sm float-right">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- akhir modal detil -->
<script type="text/javascript">
    var table;
    $(document).ready(function() {
        table = $('#tb_sap').DataTable({
            processing: true, //Feature control the processing indicator.
            serverSide: true, //Feature control DataTables' server-side processing mode.
            order: [], //Initial no order.
            autowidth: true,
            ordering: true,
            // Load data for the table's content from an Ajax source
            ajax: {
                "url": "<?php echo site_url('sap_order/ajax_list') ?>",
                "type": "POST",
                "data": function(data) {
                    data.ketok = $('#ketok').val();
                    data.tglsap = $('#tglsap').val();
                },
            },
        });
        init_select();
    });
    $('#ketok').change(function() {
        table.ajax.reload();
    });
    $('#btn-filter').click(function() { //button filter event click
        table.ajax.reload(); //just reload table
    });

    function batal() {
        $('#frm-modal-sap')[0].reset();
        $('#md-form-sap').modal('hide');
        $('.help-block').empty();
        $('.is-invalid').removeClass('is-invalid');
    }

    function refresh() {
        document.getElementById("ketok").value = "";
        document.getElementById("tglsap").value = "";
        reload_table();
    }

    function reload_table() {
        table.ajax.reload(null, false);
    }

    function tambah_form() {
        method = 'save';
        $('#md-form-sap').modal('show');
        $('#modal-title').text('Tambah Data Sap');
        $('#btnSavesap').text('Save');
        $('.is-invalid').removeClass('is-invalid');
        $(".select2").select2({
            theme: "bootstrap4"
        });
    }

    function simpan_sap() {
        if (method == 'save') {
            url = '<?= site_url('sap_order/save'); ?>';
        } else {
            url = '<?= site_url('sap_order/update'); ?>';
        }
        $.ajax({
            url: url,
            type: 'POST',
            data: new FormData($('#frm-modal-sap')[0]),
            dataType: 'JSON',
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.status) {
                    $('.help-block').empty();
                    $('#frm-modal-sap')[0].reset();
                    $('.is-invalid').removeClass('is-invalid');
                    $('#md-form-sap').modal('hide');
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
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function edit_sap(id) {
        method = 'update';
        $('#btnSavesap').text('Update');
        $(".select2").select2({
            theme: "bootstrap4"
        });
        $.ajax({
            url: '<?= site_url('sap_order/edit/') ?>' + id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                $('#id').val(data.id_sap);
                $('#tgl_sap').val(data.tgl_sap);
                $('#fo').val(data.fo);
                // $('#fr').val(data.fr);
                $('#driver_idm').val(data.driver_idm).change();
                $('#nopol_idm').val(data.nopol_idm).change();
                $('#dari_idm').val(data.dari_idm).change();
                $('#tujuan_idm').val(data.tujuan_idm).change();
                $('#produk_idm').val(data.produk_idm).change();
                $('#orderan').val(data.orderan).change();
                $('#outlet').val(data.outlet);
                $('#keterangan').val(data.keterangan).change();
                $('#ket_sap').val(data.ket_sap);

                $('#md-form-sap').modal('show');
                $('#modal-title').text('Edit Data sap');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error!');
            }
        });
    }

    function hapus_sap(id) {
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
                    url: "<?php echo site_url('sap_order/delete') ?>/" + id,
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

    function detil_sap(id) {
        $.ajax({
            url: '<?= site_url('sap_order/getdatasap/') ?>' + id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                $('#id').val(data.id_sap);
                $('#supir').text(data.nama);
                $('#nohp').text(data.nohp);
                $('#keur').text(data.no_keur);
                $('#weight').text(data.kerb_weight);
                $('#jbbb').text(data.jbb);
                $('#jbii').text(data.jbi);
                $('#md-detil').modal('show');
                $('#judul').text('Detil SAP');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error!');
            }
        });
    }

    function keluar() {
        $('#md-detil').modal('hide');
        $('.help-block').empty();
        $('.is-invalid').removeClass('is-invalid');
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
                icon: 'warning',
                title: 'Data berhasil di ubah'
            })
        }

    }

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
<?= $this->endSection('content') ?>

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