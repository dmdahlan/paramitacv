<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class CreateModel extends BaseCommand
{
    protected $group       = 'Model';
    protected $name        = 'model:create';
    protected $description = 'To Create Model.';

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
        $newFileName = APPPATH . '\Models/' . $file_name . ".php";
        $newFileContent = $this->file_structure($file_name);

        if (file_exists($newFileName)) {
            echo "Model Sudah Ada";
            exit;
        }

        helper('filesystem');

        if (!write_file($newFileName, $newFileContent)) {
            echo "Unable To Create Model";
        } else {
            echo "Model Berhasil Dibuat !";
        }
    }
    private function file_structure($model_name)
    {
        $data = "<?php namespace App\Models;
use CodeIgniter\Model;
class " . ucfirst($model_name) . " extends Model
{
    protected table = '';
    protected allowedFields = [''];
    protected id = '';
    protected primaryKey = '';
    protected useTimestamps = true;
    protected useSoftDeletes = true; 
}";
        return $data;
    }
}
