<?php

namespace App\Models;

use CodeIgniter\Model;

class DelivGaji extends Model
{
    protected $table = 'deliv_gaji';
    protected $allowedFields = ['tgl_gaji', 'deliv_idm', 'nominal_gaji'];
    protected $id = 'idm_gaji';
    protected $primaryKey = 'idm_gaji';
    protected $useTimestamps = true;

    protected $column_order = array('idm_deliv', 'sj_kembali', 'tgl_gaji', 'tgl', 'nama', 'shipment', 'nopol', 'produk', 'dari', 'tujuan', 'gaji');
    protected $column_search = array('idm_deliv', 'sj_kembali', 'tgl_gaji', 'tgl', 'nama', 'shipment', 'nopol', 'produk', 'dari', 'tujuan', 'gaji');
    protected $order = array('tgl' => 'asc');

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
            ->join('deliv_gaji', 'deliv_gaji.deliv_idm=deliv_order.idm_deliv', 'left')
            ->join('master_gaji', 'master_gaji.ketjuan=deliv_order.ketjuan', 'left')
            ->join('master_driver', 'master_driver.idm_driver = deliv_order.driver_idm', 'left')
            ->join('master_produk', 'master_produk.idm_produk = deliv_order.produk_idm', 'left')
            ->join('master_unit', 'master_unit.idm_nopol = deliv_order.nopol_idm', 'left')
            ->join('master_dari', 'master_dari.idm_dari = deliv_order.dari_idm', 'left')
            ->join('master_tujuan', 'master_tujuan.idm_tujuan = deliv_order.tujuan_idm', 'left')
            ->select('deliv_order.*, deliv_order.tgl as tgl_deliv, master_unit.nopol,master_dari.dari,deliv_gaji.tgl_gaji,deliv_gaji.nominal_gaji,master_driver.nama, master_produk.produk,master_tujuan.tujuan,master_gaji.gaji,deliv_gaji.idm_gaji');
        $this->dt->where('deliv_order.deleted_at', null);
        $request = \Config\Services::request();
        if ($request->getVar('bk') == 'BELUM KEMBALI') {
            $this->dt->where('sj_kembali', null);
        }
        if ($request->getVar('bk') == 'KEMBALI') {
            $this->dt->where('sj_kembali !=', null);
        }
        if ($request->getVar('bg') == 'belumterbayar') {
            $this->dt->where('tgl_gaji', null);
        }
        if ($request->getVar('bg') == 'terbayar') {
            $this->dt->where('tgl_gaji !=', null);
        }
        if ($request->getVar('tglgaji')) {
            $this->dt->like('tgl_gaji',  date('Y-m', strtotime($request->getPost('tglgaji'))));
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
    public function getgaji($id)
    {
        $this->dg = $this->db->table('deliv_order')
            ->join('deliv_gaji', 'deliv_gaji.deliv_idm = deliv_order.idm_deliv', 'left')
            ->join('master_unit', 'master_unit.idm_nopol = deliv_order.nopol_idm', 'left')
            ->join('master_dari', 'master_dari.idm_dari = deliv_order.dari_idm', 'left')
            ->join('master_tujuan', 'master_tujuan.idm_tujuan = deliv_order.tujuan_idm', 'left')
            ->join('master_produk', 'master_produk.idm_produk = deliv_order.produk_idm', 'left')
            ->join('master_driver', 'master_driver.idm_driver = deliv_order.driver_idm', 'left')
            ->join('master_gaji', 'master_gaji.ketjuan = deliv_order.ketjuan', 'left')
            ->select('deliv_order.*, deliv_order.tgl as tgl_deliv, master_unit.nopol,master_dari.dari, master_tujuan.tujuan,master_produk.produk,deliv_gaji.idm_gaji,deliv_gaji.tgl_gaji,master_driver.nama,master_gaji.gaji as nominal_gaji');
        $this->dg->where('deliv_order.deleted_at', null);
        return $this->dg->getWhere(['idm_deliv' => $id])->getRowArray();
    }
}
