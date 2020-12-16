<?php

namespace App\Controllers;

class Master_outlet extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Master | outlet'
        ];
        return view('data/vw_masteroutlet', $data);
    }
    public function ajax_list()
    {
        $list = $this->masteroutlet->get_datatables();
        $data = array();
        $no = @$_POST['start'];

        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->outlet;
            $row[] = $r->ket_outlet;
            $row[] = '
                    <a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_outlet(' . "'" . $r->id_outlet . "'" . ')">Edit</a>
                    <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="hapus_outlet(' . "'" . $r->id_outlet . "'" . ')">Hapus</a>
                    ';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->masteroutlet->count_all(),
            "recordsFiltered" => $this->masteroutlet->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function save()
    {
        $this->_validate('save');
        $data = [
            'outlet'             => $this->request->getPost('outlet'),
            'ket_outlet'         => $this->request->getPost('ket_outlet'),
        ];

        if ($this->masteroutlet->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function edit($id)
    {
        $data = $this->masteroutlet->find($id);
        echo json_encode($data);
    }
    public function update()
    {
        $this->_validate('update');
        $data = [
            'id_outlet'          => $this->request->getPost('id'),
            'outlet'             => $this->request->getPost('outlet'),
            'ket_outlet'         => $this->request->getPost('ket_outlet')
        ];

        if ($this->masteroutlet->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function delete($id)
    {
        if ($this->masteroutlet->delete($id)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function getoutlet()
    {
        $data = $this->masteroutlet->orderBY('outlet', 'ASC')->findAll();
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

            if ($validation->hasError('outlet')) {
                $data['inputerror'][] = 'outlet';
                $data['error_string'][] = $validation->getError('outlet');
                $data['status'] = FALSE;
            }
            if ($validation->hasError('ket_outlet')) {
                $data['inputerror'][] = 'ket_outlet';
                $data['error_string'][] = $validation->getError('ket_outlet');
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
            $outlet                = 'required|is_unique[master_outlet.outlet]';
            $ket_outlet            = 'required|is_unique[master_outlet.ket_outlet]';
        } else {
            $outlet                = 'required|is_unique[master_outlet.outlet,id_outlet,{id}]';
            $ket_outlet            = 'required|is_unique[master_outlet.ket_outlet,id_outlet,{id}]';
        }
        $rulesValidation = [
            'outlet' => [
                'rules' => $outlet,
                'errors' => [
                    'required' => 'outlet harus diisi',
                    'is_unique' => 'outlet sudah ada'
                ]
            ],
            'ket_outlet' => [
                'rules' => $ket_outlet,
                'errors' => [
                    'required' => 'Keterangan harus diisi',
                    'is_unique' => 'Keterangan sudah ada'
                ]
            ]
        ];
        return $rulesValidation;
    }
}
