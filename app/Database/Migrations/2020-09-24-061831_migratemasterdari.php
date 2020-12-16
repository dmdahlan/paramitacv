<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MigrateMasterdari extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'idm_dari'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'dari'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '200',
			],
			'keterangan' => [
				'type'           => 'varchar',
				'constraint'     => '255',
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
		$this->forge->addKey('idm_dari', true);
		$this->forge->createTable('master_dari');
	}

	public function down()
	{
		$this->forge->dropTable('master_dari');
	}
}
