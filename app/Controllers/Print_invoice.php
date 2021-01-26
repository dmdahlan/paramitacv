<?php

namespace App\Controllers;

class Print_invoice extends BaseController
{
    public function index()
    {
        if (empty($this->request->getPost('keyword'))) {
            $keyword = $this->printinv->max();
        } else {
            $keyword = $this->request->getPost('keyword');
        }
        if (empty($this->request->getPost('keyword'))) {
            $cari = '';
        } else {
            $cari = $this->request->getPost('keyword');
        }
        $data = [
            'title'         => 'Print Invoice',
            'invoice'       => $this->printinv->inv($cari),
            'ket'           => $this->printinv->ket($keyword)
        ];
        return view('print/vw_printinv', $data);
    }
}
