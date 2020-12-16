<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminUser extends Model
{
    protected $table = 'auth_groups_users';
    protected $allowedFields = ['group_id'];
    protected $id = 'id';
    protected $primaryKey = 'id';

    protected $column_order = array('users.username', 'users.email', 'auth_groups.name');
    protected $column_search = array('users.username', 'users.email', 'auth_groups.name');
    protected $order = array('users.username' => 'asc');

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
        $this->dt = $this->db->table('auth_groups_users')
            ->join('users', 'users.id=auth_groups_users.user_id', 'left')
            ->join('auth_groups', 'auth_groups.id=auth_groups_users.group_id', 'left')
            ->select('auth_groups_users.*, auth_groups_users.id, users.username, users.email, auth_groups.name');
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
    public function getid($id)
    {
        $this->dg = $this->db->table('auth_groups_users')
            ->join('users', 'users.id=auth_groups_users.user_id', 'left')
            ->join('auth_groups', 'auth_groups.id=auth_groups_users.group_id', 'left')
            ->select('auth_groups_users.*, auth_groups_users.id, users.username, users.email, auth_groups.name');

        return $this->dg->getWhere(['auth_groups_users.id' => $id])->getRowArray();
    }
}
