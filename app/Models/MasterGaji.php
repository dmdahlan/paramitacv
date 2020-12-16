<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterGaji extends Model
{
    protected $table = 'master_gaji';
    protected $allowedFields = ['dari_idm', 'tujuan_idm', 'tipe', 'gaji', 'uang_jalan', 'ketjuan'];
    protected $id = 'idm_gaji';
    protected $primaryKey = 'idm_gaji';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $column_order = array('idm_gaji', 'dari', 'tujuan', 'tipe', 'gaji', 'uang_jalan', 'ketjuan');
    protected $column_search = array('idm_gaji', 'dari', 'tujuan', 'tipe', 'gaji', 'uang_jalan', 'ketjuan');
    protected $order = array('dari' => 'asc');

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
        $this->dt = $this->db->table('master_gaji')
            ->join('master_dari', 'master_dari.idm_dari = master_gaji.dari_idm', 'left')
            ->join('master_tujuan', 'master_tujuan.idm_tujuan = master_gaji.tujuan_idm', 'left')
            ->select('master_gaji.*,  master_dari.dari as dari, master_tujuan.tujuan as tujuan');
        $this->dt->where('master_gaji.deleted_at', null);
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
