<?php

namespace App\Controllers;

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
        $nama = session()->get('name');
        $list = $this->drivergaji->get_datatables($nama);
        $data = array();
        $no = @$_POST['start'];
        $total = 0;
        if (session()->get('role_name') == 'Driver') {
            foreach ($list as $r) {
                if (session()->get('name') == $r->nama) {
                    $no++;
                    $row = array();
                    $row[] = $no;
                    $row[] = $r->sj_kembali;
                    $row[] = $r->tgl_gaji;
                    $row[] = $r->tgl;
                    $row[] = $r->nopol;
                    $row[] = $r->produk;
                    $row[] = $r->dari;
                    $row[] = $this->rupiah($r->gaji);
                    $row[] = $r->shipment;
                    $row[] = $r->nama;

                    $total += $r->gaji;
                    $data[] = $row;
                }
            }
        } else {
            foreach ($list as $r) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $r->sj_kembali;
                $row[] = $r->tgl_gaji;
                $row[] = $r->tgl;
                $row[] = $r->nopol;
                $row[] = $r->produk;
                $row[] = $r->dari;
                $row[] = $this->rupiah($r->gaji);
                $row[] = $r->shipment;
                $row[] = $r->nama;

                $total += $r->gaji;
                $data[] = $row;
            }
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
