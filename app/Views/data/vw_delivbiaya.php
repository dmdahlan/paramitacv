<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<style>
    table {
        size: 10px;
    }
</style>
<section class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="m-0 text-dark">Data Uang Jalan</h5>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Data Muatan</a></li>
                        <li class="breadcrumb-item active">Uang Jalan</li>
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
                                    <input id="tgldeliv" placeholder="Delivery" class="form-control tgl form-control-sm" type="text" autocomplete="off">
                                </div>
                                <div class="col-md-2">
                                    <input id="nopoll" placeholder="Nopol" class="form-control form-control-sm" type="text" autocomplete="off">
                                </div>
                                <div class="col">
                                    <button class="btn btn-info btn-sm" onclick="refresh()"> <span>Refresh</span></button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table table-sm">
                            <table id="biaya" class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>TANGGAL</th>
                                        <th>SJ KEMBALI</th>
                                        <th>NO POLISI</th>
                                        <th>ORDERAN</th>
                                        <th>DRIVER</th>
                                        <th>AWAL</th>
                                        <th>DARI - TUJUAN</th>
                                        <th>PRODUK</th>
                                        <th>SHIPMENT</th>
                                        <th>TGL</th>
                                        <th>NOMINAL</th>
                                        <th>TGL</th>
                                        <th>NOMINAL</th>
                                        <th>TGL</th>
                                        <th>MUAT</th>
                                        <th>TGL</th>
                                        <th>BONGKAR</th>
                                        <th>TGL</th>
                                        <th>INAP</th>
                                        <th>TGL</th>
                                        <th>PORTAL</th>
                                        <th>TGL</th>
                                        <th>LAIN2</th>
                                        <th>KET</th>
                                        <th>TOTAL</th>
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
<div class="modal fade" id="md-form-biaya">
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
                    <form id="frm-modal-biaya">
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Oderan</label>
                                    <input id="orderan" name="orderan" class="form-control" readonly>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Driver</label>
                                    <input id="driver_idm" name="driver_idm" class="form-control" readonly>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Dari</label>
                                    <input id="dari_idm" name="dari_idm" class="form-control" readonly>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class=" form-group">
                                    <label class="form-label">Tujuan</label>
                                    <input id="tujuan_idm" name="tujuan_idm" class="form-control" type="text" readonly>
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Tgl</label>
                                    <input id="tgl_1" name="tgl_1" class="form-control tanggal" type="text" placeholder="Tanggal" autocomplete="off">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Jumlah</label>
                                    <input id="jml_11" name="jml_11" class="form-control" type="text" placeholder="nominal" onkeyup="hitung()">
                                    <input type="hidden" id="jml_1" name="jml_1">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Tgl</label>
                                    <input id="tgl_2" name="tgl_2" class="form-control tanggal" type="text" placeholder="Tanggal" autocomplete="off">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Jumlah</label>
                                    <input id="jml_22" name="jml_22" class="form-control" type="text" placeholder="nominal" onkeyup="hitung()">
                                    <input type="hidden" id="jml_2" name="jml_2">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Tgl</label>
                                    <input id="tgl_buruhmuat" name="tgl_buruhmuat" class="form-control tanggal" type="text" placeholder="Tanggal" autocomplete="off">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Buruh Muat</label>
                                    <input id="jml_buruhmuatt" name="jml_buruhmuatt" class="form-control" type="text" placeholder="nominal" onkeyup="hitung()">
                                    <input type="hidden" id="jml_buruhmuat" name="jml_buruhmuat">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Tgl</label>
                                    <input id="tgl_buruhbongkar" name="tgl_buruhbongkar" class="form-control tanggal" type="text" placeholder="Tanggal" autocomplete="off">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Buruh Bongkar</label>
                                    <input id="jml_buruhbongkarr" name="jml_buruhbongkarr" class="form-control" type="text" placeholder="nominal" onkeyup="hitung()">
                                    <input type="hidden" id="jml_buruhbongkar" name="jml_buruhbongkar">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Tgl</label>
                                    <input id="tgl_inap" name="tgl_inap" class="form-control tanggal" type="text" placeholder="Tanggal" autocomplete="off">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Uang Inap</label>
                                    <input id="nominal_inapp" name="nominal_inapp" class="form-control" type="text" placeholder="nominal" onkeyup="hitung()">
                                    <input type="hidden" id="nominal_inap" name="nominal_inap">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Tgl</label>
                                    <input id="tgl_portal" name="tgl_portal" class="form-control tanggal" type="text" placeholder="Tanggal" autocomplete="off">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Uang Portal</label>
                                    <input id="nominal_portall" name="nominal_portall" class="form-control" type="text" placeholder="nominal" onkeyup="hitung()">
                                    <input type="hidden" id="nominal_portal" name="nominal_portal">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Tgl</label>
                                    <input id="tgl_lain2" name="tgl_lain2" class="form-control tanggal" type="text" placeholder="Tanggal" autocomplete="off">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Lain2</label>
                                    <input id="jml_lain22" name="jml_lain22" class="form-control" type="text" placeholder="nominal" onkeyup="hitung()">
                                    <input type="hidden" id="jml_lain2" name="jml_lain2">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Total</label>
                                    <input id="totall" name="totall" class="form-control" type="text" placeholder="nominal">
                                    <input type="hidden" id="total" name="total">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Keterangan</label>
                                    <input id="ket_biaya" name="ket_biaya" class="form-control" type="text" placeholder="Keterangan">
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button id='btnSavebiaya' class="btn btn-primary btn-sm float-right" onclick="simpan_biaya()">Simpan</button>
                <button onclick='batal()' type='button' class="btn btn-warning btn-sm float-right">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
    var jml_11 = document.getElementById('jml_11');
    var jml_1 = document.getElementById('jml_1');
    var jml_22 = document.getElementById('jml_22');
    var jml_2 = document.getElementById('jml_2');
    var jml_buruhmuatt = document.getElementById('jml_buruhmuatt');
    var jml_buruhmuat = document.getElementById('jml_buruhmuat');
    var jml_buruhbongkarr = document.getElementById('jml_buruhbongkarr');
    var jml_buruhbongkar = document.getElementById('jml_buruhbongkar');
    var nominal_inapp = document.getElementById('nominal_inapp');
    var nominal_inap = document.getElementById('nominal_inap');
    var nominal_portall = document.getElementById('nominal_portall');
    var nominal_portal = document.getElementById('nominal_portal');
    var jml_jmlain22 = document.getElementById('jml_lain22');
    var jml_jmlain2 = document.getElementById('jml_lain2');

    jml_11.addEventListener('keyup', function(e) {
        jml_11.value = currencyIDR(this.value);
        jml_1.value = this.value.replace(/\./g, '');
    });
    jml_22.addEventListener('keyup', function(e) {
        jml_22.value = currencyIDR(this.value);
        jml_2.value = this.value.replace(/\./g, '');
    });
    jml_buruhmuatt.addEventListener('keyup', function(e) {
        jml_buruhmuatt.value = currencyIDR(this.value);
        jml_buruhmuat.value = this.value.replace(/\./g, '');
    });
    jml_buruhbongkarr.addEventListener('keyup', function(e) {
        jml_buruhbongkarr.value = currencyIDR(this.value);
        jml_buruhbongkar.value = this.value.replace(/\./g, '');
    });
    nominal_inapp.addEventListener('keyup', function(e) {
        nominal_inapp.value = currencyIDR(this.value);
        nominal_inap.value = this.value.replace(/\./g, '');
    });
    nominal_portall.addEventListener('keyup', function(e) {
        nominal_portall.value = currencyIDR(this.value);
        nominal_portal.value = this.value.replace(/\./g, '');
    });
    jml_jmlain22.addEventListener('keyup', function(e) {
        jml_jmlain22.value = currencyIDR(this.value);
        jml_jmlain2.value = this.value.replace(/\./g, '');
    });

    function currencyIDR(angka, prefix) {
        if (prefix != "") {
            var num_string = angka.replace(/[^,\d]/g, '').toString(),
                split = num_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
        } else {
            var num_string = angka.toString(),
                sisa = num_string.length % 3,
                rupiah = num_string.substr(0, sisa),
                ribuan = num_string.substr(sisa).match(/\d{3}/g);
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
        }
    }

    function hitung() {
        var getjml_1 = document.getElementById('jml_11').value;
        var getjml_2 = document.getElementById('jml_22').value;
        var getmuat = document.getElementById('jml_buruhmuatt').value;
        var getbongkar = document.getElementById('jml_buruhbongkarr').value;
        var getinap = document.getElementById('nominal_inapp').value;
        var getportal = document.getElementById('nominal_portall').value;
        var getlain2 = document.getElementById('jml_lain22').value;

        var jml_1 = getjml_1.split(".").join("");
        var jml_2 = getjml_2.split(".").join("");
        var muat = getmuat.split(".").join("");
        var bongkar = getbongkar.split(".").join("");
        var inap = getinap.split(".").join("");
        var portal = getportal.split(".").join("");
        var lain2 = getlain2.split(".").join("");

        var grand = Number(jml_1) + Number(jml_2) + Number(muat) + Number(bongkar) + Number(inap) + Number(portal) + Number(lain2);

        var currencytotal = currencyIDR(grand, '');
        document.getElementById('totall').value = currencytotal;
        document.getElementById('total').value = grand;
    }
    var table;
    $(document).ready(function() {
        table = $('#biaya').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "autowidth": true,
            "ordering": true,
            "lengthMenu": [
                [18, 100, 500, 1500],
                [18, 100, 500, 1500]
            ],
            "scrollY": 720,
            "scrollX": true,
            "scrollCollapse": true,
            "fixedColumns": {
                "leftColumns": 10
            },
            // Load data for the table's content from an Ajax source
            ajax: {
                "url": "<?php echo site_url('deliv_biaya/ajax_list'); ?>",
                "type": "POST",
                "data": function(data) {
                    data.nopol = $('#nopoll').val();
                    data.tgl_deliv = $('#tgldeliv').val();
                },
            },
            "columnDefs": [{
                "targets": [10, 12, 14, 16, 18, 20],
                "className": 'text-right'
            }]
        });
    });
    $('#nopoll').keyup(function() {
        table.ajax.reload();
    });
    $('#tgldeliv').change(function() {
        table.ajax.reload();
    });

    function refresh() {
        document.getElementById("nopoll").value = "";
        document.getElementById("tgldeliv").value = "";
        reload_table();
    }

    function reload_table() {
        table.ajax.reload(null, false);
    }

    function batal() {
        $('#frm-modal-biaya')[0].reset();
        $('.help-block').empty();
        $('#md-form-biaya').modal('hide');
        $('.is-invalid').removeClass('is-invalid');
        $("input[type=hidden]").val('');
    }

    function tambah_biaya(id) {
        method = 'save';
        $('#md-form-biaya').modal('show');
        $('#modal-title').text('Tambah Data Uang Jalan');
        $('#btnSavebiaya').text('Simpan');

        $.ajax({
            url: '<?= site_url('deliv_biaya/edit_biaya/'); ?>' + id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                $('#deliv_idm').val(data.idm_deliv);
                $('#tgl_deliv').val(data.tgl);
                $('#nopol_idm').val(data.nopol);
                $('#orderan').val(data.orderan);
                $('#dari_idm').val(data.dari);
                $('#tujuan_idm').val(data.tujuan);
                $('#produk_idm').val(data.produk);
                $('#shipment').val(data.shipment);
                $('#driver_idm').val(data.nama);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error!');
            }
        });
    }

    function edit_biaya(id) {
        method = 'update';
        $('#md-form-biaya').modal('show');
        $('#modal-title').text('Edit Data biaya');
        $('#btnSavebiaya').text('Update');
        $.ajax({
            url: '<?= site_url('deliv_biaya/edit_biaya/'); ?>' + id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                $('#id').val(data.id_biaya);
                $('#deliv_idm').val(data.idm_deliv);
                $('#tgl_deliv').val(data.tgl);
                $('#nopol_idm').val(data.nopol);
                $('#orderan').val(data.orderan);
                $('#dari_idm').val(data.dari);
                $('#tujuan_idm').val(data.tujuan);
                $('#produk_idm').val(data.produk);
                $('#shipment').val(data.shipment);
                $('#driver_idm').val(data.nama);
                $('#tgl_1').val(data.tgl_1);
                $('#jml_1').val(data.jml_1);
                $('#jml_11').val(data.jml_1);
                $('#tgl_2').val(data.tgl_2);
                $('#jml_2').val(data.jml_2);
                $('#jml_22').val(data.jml_2);
                $('#tgl_buruhmuat').val(data.tgl_buruhmuat);
                $('#jml_buruhmuat').val(data.jml_buruhmuat);
                $('#jml_buruhmuatt').val(data.jml_buruhmuat);
                $('#tgl_buruhbongkar').val(data.tgl_buruhbongkar);
                $('#jml_buruhbongkar').val(data.jml_buruhbongkar);
                $('#jml_buruhbongkarr').val(data.jml_buruhbongkar);
                $('#tgl_inap').val(data.tgl_inap);
                $('#nominal_inapp').val(data.nominal_inap);
                $('#nominal_inap').val(data.nominal_inap);
                $('#tgl_portal').val(data.tgl_portal);
                $('#nominal_portall').val(data.nominal_portal);
                $('#nominal_portal').val(data.nominal_portal);
                $('#tgl_lain2').val(data.tgl_lain2);
                $('#jml_lain2').val(data.jml_lain2);
                $('#jml_lain22').val(data.jml_lain2);
                $('#ket_biaya').val(data.ket_biaya);
                $('#total').val(data.total);
                $('#totall').val(data.total);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error!');
            }
        });
    }

    function simpan_biaya() {
        if (method == 'save') {
            url = '<?= site_url('deliv_biaya/simpan_biaya'); ?>';
        } else {
            url = '<?= site_url('deliv_biaya/update_biaya'); ?>';
        }
        $.ajax({
            url: url,
            type: 'POST',
            data: new FormData($('#frm-modal-biaya')[0]),
            dataType: 'JSON',
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.status) {

                    $('.help-block').empty();
                    $('.is-invalid').removeClass('is-invalid');
                    $('#frm-modal-biaya')[0].reset();
                    $("input[type=hidden]").val('');
                    $('#md-form-biaya').modal('hide');
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

    function hapus_biaya(id) {
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
                    url: "<?php echo site_url('deliv_biaya/delete_biaya') ?>/" + id,
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
        format: "dd-mm-yyyy"
    });

    $('.tgl').datepicker({
        startView: "months",
        minViewMode: "months",
        format: 'MM yyyy'
    }).on('change', function() {
        $('.datepicker').hide();
    });
</script>
<?= $this->endSection('content'); ?>

<?= $this->section('css') ?>
<!-- DataTables -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">-->
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.3.2/css/fixedColumns.bootstrap4.min.css">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/tambahan/sweetalert2/dist/sweetalert2.min.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/tambahan/datepicker/dist/css/bootstrap-datepicker.min.css">
<?= $this->endSection('css') ?>

<?= $this->section('js') ?>
<!-- DataTables -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>-->
<script src="<?= base_url(''); ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(''); ?>/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(''); ?>/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(''); ?>/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url(''); ?>/assets/tambahan/sweetalert2/dist/sweetalert2.min.js"></script>
<!-- date-picker -->
<script src="<?= base_url(''); ?>/assets/tambahan/datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<?= $this->endSection('js') ?>