<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterUnit extends Model
{
    protected $table = 'master_unit';
    protected $allowedFields = ['kode_nopol', 'nopol', 'jenis', 'kapasitas', 'no_keur', 'kerb_weight', 'jbb', 'jbi'];
    protected $id = 'idm_nopol';
    protected $primaryKey = 'idm_nopol';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $column_order = array('kode_nopol', 'nopol', 'jenis', 'kapasitas', 'no_keur', 'kerb_weight', 'jbb', 'jbi');
    protected $column_search = array('kode_nopol', 'nopol', 'jenis', 'kapasitas', 'no_keur', 'kerb_weight', 'jbb', 'jbi');
    protected $order = array('nopol' => 'asc');

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
        $this->dt = $this->db->table('master_unit');
        $this->dt->where('deleted_at', null);
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
