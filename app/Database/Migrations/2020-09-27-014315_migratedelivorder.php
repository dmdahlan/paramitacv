<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migratedelivorder extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'idm_deliv'	     => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'tgl'	     => [
				'type'           => 'DATE',
				'null'			 => true,
			],
			'sj_kembali'	     => [
				'type'           => 'DATE',
				'null'			 => true,
			],
			'no_sj'	     => [
				'type'           => 'VARCHAR',
				'constraint'     => 100,
				'null'			 => true,
			],
			'nopol_idm'	     => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'			 => true,
			],
			'orderan'	     => [
				'type'           => 'VARCHAR',
				'constraint'     => 30,
				'null'			 => true,
			],
			'driver_idm'	     => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'			 => true,
			],
			'lokasi_awal'	     => [
				'type'           => 'VARCHAR',
				'constraint'     => 11,
				'null'			 => true,
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
			'outlet'	     => [
				'type'           => 'VARCHAR',
				'constraint'     => 128,
				'null'			 => true,
			],
			'produk_idm'	     => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'			 => true,
			],
			'shipment'	     => [
				'type'           => 'VARCHAR',
				'constraint'     => 128,
				'null'			 => true,
			],
			'qty'	     => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'			 => true,
			],
			'claim'	     => [
				'type'           => 'VARCHAR',
				'constraint'     => 128,
				'null'			 => true,
			],
			'ketjuan'          => [
				'type'           => 'BIGINT',
				'constraint'     => 20,
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
		$this->forge->addKey('idm_deliv', true);
		$this->forge->createTable('deliv_order');
	}

	public function down()
	{
		$this->forge->dropTable('deliv_order');
	}
}
