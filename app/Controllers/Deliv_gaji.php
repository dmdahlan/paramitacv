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
                $row[] = Time::parse($r->sj_kembali)->toLocalizedString('dd-MMM-yy');
            }
            if ($r->tgl_gaji == null) {
                $row[] = '';
            } else {
                $row[] = Time::parse($r->tgl_gaji)->toLocalizedString('MMM-YYYY');
            }
            $row[] = Time::parse($r->tgl)->toLocalizedString('dd-MMM-yy');
            $row[] = $r->nama;
            $row[] = $r->shipment;
            $row[] = $r->nopol;
            $row[] = $r->produk;
            $row[] = $r->dari;
            $row[] = $r->tujuan;
            if ($r->tgl_gaji == '') {
                $nominal = $r->gaji;
            } else {
                $nominal = $r->nominal_gaji;
            }
            $row[] = $this->rupiah($nominal);
            if ($r->tgl_gaji == '') {
                $row[] =
                    '<a class="btn btn-warning btn-xs" href="javascript:void(0)" title="tambah" onclick="tambah_gaji(' . "'" . $r->idm_deliv . "'" . ')">Edit</a>
                    ';
            } else {
                $row[] =
                    '<a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_gaji(' . "'" . $r->idm_deliv . "'" . ')">Edit</a>
                    <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="hapus" onclick="hapus_gaji(' . "'" . $r->idm_gaji . "'" . ')">hapus</a>
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
        $this->_validate('save');
        $data = [
            'deliv_idm'       => $this->request->getPost('deliv_idm'),
            'tgl_gaji'        => time::parse($this->request->getPost('tgl_gaji')),
            'nominal_gaji'    => $this->request->getPost('nominal_gaji'),
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
        $id = $this->request->getPost('id');
        $data = [
            'deliv_idm'        => $this->request->getPost('deliv_idm'),
            'tgl_gaji'         => time::parse($this->request->getPost('tgl_gaji')),
            'nominal_gaji'     => $this->request->getPost('nominal_gaji'),
        ];

        if ($this->deliverygaji->update($id, $data)) {
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
    public function _validate($method)
    {
        if (!$this->validate($this->_getRulesValidation($method))) {
            $validation = \Config\Services::validation();

            $data = [];
            $data['error_string'] = [];
            $data['inputerror'] = [];
            $data['status'] = TRUE;

            if ($validation->hasError('tgl_gaji')) {
                $data['inputerror'][] = 'tgl_gaji';
                $data['error_string'][] = $validation->getError('tgl_gaji');
                $data['status'] = FALSE;
            }
            if ($validation->hasError('deliv_idm')) {
                $data['inputerror'][] = 'deliv_idm';
                $data['error_string'][] = $validation->getError('deliv_idm');
                $data['status'] = FALSE;
            }
            if ($data['status'] === FALSE) {
                echo json_encode($data);
                exit();
            }
        }
    }
    public function _getRulesValidation($method = null)
    {
        if ($method == 'save') {
            $tgl_gaji            = 'required';
            $deliv_idm           = 'required|is_unique[deliv_gaji.deliv_idm]';
        } else {
            $tgl_gaji            = 'required';
            $deliv_idm           = 'required|is_unique[deliv_gaji.deliv_idm,idm_gaji,{id}]';
        }
        $rulesValidation = [
            'tgl_gaji' => [
                'rules' => $tgl_gaji,
                'errors' => [
                    'required' => 'Tanggal harus diisi.'
                ]
            ], 'deliv_idm' => [
                'rules' => $deliv_idm,
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah ada'
                ]
            ]
        ];
        return $rulesValidation;
    }
}
