<?php

namespace App\Controllers;

class Report_produk extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Report | Unit'
        ];
        return view('report/vw_reportproduk', $data);
    }
    public function repproduk()
    {
        $tgl_awal  = $this->request->getPost('tgl_awal');
        $tgl_akhir = $this->request->getPost('tgl_akhir');

        $report = $this->reportproduk->reportproduk($tgl_awal, $tgl_akhir)->getResult();
        $recordTotal = $this->reportproduk->reportproduk($tgl_awal, $tgl_akhir)->getFieldCount();
        $recordFiltered = $this->reportproduk->reportproduk($tgl_awal, $tgl_akhir)->getFieldCount();

        $data = array();
        $no = @$_POST['start'];
        $temp_bln_1 = 0;
        $temp_bln_2 = 0;
        $temp_bln_3 = 0;
        $temp_bln_4 = 0;
        $temp_bln_5 = 0;
        $temp_bln_6 = 0;
        $temp_bln_7 = 0;
        $temp_bln_8 = 0;
        $temp_bln_9 = 0;
        $temp_bln_10 = 0;
        $temp_bln_11 = 0;
        $temp_bln_12 = 0;
        $temp_bln_total = 0;

        foreach ($report as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->produk;
            $row[] = $this->rupiah($r->jan);
            $row[] = $this->rupiah($r->feb);
            $row[] = $this->rupiah($r->mar);
            $row[] = $this->rupiah($r->apr);
            $row[] = $this->rupiah($r->mei);
            $row[] = $this->rupiah($r->jun);
            $row[] = $this->rupiah($r->jul);
            $row[] = $this->rupiah($r->agt);
            $row[] = $this->rupiah($r->sep);
            $row[] = $this->rupiah($r->okt);
            $row[] = $this->rupiah($r->nop);
            $row[] = $this->rupiah($r->dess);

            $total_bulan = $r->jan + ($r->feb) + ($r->mar) + ($r->apr) + ($r->mei) + ($r->jun) + ($r->jul) + ($r->agt) + ($r->sep) + ($r->okt) + ($r->nop) + ($r->dess);

            $row[] = $this->rupiah($total_bulan);

            $temp_bln_1      += $r->jan;
            $temp_bln_2      += $r->feb;
            $temp_bln_3      += $r->mar;
            $temp_bln_4      += $r->apr;
            $temp_bln_5      += $r->mei;
            $temp_bln_6      += $r->jun;
            $temp_bln_7      += $r->jul;
            $temp_bln_8      += $r->agt;
            $temp_bln_9      += $r->sep;
            $temp_bln_10     += $r->okt;
            $temp_bln_11     += $r->nop;
            $temp_bln_12     += $r->dess;
            $temp_bln_total  += $total_bulan;
            //add html for action
            $data[] = $row;
        }
        $data[] = array(
            '',
            'Total Per Bulan',
            $this->rupiah($temp_bln_1),
            $this->rupiah($temp_bln_2),
            $this->rupiah($temp_bln_3),
            $this->rupiah($temp_bln_4),
            $this->rupiah($temp_bln_5),
            $this->rupiah($temp_bln_6),
            $this->rupiah($temp_bln_7),
            $this->rupiah($temp_bln_8),
            $this->rupiah($temp_bln_9),
            $this->rupiah($temp_bln_10),
            $this->rupiah($temp_bln_11),
            $this->rupiah($temp_bln_12),
            $this->rupiah($temp_bln_total),
        );

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $recordTotal,
            "recordsFiltered" => $recordFiltered,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}
