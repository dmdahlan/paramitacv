<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<style>
    @media print {
        .btn {
            display: none;
        }

        .form-control-sm {
            display: none;
        }

        .main-footer {
            display: none;
        }
    }
</style>
<?php

use CodeIgniter\I18n\Time;
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h4>PRINT INVOICE</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">PRINT INVOICE</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="invoice">
        <div class="container">
            <!-- title row -->
            <div class="row">
                <form action="" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-sm" name="keyword" placeholder="no invoice" value="<?= $ket['no_inv']; ?>">
                        <div class="input-group-append">
                            <button class="btn btn-default btn-sm" type="submit">cari</button>
                            <a onclick="window.print()" class="btn btn-default btn-sm"><i class="fas fa-print"></i> Print</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                        <img src="<?= base_url('img/paramita.png') ?>" width="200px" alt="">
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-1 invoice-col">
                    <address>
                        <strong style=" font-size:20px"> <u>INVOICE</u> </strong>
                    </address>
                </div>
            </div>
            <div class="row invoice-info">
                <div class="col-sm-1 invoice-col">
                    <address style=" font-size:20px">
                        INVOICE<br>
                        TANGGAL <br>
                        PO
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-1 invoice-col">
                    <address style=" font-size:20px">
                        :<br>
                        :<br>
                        :
                    </address>
                </div>

                <div class="col-sm-5 invoice-col">
                    <address style=" font-size:20px">
                        <?= $ket['no_inv'] ?><br>
                        <?= Time::parse($ket['tgl_inv'])->toLocalizedString('dd MMMM yyyy') ?><br>
                        <?= $ket['po'] ?><br>
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    <address class="float-right" style=" font-size:20px">
                        <strong>INVOICE TO :</strong><br>
                        <?= $ket['customer'] ?> <br>
                        <?= $ket['alamat'] ?>
                    </address>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12  table-sm" style="font-size: 14px;">
                    <table class="table" width="100%" style="border: 1px solid black">
                        <thead>
                            <tr>
                                <th style="border: 1px solid black; font-size:20px">NO</th>
                                <th style="border: 1px solid black; font-size:20px">TANGGAL</th>
                                <th style="border: 1px solid black; font-size:20px">NO POLISI</th>
                                <th style="border: 1px solid black; font-size:20px">TYPE</th>
                                <th style="border: 1px solid black; font-size:20px">AREA</th>
                                <th style="border: 1px solid black; font-size:20px">NO SHIPMENT</th>
                                <th style="border: 1px solid black; font-size:20px">QTY</th>
                                <th style="border: 1px solid black; font-size:20px">TARIF</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php


                            $i = 1;
                            $dpp = 0;
                            $dppppn = 0;
                            $ppn = 0;
                            $pph = 0;
                            $grand_total = 0;
                            ?>
                            <?php foreach ($invoice as $r) : ?>
                                <tr>
                                    <td style="border: 1px solid black; font-size:20px"><?= $i++ ?></td>
                                    <td style="border: 1px solid black; font-size:20px"><?= Time::parse($r['tgl'])->toLocalizedString('dd-MMM-yy') ?></td>
                                    <td style="border: 1px solid black; font-size:20px"><?= $r['nopol'] ?></td>
                                    <td style="border: 1px solid black; font-size:20px"><?= $r['jenis'] ?></td>
                                    <td style="border: 1px solid black; font-size:20px"><?= $r['dari'] . ' - ' . $r['tujuan'] ?></td>
                                    <td style="border: 1px solid black; font-size:20px"><?= $r['shipment'] ?></td>
                                    <td style="border: 1px solid black; font-size:20px"><?= number_format($r['qty'], 0, ',', '.') ?></td>
                                    <td style="border: 1px solid black; font-size:20px" class="text-right"><?= number_format($r['nominal'], 0, ',', '.') ?></td>
                                    <?php $dpp += $r['nominal'] ?>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class=" row">
                <!-- accepted payments column -->
                <div class="col-7">
                    <p>KETERANGAN:</p>
                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                        Dana dapat ditransfer ke rekening atas nama: <br>
                        CV. PARAMITA <br>
                        Bank Danamon Cabang BALIKPAPAN <br>
                        Primagiro No 33109547
                    </p>

                </div>
                <!-- /.col -->
                <div class="col-4 table-sm" style="font-size: 14px;">
                    <div class=" table-responsive">
                        <table class="table" rules=rows>
                            <?php
                            if ($ket['ppninv'] == 1) {
                                $ppn = $dpp * 10 / 100;
                            } else {
                                $ppn = null;
                            }
                            if ($ket['pphinv'] == 1) {
                                $pph = $dpp * 2 / 100;
                            } else {
                                $pph = null;
                            }
                            $dppppn = $dpp + $ppn;
                            $grand_total = $dpp + $ppn - $pph;
                            ?>
                            <tr>
                                <th></th>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th style="width:40%; font-size:20px">DPP</th>
                                <td style=" font-size:20px">:</td>
                                <td class="text-right" style=" font-size:20px"><?= number_format($dpp, 0, ',', '.') ?></td>
                                <td style=" font-size:20px"></td>
                            </tr>
                            <tr>
                                <th style=" font-size:20px">PPN 10%</th>
                                <td style=" font-size:20px">:</td>
                                <td class="text-right" style=" font-size:20px"><?= number_format($ppn, 0, ',', '.') ?></td>
                                <td style=" font-size:20px"></td>
                            </tr>
                            <tr>
                                <th style=" font-size:20px">DPP+PPN</th>
                                <td style=" font-size:20px">:</td>
                                <td class="text-right" style=" font-size:20px"><?= number_format($dppppn, 0, ',', '.') ?></td>
                                <td style=" font-size:20px"></td>
                            </tr>
                            <tr>
                                <th style=" font-size:20px">PPH 2%</th>
                                <td style=" font-size:20px">:</td>
                                <td class="text-right" style=" font-size:20px"><?= number_format($pph, 0, ',', '.') ?></td>
                                <td style=" font-size:20px"></td>
                            </tr>
                            <tr>
                                <th style=" font-size:20px">Grand Total:</th>
                                <td style=" font-size:20px">:</td>
                                <td class="text-right" style=" font-size:20px"><?= number_format($grand_total, 0, ',', '.') ?></td>
                                <td style=" font-size:20px"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-8">
                </div>
                <div class="col-4">
                    <p style=" font-size:20px"><strong>Balikpapan, <?= Time::parse($ket['tgl_inv'])->toLocalizedString('dd MMMM yyyy') ?></strong></p><br><br><br><br>
                    <p class="mt-5" style=" font-size:20px"><strong>Pranawingrum</strong></p>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </section>
    <!-- /.content -->
</div>
<?= $this->endsection() ?>