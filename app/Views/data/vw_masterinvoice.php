<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<section class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0 text-dark">Tarif Invoice</h5>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                        <li class="breadcrumb-item active">Tarif Invoice</li>
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
                                    <a href="" class="btn btn-info btn-sm" data-toggle="modal" onclick="tambah_invoice()">Tambah</a>
                                    <button class="btn btn-info btn-sm" onclick="refresh()"> <span>Refresh</span></button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table table-responsive table-sm" style="font-size: 14px;">
                            <table id="tb_invoice" class="table table-bordered table-hover table-striped js-basic-example dataTable nowrap cell-border" cellspacing="0" width="100%" role="grid">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Dari</th>
                                        <th>Tujuan</th>
                                        <th>Orderan</th>
                                        <th>Customer</th>
                                        <th>Tarif</th>
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
<div class="modal fade" id="md-form-invoice">
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
                    <form id="frm-modal-invoice">
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
                                    <label class="form-label">Orderan</label>
                                    <select id="orderan" name="orderan" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="CDD">CDD</option>
                                        <option value="FUSO">FUSO</option>
                                    </select>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Customer</label>
                                    <select id="produk_idm" name="produk_idm" class="form-control select2">
                                    </select>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Tarif</label>
                                    <input id="tariff" name="tariff" class=" form-control uang" placeholder="Invoice" type="text">
                                    <span class="help-block text-danger"></span>
                                    <input type="hidden" id="tarif" name="tarif">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Pengkodean</label>
                                    <input type="text" class="form-control" id="kode_inv" name="kode_inv" readonly>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button id='btnSaveinvoice' class="btn btn-primary btn-sm float-right" onclick="simpan_invoice()">Simpan</button>
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
        table = $('#tb_invoice').DataTable({
            processing: true, //Feature control the processing indicator.
            serverSide: true, //Feature control DataTables' server-side processing mode.
            order: [], //Initial no order.
            autowidth: true,
            ordering: true,
            // Load data for the table's content from an Ajax source
            ajax: {
                "url": "<?php echo site_url('master_invoice/ajax_list') ?>",
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
        $('#frm-modal-invoice')[0].reset();
        $('#md-form-invoice').modal('hide');
        $('.help-block').empty();
        $("input[type=hidden]").val('');
        $('.is-invalid').removeClass('is-invalid');
    }
    $('#dari_idm,#tujuan_idm,#orderan,#produk_idm').change(function() {
        var dari = $('#dari_idm').val();
        var tujuan = $('#tujuan_idm').val();
        var tipe = $('#orderan').val();
        var produk = $('#produk_idm').val();
        var gabung = dari.concat(tujuan, tipe, produk);
        $('#kode_inv').val(gabung);
    });

    function tambah_invoice() {
        method = 'save';
        $('#md-form-invoice').modal('show');
        $("input[type=hidden]").val('');
        $('#modal-title').text('Tambah Tarif Invoice');
        $('#btnSaveinvoice').text('Simpan');
        $('.is-invalid').removeClass('is-invalid');
        $(".select2").select2({
            theme: "bootstrap4"
        });
    }

    function simpan_invoice() {
        if (method == 'save') {
            url = '<?= site_url('master_invoice/simpan_invoice'); ?>';
        } else {
            url = '<?= site_url('master_invoice/update_invoice'); ?>';
        }
        $.ajax({
            url: url,
            type: 'POST',
            data: new FormData($('#frm-modal-invoice')[0]),
            dataType: 'JSON',
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.status) {

                    $('.help-block').empty();
                    $('.is-invalid').removeClass('is-invalid');
                    $('#frm-modal-invoice')[0].reset();
                    $("input[type=hidden]").val('');
                    $('#md-form-invoice').modal('hide');
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

    function edit_invoice(id) {
        method = 'update';
        $(".select2").select2({
            theme: "bootstrap4"
        });
        $('#btnSaveinvoice').text('Update');
        $.ajax({
            url: '<?= site_url('master_invoice/edit_invoice/') ?>' + id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                $('#id').val(data.id_tarif);
                $('#dari_idm').val(data.dari_idm).change();
                $('#tujuan_idm').val(data.tujuan_idm).change();
                $('#orderan').val(data.orderan);
                $('#produk_idm').val(data.produk_idm).change();
                $('#tarif').val(data.tarif);
                $('#tariff').val(data.tarif);
                $('#ket_inv').val(data.ket_inv);

                $('#md-form-invoice').modal('show');
                $('#modal-title').text('Edit Tarif Invoice');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error!');
            }
        });
    }

    function hapus_invoice(id) {
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
                    url: "<?php echo site_url('master_invoice/delete_invoice') ?>/" + id,
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
        let dropdown_produk = $('#produk_idm');
        dropdown_produk.empty();
        dropdown_produk.append('<option value="">Pilih Customer</option>');
        dropdown_produk.prop('selectedIndex', 0);
        const url_produk = '<?= base_url('master_produk/getproduk/') ?>';
        // Populate dropdown with list
        $.getJSON(url_produk, function(data) {
            $.each(data, function(key, entry) {
                dropdown_produk.append($('<option></option>').attr('value', entry.idm_produk).text(entry.customer));
            })
        });
    }
    $('.uang').mask('000.000.000.000', {
        reverse: true
    });
    var tariff = document.querySelector('input[name="tariff"]');
    var tarif = document.querySelector('input[name="tarif"]');
    tariff.onkeyup = function() {
        tarif.value = this.value.replace(/\./g, '');
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