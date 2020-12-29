<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Sap_order extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'SAP'
        ];
        return view('data/vw_saporder', $data);
    }
    public function ajax_list()
    {
        $list = $this->saporder->get_datatables();
        $data = array();
        $no = @$_POST['start'];

        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = Time::parse($r->tgl_sap)->toLocalizedString('dd-MMM-yy');
            $row[] = $r->fo;
            // $row[] = $r->fr;
            $row[] = $r->nama;
            $row[] = $r->nopol;
            $row[] = $r->dari;
            $row[] = $r->tujuan;
            $row[] = $r->produk;
            $row[] = $r->orderan;
            $row[] = $r->keterangansap;
            $row[] = $r->ket_sap;
            $row[] = '
            <a class="btn btn-primary btn-xs" href="javascript:void(0)" title="Detil" onclick="detil_sap(' . "'" . $r->id_sap . "'" . ')">Detil</a>
            <a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_sap(' . "'" . $r->id_sap . "'" . ')">Edit</a>
            <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="hapus_sap(' . "'" . $r->id_sap . "'" . ')">Hapus</a>
            ';
            $row[] = $r->outlet;
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->saporder->count_all(),
            "recordsFiltered" => $this->saporder->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function save()
    {
        $this->_validate('save');
        $data = [
            'tgl_sap'             => time::parse($this->request->getPost('tgl_sap')),
            'fo'                  => $this->request->getPost('fo'),
            // 'fr'                  => $this->request->getPost('fr'),
            'driver_idm'          => $this->request->getPost('driver_idm'),
            'nopol_idm'           => $this->request->getPost('nopol_idm'),
            'dari_idm'            => $this->request->getPost('dari_idm'),
            'tujuan_idm'          => $this->request->getPost('tujuan_idm'),
            'produk_idm'          => $this->request->getPost('produk_idm'),
            'orderan'             => $this->request->getPost('orderan'),
            'outlet'              => $this->request->getPost('outlet'),
            'keterangan'          => $this->request->getPost('keterangan'),
            'ket_sap'             => $this->request->getPost('ket_sap')
        ];

        if ($this->saporder->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function edit($id)
    {
        $data = $this->saporder->find($id);
        echo json_encode($data);
    }
    public function update()
    {
        $this->_validate('update');
        $data = [
            'id_sap'              => $this->request->getPost('id'),
            'tgl_sap'             => time::parse($this->request->getPost('tgl_sap')),
            'fo'                  => $this->request->getPost('fo'),
            // 'fr'                  => $this->request->getPost('fr'),
            'driver_idm'          => $this->request->getPost('driver_idm'),
            'nopol_idm'           => $this->request->getPost('nopol_idm'),
            'dari_idm'            => $this->request->getPost('dari_idm'),
            'tujuan_idm'          => $this->request->getPost('tujuan_idm'),
            'produk_idm'          => $this->request->getPost('produk_idm'),
            'orderan'             => $this->request->getPost('orderan'),
            'outlet'           => $this->request->getPost('outlet'),
            'keterangan'          => $this->request->getPost('keterangan'),
            'ket_sap'             => $this->request->getPost('ket_sap')
        ];

        if ($this->saporder->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function delete($id)
    {
        if ($this->saporder->delete($id)) {
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

            if ($validation->hasError('tgl_sap')) {
                $data['inputerror'][] = 'tgl_sap';
                $data['error_string'][] = $validation->getError('tgl_sap');
                $data['status'] = FALSE;
            }
            if ($validation->hasError('fo')) {
                $data['inputerror'][] = 'fo';
                $data['error_string'][] = $validation->getError('fo');
                $data['status'] = FALSE;
            }
            if ($data['status'] === FALSE) {
                echo json_encode($data);
                exit();
            }
        }
    }
    public function getdatasap($id)
    {
        $data = $this->saporder->getsap($id);
        echo json_encode($data);
    }
    public function _getRulesValidation($method = null)
    {
        if ($method == 'save') {
            $tgl               = 'required';
            $fo                = 'required|is_unique[sap_order.fo]';
        } else {
            $tgl               = 'required';
            $fo                = 'required|is_unique[sap_order.fo,id_sap,{id}]';
        }
        $rulesValidation = [
            'tgl_sap' => [
                'rules' => $tgl,
                'errors' => [
                    'required' => 'Tanggal harus diisi'
                ]
            ],
            'fo' => [
                'rules' => $fo,
                'errors' => [
                    'required' => 'No FO harus diisi',
                    'is_unique' => 'No FO sudah ada'
                ]
            ]
        ];
        return $rulesValidation;
    }
}
