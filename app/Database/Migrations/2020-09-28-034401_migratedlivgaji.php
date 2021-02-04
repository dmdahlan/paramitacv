<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migratedlivgaji extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'idm_gaji'	     => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'deliv_idm'	     => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'			 => true,
			],
			'tgl_gaji'	     => [
				'type'           => 'DATE',
				'null'			 => true,
			],
			'created_at' 	   => [
				'type'			 => 'DATETIME',
				'null'			 => true
			],
			'updated_at' 	   => [
				'type'			 => 'DATETIME',
				'null'			 => true
			],
			'deleted_at' 	   => [
				'type'			 => 'DATETIME',
				'null'			 => true
			]
		]);
		$this->forge->addKey('idm_gaji', true);
		$this->forge->addUniqueKey('deliv_idm');
		$this->forge->createTable('deliv_gaji');
	}

	public function down()
	{
		$this->forge->dropTable('deliv_gaji');
	}
}
