<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MigrateMasterOutlet extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_outlet'	     => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'outlet' => [
				'type'           => 'varchar',
				'constraint'     => '128',
			],
			'ket_outlet' => [
				'type'           => 'varchar',
				'constraint'     => '50',
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
		$this->forge->addKey('id_outlet', true);
		$this->forge->createTable('master_outlet');
	}

	public function down()
	{
		$this->forge->dropTable('master_outlet');
	}
}
