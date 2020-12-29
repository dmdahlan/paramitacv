<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Rekap_invoice extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Rekap | Invoice'
        ];
        return view('data/vw_rekapinvoice', $data);
    }
    public function ajax_list()
    {
        if (!empty($_POST['tgl_bayar1'])) {
            $tgl_bayar1 = time::parse($this->request->getPost('tgl_bayar1'));
        } else {
            $tgl_bayar1 = null;
        }
        if (!empty($_POST['tgl_bayar2'])) {
            $tgl_bayar2 = time::parse($this->request->getPost('tgl_bayar2'));
        } else {
            $tgl_bayar2 = null;
        }
        $list = $this->rekapinvoice->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        $total = 0;
        $grandtotal = 0;
        $bayar1 = 0;
        $bayar2 = 0;
        $piutang = 0;
        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = Time::parse($r->tgl_rekap)->toLocalizedString('dd-MMM-yy');
            $row[] = '<a class="text-orange" href="javascript:void(0)" onclick="edit_rekap(' . "'" . $r->id_rekap . "'" . ')">' . $r->no_inv;
            $row[] = $r->no_faktur;
            $row[] = $r->customer;
            $row[] = $this->rupiah($r->nominal);
            // ketearngan
            $ppn = $r->nominal * 10 / 100;
            $pph = $r->nominal * 2 / 100;
            // ppn
            if ($r->ppn == 1) {
                $row[] = $this->rupiah($ppn);
            } else {
                $row[] = null;
            }
            // pph23
            if ($r->pph == 1) {
                $row[] = $this->rupiah($pph);
            } else {
                $row[] = null;
            }
            // total
            if ($r->ppn +  $r->pph == 0) {
                $row[] = $this->rupiah($r->nominal);
            }
            if ($r->ppn +  $r->pph == 1) {
                $row[] = $this->rupiah($r->nominal + $ppn);
            }
            if ($r->ppn +  $r->pph == 2) {
                $row[] = $this->rupiah($r->nominal + $ppn - $pph);
            }
            $row[] = $r->bank1;
            if ($r->tgl_bayar1 == null) {
                $row[] = '';
            } else {
                $row[] = Time::parse($r->tgl_bayar1)->toLocalizedString('dd-MMM-yy');
            }
            $row[] = $this->rupiah($r->nominal1);
            // if ($r->tgl_bayar2 == null) {
            //     $row[] = '';
            // } else {
            //     $row[] = Time::parse($r->tgl_bayar2)->toLocalizedString('dd-MMM-YY');
            // }
            // $row[] = $this->rupiah($r->nominal2);
            // sisa
            if ($r->ppn +  $r->pph == 0) {
                $row[] = $this->rupiah($r->nominal - $r->nominal1 - $r->nominal2);
            }
            if ($r->ppn +  $r->pph == 1) {
                $row[] = $this->rupiah($r->nominal + $ppn - $r->nominal1 - $r->nominal2);
            }
            if ($r->ppn +  $r->pph == 2) {
                $row[] = $this->rupiah($r->nominal + $ppn - $pph - $r->nominal1 - $r->nominal2);
            }
            $row[] = $r->ket_rekap;
            // $row[] = '
            //          <a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_rekap(' . "'" . $r->id_rekap . "'" . ')">Edit</a>
            //          <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="hapus_rekap(' . "'" . $r->id_rekap . "'" . ')">Hapus</a>
            //         ';
            $invaja = 0;
            if ($r->ppn +  $r->pph == 0) {
                $invaja = $r->nominal;
            }
            if ($r->ppn +  $r->pph == 1) {
                $invaja = $r->nominal + $ppn;
            }
            if ($r->ppn +  $r->pph == 2) {
                $invaja = $r->nominal + $ppn - $pph;
            }
            // sisa pembayaran
            $sisabayar = 0;
            if ($r->ppn +  $r->pph == 0) {
                $sisabayar = $r->nominal - $r->nominal1 - $r->nominal2;
            }
            if ($r->ppn +  $r->pph == 1) {
                $sisabayar = $r->nominal + $ppn - $r->nominal1 - $r->nominal2;
            }
            if ($r->ppn +  $r->pph == 2) {
                $sisabayar = $r->nominal + $ppn - $pph - $r->nominal1 - $r->nominal2;
            }

            $bayar1 += $r->nominal1;
            $bayar2 += $r->nominal2;
            $total += $r->nominal;
            $grandtotal += $invaja;
            $piutang += $sisabayar;
            $data[] = $row;
        }
        $data[] = array(
            '', '', '', '', 'TOTAL', $this->rupiah($total), '', '', $this->rupiah($grandtotal), '', '', $this->rupiah($bayar1), $this->rupiah($piutang), ''
        );
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->rekapinvoice->count_all(),
            "recordsFiltered" => $this->rekapinvoice->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function save()
    {

        if (!empty($_POST['tgl_bayar1'])) {
            $tgl_bayar1 = time::parse($this->request->getPost('tgl_bayar1'));
        } else {
            $tgl_bayar1 = null;
        }
        if (!empty($_POST['tgl_bayar2'])) {
            $tgl_bayar2 = time::parse($this->request->getPost('tgl_bayar2'));
        } else {
            $tgl_bayar2 = null;
        }
        $this->_validate('save');
        $data = [
            'tgl_rekap'             => time::parse($this->request->getPost('tgl_rekap')),
            'no_inv'                => $this->request->getPost('no_inv'),
            'no_faktur'             => $this->request->getPost('no_faktur'),
            'produk_idm'            => $this->request->getPost('produk_idm'),
            'nominal'               => $this->request->getPost('nominal'),
            'ket_rekap'             => $this->request->getPost('ket_rekap'),
            'bank1'                 => $this->request->getPost('bank1'),
            'tgl_bayar1'            => $tgl_bayar1,
            'nominal1'              => $this->request->getPost('nominal1'),
            // 'tgl_bayar2'            => $tgl_bayar2,
            // 'nominal2'              => $this->request->getPost('nominal2'),
        ];
        if ($this->rekapinvoice->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function edit($id)
    {
        echo json_encode($this->rekapinvoice->find($id));
    }
    public function update()
    {

        if (!empty($_POST['tgl_bayar1'])) {
            $tgl_bayar1 = time::parse($this->request->getPost('tgl_bayar1'));
        } else {
            $tgl_bayar1 = null;
        }
        if (!empty($_POST['tgl_bayar2'])) {
            $tgl_bayar2 = time::parse($this->request->getPost('tgl_bayar2'));
        } else {
            $tgl_bayar2 = null;
        }
        $this->_validate('update');
        $data = [
            'id_rekap'              => $this->request->getPost('id'),
            'tgl_rekap'             => time::parse($this->request->getPost('tgl_rekap')),
            'no_inv'                => $this->request->getPost('no_inv'),
            'no_faktur'             => $this->request->getPost('no_faktur'),
            'produk_idm'            => $this->request->getPost('produk_idm'),
            'nominal'               => $this->request->getPost('nominal'),
            'ket_rekap'             => $this->request->getPost('ket_rekap'),
            'bank1'                 => $this->request->getPost('bank1'),
            'tgl_bayar1'            => $tgl_bayar1,
            'nominal1'              => $this->request->getPost('nominal1'),
            // 'tgl_bayar2'            => $tgl_bayar2,
            // 'nominal2'              => $this->request->getPost('nominal2'),
        ];
        if ($this->rekapinvoice->save($data)) {
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

            if ($validation->hasError('tgl_rekap')) {
                $data['inputerror'][] = 'tgl_rekap';
                $data['error_string'][] = $validation->getError('tgl_rekap');
                $data['status'] = FALSE;
            }
            if ($validation->hasError('no_inv')) {
                $data['inputerror'][] = 'no_inv';
                $data['error_string'][] = $validation->getError('no_inv');
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
            $tgl_rekap            = 'required';
            $no_inv               = 'required|is_unique[rekap_invoice.no_inv]';
        } else {
            $tgl_rekap            = 'required';
            $no_inv               = 'required|is_unique[rekap_invoice.no_inv,id_rekap,{id}]';
        }
        $rulesValidation = [
            'tgl_rekap' => [
                'rules' => $tgl_rekap,
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'no_inv' => [
                'rules' => $no_inv,
                'errors' => [
                    'required' => 'No Invoice harus diisi',
                    'is_unique' => 'No Invoice sudah ada'
                ]
            ]
        ];
        return $rulesValidation;
    }
}
