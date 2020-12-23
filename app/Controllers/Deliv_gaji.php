<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Deliv_gaji extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Data | Gaji'
        ];
        return view('data/vw_delivgaji', $data);
    }
    public function ajax_list()
    {
        $list = $this->deliverygaji->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        $total_gaji = 0;

        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            // $row[] = $r->idm_gaji;
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
            $row[] = Time::parse($r->tgl)->toLocalizedString('dd-MMM-YY');
            $row[] = $r->nama;
            $row[] = $r->shipment;
            $row[] = $r->nopol;
            $row[] = $r->produk;
            $row[] = $r->dari;
            $row[] = $r->tujuan;
            $row[] = $this->rupiah($r->gaji);

            if ($r->tgl_gaji == '') {
                $row[] =
                    '<a class="btn btn-warning btn-xs" href="javascript:void(0)" title="tambah" onclick="tambah_gaji(' . "'" . $r->idm_deliv . "'" . ')">Edit</a>
                    ';
            } else {
                $row[] =
                    '<a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_gaji(' . "'" . $r->idm_deliv . "'" . ')">Edit</a>
                    <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Edit" onclick="hapus_gaji(' . "'" . $r->idm_gaji . "'" . ')">hapus</a>
                    ';
            }
            $total_gaji += $r->gaji;
            $data[] = $row;
        }
        $data[] = array(
            '', '', '', '', '', '', '', '', '', 'TOTAL', $this->rupiah($total_gaji), ''
        );
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->deliverygaji->count_all(),
            "recordsFiltered" => $this->deliverygaji->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function simpan_gaji()
    {
        $data = [
            'deliv_idm'       => $this->request->getVar('deliv_idm'),
            'tgl_gaji'        => $this->request->getVar('tgl_gaji')
        ];
        if ($this->deliverygaji->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function edit_gaji($id)
    {
        $data = $this->deliverygaji->getgaji($id);
        echo json_encode($data);
    }
    public function update_gaji()
    {
        $data = [
            'idm_gaji'         => $this->request->getVar('id'),
            'tgl_gaji'        => $this->request->getVar('tgl_gaji')
        ];

        if ($this->deliverygaji->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function delete_gaji($id)
    {
        if ($this->deliverygaji->delete($id)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
}
