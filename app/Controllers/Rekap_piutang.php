<?php

namespace App\Controllers;

class Rekap_piutang extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Rekap | Piutang'
        ];
        return view('data/vw_rekappiutang', $data);
    }
    public function list()
    {
        $tgl_awal  = $this->request->getPost('tgl_awal');
        $tgl_akhir = $this->request->getPost('tgl_akhir');

        $report = $this->rekappiutang->rekaphutang($tgl_awal, $tgl_akhir)->getResult();
        $recordTotal = $this->rekappiutang->rekaphutang($tgl_awal, $tgl_akhir)->getFieldCount();
        $recordFiltered = $this->rekappiutang->rekaphutang($tgl_awal, $tgl_akhir)->getFieldCount();

        $data = array();
        $no = @$_POST['start'];
        $temp_hutang = 0;

        $temp_bln_total = 0;

        foreach ($report as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->customer;
            $row[] = $this->rupiah($r->piutang);


            $total_bulan = $r->piutang;

            $row[] = $this->rupiah($total_bulan);

            $temp_hutang      += $r->piutang;

            $temp_bln_total  += $total_bulan;
            //add html for action
            $data[] = $row;
        }
        $data[] = array(
            '',
            'Total Piutang',
            $this->rupiah($temp_hutang),
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
