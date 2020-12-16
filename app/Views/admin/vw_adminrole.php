<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<section class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0 text-dark">Data Role</h5>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Administrator</a></li>
                        <li class="breadcrumb-item active">Data Role</li>
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
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" onclick="tambah()">Tambah</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table table-responsive table-sm" style="font-size: 14px;">
                            <table id="tb_role" class="table table-bordered table-hover table-striped js-basic-example dataTable nowrap cell-border" cellspacing="0" width="100%" role="grid">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Role</th>
                                        <th>Nama Role</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($role as $r) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $r['name']; ?></td>
                                            <td><?= $r['description']; ?></td>
                                            <td>
                                                <a href="javascript:void(0)" title="Edit" class="btn btn-success btn-xs" onclick="aksesmenu('<?= $r['id']; ?>')">Akses</a>
                                                <a href="<?= base_url('admin_role/roleaccess') . '/' . $r['id']; ?>" class="btn btn-primary btn-xs">Akses</a>
                                                <button href="" class="btn btn-warning btn-xs" onclick="edit('<?= $r['id']; ?>')">edit</button>
                                                <a href="admin_role/delete/<?= $r['id']; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Hapus Data?')">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
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
<!-- /.modal -->
<div class="modal fade" id="md-form-role" aria-labelledby="md-form-role" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel"></h5>
                <button onclick='batal()' type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                <div class="form-group">
                    <form id="frm-modal-role" action="<?= base_url('admin_role/save'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" id="id" name="id">
                                    <label class="form-label">Role</label>
                                    <input id="name" name="name" class="form-control <?= ($validation->haserror('name')) ? 'is-invalid' : ''; ?>" value="<?= (old('name')) ?>" placeholder="Role" type="text">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('name'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Nama Role</label>
                                    <input id="description" name="description" class="form-control <?= ($validation->haserror('description')) ? 'is-invalid' : ''; ?>" value="<?= old('description'); ?>" placeholder=" Nama Role" type="text">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('description'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm float-right">Simpan</button>
                            <button onclick='batal()' type='button' class="btn btn-warning btn-sm float-right">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- /.modal -->
<div class="modal fade" id="md-form-role-access" aria-labelledby="md-form-role-access" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel"></h5>
                <button onclick='batal()' type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-5">
                                        <h5 id="namerole"></h5>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table table-responsive table-sm" style="font-size: 14px;">
                                <table id="tb_role_akses" class="table table-bordered table-hover table-striped js-basic-example dataTable nowrap cell-border" cellspacing="0" width="100%" role="grid">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Menu</th>
                                            <th>Url</th>
                                            <th>Parent Menu</th>
                                            <th>Akses</th>
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
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript">
    $(function() {
        table = $('#tb_role').DataTable()
        // table.page('last').draw(false);
    });

    function batal() {
        $('#frm-modal-role')[0].reset();
        $('.help-block').empty();
        $('.is-invalid').removeClass('is-invalid');
        $('#md-form-role').modal('hide');
    }

    function tambah() {
        $('#md-form-role').modal('show');
        $('#formModalLabel').html('Tambah Data Role');
        $('.modal-footer button[type=submit]').html('Simpan');
    }

    function edit(id) {
        $('#md-form-role').modal('show');
        $('#formModalLabel').html('Ubah Data Role');
        $('.modal-footer button[type=submit]').html('Update Role');
        $('.modal-body form').attr('action', "<?= base_url('admin_role/update') ?>");

        $.ajax({
            url: "<?= base_url(''); ?>/admin_role/edit/" + id,
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#frm-modal-role')[0].reset();

                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#description').val(data.description);
            }
        });
    }

    function aksesmenu(id) {
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $.ajax({
            url: "<?php echo site_url('admin_role/edit/') ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                table = $('#tb_role_akses').DataTable({
                    processing: true, //Feature control the processing indicator.
                    serverSide: true, //Feature control DataTables' server-side processing mode.
                    order: [], //Initial no order.
                    autowidth: true,
                    ordering: false,
                    destroy: true,
                    lengthMenu: [10, 20, 50],
                    ajax: {
                        url: "<?php echo base_url('admin_menu/ajax_list_menu/'); ?>",
                        type: 'POST',
                        data: function(data) {
                            data.id = id;
                        },
                    },
                });
                $('#namerole').text(data.description);
                // show bootstrap modal
                $('#md-form-role-access').modal('show');
                $('#modal-title').text('Edit Data Menu');

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    $(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });
        <?php if (session()->getFlashData('suksesinput')) : ?>
            Toast.fire({
                icon: 'success',
                title: 'Data Berhasil diinput'
            })
        <?php endif; ?>
        <?php if (session()->getFlashData('ubahdata')) : ?>
            Toast.fire({
                icon: 'warning',
                title: 'Data Berhasil diubah'
            })
        <?php endif; ?>
        <?php if (session()->getFlashData('gagal')) : ?>
            $('#md-form-role').modal('show');
        <?php endif; ?>
    });
    $('.form-check-input').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        $.ajax({
            url: "<?= base_url('admin_role/changeaccess'); ?>",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                document.location.href = "<?= site_url('admin_role/roleaccess/'); ?>" + roleId;
            }
        });
    });
</script>
<?= $this->endSection('content'); ?>

<?= $this->section('css') ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css" />
<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/tambahan/sweetalert2/dist/sweetalert2.min.css">
<?= $this->endSection('css') ?>

<?= $this->section('js') ?>
<!-- DataTables -->
<script src="<?= base_url(''); ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(''); ?>/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(''); ?>/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(''); ?>/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url(''); ?>/assets/tambahan/sweetalert2/dist/sweetalert2.min.js"></script>
<?= $this->endSection('js') ?>