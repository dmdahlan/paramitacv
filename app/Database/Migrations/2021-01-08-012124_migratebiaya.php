<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migratebiaya extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_biaya' 			=> ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'deliv_idm' 	   	=> ['type' => 'INT', 'constraint' => 11],
			'tgl_1' 	   		=> ['type' => 'DATE', 'null' => true],
			'jml_1'   			=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'tgl_2' 	   		=> ['type' => 'DATE', 'null' => true],
			'jml_2'   			=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'tgl_buruhmuat' 	=> ['type' => 'DATE', 'null' => true],
			'jml_buruhmuat'   	=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'tgl_buruhbongkar' 	=> ['type' => 'DATE', 'null' => true],
			'jml_buruhbongkar'  => ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'tgl_inap' 			=> ['type' => 'DATE', 'null' => true],
			'nominal_inap'  	=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'tgl_portal' 		=> ['type' => 'DATE', 'null' => true],
			'nominal_portal'  	=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'tgl_lain2' 		=> ['type' => 'DATE', 'null' => true],
			'jml_lain2'  		=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'ket_biaya'  		=> ['type' => 'VARCHAR', 'constraint' => 225, 'null' => true],
			'total'  			=> ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'created_at' 	    => ['type' => 'DATETIME', 'null' => true],
			'updated_at' 	    => ['type' => 'DATETIME', 'null' => true],
		]);
		$this->forge->addKey('id_biaya', true);
		$this->forge->addUniqueKey('deliv_idm');
		$this->forge->createTable('deliv_biaya');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('deliv_biaya');
	}
}
