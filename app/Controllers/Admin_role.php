<?php

namespace App\Controllers;

class Admin_role extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'Admin | Role',
            'role'          => $this->adminrole->findAll(),
            'validation'    => \Config\Services::validation()
        ];

        return view('admin/vw_adminrole', $data);
    }
    public function save()
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required|is_unique[auth_groups.name]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah Ada'
                ]
            ],
            'description' => [
                'rules' => 'required|is_unique[auth_groups.description]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah Ada'
                ]
            ]

        ])) {
            session()->setFlashdata('gagal', 'data');
            return redirect()->route('admin_role')->withInput();
        }
        $this->adminrole->save([
            'name'                  => $this->request->getPost('name'),
            'description'           => $this->request->getPost('description')

        ]);
        session()->setFlashdata('suksesinput', 'Data berhasil Ditambahkan !');
        return redirect()->route('admin_role');
    }
    public function edit($id = 0)
    {
        echo json_encode($this->adminrole->find($id));
    }
    public function update()
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required|is_unique[auth_groups.name,id,{id}]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah Ada'
                ]
            ],
            'description' => [
                'rules' => 'required|is_unique[auth_groups.description,id,{id}]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah Ada'
                ]
            ]

        ])) {
            session()->setFlashdata('gagal', 'data');
            return redirect()->route('admin_role')->withInput();
        }
        $this->adminrole->save([
            'id'                    => $this->request->getPost('id'),
            'name'                  => $this->request->getPost('name'),
            'description'           => $this->request->getPost('description')

        ]);
        session()->setFlashdata('ubahdata', 'Data');
        return redirect()->route('admin_role');
    }
    public function delete($id)
    {
        $this->adminrole->delete($id);
        return redirect()->route('admin_role');
    }
    public function roleAccess($role_id)
    {
        $data = [
            'title'         => 'Akses | Role',
            'role'          => $this->db->table('auth_groups')->getWhere(['id' => $role_id])->getRowArray(),
            'menu'          => $this->adminmenu->getViMenu()->getResultArray()
        ];
        return view('admin/vw-role-access', $data);
    }
    public function getRole()
    {
        $data = $this->adminrole->getRole();
        echo json_encode($data);
    }
    public function changeAccess()
    {

        $menu_id = $this->request->getPost('menuId');
        $role_id = $this->request->getPost('roleId');

        $data = [

            'group_id' => $role_id,
            'permission_id' => $menu_id
        ];

        $result = $this->db->table('auth_groups_permissions')->getWhere($data);
        if ($result->getRowArray() < 1) {
            $this->db->table('auth_groups_permissions')->insert($data);
        } else {
            $this->db->table('auth_groups_permissions')->delete($data);
        }
        // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Akses Berhasil dirubah</div>');
    }
}
