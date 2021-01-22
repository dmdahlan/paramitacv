<?php

namespace App\Models;

use CodeIgniter\Model;

class DelivInvoice extends Model
{
    protected $table = 'deliv_invoice';
    protected $allowedFields = ['deliv_idm', 'tgl_inv', 'no_inv', 'billing', 'nominal'];
    protected $id = 'idm_inv';
    protected $primaryKey = 'idm_inv';
    protected $useTimestamps = true;

    protected $column_order = array('idm_deliv', 'deliv_order.tgl', 'master_unit.nopol', 'orderan', 'dari', 'tujuan', 'customer', 'shipment', 'qty', 'tgl_inv', 'no_inv', 'billing', 'produk', 'shipment');
    protected $column_search = array('idm_deliv', 'deliv_order.tgl', 'orderan', 'dari', 'tujuan', 'master_unit.nopol', 'dari', 'outlet', 'customer', 'shipment', 'qty', 'tgl_inv', 'no_inv', 'billing', 'produk', 'shipment');
    protected $order = array('tgl_deliv' => 'desc');

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
        $this->dt = $this->db->table('deliv_order')
            ->join('deliv_invoice', 'deliv_invoice.deliv_idm = deliv_order.idm_deliv', 'left')
            ->join('deliv_biaya', 'deliv_biaya.deliv_idm = deliv_order.idm_deliv', 'left')
            ->join('master_unit', 'master_unit.idm_nopol = deliv_order.nopol_idm', 'left')
            ->join('master_dari', 'master_dari.idm_dari = deliv_order.dari_idm', 'left')
            ->join('master_tujuan', 'master_tujuan.idm_tujuan = deliv_order.tujuan_idm', 'left')
            ->join('master_produk', 'master_produk.idm_produk = deliv_order.produk_idm', 'left')
            ->select('deliv_order.*, deliv_order.tgl as tgl_deliv, master_unit.nopol,master_dari.dari, master_tujuan.tujuan,master_produk.produk,deliv_invoice.idm_inv,deliv_invoice.tgl_inv,deliv_invoice.no_inv,deliv_invoice.billing,deliv_invoice.nominal,master_produk.customer,deliv_biaya.total as ttlbiaya');
        $this->dt->where('deliv_order.deleted_at', null);

        $request = \Config\Services::request();
        if ($request->getPost('dari')) {
            $this->dt->like('dari', $request->getPost('dari'));
        }
        if ($request->getPost('tujuan')) {
            $this->dt->like('tujuan', $request->getPost('tujuan'));
        }
        if ($request->getVar('bk') == 'BELUM KEMBALI') {
            $this->dt->where('sj_kembali', null);
        }
        if ($request->getVar('bk') == 'KEMBALI') {
            $this->dt->where('sj_kembali !=', null);
        }
        if ($request->getVar('bt') == 'Belum Tertagih') {
            $this->dt->where('no_inv', null);
        }
        if ($request->getVar('bt') == 'Tertagih') {
            $this->dt->where('no_inv !=', null);
        }
        if ($request->getVar('tgldeliv')) {
            $this->dt->where('tgl', $request->getVar('tgldeliv'));
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
    public function getinv($id)
    {
        $this->di = $this->db->table('deliv_order')
            ->join('deliv_invoice', 'deliv_invoice.deliv_idm = deliv_order.idm_deliv', 'left')
            ->join('master_unit', 'master_unit.idm_nopol = deliv_order.nopol_idm', 'left')
            ->join('master_dari', 'master_dari.idm_dari = deliv_order.dari_idm', 'left')
            ->join('master_tujuan', 'master_tujuan.idm_tujuan = deliv_order.tujuan_idm', 'left')
            ->join('master_produk', 'master_produk.idm_produk = deliv_order.produk_idm', 'left')
            ->select('deliv_order.*, deliv_order.tgl as tgl_deliv, master_unit.nopol,master_dari.dari, master_tujuan.tujuan,master_produk.produk,deliv_invoice.idm_inv,deliv_invoice.tgl_inv,deliv_invoice.no_inv,deliv_invoice.billing,deliv_invoice.nominal');
        $this->di->where('deliv_order.deleted_at', null);
        return $this->di->getWhere(['idm_deliv' => $id])->getRowArray();
    }
}
