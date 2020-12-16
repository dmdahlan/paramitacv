<?php

namespace App\Controllers;

class Admin_user extends BaseController
{
    public function index()
    {
        $data = [
            'title'     => 'Admin | User'
        ];
        return view('admin/vw_adminuser', $data);
    }
    public function ajax_list()
    {
        $list = $this->adminuser->get_datatables();
        $data = array();
        $no = @$_POST['start'];

        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->username;
            $row[] = $r->email;
            $row[] = $r->name;
            $row[] = '
                    <a class="btn btn-warning btn-xs" href="javascript:void(0)" title="Edit" onclick="edit(' . "'" . $r->id . "'" . ')">Edit</a>
                    ';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->adminuser->count_all(),
            "recordsFiltered" => $this->adminuser->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function edit($id)
    {
        $data = $this->adminuser->getid($id);
        echo json_encode($data);
    }
    public function update()
    {
        $data = [
            'id'                 => $this->request->getPost('id'),
            'group_id'           => $this->request->getPost('role_id')
        ];

        if ($this->adminuser->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }
}
