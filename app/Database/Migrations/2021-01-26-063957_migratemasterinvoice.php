<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migratemasterinvoice extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_tarif' 			=> ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'dari_idm'	     	=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'tujuan_idm'	    => ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'orderan'	    	=> ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
			'produk_idm'	    => ['type' => 'INT', 'constraint' => 11, 'null'	=> true,],
			'tarif'	    		=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'kode_inv'	    	=> ['type' => 'VARCHAR', 'constraint' => 200, 'null' => true],
			'created_at' 	    => ['type' => 'DATETIME', 'null' => true],
			'updated_at' 	    => ['type' => 'DATETIME', 'null' => true],
			'deleted_at' 	    => ['type' => 'DATETIME', 'null' => true],
		]);
		$this->forge->addKey('id_tarif', true);
		$this->forge->createTable('master_invoice');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('master_invoice');
	}
}
