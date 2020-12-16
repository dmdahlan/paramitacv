<?php

namespace App\Controllers;

class Print_invoice extends BaseController
{
    public function index()
    {

        $keyword = ($this->request->getVar('keyword'));
        $data = [
            'title'         => 'Print Invoice',
            'invoice'       => $this->printinv->inv($keyword)
        ];
        return view('print/vw_printinv', $data);
    }
}
