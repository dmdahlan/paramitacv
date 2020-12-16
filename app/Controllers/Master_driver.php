<?php

namespace App\Controllers;

class Master_driver extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Data | Driver',
            'validation'    => $this->validation
        ];
        return view('data/vw_masterdriver', $data);
    }
    public function ajax_list()
    {
        $list = $this->masterdriver->get_datatables();
        $data = array();
        $no = @$_POST['start'];

        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->nama;
            $row[] = $r->nohp;
            $row[] = $r->alamat;
            $row[] = '
                    <a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_driver(' . "'" . $r->idm_driver . "'" . ')">Edit</a>
                    <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="hapus_driver(' . "'" . $r->idm_driver . "'" . ')">Hapus</a>
                    ';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->masterdriver->count_all(),
            "recordsFiltered" => $this->masterdriver->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function simpan_driver()
    {
        $this->_validate('save');
        $data = [
            'nama'            => $this->request->getPost('nama'),
            'nohp'            => $this->request->getPost('nohp'),
            'alamat'          => $this->request->getPost('alamat')
        ];

        if ($this->masterdriver->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function edit_driver($id)
    {
        $data = $this->masterdriver->find($id);
        echo json_encode($data);
    }
    public function update_driver()
    {
        //Validasi
        $this->_validate('update');

        $data = [
            'idm_driver'      => $this->request->getPost('id'),
            'nama'            => $this->request->getPost('nama'),
            'nohp'            => $this->request->getPost('nohp'),
            'alamat'          => $this->request->getPost('alamat')
        ];

        if ($this->masterdriver->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function delete_driver($id)
    {
        if ($this->masterdriver->delete($id)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function getdriver()
    {
        $data = $this->masterdriver->orderBy('nama', 'ASC')->findAll();
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

            if ($validation->hasError('nama')) {
                $data['inputerror'][] = 'nama';
                $data['error_string'][] = $validation->getError('nama');
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
            $nama         = 'required|is_unique[master_driver.nama]';
        } else {
            $nama         = 'required|is_unique[master_driver.nama,idm_driver,{id}]';
        }
        $rulesValidation = [
            'nama' => [
                'rules' => $nama,
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah ada'
                ]
            ]
        ];
        return $rulesValidation;
    }
}
