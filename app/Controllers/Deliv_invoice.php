<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Deliv_invoice extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Data | Invoice'
        ];
        return view('data/vw_delivinvoice', $data);
    }
    public function ajax_list()
    {
        $list = $this->deliveryinvoice->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        $total = 0;

        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = Time::parse($r->tgl_deliv)->toLocalizedString('dd-MMM-yy');
            $row[] = $r->nopol;
            $row[] = $r->orderan;
            $row[] = $r->dari . ' - ' . $r->tujuan;
            $row[] = $r->outlet;
            $row[] = $r->customer;
            $row[] = $r->shipment;
            $row[] = $r->qty;
            if ($r->tgl_inv == null) {
                $row[] = '';
            } else {
                $row[] = Time::parse($r->tgl_inv)->toLocalizedString('dd-MMM-yy');
            }
            $row[] = $r->no_inv;
            $row[] = $r->billing;
            $row[] = $this->rupiah($r->nominal);
            // $row[] = $r->idm_deliv;
            if ($r->tgl_inv == '') {
                $row[] =
                    '<a class="btn btn-warning btn-xs" href="javascript:void(0)" title="tambah" onclick="tambah_inv(' . "'" . $r->idm_deliv . "'" . ')">Edit</a>
                    ';
            } else {
                $row[] =
                    '<a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_inv(' . "'" . $r->idm_deliv . "'" . ')">Edit</a>
                    ';
            }
            $total += $r->nominal;
            $data[] = $row;
        }
        $data[] = array(
            '', '', '', '', '', '', '', '', '', '', '', 'TOTAL', $this->rupiah($total), '', ''
        );
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->deliveryinvoice->count_all(),
            "recordsFiltered" => $this->deliveryinvoice->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function simpan_invoice()
    {
        $this->_validate('save');
        $data = [
            'deliv_idm'       => $this->request->getVar('deliv_idm'),
            'tgl_inv'         => $this->request->getVar('tgl_inv'),
            'no_inv'          => $this->request->getVar('no_inv'),
            'billing'         => $this->request->getVar('billing'),
            'nominal'         => $this->request->getVar('nominal')
        ];
        if ($this->deliveryinvoice->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function edit_inv($id)
    {
        $data = $this->deliveryinvoice->getinv($id);
        echo json_encode($data);
    }
    public function update_invoice()
    {
        //Validasi
        $this->_validate('update');

        $data = [
            'idm_inv'         => $this->request->getVar('id'),
            'deliv_idm'       => $this->request->getVar('deliv_idm'),
            'tgl_inv'         => $this->request->getVar('tgl_inv'),
            'no_inv'          => $this->request->getVar('no_inv'),
            'billing'         => $this->request->getVar('billing'),
            'nominal'         => $this->request->getVar('nominal')
        ];

        if ($this->deliveryinvoice->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function delete_inv($id)
    {
        if ($this->deliveryinvoice->delete($id)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function printinv()
    {
        return view('data/vw_printinv');
    }
    public function _validate($method)
    {
        if (!$this->validate($this->_getRulesValidation($method))) {
            $validation = \Config\Services::validation();

            $data = [];
            $data['error_string'] = [];
            $data['inputerror'] = [];
            $data['status'] = TRUE;

            if ($validation->hasError('tgl_inv')) {
                $data['inputerror'][] = 'tgl_inv';
                $data['error_string'][] = $validation->getError('tgl_inv');
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
            $tgl_inv            = 'required';
        } else {
            $tgl_inv            = 'required';
        }
        $rulesValidation = [
            'tgl_inv' => [
                'rules' => $tgl_inv,
                'errors' => [
                    'required' => 'Tanggal harus diisi.'
                ]
            ]
        ];
        return $rulesValidation;
    }
}
