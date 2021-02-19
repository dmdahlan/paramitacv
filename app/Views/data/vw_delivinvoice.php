<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<section class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="m-0 text-dark">Data Invoice</h5>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Data Muatan</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
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
                                    <select id="bt" class="form-control form-control-sm">
                                        <option value="">Status Tertagih</option>
                                        <option value="Belum Tertagih">Belum Tertagih</option>
                                        <option value="Tertagih">Tertagih</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input id="tgldeliv" placeholder="Tanggal Delivery" class="form-control tanggall form-control-sm" type="text" autocomplete="off">
                                </div>
                                <div class="col-md-2">
                                    <input id="dari" placeholder="dari" class="form-control form-control-sm" type="text" autocomplete="off">
                                </div>
                                <div class="col-md-2">
                                    <input id="tujuan" placeholder="tujuan" class="form-control form-control-sm" type="text" autocomplete="off">
                                </div>
                                <div class="col">
                                    <button class="btn btn-info btn-sm" onclick="refresh()"> <span>Refresh</span></button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table table-responsive table-sm" style="font-size: 14px;">
                            <table id="invoice" class="table table-bordered table-hover table-striped js-basic-example dataTable nowrap cell-border" cellspacing="0" width="100%" role="grid">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>TANGGAL</th>
                                        <th>SJ KEMBALI</th>
                                        <th>NO POLISI</th>
                                        <th>TYPE</th>
                                        <th>DARI - TUJUAN</th>
                                        <th>CUSTOMER</th>
                                        <th>SHIPMENT</th>
                                        <th>Qty</th>
                                        <th>TGL INV</th>
                                        <th>NO INV</th>
                                        <th>BILLING</th>
                                        <th>INVOICE</th>
                                        <th>BIAYA</th>
                                        <th>GAJI</th>
                                        <th>MARGIN</th>
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
<div class="modal fade" id="md-form-invoice">
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
                    <form id="frm-modal-invoice">
                        <?= csrf_field() ?>
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
                                    <label class="form-label">No Kendaraan</label>
                                    <input id="nopol_idm" name="nopol_idm" class="form-control" readonly>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">Oderan</label>
                                    <input id="orderan" name="orderan" class="form-control" readonly>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Dari</label>
                                    <input id="dari_idm" name="dari_idm" class="form-control" readonly>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class=" form-group">
                                    <label class="form-label">Outlet</label>
                                    <input id="outlet" name="outlet" class="form-control" type="text" readonly>
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
                                    <label class="form-label">Shipment</label>
                                    <input id="shipment" name="shipment" class="form-control" readonly>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label">Qty</label>
                                    <input id="qty" name="qty" class="form-control" type="text" readonly>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Tgl Inv</label>
                                    <input id="tgl_inv" name="tgl_inv" class="form-control tanggal" type="text" placeholder="Tanggal Invoice" autocomplete="off">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">No Inv</label>
                                    <input id="no_inv" name="no_inv" class="form-control" type="text" placeholder="No Invoice">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Billing</label>
                                    <input id="billing" name="billing" class="form-control" type="text" placeholder="Billing">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Tarif</label>
                                    <input id="nominall" name="nominall" class="form-control uang" type="text" placeholder="Nominal">
                                    <input type="hidden" id="nominal" name="nominal">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button id='btnSaveInvoice' class="btn btn-primary btn-sm float-right" onclick="simpan_inv()">Simpan</button>
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
        table = $('#invoice').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "autowidth": true,
            "ordering": true,
            "scrollY": 350,
            "scrollX": true,
            "lengthMenu": [
                [10, 100, 500, 1500],
                [10, 100, 500, 1500]
            ],
            "createdRow": function(row, data, dataIndex) {
                if (data[2] == '') {
                    // $(row).css("background-color", "crimson");
                    $(row).css("color", "red");
                }
            },
            // Load data for the table's content from an Ajax source
            ajax: {
                "url": "<?php echo site_url('deliv_invoice/ajax_list'); ?>",
                "type": "POST",
                "data": function(data) {
                    data.nopol = $('#nopoll').val();
                    data.bk = $('#bk').val();
                    data.bt = $('#bt').val();
                    data.tgldeliv = $('#tgldeliv').val();
                    data.dari = $('#dari').val();
                    data.tujuan = $('#tujuan').val();
                },
            },
            "columnDefs": [{
                "targets": [11, 12, 13],
                "className": 'text-right'
            }]
        });
    });
    $('#bk').change(function() {
        table.ajax.reload();
    });
    $('#bt').change(function() {
        table.ajax.reload();
    });
    $('#tgldeliv').change(function() {
        table.ajax.reload();
    });
    $('#dari').keyup(function() {
        table.ajax.reload();
    });
    $('#tujuan').keyup(function() {
        table.ajax.reload();
    });

    function reload_table() {
        table.ajax.reload(null, false);
    }

    function refresh() {
        document.getElementById("bk").value = "";
        document.getElementById("bt").value = "";
        document.getElementById("tgldeliv").value = "";
        document.getElementById("dari").value = "";
        document.getElementById("tujuan").value = "";
        reload_table();
    }

    function batal() {
        $('#frm-modal-invoice')[0].reset();
        $('.help-block').empty();
        $('#md-form-invoice').modal('hide');
        $('.is-invalid').removeClass('is-invalid');
        $("input[type=hidden]").val('');
    }

    function tambah_inv(id) {
        method = 'save';
        $('#md-form-invoice').modal('show');
        $('#modal-title').text('Tambah Data Invoice');
        $('#btnSaveInvoice').text('Simpan');

        $.ajax({
            url: '<?= site_url('deliv_invoice/edit_inv/'); ?>' + id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                $('#deliv_idm').val(data.idm_deliv);
                $('#tgl_deliv').val(data.tgl);
                $('#nopol_idm').val(data.nopol);
                $('#orderan').val(data.orderan);
                $('#dari_idm').val(data.dari);
                $('#outlet').val(data.outlet);
                $('#produk_idm').val(data.produk);
                $('#shipment').val(data.shipment);
                $('#qty').val(data.qty);
                $('#nominal').val(data.tarif);
                $('#nominall').val(data.tarif);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error!');
            }
        });
    }

    function edit_inv(id) {
        method = 'update';
        $('#md-form-invoice').modal('show');
        $('#modal-title').text('Edit Data Invoice');
        $('#btnSaveInvoice').text('Update');
        $.ajax({
            url: '<?= site_url('deliv_invoice/edit_inv/'); ?>' + id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                $('#id').val(data.idm_inv);
                $('#deliv_idm').val(data.idm_deliv);
                $('#tgl_deliv').val(data.tgl);
                $('#nopol_idm').val(data.nopol);
                $('#orderan').val(data.orderan);
                $('#dari_idm').val(data.dari);
                $('#outlet').val(data.outlet);
                $('#produk_idm').val(data.produk);
                $('#shipment').val(data.shipment);
                $('#qty').val(data.qty);
                $('#tgl_inv').val(data.tgl_inv);
                $('#no_inv').val(data.no_inv);
                $('#billing').val(data.billing);
                $('#nominal').val(data.tarif);
                $('#nominall').val(data.tarif);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error!');
            }
        });
    }

    function simpan_inv() {
        if (method == 'save') {
            url = '<?= site_url('deliv_invoice/simpan_invoice'); ?>';
        } else {
            url = '<?= site_url('deliv_invoice/update_invoice'); ?>';
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
    }).datepicker("setDate", new Date());
    $('.tanggall').datepicker({
        startView: "months",
        minViewMode: "months",
        format: 'yyyy-mm'
    }).on('change', function() {
        $('.datepicker').hide();
    });
    $('.uang').mask('000.000.000.000', {
        reverse: true
    });
    var nominall = document.querySelector('input[name="nominall"]');
    var nominal = document.querySelector('input[name="nominal"]');
    nominall.onkeyup = function() {
        nominal.value = this.value.replace(/\./g, '');
    }
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
<!-- angka -->
<script src="<?= base_url(''); ?>/assets/tambahan/angka/dist/jquery.mask.js"></script>
<script src="<?= base_url(''); ?>/assets/tambahan/angka/dist/jquery.mask.min.js"></script>
<?= $this->endSection('js') ?>