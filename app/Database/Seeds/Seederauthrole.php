<?php

namespace App\Database\Seeds;


class Seederauthrole extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            [
                'name'               => 'Guest',
                'description'        => 'Guest'
            ],
            [
                'name'               => 'Administrator',
                'description'        => 'Administrator'

            ]

        ];
        $this->db->table('auth_groups')->insertBatch($data);
    }
}
