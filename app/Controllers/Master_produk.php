<?php

namespace App\Controllers;

class Master_produk extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Data | Produk',
            'validation'    => $this->validation
        ];
        return view('data/vw_masterproduk', $data);
    }
    public function ajax_list()
    {
        $list = $this->masterproduk->get_datatables();
        $data = array();
        $no = @$_POST['start'];

        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->customer;
            $row[] = $r->produk;
            $row[] = $r->alamat;
            $row[] = '
                    <a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_produk(' . "'" . $r->idm_produk . "'" . ')">Edit</a>
                    <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="hapus_produk(' . "'" . $r->idm_produk . "'" . ')">Hapus</a>
                    ';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->masterproduk->count_all(),
            "recordsFiltered" => $this->masterproduk->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function simpan_produk()
    {
        $this->_validate('save');
        if (!empty($_POST['ppn'])) {
            $ppn = $this->request->getVar('ppn');
        } else {
            $ppn = 0;
        }
        if (!empty($_POST['pph'])) {
            $pph = $this->request->getVar('pph');
        } else {
            $pph = 0;
        }
        $data = [
            'produk'          => $this->request->getPost('produk'),
            'customer'        => $this->request->getPost('customer'),
            'alamat'          => $this->request->getPost('alamat'),
            'ppn'             => $ppn,
            'pph'             => $pph
        ];

        if ($this->masterproduk->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function edit_produk($id)
    {
        $data = $this->masterproduk->find($id);
        echo json_encode($data);
    }
    public function update_produk()
    {
        //Validasi
        $this->_validate('update');
        if (!empty($_POST['ppn'])) {
            $ppn = $this->request->getVar('ppn');
        } else {
            $ppn = 0;
        }
        if (!empty($_POST['pph'])) {
            $pph = $this->request->getVar('pph');
        } else {
            $pph = 0;
        }
        $data = [
            'idm_produk'      => $this->request->getPost('id'),
            'produk'          => $this->request->getPost('produk'),
            'customer'        => $this->request->getPost('customer'),
            'alamat'          => $this->request->getPost('alamat'),
            'ppn'             => $ppn,
            'pph'             => $pph
        ];

        if ($this->masterproduk->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function delete_produk($id)
    {
        if ($this->masterproduk->delete($id)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function getproduk()
    {
        $data = $this->masterproduk->orderBy('produk', 'ASC')->findAll();
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

            if ($validation->hasError('produk')) {
                $data['inputerror'][] = 'produk';
                $data['error_string'][] = $validation->getError('produk');
                $data['status'] = FALSE;
            }
            if ($validation->hasError('customer')) {
                $data['inputerror'][] = 'customer';
                $data['error_string'][] = $validation->getError('customer');
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
            $produk         = 'required]';
            $customer       = 'required]';
        } else {
            $produk         = 'required';
            $customer       = 'required';
        }
        $rulesValidation = [
            'produk' => [
                'rules' => $produk,
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'customer' => [
                'rules' => $customer,
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ];
        return $rulesValidation;
    }
}
