<?php

namespace App\Database\Seeds;


class Seederauthakses extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            ['group_id'     => 1, 'permission_id'  => 1],
            ['group_id'     => 2, 'permission_id'  => 1],
            ['group_id'     => 2, 'permission_id'  => 2],
            ['group_id'     => 2, 'permission_id'  => 3],
            ['group_id'     => 2, 'permission_id'  => 4],
            ['group_id'     => 2, 'permission_id'  => 5]

        ];
        $this->db->table('auth_groups_permissions')->insertBatch($data);
    }
}
