<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminMenu extends Model
{
    protected $allowedFields = ['name', 'description', 'parent_id', 'parent_menu', 'sort_menu', 'is_active'];
    protected $table = 'auth_permissions';
    protected $primaryKey = 'id';
    protected $id = 'id';

    protected $column_order = array('id', 'description', 'name', 'parent_menu', 'sort_menu', 'is_active');
    protected $column_search = array('id', 'description', 'name', 'parent_menu', 'sort_menu', 'is_active');
    protected $order = array('description' => 'asc');

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
        $this->dt = $this->db->table('auth_permissions');
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
        return $this->dt->countAllResults();
    }
    public function getParentMenu()
    {
        $builder = $this->db->table('auth_permissions');
        $builder->where('parent_id', '0');
        $builder->where('is_active', 1);
        $query   = $builder->get();

        if ($query->getFieldCount() > 0) {
            return $query->getResult();
        }
    }
    public function getViMenu()
    {
        $builder = $this->db->table('auth_permissions');
        $builder->orderBy('description', 'ASC');
        return $builder->get();
    }
}
