<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migratemastergaji extends Migration
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
			'dari_idm'	     => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'			 => true,
			],
			'tujuan_idm'	     => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'			 => true,
			],
			'tipe'	     => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'			 => true,
			],
			'gaji'	     => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'			 => true,
			],
			'uang_jalan'	     => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'			 => true,
			],
			'ketjuan'	     => [
				'type'           => 'BIGINT',
				'constraint'     => 20,
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
		$this->forge->createTable('master_gaji');
	}

	public function down()
	{
		$this->forge->dropTable('master_gaji');
	}
}
