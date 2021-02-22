<?php

namespace App\Models;

use CodeIgniter\Model;

class DelivBiaya extends Model
{
    protected $table = 'deliv_biaya';
    protected $allowedFields = ['deliv_idm', 'tgl_1', 'jml_1', 'tgl_2', 'jml_2', 'tgl_buruhmuat', 'jml_buruhmuat', 'tgl_buruhbongkar', 'jml_buruhbongkar', 'tgl_inap', 'nominal_inap', 'tgl_portal', 'nominal_portal', 'tgl_lain2', 'jml_lain2', 'ket_biaya', 'total'];
    protected $id = 'id_biaya';
    protected $primaryKey = 'id_biaya';
    protected $useTimestamps = true;

    protected $column_order = array('idm_deliv', 'tgl_deliv', 'sj_kembali', 'nopol', 'orderan', 'nama', 'lokasi_awal', 'dari', 'produk', 'shipment', 'tgl_1', 'jml_1', 'tgl_2', 'jml_2', 'tgl_buruhmuat', 'jml_buruhmuat', 'tgl_buruhbongkar', 'jml_buruhbongkar', 'tgl_inap', 'nominal_inap', 'tgl_portal', 'nominal_portal', 'tgl_lain2', 'jml_lain2', 'ket_biaya', 'total');
    protected $column_search = array('idm_deliv', 'tgl', 'sj_kembali', 'nopol', 'orderan', 'nama', 'lokasi_awal', 'dari', 'produk', 'shipment', 'tgl_1', 'jml_1', 'tgl_2', 'jml_2', 'tgl_buruhmuat', 'jml_buruhmuat', 'tgl_buruhbongkar', 'jml_buruhbongkar', 'tgl_inap', 'nominal_inap', 'tgl_portal', 'nominal_portal', 'tgl_lain2', 'jml_lain2', 'ket_biaya', 'total', 'tujuan');
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
            ->join('deliv_biaya', 'deliv_biaya.deliv_idm = deliv_order.idm_deliv', 'left')
            ->join('master_unit', 'master_unit.idm_nopol = deliv_order.nopol_idm', 'left')
            ->join('master_dari', 'master_dari.idm_dari = deliv_order.dari_idm', 'left')
            ->join('master_tujuan', 'master_tujuan.idm_tujuan = deliv_order.tujuan_idm', 'left')
            ->join('master_produk', 'master_produk.idm_produk = deliv_order.produk_idm', 'left')
            ->join('master_driver', 'master_driver.idm_driver = deliv_order.driver_idm', 'left')
            ->select('deliv_order.*, deliv_order.tgl as tgl_deliv, master_unit.nopol,master_dari.dari, master_tujuan.tujuan,master_produk.produk,master_driver.nama,deliv_biaya.tgl_1,deliv_biaya.jml_1,deliv_biaya.tgl_2,deliv_biaya.jml_2,deliv_biaya.tgl_buruhmuat,deliv_biaya.jml_buruhmuat,deliv_biaya.tgl_buruhbongkar,deliv_biaya.jml_buruhbongkar,deliv_biaya.tgl_inap,deliv_biaya.nominal_inap,deliv_biaya.tgl_portal,deliv_biaya.nominal_portal,deliv_biaya.tgl_lain2,deliv_biaya.jml_lain2,deliv_biaya.ket_biaya,deliv_biaya.total,deliv_biaya.id_biaya');
        $this->dt->where('deliv_order.deleted_at', null);

        $request = \Config\Services::request();
        if ($request->getVar('nopol')) {
            $this->dt->like('nopol', $request->getVar('nopol'));
        }
        if ($request->getPost('tgl_deliv')) {
            $this->dt->like('tgl',  date('Y-m', strtotime($request->getPost('tgl_deliv'))));
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
    public function getdata($id)
    {
        $this->di = $this->db->table('deliv_order')
            ->join('deliv_biaya', 'deliv_biaya.deliv_idm = deliv_order.idm_deliv', 'left')
            ->join('master_unit', 'master_unit.idm_nopol = deliv_order.nopol_idm', 'left')
            ->join('master_dari', 'master_dari.idm_dari = deliv_order.dari_idm', 'left')
            ->join('master_tujuan', 'master_tujuan.idm_tujuan = deliv_order.tujuan_idm', 'left')
            ->join('master_produk', 'master_produk.idm_produk = deliv_order.produk_idm', 'left')
            ->join('master_driver', 'master_driver.idm_driver = deliv_order.driver_idm', 'left')
            ->select('deliv_order.*, deliv_order.tgl as tgl_deliv, master_unit.nopol,master_dari.dari, master_tujuan.tujuan,master_produk.produk,master_driver.nama,deliv_biaya.tgl_1,deliv_biaya.jml_1,deliv_biaya.tgl_2,deliv_biaya.jml_2,deliv_biaya.tgl_buruhmuat,deliv_biaya.jml_buruhmuat,deliv_biaya.tgl_buruhbongkar,deliv_biaya.jml_buruhbongkar,deliv_biaya.tgl_inap,deliv_biaya.nominal_inap,deliv_biaya.tgl_portal,deliv_biaya.nominal_portal,deliv_biaya.tgl_lain2,deliv_biaya.jml_lain2,deliv_biaya.ket_biaya,deliv_biaya.total,deliv_biaya.id_biaya');
        $this->di->where('deliv_order.deleted_at', null);
        return $this->di->getWhere(['idm_deliv' => $id])->getRowArray();
    }
}
