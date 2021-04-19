<?php

namespace App\Models;

use CodeIgniter\Model;

class DelivOrder extends Model
{
    protected $table = 'deliv_order';
    protected $allowedFields = ['tgl', 'sj_kembali', 'no_sj', 'nopol_idm', 'orderan', 'driver_idm', 'lokasi_awal', 'dari_idm', 'tujuan_idm', 'tujuaninv_idm', 'outlet', 'produk_idm', 'shipment', 'qty', 'claim', 'ketjuan'];
    protected $id = 'idm_deliv';
    protected $primaryKey = 'idm_deliv';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $column_order = array('idm_deliv', 'sj_kembali', 'no_sj', 'nopol', 'orderan', 'nama', 'lokasi_awal', 'dari', 'tujuan', 'tujuaninv', 'keterangan_tujuan', 'outlet', 'produk', 'customer', 'shipment', 'qty', 'claim');
    protected $column_search = array('idm_deliv', 'sj_kembali', 'no_sj', 'nopol', 'orderan', 'nama', 'lokasi_awal', 'dari', 'master_tujuan.tujuan', 'master_tujuan.keterangan', 'tujuan_inv.tujuan', 'outlet', 'produk', 'customer', 'shipment', 'qty', 'claim');
    protected $order = array('tgl,created_at' => 'desc');

    function __construct()
    {
        parent::__construct();
        $this->dt = $this->db->table('deliv_order');
    }
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
            ->join('master_unit', 'master_unit.idm_nopol = deliv_order.nopol_idm', 'left')
            ->join('master_driver', 'master_driver.idm_driver = deliv_order.driver_idm', 'left')
            ->join('master_dari', 'master_dari.idm_dari = deliv_order.dari_idm', 'left')
            ->join('master_tujuan', 'master_tujuan.idm_tujuan = deliv_order.tujuan_idm', 'left')
            ->join('master_tujuan as tujuan_inv', 'tujuan_inv.idm_tujuan = deliv_order.tujuaninv_idm', 'left')
            ->join('master_produk', 'master_produk.idm_produk = deliv_order.produk_idm', 'left')
            ->join('deliv_biaya', 'deliv_biaya.deliv_idm=deliv_order.idm_deliv', 'left')
            ->select('deliv_order.*, deliv_order.tgl as tgl_deliv, master_unit.nopol,master_driver.nama,master_dari.dari as dari, master_tujuan.tujuan as tujuan,tujuan_inv.tujuan as tujuaninv,tujuan_inv.keterangan as keterangan_tujuan,master_produk.produk as produk,master_produk.customer,deliv_biaya.deliv_idm');
        $this->dt->where('deliv_order.deleted_at', null);

        $request = \Config\Services::request();
        if ($request->getVar('nopol')) {
            $this->dt->like('nopol', $request->getVar('nopol'));
        }
        if ($request->getPost('sj_kembali')) {
            $this->dt->where('sj_kembali', $request->getPost('sj_kembali'));
        }
        if ($request->getVar('bk') == 'BELUM KEMBALI') {
            $this->dt->where('sj_kembali', null);
        }
        if ($request->getVar('bk') == 'KEMBALI') {
            $this->dt->where('sj_kembali !=', null);
        }
        if ($request->getVar('tgl_awal') && $request->getVar('tgl_akhir')) {
            $this->dt->where('tgl BETWEEN "' . date('Y-m-d', strtotime($request->getVar('tgl_awal'))) . '" AND "' . date('Y-m-d', strtotime($request->getVar('tgl_akhir'))) . '"');
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
    function get_datatablesharian($tgl_awal, $tgl_akhir)
    {
        $this->_get_datatables_harian($tgl_awal, $tgl_akhir);
        if (@$_POST['length'] != -1)
            $this->dh->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->dh->get();
        return $query->getResult();
    }
    private function _get_datatables_harian($tgl_awal, $tgl_akhir)
    {
        $this->dh = $this->db->table('deliv_order')
            ->join('master_unit', 'master_unit.idm_nopol = deliv_order.nopol_idm', 'left')
            ->join('master_driver', 'master_driver.idm_driver = deliv_order.driver_idm', 'left')
            ->join('master_dari', 'master_dari.idm_dari = deliv_order.dari_idm', 'left')
            ->join('master_tujuan', 'master_tujuan.idm_tujuan = deliv_order.tujuan_idm', 'left')
            ->join('master_produk', 'master_produk.idm_produk = deliv_order.produk_idm', 'left')
            ->select('deliv_order.*,  master_unit.nopol as nopol,master_driver.nama as nama,master_dari.dari as dari, master_tujuan.tujuan as tujuan,master_produk.produk as produk');
        $this->dh->where('deliv_order.deleted_at', null);

        $request = \Config\Services::request();
        if ($request->getVar('tgl_awal') && $request->getVar('tgl_akhir')) {
            $this->dh->where('tgl BETWEEN "' . date('Y-m-d', strtotime($request->getVar('tgl_awal'))) . '" AND "' . date('Y-m-d', strtotime($request->getVar('tgl_akhir'))) . '"');
        }
        $this->dh->where('tgl BETWEEN "' . $tgl_awal . '" and "' . $tgl_akhir . '"');
        // $this->dh->where('tgl BETWEEN "' . $tgl_awal . '" and "' . $tgl_akhir . '"');
        $i = 0;
        foreach ($this->column_search as $item) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->dh->groupStart();
                    $this->dh->like($item, $_POST['search']['value']);
                } else {
                    $this->dh->orLike($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dh->groupEnd();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->dh->orderBy($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dh->orderBy(key($order), $order[key($order)]);
        }
    }
    function count_filteredharian($tgl_awal, $tgl_akhir)
    {
        // $this->dh->where('tgl BETWEEN "' . $tgl_awal . '" and "' . $tgl_akhir . '"');
        $this->_get_datatables_harian($tgl_awal, $tgl_akhir);
        return $this->dh->countAllResults();
    }
    public function count_allharian($tgl_awal, $tgl_akhir)
    {
        $query = $this->dh->where('deleted_at', null);
        $query->where('tgl BETWEEN "' . $tgl_awal . '" and "' . $tgl_akhir . '"');
        return $query->countAllResults();
    }
}
