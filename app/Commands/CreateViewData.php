<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class CreateViewData extends BaseCommand
{
    protected $group       = 'ViewData';
    protected $name        = 'viewdata:create';
    protected $description = 'To Create View data';

    public function run(array $params)
    {
        if (empty($params)) {
            echo "Please Enter File Name.";
            exit;
        } else {
            $file_name = strtolower($params[0]);
            $this->create($file_name);
            exit;
        }
    }
    private function create($file_name)
    {
        $newFileName = APPPATH . '\Views/data/' . $file_name . ".php";
        $newFileContent = $this->file_structure($file_name);

        if (file_exists($newFileName)) {
            echo "Nama View Sudah Ada";
            exit;
        }

        helper('filesystem');

        if (!write_file($newFileName, $newFileContent)) {
            echo "Unable To Create View";
        } else {
            echo "View Data Berhasil Dibuat !";
        }
    }
    private function file_structure()
    {
        $data = "";
        return $data;
    }
}
