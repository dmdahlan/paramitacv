<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<section class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="" class="btn btn-info btn-sm" data-toggle="modal" onclick="tambah_form()">Tambah</a>
                                </div>
                                <div class="col-md-2">
                                    <input id="tglawal" placeholder="tgl awal" class="form-control tanggal form-control-sm" type="text" autocomplete="off">
                                </div>
                                <div class="col-md-2">
                                    <input id="tglakhir" placeholder="tgl akhir" class="form-control tanggal form-control-sm" type="text" autocomplete="off">
                                </div>
                                <div class="col-md-2">
                                    <select id="payment" class="form-control form-control-sm">
                                        <option value="">Status Tertagih</option>
                                        <option value="Belum Bayar">Belum Bayar</option>
                                    </select>
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
                            <table id="tb_rekapinv" class="table table-bordered table-hover table-striped js-basic-example dataTable nowrap cell-border" cellspacing="0" width="100%" role="grid">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>TANGGAL</th>
                                        <th>NO INVOICE</th>
                                        <th>NO FAKTUR</th>
                                        <th>CUSTOMER</th>
                                        <th>NOMINAL</th>
                                        <th>PPN</th>
                                        <th>PPH23</th>
                                        <th>TOTAL</th>
                                        <th>BANK</th>
                                        <th>TGL BYR</th>
                                        <th>NOMINAL</th>
                                        <!-- <th>TGL BYR</th>
                                        <th>NOMINAL</th> -->
                                        <th>SISA</th>
                                        <th>KETERANGAN</th>
                                        <!-- <th>Opsi</th> -->
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
<div class="modal fade" id="md-form-rekapinv">
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
                    <form id="frm-modal-rekapinv">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="hidden" id="id" name="id">
                                    <label class="form-label">TGL INVOICE</label>
                                    <input id="tgl_rekap" name="tgl_rekap" class="form-control tanggal" placeholder="Tanggal" type="text" autocomplete="off">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">NO INVOICE</label>
                                    <input id="no_inv" name="no_inv" class="form-control" placeholder="No Invoice" type="text">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-label">NO FAKTUR</label>
                                    <input id="no_faktur" name="no_faktur" class="form-control" placeholder="No Faktur" type="text">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-label">PRODUK</label>
                                    <select id="produk_idm" name="produk_idm" class="form-control select2">
                                    </select>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">NOMINAL</label>
                                    <input id="nominall" name="nominall" class=" form-control uang" placeholder="Nominal" type="text">
                                    <span class="help-block text-danger"></span>
                                    <input type="hidden" id="nominal" name="nominal">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">KETERANGAN</label>
                                    <input id="ket_rekap" name="ket_rekap" class="form-control" placeholder="Keterangan" type="text">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-label">BANK</label>
                                    <select id="bank1" name="brand_id" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="danamon">Danamon</option>
                                        <option value="bca">BCA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">TGL BAYAR</label>
                                    <input id="tgl_bayar1" name="tgl_bayar1" class="form-control tanggal" placeholder="Tanggal" type="text" autocomplete="off">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">NOMINAL</label>
                                    <input id="nominall1" name="nominall1" class=" form-control uang" placeholder="Nominal" type="text">
                                    <span class="help-block text-danger"></span>
                                    <input type="hidden" id="nominal1" name="nominal1">
                                </div>
                            </div>
                            <!-- <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">TGL BAYAR</label>
                                    <input id="tgl_bayar2" name="tgl_bayar2" class="form-control tanggal" placeholder="Tanggal" type="text" autocomplete="off">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">NOMINAL</label>
                                    <input id="nominall2" name="nominall2" class=" form-control uang" placeholder="Nominal" type="text">
                                    <span class="help-block text-danger"></span>
                                    <input type="hidden" id="nominal2" name="nominal2">
                                </div>
                            </div> -->
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button id='btnSaverekapinv' class="btn btn-primary btn-sm float-right" onclick="simpan_rekapinv()">Simpan</button>
                <button onclick='batal()' type='button' class="btn btn-warning btn-sm float-right">Close</button>
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
        table = $('#tb_rekapinv').DataTable({
            processing: true, //Feature control the processing indicator.
            serverSide: true, //Feature control DataTables' server-side processing mode.
            order: [], //Initial no order.
            autowidth: true,
            ordering: true,
            // Load data for the table's content from an Ajax source
            ajax: {
                "url": "<?php echo site_url('rekap_invoice/ajax_list') ?>",
                "type": "POST",
                "data": function(data) {
                    data.tgl_awal = $('#tglawal').val();
                    data.tgl_akhir = $('#tglakhir').val();
                    data.payment = $('#payment').val();
                },
            },
            "columnDefs": [{
                "targets": [5, 6, 7, 8, 11, 13],
                "className": 'text-right'
            }]
        });
        init_select();
    });
    $('#payment').change(function() {
        table.ajax.reload();
    });
    $('#btn-filter').click(function() { //button filter event click
        table.ajax.reload(); //just reload table
    });

    function batal() {
        $('#frm-modal-rekapinv')[0].reset();
        $('#md-form-rekapinv').modal('hide');
        $('.help-block').empty();
        $("input[type=hidden]").val('');
        $('.is-invalid').removeClass('is-invalid');
    }

    function refresh() {
        document.getElementById("tglawal").value = "";
        document.getElementById("tglakhir").value = "";
        document.getElementById("payment").value = "";
        reload_table();
    }

    function reload_table() {
        table.ajax.reload(null, false);
    }

    function tambah_form() {
        method = 'save';
        $('#md-form-rekapinv').modal('show');
        $('#modal-title').text('Tambah Data rekapinv');
        $('#btnSaverekapinv').text('Save');
        $('.is-invalid').removeClass('is-invalid');
        $(".select2").select2({
            theme: "bootstrap4"
        });
    }

    function simpan_rekapinv() {
        if (method == 'save') {
            url = '<?= site_url('rekap_invoice/save'); ?>';
        } else {
            url = '<?= site_url('rekap_invoice/update'); ?>';
        }
        $.ajax({
            url: url,
            type: 'POST',
            data: new FormData($('#frm-modal-rekapinv')[0]),
            dataType: 'JSON',
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.status) {
                    $('.help-block').empty();
                    $('#frm-modal-rekapinv')[0].reset();
                    $('.is-invalid').removeClass('is-invalid');
                    $("input[type=hidden]").val('');
                    $('#md-form-rekapinv').modal('hide');
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

    function edit_rekap(id) {
        method = 'update';
        $('#btnSaverekapinv').text('Update');
        $(".select2").select2({
            theme: "bootstrap4"
        });
        $.ajax({
            url: '<?= site_url('rekap_invoice/edit/') ?>' + id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                $('#id').val(data.id_rekap);
                $('#tgl_rekap').val(data.tgl_rekap);
                $('#no_inv').val(data.no_inv);
                $('#no_faktur').val(data.no_faktur);
                $('#produk_idm').val(data.produk_idm).change();
                $('#nominall').val(data.nominal);
                $('#nominal').val(data.nominal);
                $('#ket_rekap').val(data.ket_rekap);
                $('#bank1').val(data.bank1);
                $('#tgl_bayar1').val(data.tgl_bayar1);
                $('#nominall1').val(data.nominal1);
                // $('#tgl_bayar2').val(data.tgl_bayar2);
                // $('#nominall2').val(data.nominal2);
                $('#md-form-rekapinv').modal('show');
                $('#modal-title').text('Edit Data rekapinv');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error!');
            }
        });
    }

    function hapus_rekapinv(id) {
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
                    url: "<?php echo site_url('rekapinv_order/delete') ?>/" + id,
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
                icon: 'warning',
                title: 'Data berhasil di ubah'
            })
        }

    }

    function init_select() {
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
    var nominall = document.querySelector('input[name="nominall"]');
    var niminal = document.querySelector('input[name="nominal"]');
    nominall.onkeyup = function() {
        nominal.value = this.value.replace(/\./g, '');
    }
    var nominall1 = document.querySelector('input[name="nominall1"]');
    var niminal1 = document.querySelector('input[name="nominal1"]');
    nominall1.onkeyup = function() {
        nominal1.value = this.value.replace(/\./g, '');
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
<!-- angka -->
<script src="<?= base_url(''); ?>/assets/tambahan/angka/dist/jquery.mask.js"></script>
<script src="<?= base_url(''); ?>/assets/tambahan/angka/dist/jquery.mask.min.js"></script>
<?= $this->endSection('js') ?>