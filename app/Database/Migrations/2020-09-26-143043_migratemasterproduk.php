<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migratemasterproduk extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'idm_produk'	     => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'produk' => [
				'type'           => 'varchar',
				'constraint'     => '128',
			],
			'customer' => [
				'type'           => 'varchar',
				'constraint'     => '128',
				'null'			 => true,
			],
			'alamat' => [
				'type'           => 'varchar',
				'constraint'     => '128',
				'null'			 => true,
			],
			'ppn'          => [
				'type'           => 'INT',
				'constraint'     => 1,
				'default'		 => 0,
			],
			'pph'          => [
				'type'           => 'INT',
				'constraint'     => 1,
				'default'		 => 0,
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
		$this->forge->addKey('idm_produk', true);
		$this->forge->createTable('master_produk');
	}

	public function down()
	{
		$this->forge->dropTable('master_produk');
	}
}
