<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migratesaporder extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_sap'	     => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'tgl_sap'	     => [
				'type'           => 'DATE',
				'null'			 => true,
			],
			'fo'	     => [
				'type'           => 'VARCHAR',
				'constraint'     => 20,
				'null'			 => true,
			],
			'fr'	     => [
				'type'           => 'VARCHAR',
				'constraint'     => 20,
				'null'			 => true,
			],
			'driver_idm'	     => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'			 => true,
			],
			'nopol_idm'	     => [
				'type'           => 'INT',
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
			'produk_idm'	     => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'			 => true,
			],
			'orderan'	     => [
				'type'           => 'VARCHAR',
				'constraint'     => 30,
				'null'			 => true,
			],
			'outlet'	     => [
				'type'           => 'VARCHAR',
				'constraint'     => 400,
				'null'			 => true,
			],
			'keterangan'	     => [
				'type'           => 'VARCHAR',
				'constraint'     => 30,
				'null'			 => true,
			],
			'ket_sap'	     => [
				'type'           => 'VARCHAR',
				'constraint'     => 30,
				'null'			 => true,
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
		$this->forge->addKey('id_sap', true);
		$this->forge->createTable('sap_order');
	}

	public function down()
	{
		$this->forge->dropTable('sap_order');
	}
}
