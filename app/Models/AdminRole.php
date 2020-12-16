<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminRole extends Model
{
    protected $allowedFields = ['name', 'description'];
    protected $table = 'auth_groups';


    function __construct()
    {
        parent::__construct();
        $this->dt = $this->db->table($this->table);
    }
    public function getRole()
    {
        $builder = $this->db->table('auth_groups');
        $query   = $builder->get();

        if ($query->getFieldCount() > 0) {
            return $query->getResult();
        }
    }
}
