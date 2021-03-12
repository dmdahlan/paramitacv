<?php

namespace App\Controllers;

class Rekap_piutang extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Rekap | Piutang',
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
        $jan = 0;
        $feb = 0;
        $mar = 0;
        $apr = 0;
        $mei = 0;
        $jun = 0;
        $jul = 0;
        $agt = 0;
        $sep = 0;
        $okt = 0;
        $nop = 0;
        $des = 0;
        $grandtotal = 0;
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

            $total_bulan = $r->jan + $r->feb + $r->mar + $r->apr + $r->mei + $r->jun + $r->jul + $r->agt + $r->sep + $r->okt + $r->nop + $r->dess;
            $row[] = $this->rupiah($total_bulan);

            $jan += $r->jan;
            $feb += $r->feb;
            $mar += $r->mar;
            $apr += $r->apr;
            $mei += $r->mei;
            $jun += $r->jun;
            $agt += $r->agt;
            $sep += $r->sep;
            $okt += $r->okt;
            $nop += $r->nop;
            $des += $r->dess;
            $grandtotal += $total_bulan;
            //add html for action
            $data[] = $row;
        }
        $data[] = array(
            '',
            'TOTAL',
            $this->rupiah($jan),
            $this->rupiah($feb),
            $this->rupiah($mar),
            $this->rupiah($apr),
            $this->rupiah($mei),
            $this->rupiah($jun),
            $this->rupiah($jul),
            $this->rupiah($agt),
            $this->rupiah($sep),
            $this->rupiah($okt),
            $this->rupiah($nop),
            $this->rupiah($des),
            $this->rupiah($grandtotal),
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
    public function bayar()
    {
        $tgl_awal  = $this->request->getPost('tgl_awal');
        $tgl_akhir = $this->request->getPost('tgl_akhir');

        $report = $this->rekappiutang->rekapbayar($tgl_awal, $tgl_akhir)->getResult();
        $recordTotal = $this->rekappiutang->rekapbayar($tgl_awal, $tgl_akhir)->getFieldCount();
        $recordFiltered = $this->rekappiutang->rekapbayar($tgl_awal, $tgl_akhir)->getFieldCount();

        $data = array();
        $no = @$_POST['start'];
        $jan = 0;
        $feb = 0;
        $mar = 0;
        $apr = 0;
        $mei = 0;
        $jun = 0;
        $jul = 0;
        $agt = 0;
        $sep = 0;
        $okt = 0;
        $nop = 0;
        $des = 0;
        $grandtotal = 0;
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

            $total_bulan = $r->jan + $r->feb + $r->mar + $r->apr + $r->mei + $r->jun + $r->jul + $r->agt + $r->sep + $r->okt + $r->nop + $r->dess;
            $row[] = $this->rupiah($total_bulan);

            $jan += $r->jan;
            $feb += $r->feb;
            $mar += $r->mar;
            $apr += $r->apr;
            $mei += $r->mei;
            $jun += $r->jun;
            $agt += $r->agt;
            $sep += $r->sep;
            $okt += $r->okt;
            $nop += $r->nop;
            $des += $r->dess;
            $grandtotal += $total_bulan;
            //add html for action
            $data[] = $row;
        }
        $data[] = array(
            '',
            'TOTAL',
            $this->rupiah($jan),
            $this->rupiah($feb),
            $this->rupiah($mar),
            $this->rupiah($apr),
            $this->rupiah($mei),
            $this->rupiah($jun),
            $this->rupiah($jul),
            $this->rupiah($agt),
            $this->rupiah($sep),
            $this->rupiah($okt),
            $this->rupiah($nop),
            $this->rupiah($des),
            $this->rupiah($grandtotal),
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
