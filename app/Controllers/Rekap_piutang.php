<?php

namespace App\Controllers;

class Rekap_piutang extends BaseController
{
    public function index()
    {
        $tgl_awalinv  = '2021-01-01';
        $tgl_akhirinv = '2021-12-31';
        $tgl_awalbyr  = '2020-01-01';
        $tgl_akhirbyr = '2021-12-31';
        $data = [
            'title'         => 'Rekap | Piutang',
            'invoice'       => $this->rekappiutang->rekaphutang($tgl_awalinv, $tgl_akhirinv)->getResultArray(),
            'bayar'         => $this->rekappiutang->rekapbayar($tgl_awalbyr, $tgl_akhirbyr)->getResultArray(),
        ];
        return view('data/vw_rekapan', $data);
        // return view('data/vw_rekappiutang', $data);
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

            //add html for action
            $data[] = $row;
        }

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
