<?php

namespace App\Controllers;

class Master_gaji extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Gaji | Uang Jalan'
        ];
        return view('data/vw_mastergaji', $data);
    }
    public function ajax_list()
    {
        $list = $this->mastergaji->get_datatables();
        $data = array();
        $no = @$_POST['start'];

        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->dari;
            $row[] = $r->tujuan;
            $row[] = $this->rupiah($r->tipe);
            $row[] = $this->rupiah($r->gaji);
            $row[] = $this->rupiah($r->uang_jalan);
            $row[] = $r->ketjuan;
            $row[] = '
                    <a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_gaji(' . "'" . $r->idm_gaji . "'" . ')">Edit</a>
                    <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="hapus_gaji(' . "'" . $r->idm_gaji . "'" . ')">Hapus</a>
                    ';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->mastergaji->count_all(),
            "recordsFiltered" => $this->mastergaji->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function simpan_gaji()
    {
        $this->_validate('save');
        $data = [
            'dari_idm'         => $this->request->getVar('dari_idm'),
            'tujuan_idm'       => $this->request->getVar('tujuan_idm'),
            'tipe'             => $this->request->getVar('tipe'),
            'gaji'             => $this->request->getVar('gaji'),
            'uang_jalan'       => $this->request->getVar('uang_jalan'),
            'ketjuan'          => $this->request->getVar('ketjuan')
        ];
        if ($this->mastergaji->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function edit_gaji($id)
    {
        $data = $this->mastergaji->find($id);
        echo json_encode($data);
    }
    public function update_gaji()
    {
        $this->_validate('update');
        $data = [
            'idm_gaji'         => $this->request->getPost('id'),
            'dari_idm'         => $this->request->getPost('dari_idm'),
            'tujuan_idm'       => $this->request->getPost('tujuan_idm'),
            'tipe'             => $this->request->getPost('tipe'),
            'gaji'             => $this->request->getPost('gaji'),
            'uang_jalan'       => $this->request->getPost('uang_jalan'),
            'ketjuan'          => $this->request->getPost('ketjuan')
        ];

        if ($this->mastergaji->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function delete_gaji($id)
    {
        if ($this->mastergaji->delete($id)) {
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

            if ($validation->hasError('ketjuan')) {
                $data['inputerror'][] = 'ketjuan';
                $data['error_string'][] = $validation->getError('ketjuan');
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
            $ketjuan            = 'is_unique[master_gaji.ketjuan]';
        } else {
            $ketjuan            = 'is_unique[master_gaji.ketjuan,idm_gaji,{id}]';
        }
        $rulesValidation = [
            'ketjuan' => [
                'rules' => $ketjuan,
                'errors' => [
                    'is_unique' => 'Data sudah ada'
                ]
            ]
        ];
        return $rulesValidation;
    }
}
