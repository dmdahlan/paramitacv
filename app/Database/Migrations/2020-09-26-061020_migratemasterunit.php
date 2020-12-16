<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migratemasterunit extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'idm_nopol'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'kode_nopol'         => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
				'null'			 => true,
			],
			'nopol' => [
				'type'           => 'varchar',
				'constraint'     => '50',
				'null'			 => true,
			],
			'jenis' => [
				'type'           => 'varchar',
				'constraint'     => '50',
				'null'			 => true,
			],
			'kapasitas' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'			 => true,
			],
			'no_keur' => [
				'type'           => 'varchar',
				'constraint'     => '50',
				'null'			 => true,
			],
			'kerb_weight' => [
				'type'           => 'varchar',
				'constraint'     => '50',
				'null'			 => true,
			],
			'jbb' => [
				'type'           => 'varchar',
				'constraint'     => '50',
				'null'			 => true,
			],
			'jbi' => [
				'type'           => 'varchar',
				'constraint'     => '50',
				'null'			 => true,
			],
			'created_at' 	   => [
				'type'			 => 'DATETIME',
				'null'			 => true,
			],
			'updated_at' 	   => [
				'type'			 => 'DATETIME',
				'null'			 => true,
			],
			'deleted_at' 	   => [
				'type'			 => 'DATETIME',
				'null'			 => true,
			]
		]);
		$this->forge->addKey('idm_nopol', true);
		$this->forge->createTable('master_unit');
	}
	public function down()
	{
		$this->forge->dropTable('master_unit');
	}
}
