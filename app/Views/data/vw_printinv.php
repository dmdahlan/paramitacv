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
                <div class="input-group mb-3">
                    <a onclick="window.print()" class="btn btn-default btn-sm"><i class="fas fa-print"></i> Print</a>
                </div>
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
                        <strong> <u>INVOICE</u> </strong>
                    </address>
                </div>
            </div>
            <div class="row invoice-info">
                <div class="col-sm-1 invoice-col">
                    <address>
                        INVOICE<br>
                        TANGGAL
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-1 invoice-col">
                    <address>
                        :<br>
                        :
                    </address>
                </div>

                <div class="col-sm-5 invoice-col">
                    <address>
                        <?= $ket['no_inv'] ?><br>
                        <?= Time::parse($ket['tgl_inv'])->toLocalizedString('dd MMMM yyyy') ?>
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    <address class="float-right">
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
                                <th style="border: 1px solid black">NO</th>
                                <th style="border: 1px solid black">TANGGAL</th>
                                <th style="border: 1px solid black">NO POLISI</th>
                                <th style="border: 1px solid black">TYPE</th>
                                <th style="border: 1px solid black">AREA</th>
                                <th style="border: 1px solid black">NO SHIPMENT</th>
                                <th style="border: 1px solid black">QTY</th>
                                <th style="border: 1px solid black">TARIF</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php


                            $i = 1;
                            $total_inv = 0;
                            $ppn = 0;
                            $pph = 0;
                            $grand_total = 0;
                            ?>
                            <?php foreach ($invoice as $r) : ?>
                                <tr>
                                    <td style="border: 1px solid black"><?= $i++ ?></td>
                                    <td style="border: 1px solid black"><?= Time::parse($r['tgl'])->toLocalizedString('dd-MMM-yy') ?></td>
                                    <td style="border: 1px solid black"><?= $r['nopol'] ?></td>
                                    <td style="border: 1px solid black"><?= $r['jenis'] ?></td>
                                    <td style="border: 1px solid black"><?= $r['dari'] . ' - ' . $r['tujuan'] ?></td>
                                    <td style="border: 1px solid black"><?= $r['shipment'] ?></td>
                                    <td style="border: 1px solid black"><?= number_format($r['qty'], 0, ',', '.') ?></td>
                                    <td style="border: 1px solid black" class="text-right"><?= number_format($r['nominal'], 0, ',', '.') ?></td>
                                    <?php $total_inv += $r['nominal'] ?>
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
                                $ppn = $total_inv * 10 / 100;
                            } else {
                                $ppn = null;
                            }
                            if ($ket['pphinv'] == 1) {
                                $pph = $total_inv * 2 / 100;
                            } else {
                                $pph = null;
                            }
                            $grand_total = $total_inv + $ppn - $pph;
                            ?>
                            <tr>
                                <th></th>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th style="width:30%">Total</th>
                                <td>:</td>
                                <td class="text-right"><?= number_format($total_inv, 0, ',', '.') ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>PPN 10%</th>
                                <td>:</td>
                                <td class="text-right"><?= number_format($ppn, 0, ',', '.') ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>PPH 2%</th>
                                <td>:</td>
                                <td class="text-right"><?= number_format($pph, 0, ',', '.') ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Grand Total:</th>
                                <td>:</td>
                                <td class="text-right"><?= number_format($grand_total, 0, ',', '.') ?></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-8">
                </div>
                <div class="col-4">
                    <p><strong>Balikpapan, <?= Time::parse($ket['tgl_inv'])->toLocalizedString('dd MMMM yyyy') ?></strong></p><br><br><br><br>
                    <p class="mt-5"><strong>Pranawingrum</strong></p>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </section>
    <!-- /.content -->
</div>
<?= $this->endsection() ?>