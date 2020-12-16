<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class CreateController extends BaseCommand
{
    protected $group       = 'Controller';
    protected $name        = 'controller:create';
    protected $description = 'To Create Controller.';

    public function run(array $params)
    {
        if (empty($params)) {
            echo "Please Enter File Name.";
            exit;
        } else {
            $file_name = ucfirst($params[0]);
            $this->create($file_name);
            exit;
        }
    }
    private function create($file_name)
    {
        $newFileName = APPPATH . '\Controllers/' . $file_name . ".php";
        $newFileContent = $this->file_structure($file_name);

        if (file_exists($newFileName)) {
            echo "Controller Sudah Ada";
            exit;
        }

        helper('filesystem');

        if (!write_file($newFileName, $newFileContent)) {
            echo "Unable To Create Controller";
        } else {
            echo "Controller Berhasil Dibuat !";
        }
    }
    private function file_structure($controller_name)
    {
        $data = "<?php namespace App\Controllers;

class " . ucfirst($controller_name) . " extends BaseController
{
    public function index()
    {
        return view('data/vw_');
    }
}";
        return $data;
    }
}
