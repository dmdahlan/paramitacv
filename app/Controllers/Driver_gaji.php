<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Driver_gaji extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Data | Gaji'
        ];
        return view('data/vw_gajidriver', $data);
    }
    public function ajax_list()
    {
        $nama = user()->username;
        $list = $this->drivergaji->get_datatables($nama);
        $data = array();
        $no = @$_POST['start'];
        $total = 0;
        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            if ($r->sj_kembali == null) {
                $row[] = '';
            } else {
                $row[] = Time::parse($r->sj_kembali)->toLocalizedString('dd-MMM-YY');
            }
            if ($r->tgl_gaji == null) {
                $row[] = '';
            } else {
                $row[] = Time::parse($r->tgl_gaji)->toLocalizedString('MMM-YYYY');
            }
            $row[] = Time::parse($r->tgl)->toLocalizedString('MM yyyy');
            $row[] = $r->nopol;
            $row[] = $r->produk;
            $row[] = $r->dari;
            $row[] = $this->rupiah($r->gaji);
            $row[] = $r->shipment;
            $row[] = $r->nama;

            $total += $r->gaji;
            $data[] = $row;
        }

        $data[] = array(
            '', '', '', '', '', 'TOTAL', '', $this->rupiah($total), '', ''
        );
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->drivergaji->count_all($nama),
            "recordsFiltered" => $this->drivergaji->count_filtered($nama),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}
