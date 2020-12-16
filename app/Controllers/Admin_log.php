<?php

namespace App\Controllers;

class Admin_log extends BaseController
{
    public function index()
    {
        $data = [
            'title'         => 'History | Login'
        ];
        return view('admin/vw_adminlog', $data);
    }
    public function ajax_list()
    {
        $list = $this->adminlog->get_datatables();
        $data = array();
        $no = @$_POST['start'];

        foreach ($list as $r) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $r->date;
            $row[] = $r->ip_address;
            $row[] = $r->email;
            $row[] = $r->user_id;
            if ($r->success == 1) {
                $row[] = '<a class="btn btn-success btn-xs" href="javascript:void(0)">Sukses</a>';
            } else {
                $row[] = '<a class="btn btn-danger btn-xs" href="javascript:void(0)">Gagal</a>';
            }
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->adminlog->count_all(),
            "recordsFiltered" => $this->adminlog->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}
