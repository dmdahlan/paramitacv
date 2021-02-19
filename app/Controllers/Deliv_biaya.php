<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Deliv_biaya extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Uang | Jalan'
        ];
        return view('data/vw_delivbiaya', $data);
    }
    public function ajax_list()
    {
        $list = $this->deliverybiaya->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        $jmlh_1 = 0;
        $jmlh_2 = 0;
        $buruh_m = 0;
        $buruh_b = 0;
        $lain2 = 0;
        $total_biaya = 0;

        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = Time::parse($r->tgl_deliv)->toLocalizedString('dd-MMM-yy');
            if ($r->sj_kembali == '') {
                $row[] = '';
            } else {
                $row[] = Time::parse($r->sj_kembali)->toLocalizedString('dd-MMM-yy');
            }
            if ($r->total == '') {
                $row[] = '<a class="text-blue" href="javascript:void(0)" onclick="tambah_biaya(' . "'" . $r->idm_deliv . "'" . ')">' . $r->nopol;
            } else {
                $row[] = '<a class="text-blue" href="javascript:void(0)" onclick="edit_biaya(' . "'" . $r->idm_deliv . "'" . ')">' . $r->nopol;
            }
            $row[] = $r->orderan;
            $row[] = $r->nama;
            $row[] = $r->lokasi_awal;
            $row[] = $r->dari . ' - ' . $r->tujuan;
            $row[] = $r->produk;
            $row[] = $r->shipment;
            if ($r->tgl_1 == null) {
                $row[] = '';
            } else {
                $row[] = Time::parse($r->tgl_1)->toLocalizedString('dd-MMM-yy');
            }
            $row[] = $this->rupiah($r->jml_1);
            if ($r->tgl_2 == null) {
                $row[] = '';
            } else {
                $row[] = Time::parse($r->tgl_2)->toLocalizedString('dd-MMM-yy');
            }
            $row[] = $this->rupiah($r->jml_2);
            if ($r->tgl_buruhmuat == null) {
                $row[] = '';
            } else {
                $row[] = Time::parse($r->tgl_buruhmuat)->toLocalizedString('dd-MMM-yy');
            }
            $row[] = $this->rupiah($r->jml_buruhmuat);
            if ($r->tgl_buruhbongkar == null) {
                $row[] = '';
            } else {
                $row[] = Time::parse($r->tgl_buruhbongkar)->toLocalizedString('dd-MMM-yy');
            }
            $row[] = $this->rupiah($r->jml_buruhbongkar);
            if ($r->tgl_lain2 == null) {
                $row[] = '';
            } else {
                $row[] = Time::parse($r->tgl_lain2)->toLocalizedString('dd-MMM-yy');
            }
            $row[] = $this->rupiah($r->jml_lain2);
            $row[] = $r->ket_biaya;
            $row[] = $this->rupiah($r->total);
            // opsi
            if ($r->total == '') {
                $row[] =
                    '<a class="btn btn-warning btn-xs" href="javascript:void(0)" title="tambah" onclick="tambah_biaya(' . "'" . $r->idm_deliv . "'" . ')">Edit</a>
                    ';
            } else {
                $row[] =
                    '<a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_biaya(' . "'" . $r->idm_deliv . "'" . ')">Edit</a>
                    <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Edit" onclick="hapus_biaya(' . "'" . $r->id_biaya . "'" . ')">hapus</a>
                    ';
            }
            $jmlh_1 += $r->jml_1;
            $jmlh_2 += $r->jml_2;
            $buruh_m += $r->jml_buruhmuat;
            $buruh_b += $r->jml_buruhbongkar;
            $lain2 += $r->jml_lain2;
            $total_biaya += $r->total;
            $data[] = $row;
        }
        $data[] = array(
            '', '', '', '', '', '', '', '', '', '', 'TOTAL', $this->rupiah($jmlh_1), '', $this->rupiah($jmlh_2), '', $this->rupiah($buruh_m), '', $this->rupiah($buruh_b), '', $this->rupiah($lain2), '', $this->rupiah($total_biaya), ''
        );
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->deliverybiaya->count_all(),
            "recordsFiltered" => $this->deliverybiaya->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function simpan_biaya()
    {
        if (!empty($_POST['tgl_1'])) {
            $tgl_1 = time::parse($this->request->getPost('tgl_1'));
        } else {
            $tgl_1 = null;
        }
        if (!empty($_POST['tgl_2'])) {
            $tgl_2 = time::parse($this->request->getPost('tgl_2'));
        } else {
            $tgl_2 = null;
        }
        if (!empty($_POST['tgl_buruhmuat'])) {
            $tgl_buruhmuat = time::parse($this->request->getPost('tgl_buruhmuat'));
        } else {
            $tgl_buruhmuat = null;
        }
        if (!empty($_POST['tgl_buruhbongkar'])) {
            $tgl_buruhbongkar = time::parse($this->request->getPost('tgl_buruhbongkar'));
        } else {
            $tgl_buruhbongkar = null;
        }
        if (!empty($_POST['tgl_lain2'])) {
            $tgl_lain2 = time::parse($this->request->getPost('tgl_lain2'));
        } else {
            $tgl_lain2 = null;
        }
        $this->_validate('save');
        $data = [
            'deliv_idm'         => $this->request->getPost('deliv_idm'),
            'tgl_1'             => $tgl_1,
            'jml_1'             => $this->request->getPost('jml_1'),
            'tgl_2'             => $tgl_2,
            'jml_2'             => $this->request->getPost('jml_2'),
            'tgl_buruhmuat'     => $tgl_buruhmuat,
            'jml_buruhmuat'     => $this->request->getPost('jml_buruhmuat'),
            'tgl_buruhbongkar'  => $tgl_buruhbongkar,
            'jml_buruhbongkar'  => $this->request->getPost('jml_buruhbongkar'),
            'tgl_lain2'         => $tgl_lain2,
            'jml_lain2'         => $this->request->getPost('jml_lain2'),
            'ket_biaya'         => $this->request->getPost('ket_biaya'),
            'total'             => $this->request->getPost('total')
        ];
        if ($this->deliverybiaya->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function edit_biaya($id)
    {
        $data = $this->deliverybiaya->getdata($id);
        echo json_encode($data);
    }
    public function update_biaya()
    {
        if (!empty($_POST['tgl_1'])) {
            $tgl_1 = time::parse($this->request->getPost('tgl_1'));
        } else {
            $tgl_1 = null;
        }
        if (!empty($_POST['tgl_2'])) {
            $tgl_2 = time::parse($this->request->getPost('tgl_2'));
        } else {
            $tgl_2 = null;
        }
        if (!empty($_POST['tgl_buruhmuat'])) {
            $tgl_buruhmuat = time::parse($this->request->getPost('tgl_buruhmuat'));
        } else {
            $tgl_buruhmuat = null;
        }
        if (!empty($_POST['tgl_buruhbongkar'])) {
            $tgl_buruhbongkar = time::parse($this->request->getPost('tgl_buruhbongkar'));
        } else {
            $tgl_buruhbongkar = null;
        }
        if (!empty($_POST['tgl_lain2'])) {
            $tgl_lain2 = time::parse($this->request->getPost('tgl_lain2'));
        } else {
            $tgl_lain2 = null;
        }
        //Validasi
        $this->_validate('update');

        $data = [
            'id_biaya'          => $this->request->getPost('id'),
            'deliv_idm'         => $this->request->getPost('deliv_idm'),
            'tgl_1'             => $tgl_1,
            'jml_1'             => $this->request->getPost('jml_1'),
            'tgl_2'             => $tgl_2,
            'jml_2'             => $this->request->getPost('jml_2'),
            'tgl_buruhmuat'     => $tgl_buruhmuat,
            'jml_buruhmuat'     => $this->request->getPost('jml_buruhmuat'),
            'tgl_buruhbongkar'  => $tgl_buruhbongkar,
            'jml_buruhbongkar'  => $this->request->getPost('jml_buruhbongkar'),
            'tgl_lain2'         => $tgl_lain2,
            'jml_lain2'         => $this->request->getPost('jml_lain2'),
            'ket_biaya'         => $this->request->getPost('ket_biaya'),
            'total'             => $this->request->getPost('total')
        ];

        if ($this->deliverybiaya->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function delete_biaya($id)
    {
        if ($this->deliverybiaya->delete($id)) {
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

            if ($validation->hasError('deliv_idm')) {
                $data['inputerror'][] = 'deliv_idm';
                $data['error_string'][] = $validation->getError('deliv_idm');
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
            $deliv_idm        = 'required|is_unique[deliv_biaya.deliv_idm]';
        } else {
            $deliv_idm        = 'required|is_unique[deliv_biaya.deliv_idm,id_biaya,{id}]';
        }
        $rulesValidation = [
            'deliv_idm' => [
                'rules' => $deliv_idm,
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah ada'
                ]
            ]
        ];
        return $rulesValidation;
    }
}
