<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migraterekapinvoice extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_rekap'	     => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'tgl_rekap'	     => [
				'type'           => 'DATE',
				'null'			 => true,
			],
			'no_inv'	     => [
				'type'           => 'VARCHAR',
				'constraint'     => 20,
				'null'			 => true,
			],
			'no_faktur'	     => [
				'type'           => 'VARCHAR',
				'constraint'     => 100,
				'null'			 => true,
			],
			'produk_idm'	     => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'			 => true,
			],
			'nominal'	     => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'nominal_claim'	     => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'ket_rekap'	     => [
				'type'           => 'VARCHAR',
				'constraint'     => 30,
				'null'			 => true,
			],
			'bank1'	     => [
				'type'           => 'VARCHAR',
				'constraint'     => 100,
				'null'			 => true,
			],
			'tgl_bayar1'	     => [
				'type'           => 'DATE',
				'null'			 => true,
			],
			'nominal1'	     => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'bank2'	     => [
				'type'           => 'VARCHAR',
				'constraint'     => 100,
				'null'			 => true,
			],
			'tgl_bayar2'	     => [
				'type'           => 'DATE',
				'null'			 => true,
			],
			'nominal2'	     => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'coun'          => [
				'type'           => 'INT',
				'constraint'     => 1,
				'default'		 => 1,
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
		$this->forge->addKey('id_rekap', true);
		$this->forge->createTable('rekap_invoice');
	}

	public function down()
	{
		$this->forge->dropTable('rekap_invoice');
	}
}
