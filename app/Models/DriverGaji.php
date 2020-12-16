<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class DriverGaji extends Model
{

    protected $column_order = array('');
    protected $column_search = array('');
    protected $order = array('' => 'asc');

    function get_datatables($nama)
    {
        $this->_get_datatables_query($nama);
        if (@$_POST['length'] != -1)
            $this->dt->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->dt->get();
        return $query->getResult();
    }
    private function _get_datatables_query($nama)
    {
        $this->dt = $this->db->table('deliv_order')
            ->join('deliv_gaji', 'deliv_gaji.deliv_idm=deliv_order.idm_deliv', 'left')
            ->join('master_gaji', 'master_gaji.ketjuan=deliv_order.ketjuan', 'left')
            ->join('master_driver', 'master_driver.idm_driver=deliv_order.driver_idm', 'left')
            ->join('master_produk', 'master_produk.idm_produk=deliv_order.produk_idm', 'left')
            ->join('master_unit', 'master_unit.idm_nopol = deliv_order.nopol_idm', 'left')
            ->join('master_dari', 'master_dari.idm_dari = deliv_order.dari_idm', 'left')
            ->select('deliv_order.*, deliv_order.tgl as tgl_deliv, master_unit.nopol,master_dari.dari,master_driver.nama,deliv_gaji.tgl_gaji,master_produk.produk,master_gaji.gaji');
        $this->dt->where('deliv_order.deleted_at', null);

        $request = \Config\Services::request();
        if ($request->getPost('tgl_gaji')) {
            $this->dt->like('tgl_gaji', $request->getPost('tgl_gaji'));
        }
        $this->dt->where('nama', $nama);
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
    function count_filtered($nama)
    {
        $this->_get_datatables_query($nama);
        return $this->dt->countAllResults();
    }
    public function count_all($nama)
    {
        $this->dr = $this->db->table('deliv_order')
            ->join('deliv_gaji', 'deliv_gaji.deliv_idm=deliv_order.idm_deliv', 'left')
            ->join('master_gaji', 'master_gaji.ketjuan=deliv_order.ketjuan', 'left')
            ->join('master_driver', 'master_driver.idm_driver=deliv_order.driver_idm', 'left')
            ->join('master_produk', 'master_produk.idm_produk=deliv_order.produk_idm', 'left')
            ->join('master_unit', 'master_unit.idm_nopol = deliv_order.nopol_idm', 'left')
            ->join('master_dari', 'master_dari.idm_dari = deliv_order.dari_idm', 'left')
            ->select('deliv_order.*, deliv_order.tgl as tgl_deliv, master_unit.nopol,master_dari.dari,master_driver.nama,deliv_gaji.tgl_gaji,master_produk.produk,master_gaji.gaji');
        $query = $this->dr->where('nama', $nama)
            ->where('deliv_order.deleted_at', null);
        return $query->countAllResults();
    }
}
