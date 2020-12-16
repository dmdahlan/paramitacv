<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class Seederadminmenu extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            [
                'parent_id'          => 0,
                'parent_menu'        => null,
                'sort_menu'          => 1,
                'description'        => 'home',
                'name'               => 'home',
                'is_active'          => 0
            ],
            [
                'parent_id'          => 0,
                'parent_menu'        => null,
                'sort_menu'          => 2,
                'description'        => 'Administrator',
                'name'               => 'admin',
                'is_active'          => 1
            ],
            [
                'parent_id'          => 2,
                'parent_menu'        => 'Administrator',
                'sort_menu'          => 1,
                'description'        => 'Manajemen Akses',
                'name'               => 'admin_role',
                'is_active'          => 1
            ],
            [
                'parent_id'          => 2,
                'parent_menu'        => 'Administrator',
                'sort_menu'          => 2,
                'description'        => 'Manajemen Menu',
                'name'               => 'admin_menu',
                'is_active'          => 1
            ],
            [
                'parent_id'          => 2,
                'parent_menu'        => 'Administrator',
                'sort_menu'          => 3,
                'description'        => 'Manajemen login',
                'name'               => 'admin_user',
                'is_active'          => 1
            ]
        ];
        $this->db->table('auth_permissions')->insertBatch($data);
    }
}
