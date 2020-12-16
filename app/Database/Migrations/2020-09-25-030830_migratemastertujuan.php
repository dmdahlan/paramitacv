<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MigrateMastertujuan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'idm_tujuan'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'tujuan'       => [
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
		$this->forge->addKey('idm_tujuan', true);
		$this->forge->createTable('master_tujuan');
	}

	public function down()
	{
		$this->forge->dropTable('master_tujuan');
	}
}
