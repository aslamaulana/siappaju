<?php

namespace App\Controllers\Admin\Rekening;

use App\Controllers\BaseController;
use App\Models\Admin\Rekening\Model_rekening_akun;

class Rekening_akun extends BaseController
{
	protected $rekening_akun;

	public function __construct()
	{
		$this->rekening_akun = new Model_rekening_akun();
	}

	public function index()
	{
		if (has_permission('Admin')) :
			$rekening_akun = $this->rekening_akun->findAll();
			$data = [
				'gr' => 'rekening',
				'mn' => 'rekening_akun',
				'title' => 'Admin',
				'lok' => '<b>rekening Akun</b>',
				'rekening_akun' => $rekening_akun,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Rekening/rekening_akun', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// ---------------------------------------------------------
}
