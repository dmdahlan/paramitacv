<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<section class="content-wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h4>Print Invoice</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Printa Invoice</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <img src="<?= base_url(''); ?>/img/logao.png" width="200px" alt="">
                                    </div>
                                    <form action="" method="POST">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="keyword" placeholder="no invoice">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="submit">cari</button>
                                                <a onclick="window.print()" class="btn btn-default btn-sm"><i class="fas fa-print"></i> Print</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="row invoice-info">
                                    <div class="col-sm-8 invoice-col">
                                    </div>
                                    <div class="col-sm-2 invoice-col">
                                        <strong>INVOICE TO:</strong>
                                    </div>
                                </div>
                                <div class="row invoice-info">
                                    <div class="col-sm-8 invoice-col">
                                    </div>
                                    <div class="col-sm-3 invoice-col">
                                        <strong>PT. Coca-Cola Distribution Indonesia</strong>
                                    </div>
                                </div>
                                <div class="row invoice-info">
                                    <div class="col-sm-2 invoice-col">
                                        <address>
                                            Invoice<br>
                                            Tanggal<br>
                                            PPN
                                        </address>
                                    </div>
                                    <div class="col-sm-1 invoice-col">
                                        <address>
                                            :<br>
                                            :<br>
                                            :<br>
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-5 invoice-col">
                                        <b>121 prmt</b><br>
                                        <b>20 November</b><br>
                                        <b>01010101</b>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        <b>Jl. Teuku umar km.46</b><br>
                                        <b>Cibitung - Bekasi</b><br>
                                        <b>Indonesia 1720</b>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table table-responsive table-sm" style="font-size: 14px;">
                                <table class="table table-bordered table-hover table-striped js-basic-example dataTable nowrap cell-border" cellspacing="0" width="100%" role="grid">
                                    <thead>
                                        <tr class="bg-info">
                                            <th>NO</th>
                                            <th>TANGGAL</th>
                                            <th>NO POLISI</th>
                                            <th>TYPE</th>
                                            <th>AREA</th>
                                            <th>NO RC</th>
                                            <th>NAMA OUTLET</th>
                                            <th>QTY in PC</th>
                                            <th>TARIF</th>
                                            <th>Ppn</th>
                                            <th>Pph23</th>
                                            <th>TOTAL</th>
                                            <th>KETERANGAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $totalqty = 0;
                                        $totalharga = 0;
                                        $totalppn = 0;
                                        $totalpph = 0;
                                        $totalgrand = 0;
                                        ?>
                                        <?php foreach ($invoice as $inv) : ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $inv['tgl'] ?></td>
                                                <td><?= $inv['nopol'] ?></td>
                                                <td><?= $inv['orderan'] ?></td>
                                                <td><?= $inv['dari'] ?></td>
                                                <td><?= $inv['shipment'] ?></td>
                                                <td><?= $inv['outlet'] ?></td>
                                                <td><?= $inv['qty'] ?></td>
                                                <td><?= $inv['nominal'] ?></td>
                                                <td><?= $inv['nominal'] * 10 / 100 ?></td>
                                                <td><?= $inv['nominal'] * 2 / 100 ?></td>
                                                <td>
                                                    <?= $inv['nominal'] + $inv['nominal'] * 10 / 100 - $inv['nominal'] * 2 / 100 ?>
                                                </td>
                                                <td><?= $inv['billing'] ?></td>
                                            </tr>
                                            <?php
                                            $totalqty +=  $inv['qty'];
                                            $totalharga +=  $inv['nominal'];
                                            $totalppn +=  $inv['nominal'] * 10 / 100;
                                            $totalpph +=  $inv['nominal'] * 2 / 100;
                                            $totalgrand +=  $inv['nominal'] + $inv['nominal'] * 10 / 100 - $inv['nominal'] * 2 / 100;
                                            ?>
                                        <?php endforeach ?>
                                        <tr>
                                            <td colspan="7"></td>
                                            <td><?= $totalqty ?></td>
                                            <td><?= $totalharga ?></td>
                                            <td><?= $totalppn ?></td>
                                            <td><?= $totalpph ?></td>
                                            <td><?= $totalgrand ?></td>
                                            <td></td>
                                        </tr>
                                        <?php

                                        // FUNGSI TERBILANG OLEH : MALASNGODING.COM
                                        // WEBSITE : WWW.MALASNGODING.COM
                                        // AUTHOR : https://www.malasngoding.com/author/admin


                                        function penyebut($nilai)
                                        {
                                            $nilai = abs($nilai);
                                            $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
                                            $temp = "";
                                            if ($nilai < 12) {
                                                $temp = " " . $huruf[$nilai];
                                            } else if ($nilai < 20) {
                                                $temp = penyebut($nilai - 10) . " belas";
                                            } else if ($nilai < 100) {
                                                $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
                                            } else if ($nilai < 200) {
                                                $temp = " Seratus" . penyebut($nilai - 100);
                                            } else if ($nilai < 1000) {
                                                $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
                                            } else if ($nilai < 2000) {
                                                $temp = " Seribu" . penyebut($nilai - 1000);
                                            } else if ($nilai < 1000000) {
                                                $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
                                            } else if ($nilai < 1000000000) {
                                                $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
                                            } else if ($nilai < 1000000000000) {
                                                $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
                                            } else if ($nilai < 1000000000000000) {
                                                $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
                                            }
                                            return $temp;
                                        }

                                        function terbilang($nilai)
                                        {
                                            if ($nilai < 0) {
                                                $hasil = "minus " . trim(penyebut($nilai));
                                            } else {
                                                $hasil = trim(penyebut($nilai));
                                            }
                                            return $hasil;
                                        }


                                        $angka = $totalgrand;

                                        ?>
                                        <tr>
                                            <td colspan="13"><b>Terbilang : <?= terbilang($angka); ?> Rupiah<b></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="card border-dark mt-2" style="max-width: 20rem;">
                                                <div class="card-body text-dark">
                                                    <p>Keterangan :</p>
                                                    <p>Dana dapat ditransfer ke rekening atas nama:</p>
                                                    <p>CV. Paramita</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            Balikpapan, 02 Desember 2020
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">

                                        </div>
                                        <div class="col-md-4">
                                            Pranawingrum
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</section>
<?= $this->endsection() ?>