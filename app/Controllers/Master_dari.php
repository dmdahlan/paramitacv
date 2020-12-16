<?php

namespace App\Controllers;

class Master_dari extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Master | Dari'
        ];
        return view('data/vw_masterdari', $data);
    }
    public function ajax_list()
    {
        $list = $this->masterdari->get_datatables();
        $data = array();
        $no = @$_POST['start'];

        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->dari;
            $row[] = $r->keterangan;
            $row[] = '
                    <a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_dari(' . "'" . $r->idm_dari . "'" . ')">Edit</a>
                    <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="hapus_dari(' . "'" . $r->idm_dari . "'" . ')">Hapus</a>
                    ';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->masterdari->count_all(),
            "recordsFiltered" => $this->masterdari->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function simpan_dari()
    {
        $this->_validate('save');
        $data = [
            'dari'             => $this->request->getPost('dari'),
            'keterangan'       => $this->request->getPost('keterangan'),
        ];

        if ($this->masterdari->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function edit_dari($id)
    {
        $data = $this->masterdari->find($id);
        echo json_encode($data);
    }
    public function update_dari()
    {
        $this->_validate('update');
        $data = [
            'idm_dari'         => $this->request->getPost('id'),
            'dari'             => $this->request->getPost('dari'),
            'keterangan'       => $this->request->getPost('keterangan'),
        ];

        if ($this->masterdari->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function delete_dari($id)
    {
        if ($this->masterdari->delete($id)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function getdari()
    {
        $data = $this->masterdari->orderBY('dari', 'ASC')->findAll();
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

            if ($validation->hasError('dari')) {
                $data['inputerror'][] = 'dari';
                $data['error_string'][] = $validation->getError('dari');
                $data['status'] = FALSE;
            }
            if ($validation->hasError('keterangan')) {
                $data['inputerror'][] = 'keterangan';
                $data['error_string'][] = $validation->getError('keterangan');
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
            $dari                = 'required|is_unique[master_dari.dari]';
            $keterangan          = 'required|is_unique[master_dari.keterangan]';
        } else {
            $dari                = 'required|is_unique[master_dari.dari,idm_dari,{id}]';
            $keterangan          = 'required|is_unique[master_dari.keterangan,idm_dari,{id}]';
        }
        $rulesValidation = [
            'dari' => [
                'rules' => $dari,
                'errors' => [
                    'required' => 'Dari harus diisi',
                    'is_unique' => 'Dari sudah ada'
                ]
            ],
            'keterangan' => [
                'rules' => $keterangan,
                'errors' => [
                    'required' => 'Keterangan harus diisi',
                    'is_unique' => 'Keterangan sudah ada'
                ]
            ]
        ];
        return $rulesValidation;
    }
}
