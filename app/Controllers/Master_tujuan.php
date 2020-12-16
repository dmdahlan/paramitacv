<?php

namespace App\Controllers;

class Master_tujuan extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Data | Tujuan'
        ];
        return view('data/vw_mastertujuan', $data);
    }
    public function ajax_list()
    {
        $list = $this->mastertujuan->get_datatables();
        $data = array();
        $no = @$_POST['start'];

        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->tujuan;
            $row[] = $r->keterangan;
            $row[] = '
                    <a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_tujuan(' . "'" . $r->idm_tujuan . "'" . ')">Edit</a>
                    <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="hapus_tujuan(' . "'" . $r->idm_tujuan . "'" . ')">Hapus</a>
                    ';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->mastertujuan->count_all(),
            "recordsFiltered" => $this->mastertujuan->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function simpan_tujuan()
    {
        $this->_validate('save');
        $data = [
            'tujuan'           => $this->request->getPost('tujuan'),
            'keterangan'       => $this->request->getPost('keterangan')
        ];

        if ($this->mastertujuan->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function edit_tujuan($id)
    {
        $data = $this->mastertujuan->find($id);
        echo json_encode($data);
    }
    public function update_tujuan()
    {
        $this->_validate('update');
        $data = [
            'idm_tujuan'       => $this->request->getPost('id'),
            'tujuan'           => $this->request->getPost('tujuan'),
            'keterangan'       => $this->request->getPost('keterangan')
        ];

        if ($this->mastertujuan->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function delete_tujuan($id)
    {
        if ($this->mastertujuan->delete($id)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function gettujuan()
    {
        $data = $this->mastertujuan->orderBY('tujuan', 'ASC')->findAll();
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

            if ($validation->hasError('tujuan')) {
                $data['inputerror'][] = 'tujuan';
                $data['error_string'][] = $validation->getError('tujuan');
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
            $tujuan         = 'required|is_unique[master_tujuan.tujuan]';
            $keterangan      = 'required|is_unique[master_tujuan.keterangan]';
        } else {
            $tujuan         = 'required|is_unique[master_tujuan.tujuan,idm_tujuan,{id}]';
            $keterangan     = 'required|is_unique[master_tujuan.keterangan,idm_tujuan,{id}]';
        }
        $rulesValidation = [
            'tujuan' => [
                'rules' => $tujuan,
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah ada'
                ]
            ],
            'keterangan' => [
                'rules' => $keterangan,
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah ada'
                ]
            ]
        ];
        return $rulesValidation;
    }
}
