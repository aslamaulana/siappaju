<?php

namespace App\Controllers\Admin\Permen;

use App\Controllers\BaseController;
use App\Models\Admin\Permen\Model_jenis_akun;

class Jenis_akun extends BaseController
{
	protected $jenis_akun;

	public function __construct()
	{
		$this->jenis_akun = new Model_jenis_akun();
	}

	public function index()
	{
		if (has_permission('Admin')) :
			$jenis_akun = $this->jenis_akun->findAll();
			$data = [
				'gr' => 'jenis',
				'mn' => 'jenis_akun',
				'title' => 'Admin',
				'lok' => '<b>Jenis Akun</b>',
				'jenis_akun' => $jenis_akun,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Permen/jenis_akun', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// ---------------------------------------------------------
}
