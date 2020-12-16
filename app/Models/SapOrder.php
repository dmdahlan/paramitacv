<?php

namespace App\Models;

use CodeIgniter\Model;

class SapOrder extends Model
{
    protected $table = 'sap_order';
    protected $allowedFields = ['tgl_sap', 'fo', 'driver_idm', 'nopol_idm', 'dari_idm', 'tujuan_idm', 'produk_idm', 'orderan', 'outlet', 'keterangan', 'ket_sap'];
    protected $id = 'id_sap';
    protected $primaryKey = 'id_sap';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $column_order = array('id_sap', 'tgl_sap', 'fo', 'nama', 'nopol', 'dari', 'tujuan', 'produk', 'orderan', 'outlet', 'keterangan', 'ket_sap');
    protected $column_search = array('id_sap', 'tgl_sap', 'fo', 'nama', 'nopol', 'dari', 'tujuan', 'produk', 'orderan', 'outlet', 'sap_order.keterangan', 'ket_sap');
    protected $order = array('tgl_sap,sap_order.created_at' => 'desc');

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
        $this->dt = $this->db->table('sap_order')
            ->join('master_driver', 'master_driver.idm_driver=sap_order.driver_idm', 'left')
            ->join('master_unit', 'master_unit.idm_nopol=sap_order.nopol_idm', 'left')
            ->join('master_dari', 'master_dari.idm_dari=sap_order.dari_idm', 'left')
            ->join('master_tujuan', 'master_tujuan.idm_tujuan=sap_order.tujuan_idm', 'left')
            ->join('master_produk', 'master_produk.idm_produk=sap_order.produk_idm', 'left')
            ->select('sap_order.*,  sap_order.keterangan as keterangansap,master_driver.nama,master_unit.nopol,master_dari.dari,master_tujuan.tujuan,master_produk.produk');
        $this->dt->where('sap_order.deleted_at', null);
        $request = \Config\Services::request();
        if ($request->getVar('ketok')) {
            $this->dt->where('sap_order.keterangan', $request->getVar('ketok'));
        }
        if ($request->getVar('ketok') == 'KOSONG') {
            $this->dt->where('sap_order.keterangan', null);
        }
        if ($request->getVar('tglsap')) {
            $this->dt->where('tgl_sap', $request->getVar('tglsap'));
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
    public function getsap($id)
    {
        $this->dg = $this->db->table('sap_order')
            ->join('master_driver', 'master_driver.idm_driver = sap_order.driver_idm', 'left')
            ->join('master_unit', 'master_unit.idm_nopol = sap_order.nopol_idm', 'left')
            ->select('sap_order.*, master_driver.nama,master_driver.nohp, master_unit.nopol,master_unit.no_keur,master_unit.kerb_weight,master_unit.jbb,master_unit.jbi');
        $this->dg->where('sap_order.deleted_at', null);
        return $this->dg->getWhere(['id_sap' => $id])->getRowArray();
    }
}
