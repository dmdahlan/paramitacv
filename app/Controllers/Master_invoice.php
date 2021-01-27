<?php

namespace App\Controllers;

class Master_invoice extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Tarif | Invoice '
        ];
        return view('data/vw_masterinvoice', $data);
    }
    public function ajax_list()
    {
        $list = $this->masterinvoice->get_datatables();
        $data = array();
        $no = @$_POST['start'];

        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->dari;
            $row[] = $r->tujuan;
            $row[] = $r->orderan;
            $row[] = $r->customer;
            $row[] = $this->rupiah($r->tarif);
            $row[] = $r->kode_inv;
            $row[] = '
                    <a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_invoice(' . "'" . $r->id_tarif . "'" . ')">Edit</a>
                    <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="hapus_invoice(' . "'" . $r->id_tarif . "'" . ')">Hapus</a>
                    ';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->masterinvoice->count_all(),
            "recordsFiltered" => $this->masterinvoice->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function simpan_invoice()
    {
        $this->_validate('save');
        $data = [
            'dari_idm'         => $this->request->getVar('dari_idm'),
            'tujuan_idm'       => $this->request->getVar('tujuan_idm'),
            'orderan'          => $this->request->getVar('orderan'),
            'produk_idm'       => $this->request->getVar('produk_idm'),
            'tarif'            => $this->request->getVar('tarif'),
            'kode_inv'       => $this->request->getVar('kode_inv'),
        ];
        if ($this->masterinvoice->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function edit_invoice($id)
    {
        $data = $this->masterinvoice->find($id);
        echo json_encode($data);
    }
    public function update_invoice()
    {
        $this->_validate('update');
        $data = [
            'id_tarif'         => $this->request->getPost('id'),
            'dari_idm'         => $this->request->getVar('dari_idm'),
            'tujuan_idm'       => $this->request->getVar('tujuan_idm'),
            'orderan'          => $this->request->getVar('orderan'),
            'produk_idm'       => $this->request->getVar('produk_idm'),
            'tarif'            => $this->request->getVar('tarif'),
            'kode_inv'         => $this->request->getVar('kode_inv'),
        ];

        if ($this->masterinvoice->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function delete_invoice($id)
    {
        if ($this->masterinvoice->delete($id)) {
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

            if ($validation->hasError('kode_inv')) {
                $data['inputerror'][] = 'kode_inv';
                $data['error_string'][] = $validation->getError('kode_inv');
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
            $kode_inv            = 'is_unique[master_invoice.kode_inv]';
        } else {
            $kode_inv            = 'is_unique[master_invoice.kode_inv,id_tarif,{id}]';
        }
        $rulesValidation = [
            'kode_inv' => [
                'rules' => $kode_inv,
                'errors' => [
                    'is_unique' => 'Data sudah ada'
                ]
            ]
        ];
        return $rulesValidation;
    }
}
