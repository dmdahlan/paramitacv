<?php

namespace App\Controllers;

class Report_gajidriver extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Report | Gaji Driver'
        ];
        return view('report/vw_reportgajidriver', $data);
    }
    public function ajax_list()
    {
        $tgl_awal  = $this->request->getPost('tgl_awal');
        $tgl_akhir = $this->request->getPost('tgl_akhir');

        $report = $this->reportgajidriver->reportgajidriver($tgl_awal, $tgl_akhir)->getResult();
        $recordTotal = $this->reportgajidriver->reportgajidriver($tgl_awal, $tgl_akhir)->getFieldCount();
        $recordFiltered = $this->reportgajidriver->reportgajidriver($tgl_awal, $tgl_akhir)->getFieldCount();

        $data = array();
        $no = @$_POST['start'];
        $janqty  = 0;
        $jangaji = 0;
        $febqty  = 0;
        $febgaji = 0;
        $marqty  = 0;
        $margaji = 0;
        $aprqty  = 0;
        $aprgaji = 0;
        $meiqty  = 0;
        $meigaji = 0;
        $junqty  = 0;
        $jungaji = 0;
        $julqty  = 0;
        $julgaji = 0;
        $agtqty  = 0;
        $agtgaji = 0;
        $sepqty  = 0;
        $sepgaji = 0;
        $oktqty  = 0;
        $oktgaji = 0;
        $nopqty  = 0;
        $nopgaji = 0;
        $desqty  = 0;
        $desgaji = 0;

        $total_bulan = 0;
        $temp_bln_total = 0;
        foreach ($report as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->nama;
            $row[] = $this->rupiah($r->janqty);
            $row[] = $this->rupiah($r->jangaji);
            $row[] = $this->rupiah($r->febqty);
            $row[] = $this->rupiah($r->febgaji);
            $row[] = $this->rupiah($r->marqty);
            $row[] = $this->rupiah($r->margaji);
            $row[] = $this->rupiah($r->aprqty);
            $row[] = $this->rupiah($r->aprgaji);
            $row[] = $this->rupiah($r->meiqty);
            $row[] = $this->rupiah($r->meigaji);
            $row[] = $this->rupiah($r->junqty);
            $row[] = $this->rupiah($r->jungaji);
            $row[] = $this->rupiah($r->julqty);
            $row[] = $this->rupiah($r->julgaji);
            $row[] = $this->rupiah($r->agtqty);
            $row[] = $this->rupiah($r->agtgaji);
            $row[] = $this->rupiah($r->sepqty);
            $row[] = $this->rupiah($r->sepgaji);
            $row[] = $this->rupiah($r->oktqty);
            $row[] = $this->rupiah($r->oktgaji);
            $row[] = $this->rupiah($r->nopqty);
            $row[] = $this->rupiah($r->nopgaji);
            $row[] = $this->rupiah($r->desqty);
            $row[] = $this->rupiah($r->desgaji);

            $janqty       += $r->janqty;
            $jangaji      += $r->jangaji;
            $febqty       += $r->febqty;
            $febgaji      += $r->febgaji;
            $marqty       += $r->marqty;
            $margaji      += $r->margaji;
            $aprqty       += $r->aprqty;
            $aprgaji      += $r->aprgaji;
            $temp_bln_total  += $total_bulan;
            //add html for action
            $data[] = $row;
        }
        $data[] = array(
            '',
            'Total Per Bulan',
            $this->rupiah($janqty),
            $this->rupiah($jangaji),
            $this->rupiah($febqty),
            $this->rupiah($febgaji),
            $this->rupiah($marqty),
            $this->rupiah($margaji),
            $this->rupiah($aprqty),
            $this->rupiah($aprgaji),
            $this->rupiah($meiqty),
            $this->rupiah($meigaji),
            $this->rupiah($junqty),
            $this->rupiah($jungaji),
            $this->rupiah($julqty),
            $this->rupiah($julgaji),
            $this->rupiah($agtqty),
            $this->rupiah($agtgaji),
            $this->rupiah($sepqty),
            $this->rupiah($sepgaji),
            $this->rupiah($oktqty),
            $this->rupiah($oktgaji),
            $this->rupiah($nopqty),
            $this->rupiah($nopgaji),
            $this->rupiah($desqty),
            $this->rupiah($desgaji),


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
