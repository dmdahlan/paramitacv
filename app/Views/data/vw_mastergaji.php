<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<section class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0 text-dark">Data Gaji & Uang Jalan</h5>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                        <li class="breadcrumb-item active">Gaji & uang Jalan</li>
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
                                    <a href="" class="btn btn-info btn-sm" data-toggle="modal" onclick="tambah_gaji()">Tambah</a>
                                    <button class="btn btn-info btn-sm" onclick="refresh()"> <span>Refresh</span></button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table table-responsive table-sm" style="font-size: 14px;">
                            <table id="tb_gaji" class="table table-bordered table-hover table-striped js-basic-example dataTable nowrap cell-border" cellspacing="0" width="100%" role="grid">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Dari</th>
                                        <th>Tujuan</th>
                                        <th>Type</th>
                                        <th>Gaji</th>
                                        <th>Uang Jalan</th>
                                        <th>Keterangan</th>
                                        <th>Opsi</th>
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
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='batal()'>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                <div class="form-group">
                    <form id="frm-modal-gaji">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input type="hidden" id="id" name="id">
                                    <label class="form-label">Dari</label>
                                    <select id="dari_idm" name="dari_idm" class="form-control select2">
                                    </select>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-label">Tujuan</label>
                                    <select id="tujuan_idm" name="tujuan_idm" class="form-control select2">
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">Type</label>
                                    <select id="tipe" name="tipe" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="1">CDD</option>
                                        <option value="2200">2200</option>
                                        <option value="2300">2300</option>
                                        <option value="2500">2500</option>
                                        <option value="2700">2700</option>
                                        <option value="3000">3000</option>
                                    </select>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Gaji</label>
                                    <input id="gajii" name="gajii" class=" form-control uang" placeholder="Gaji" type="text">
                                    <span class="help-block text-danger"></span>
                                    <input type="hidden" id="gaji" name="gaji">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Uang Jalan</label>
                                    <input id="uang_jalann" name="uang_jalann" class=" form-control uang" placeholder="Uang Jalan" type="text">
                                    <input type="hidden" class="form-control" id="uang_jalan" name="uang_jalan">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Pengkodean</label>
                                    <input type="text" class="form-control" id="ketjuan" name="ketjuan" readonly>
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
    $(document).ready(function() {
        table = $('#tb_gaji').DataTable({
            processing: true, //Feature control the processing indicator.
            serverSide: true, //Feature control DataTables' server-side processing mode.
            order: [], //Initial no order.
            autowidth: true,
            ordering: true,
            // Load data for the table's content from an Ajax source
            ajax: {
                "url": "<?php echo site_url('master_gaji/ajax_list') ?>",
                "type": "POST",
            },
        });
        init_select();
    });

    function refresh() {
        reload_table();
    }

    function reload_table() {
        table.ajax.reload(null, false);
    }

    function batal() {
        $('#frm-modal-gaji')[0].reset();
        $('#md-form-gaji').modal('hide');
        $('.help-block').empty();
        $("input[type=hidden]").val('');
        $('.is-invalid').removeClass('is-invalid');
    }
    $('#dari_idm,#tujuan_idm,#tipe').change(function() {
        var dari = $('#dari_idm').val();
        var tujuan = $('#tujuan_idm').val();
        var tipe = $('#tipe').val();
        var gabung = dari.concat(tujuan, tipe);
        $('#ketjuan').val(gabung);
    });

    function tambah_gaji() {
        method = 'save';
        $('#md-form-gaji').modal('show');
        $("input[type=hidden]").val('');
        $('#modal-title').text('Tambah Data Gaji & Uang jalan');
        $('#btnSaveGaji').text('Simpan');
        $('.is-invalid').removeClass('is-invalid');
        $(".select2").select2({
            theme: "bootstrap4"
        });
    }

    function simpan_gaji() {
        if (method == 'save') {
            url = '<?= site_url('master_gaji/simpan_gaji'); ?>';
        } else {
            url = '<?= site_url('master_gaji/update_gaji'); ?>';
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

    function edit_gaji(id) {
        method = 'update';
        $(".select2").select2({
            theme: "bootstrap4"
        });
        $('#btnSaveGaji').text('Update');
        $.ajax({
            url: '<?= site_url('master_gaji/edit_gaji/') ?>' + id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                $('#id').val(data.idm_gaji);
                $('#dari_idm').val(data.dari_idm).change();
                $('#tujuan_idm').val(data.tujuan_idm).change();
                $('#tipe').val(data.tipe).change();
                $('#gajii').val(data.gaji);
                $('#gaji').val(data.gaji);
                $('#uang_jalann').val(data.uang_jalan);
                $('#uang_jalan').val(data.uang_jalan);
                $('#ketjuan').val(data.ketjuan);

                $('#md-form-gaji').modal('show');
                $('#modal-title').text('Edit Data Gaji & Uang Jalan');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error!');
            }
        });
    }

    function hapus_gaji(id) {
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
                    url: "<?php echo site_url('master_gaji/delete_gaji') ?>/" + id,
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

    function init_select() {

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
    }
    $('.uang').mask('000.000.000.000', {
        reverse: true
    });
    var gajii = document.querySelector('input[name="gajii"]');
    var gaji = document.querySelector('input[name="gaji"]');
    gajii.onkeyup = function() {
        gaji.value = this.value.replace(/\./g, '');
    }
    var uang_jalann = document.querySelector('input[name="uang_jalann"]');
    var uang_jalan = document.querySelector('input[name="uang_jalan"]');
    uang_jalann.onkeyup = function() {
        uang_jalan.value = this.value.replace(/\./g, '');
    }
</script>
<?= $this->endSection('content'); ?>

<?= $this->section('css') ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css" />
<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/tambahan/sweetalert2/dist/sweetalert2.min.css">
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
<!-- Select2 -->
<script src="<?= base_url(''); ?>/assets/plugins/select2/js/select2.full.min.js"></script>
<!-- angka -->
<script src="<?= base_url(''); ?>/assets/tambahan/angka/dist/jquery.mask.js"></script>
<script src="<?= base_url(''); ?>/assets/tambahan/angka/dist/jquery.mask.min.js"></script>
<?= $this->endSection('js') ?>