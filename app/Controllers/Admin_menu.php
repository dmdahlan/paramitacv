<?php

namespace App\Controllers;


class Admin_menu extends BaseController
{
    public function index()
    {
        dd(user()->getRoles()[2]);
        $data = [
            'title'         => 'Admin | Menu'
        ];
        return view('admin/vw_adminmenu', $data);
    }
    public function ajax_list()
    {
        $list = $this->adminmenu->get_datatables();
        $data = array();
        $no = @$_POST['start'];

        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->description;
            $row[] = $r->name;
            $row[] = $r->parent_menu;
            $row[] = $r->sort_menu;
            if ($r->is_active == 1)
                $row[] = '<style="font-size: small">AKTIF';
            else
                $row[] = '<style="font-size: small">NON AKTIF';
            $row[] = '
                    <a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit_menu(' . "'" . $r->id . "'" . ')">Edit</a>
                    <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="hapus_menu(' . "'" . $r->id . "'" . ')">Hapus</a>
                    ';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->adminmenu->count_all(),
            "recordsFiltered" => $this->adminmenu->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function getParentMenu()
    {
        $data = $this->adminmenu->getParentMenu();
        echo json_encode($data);
    }
    public function simpan_menu()
    {
        $this->_validate('save');
        if (!empty($_POST['status_aktif']))
            $status_aktif = $this->request->getPost('status_aktif');
        else
            $status_aktif = 0;
        $data = [
            'parent_id'           => $this->request->getPost('parent_menu'),
            'description'         => $this->request->getPost('description'),
            'name'                => $this->request->getPost('name'),
            'sort_menu'           => $this->request->getPost('sort_menu'),
            'parent_menu'         => $this->request->getPost('parent'),
            'is_active'           => $status_aktif
        ];

        if ($this->adminmenu->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function edit_menu($id)
    {
        $data = $this->adminmenu->find($id);
        echo json_encode($data);
    }
    public function update_menu()
    {
        //Validasi
        $this->_validate('update');
        if (!empty($_POST['status_aktif']))
            $status_aktif = $this->request->getVar('status_aktif');
        else
            $status_aktif = 0;
        $data = [
            'id'                  => $this->request->getVar('id'),
            'parent_id'           => $this->request->getPost('parent_menu'),
            'description'         => $this->request->getPost('description'),
            'name'                => $this->request->getPost('name'),
            'sort_menu'           => $this->request->getPost('sort_menu'),
            'parent_menu'         => $this->request->getPost('parent'),
            'is_active'           => $status_aktif
        ];

        if ($this->adminmenu->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function delete_menu($id)
    {
        if ($this->adminmenu->delete($id)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
    public function ajax_list_menu()
    {
        $role = $this->db->table('auth_groups_users')->getWhere(['user_id' => user()->id])->getRowArray();
        $list = $this->adminmenu->get_datatables();
        $data = array();
        $no = @$_POST['start'];

        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->name;
            $row[] = $r->description;
            $row[] = $r->parent_menu;
            $row[] = '<div class="form-check">
            <input class="form-check-input" type="checkbox"' . check_access(1, $r->id) . ' data-role="" data-menu="">
        </div>';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->adminmenu->count_all(),
            "recordsFiltered" => $this->adminmenu->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function _validate($method)
    {
        if (!$this->validate($this->_getRulesValidation($method))) {
            $validation = \Config\Services::validation();

            $data = [];
            $data['error_string'] = [];
            $data['inputerror'] = [];
            $data['status'] = TRUE;

            if ($validation->hasError('description')) {
                $data['inputerror'][] = 'description';
                $data['error_string'][] = $validation->getError('description');
                $data['status'] = FALSE;
            }
            if ($validation->hasError('name')) {
                $data['inputerror'][] = 'name';
                $data['error_string'][] = $validation->getError('name');
                $data['status'] = FALSE;
            }
            if ($data['status'] === FALSE) {
                echo json_encode($data);
                exit();
            }
        }
    }
    public function _getRulesValidation($method = null)
    {
        if ($method == 'save') {
            $description         = 'required|is_unique[auth_permissions.description]';
            $name                = 'required|is_unique[auth_permissions.name]';
        } else {
            $description         = 'required|is_unique[auth_permissions.description,id,{id}]';
            $name                = 'required|is_unique[auth_permissions.name,id,{id}]';
        }
        $rulesValidation = [
            'description' => [
                'rules' => $description,
                'errors' => [
                    'required' => 'Title harus diisi.',
                    'is_unique' => 'Title sudah ada'
                ]
            ],
            'name' => [
                'rules' => $name,
                'errors' => [
                    'required' => 'url harus diisi.',
                    'is_unique' => 'url sudah ada'
                ]
            ]
        ];
        return $rulesValidation;
    }
}
