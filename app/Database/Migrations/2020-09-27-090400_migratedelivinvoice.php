<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migratedelivinvoice extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'idm_inv'	     => [
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
			'tgl_inv'	     => [
				'type'           => 'DATE',
				'null'			 => true,
			],
			'no_inv'	     => [
				'type'           => 'VARCHAR',
				'constraint'     => 100,
				'null'			 => true,
			],
			'billing'	     => [
				'type'           => 'VARCHAR',
				'constraint'     => 100,
				'null'			 => true,
			],
			'po'	     	 => [
				'type'           => 'VARCHAR',
				'constraint'     => 100,
				'null'			 => true,
			],
			'nominal'	     => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'			 => true,
			],
			'ppn'	     => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'			 => true,
			],
			'pph23'	     => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'			 => true,
			],
			'ttlinv'	     => [
				'type'           => 'INT',
				'constraint'     => 11,
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
		$this->forge->addKey('idm_inv', true);
		$this->forge->addUniqueKey('deliv_idm');
		$this->forge->createTable('deliv_invoice');
	}

	public function down()
	{
		$this->forge->dropTable('deliv_invoice');
	}
}
