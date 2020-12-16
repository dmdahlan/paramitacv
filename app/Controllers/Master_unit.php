<?php

namespace App\Controllers;

class Master_unit extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Data | Kendaraan'
        ];
        return view('data/vw_masterunit', $data);
    }
    public function ajax_list()
    {
        $list = $this->masterunit->get_datatables();
        $data = array();
        $no = @$_POST['start'];

        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->kode_nopol;
            $row[] = $r->nopol;
            $row[] = $r->jenis;
            $row[] = $r->kapasitas;
            $row[] = $r->no_keur;
            $row[] = $r->kerb_weight;
            $row[] = $r->jbb;
            $row[] = $r->jbi;
            $row[] = '
                    <a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_unit(' . "'" . $r->idm_nopol . "'" . ')">Edit</a>
                    <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="hapus_unit(' . "'" . $r->idm_nopol . "'" . ')">Hapus</a>
            ';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->masterunit->count_all(),
            "recordsFiltered" => $this->masterunit->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function simpan_unit()
    {
        $this->_validate('save');
        $data = [
            'kode_nopol'           => $this->request->getPost('kode_nopol'),
            'nopol'                => $this->request->getPost('nopol'),
            'jenis'                => $this->request->getPost('jenis'),
            'kapasitas'            => $this->request->getPost('kapasitas'),
            'no_keur'              => $this->request->getPost('no_keur'),
            'kerb_weight'          => $this->request->getPost('kerb_weight'),
            'jbb'                  => $this->request->getPost('jbb'),
            'jbi'                  => $this->request->getPost('jbi')
        ];

        if ($this->masterunit->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function edit_unit($id)
    {
        $data = $this->masterunit->find($id);
        echo json_encode($data);
    }
    public function update_unit()
    {
        $this->_validate('update');
        $data = [
            'idm_nopol'            => $this->request->getPost('id'),
            'nopol'                => $this->request->getPost('nopol'),
            'jenis'                => $this->request->getPost('jenis'),
            'kapasitas'            => $this->request->getPost('kapasitas'),
            'no_keur'              => $this->request->getPost('no_keur'),
            'kerb_weight'          => $this->request->getPost('kerb_weight'),
            'jbb'                  => $this->request->getPost('jbb'),
            'jbi'                  => $this->request->getPost('jbi')
        ];

        if ($this->masterunit->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function delete_unit($id)
    {
        if ($this->masterunit->delete($id)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function getnopol()
    {
        $data = $this->masterunit->orderBy('nopol', 'ASC')->findall();
        echo json_encode($data);
    }
    public function _validate($method)
    {
        if (!$this->validate($this->_getRulesValidation($method))) {
            $validation = \Config\Services::validation();

            $data = [];
            $data['error_string'] = [];
            $data['inputerror'] = [];
            $data['status'] = TRUE;

            if ($validation->hasError('kode_nopol')) {
                $data['inputerror'][] = 'kode_nopol';
                $data['error_string'][] = $validation->getError('kode_nopol');
                $data['status'] = FALSE;
            }
            if ($validation->hasError('nopol')) {
                $data['inputerror'][] = 'nopol';
                $data['error_string'][] = $validation->getError('nopol');
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
            $kode_nopol         = 'required|is_unique[master_unit.kode_nopol]';
            $nopol              = 'required|is_unique[master_unit.nopol]';
        } else {
            $kode_nopol         = 'required|is_unique[master_unit.kode_nopol,idm_nopol,{id}]';
            $nopol              = 'required|is_unique[master_unit.nopol,idm_nopol,{id}]';
        }
        $rulesValidation = [
            'kode_nopol' => [
                'rules'  => $kode_nopol,
                'errors' => [
                    'required' => 'Kode Nopol harus diisi',
                    'is_unique' => 'Kode Nopol sudah ada'
                ]
            ],
            'nopol' => [
                'rules' => $nopol,
                'errors' => [
                    'required' => 'Nopol harus diisi',
                    'is_unique' => 'Nopol sudah ada'
                ]
            ]
        ];
        return $rulesValidation;
    }
}
