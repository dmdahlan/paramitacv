<?php

namespace App\Models;

use CodeIgniter\Model;

class RekapInvoice extends Model
{
    protected $table = 'rekap_invoice';
    protected $allowedFields = ['tgl_rekap', 'no_inv', 'no_faktur', 'produk_idm', 'nominal', 'nominal_claim', 'ket_rekap', 'bank1',  'tgl_bayar1', 'nominal1', 'tgl_bayar2', 'nominal2'];
    protected $id = 'id_rekap';
    protected $primaryKey = 'id_rekap';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $column_order = array('id_rekap', 'tgl_rekap', 'no_inv', 'no_faktur', 'customer', 'nominal', 'ppn', 'pph', 'nominal_claim', '', 'bank1', 'tgl_bayar1', 'nominal1');
    protected $column_search = array('id_rekap', 'tgl_rekap', 'no_inv', 'no_faktur', 'customer', 'nominal', 'nominal_claim', 'ket_rekap', 'bank1', 'tgl_bayar1', 'nominal1');
    protected $order = array('tgl_rekap,rekap_invoice.created_at' => 'desc');

    function get_datatables()
    {
        $this->_get_datatables_query();
        if (@$_POST['length'] != -1)
            $this->dt->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->dt->get();
        return $query->getResult();
    }
    private function _get_datatables_query()
    {
        $this->dt = $this->db->table('rekap_invoice')
            ->join('master_produk', 'master_produk.idm_produk=rekap_invoice.produk_idm', 'left');
        $this->dt->where('rekap_invoice.deleted_at', null);
        $request = \Config\Services::request();
        if ($request->getVar('tgl_awal') && $request->getVar('tgl_akhir')) {
            $this->dt->where('tgl_rekap BETWEEN "' . date('Y-m-d', strtotime($request->getVar('tgl_awal'))) . '" AND "' . date('Y-m-d', strtotime($request->getVar('tgl_akhir'))) . '"');
        }
        if ($request->getPost('tgl_bayar')) {
            $this->dt->like('tgl_bayar1',  date('Y-m-d', strtotime($request->getPost('tgl_bayar'))));
        }
        if ($request->getVar('payment') == 'Belum Bayar') {
            $this->dt->where('tgl_bayar1', null);
        }
        $i = 0;
        foreach ($this->column_search as $item) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $_POST['search']['value']);
                } else {
                    $this->dt->orLike($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->dt->orderBy($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }
    function count_filtered()
    {
        $this->_get_datatables_query();
        return $this->dt->countAllResults();
    }
    public function count_all()
    {
        $query = $this->dt->where('deleted_at', null);
        return $query->countAllResults();
    }
}
