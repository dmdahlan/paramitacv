<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Deliv_order extends BaseController
{

    public function index()
    {
        $data = [
            'title'         => 'Data | Delivery',
            'nam'           => $this->delivery->findAll()
        ];
        return view('data/vw_delivorder', $data);
    }
    public function ajax_list()
    {
        $list = $this->delivery->get_datatables();
        $data = array();
        $no = @$_POST['start'];

        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = Time::parse($r->tgl)->toLocalizedString('dd-MMM-yy');
            if ($r->sj_kembali == null) {
                $row[] = '';
            } else {
                $row[] = Time::parse($r->sj_kembali)->toLocalizedString('dd-MMM-yy');
            }
            $row[] = $r->no_sj;
            $row[] = '<a class="text-blue" href="javascript:void(0)" onclick="edit_deliv(' . "'" . $r->idm_deliv . "'" . ')">' . $r->nopol;
            $row[] = $r->orderan;
            $row[] = $r->nama;
            $row[] = $r->lokasi_awal;
            $row[] = $r->dari;
            $row[] = $r->tujuan;
            $row[] = $r->tujuaninv;
            $row[] = $r->outlet;
            $row[] = $r->produk;
            $row[] = $r->customer;
            $row[] = $r->shipment;
            $row[] = $r->qty;
            $row[] = $r->claim;
            // $row[] = $r->idm_deliv;
            if ($r->deliv_idm != null) {
                $row[] = '
                     <a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_deliv(' . "'" . $r->idm_deliv . "'" . ')">Edit</a>';
            } else {
                $row[] = '
                     <a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_deliv(' . "'" . $r->idm_deliv . "'" . ')">Edit</a>
                     <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="hapus_deliv(' . "'" . $r->idm_deliv . "'" . ')">Hapus</a>
                    ';
            }
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->delivery->count_all(),
            "recordsFiltered" => $this->delivery->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function simpan_deliv()
    {
        $ketjuan = $this->request->getVar('dari_idm') . $this->request->getVar('tujuan_idm') . $this->request->getVar('kapasitas');
        if (!empty($_POST['sj_kembali']))
            $sj_kembali = time::parse($this->request->getPost('sj_kembali'));
        else
            $sj_kembali = null;
        $this->_validate('save');
        $data = [
            'tgl'             => time::parse($this->request->getPost('tgl')),
            'sj_kembali'      => $sj_kembali,
            'no_sj'           => $this->request->getPost('no_sj'),
            'nopol_idm'       => $this->request->getPost('nopol_idm'),
            'orderan'         => $this->request->getPost('orderan'),
            'driver_idm'      => $this->request->getPost('driver_idm'),
            'lokasi_awal'     => $this->request->getPost('lokasi_awal'),
            'dari_idm'        => $this->request->getPost('dari_idm'),
            'tujuan_idm'      => $this->request->getPost('tujuan_idm'),
            'tujuaninv_idm'   => $this->request->getPost('tujuaninv_idm'),
            'outlet'          => $this->request->getPost('outlet'),
            'produk_idm'      => $this->request->getPost('produk_idm'),
            'uang_jln'        => $this->request->getPost('uang_jln'),
            'shipment'        => $this->request->getPost('shipment'),
            'qty'             => $this->request->getPost('qty'),
            'claim'           => $this->request->getPost('claim'),
            'ketjuan'         => $ketjuan,
        ];
        if ($this->delivery->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function edit_deliv($id)
    {
        $data = $this->delivery->find($id);
        echo json_encode($data);
    }
    public function update_deliv()
    {
        //Validasi
        $this->_validate('update');
        $ketjuan = $this->request->getVar('dari_idm') . $this->request->getVar('tujuan_idm') . $this->request->getVar('kapasitas');
        if (!empty($_POST['sj_kembali']))
            $sj_kembali = time::parse($this->request->getPost('sj_kembali'));
        else
            $sj_kembali = null;
        $data = [
            'idm_deliv'       => $this->request->getVar('id'),
            'tgl'             => time::parse($this->request->getPost('tgl')),
            'sj_kembali'      => $sj_kembali,
            'no_sj'           => $this->request->getVar('no_sj'),
            'nopol_idm'       => $this->request->getVar('nopol_idm'),
            'orderan'         => $this->request->getVar('orderan'),
            'driver_idm'      => $this->request->getVar('driver_idm'),
            'lokasi_awal'     => $this->request->getVar('lokasi_awal'),
            'dari_idm'        => $this->request->getVar('dari_idm'),
            'tujuan_idm'      => $this->request->getVar('tujuan_idm'),
            'tujuaninv_idm'   => $this->request->getPost('tujuaninv_idm'),
            'outlet'          => $this->request->getVar('outlet'),
            'produk_idm'      => $this->request->getVar('produk_idm'),
            'uang_jln'        => $this->request->getVar('uang_jln'),
            'shipment'        => $this->request->getVar('shipment'),
            'qty'             => $this->request->getVar('qty'),
            'claim'           => $this->request->getVar('claim'),
            'ketjuan'         => $ketjuan,
        ];

        if ($this->delivery->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function delete_deliv($id)
    {
        if ($this->delivery->delete($id)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function harian()
    {
        $data = [
            'title'         => 'Data | Harian'
        ];
        return view('data/vw_delivharian', $data);
    }
    public function ajax_list_harian()
    {
        $tgl_awal  = $this->request->getVar('tgl_awal');
        $tgl_akhir = $this->request->getVar('tgl_akhir');
        $list = $this->delivery->get_datatablesharian($tgl_awal, $tgl_akhir);
        $data = array();
        $no = @$_POST['start'];

        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = Time::parse($r->tgl)->toLocalizedString('dd-MM-YYYY');
            $row[] = $r->nopol;
            $row[] = $r->orderan;
            $row[] = $r->nama;
            $row[] = $r->dari . ' - ' . $r->tujuan;
            $row[] = $r->produk;

            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->delivery->count_allharian($tgl_awal, $tgl_akhir),
            "recordsFiltered" => $this->delivery->count_filteredharian($tgl_awal, $tgl_akhir),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function _validate($method)
    {
        if (!$this->validate($this->_getRulesValidation($method))) {
            $validation = \Config\Services::validation();

            $data = [];
            $data['error_string'] = [];
            $data['inputerror'] = [];
            $data['status'] = TRUE;

            if ($validation->hasError('tgl')) {
                $data['inputerror'][] = 'tgl';
                $data['error_string'][] = $validation->getError('tgl');
                $data['status'] = FALSE;
            }
            if ($validation->hasError('no_sj')) {
                $data['inputerror'][] = 'no_sj';
                $data['error_string'][] = $validation->getError('no_sj');
                $data['status'] = FALSE;
            }
            // if ($validation->hasError('shipment')) {
            //     $data['inputerror'][] = 'shipment';
            //     $data['error_string'][] = $validation->getError('shipment');
            //     $data['status'] = FALSE;
            // }
            if ($data['status'] === FALSE) {
                echo json_encode($data);
                exit();
            }
        }
    }
    public function _getRulesValidation($method = null)
    {
        if ($method == 'save') {
            $tgl                 = 'required';
            // $shipment            = 'is_unique[deliv_order.shipment]';
        } else {
            $tgl                 = 'required';
            // $shipment            = 'is_unique[deliv_order.shipment,idm_deliv,{id}]';
        }
        $rulesValidation = [
            'tgl' => [
                'rules' => $tgl,
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            // 'shipment' => [
            //     'rules' => $shipment,
            //     'errors' => [
            //         'is_unique' => 'Shipment sudah ada'
            //     ]
            // ]
        ];
        return $rulesValidation;
    }
}
