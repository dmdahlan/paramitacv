<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title'            => 'Home'
        ];
        return view('vw_home', $data);
    }
}
