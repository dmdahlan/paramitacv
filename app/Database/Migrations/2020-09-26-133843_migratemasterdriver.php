<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migratemasterdriver extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'idm_driver'         => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'nama'    		     => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'nohp' => [
				'type'           => 'varchar',
				'constraint'     => '50',
				'null'			 => true,
			],
			'alamat' => [
				'type'           => 'varchar',
				'constraint'     => '200',
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
		$this->forge->addKey('idm_driver', true);
		$this->forge->createTable('master_driver');
	}

	public function down()
	{
		$this->forge->dropTable('master_driver');
	}
}
