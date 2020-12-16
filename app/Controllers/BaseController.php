<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['auth', 'md_helper', 'file', 'number'];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
		$this->validation 					= \Config\Services::validation();
		$this->db 							= \Config\Database::connect();

		$this->adminmenu 			= new \App\Models\AdminMenu;
		$this->adminrole 			= new \App\Models\AdminRole;
		$this->adminuser 			= new \App\Models\AdminUser;
		$this->adminlog 			= new \App\Models\AdminLog;

		$this->masterdari 			= new \App\Models\MasterDari;
		$this->mastertujuan 		= new \App\Models\MasterTujuan;
		$this->masterunit 			= new \App\Models\MasterUnit;
		$this->masterdriver 		= new \App\Models\MasterDriver;
		$this->masterproduk 		= new \App\Models\MasterProduk;
		$this->mastergaji 			= new \App\Models\MasterGaji;
		$this->masteroutlet 		= new \App\Models\MasterOutlet;

		$this->delivery 			= new \App\Models\DelivOrder;
		$this->deliveryinvoice 		= new \App\Models\DelivInvoice;
		$this->deliverygaji 		= new \App\Models\DelivGaji;

		$this->reportmuatan 	    = new \App\Models\ReportMuatan;
		$this->reportunitbulan 	    = new \App\Models\ReportUnit;
		$this->reportproduk 	    = new \App\Models\ReportProduk;
		$this->reportgajidriver 	= new \App\Models\ReportGajidriver;
		$this->reportnopol 			= new \App\Models\ReportNopol;

		$this->saporder				= new \App\Models\SapOrder;

		$this->drivergaji 	    	= new \App\Models\DriverGaji;

		$this->printinv 	    	= new \App\Models\PrintInvoice;

		$this->rekapinvoice 	   	= new \App\Models\RekapInvoice;
		$this->rekappiutang 	   	= new \App\Models\RekapPiutang;
	}
	function rupiah($angka)
	{
		$hasil_rupiah = number_format($angka, 0, ',', '.');
		return $hasil_rupiah;
	}
}
