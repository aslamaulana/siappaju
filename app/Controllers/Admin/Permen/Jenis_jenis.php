<?php

namespace App\Controllers\Admin\Permen;

use App\Controllers\BaseController;
use App\Models\Admin\Permen\Model_jenis_jenis;

class Jenis_jenis extends BaseController
{
	protected $jenis_jenis;

	public function __construct()
	{
		$this->jenis_jenis = new Model_jenis_jenis();
	}

	public function index()
	{
		if (has_permission('Admin')) :
			$jenis_jenis = $this->jenis_jenis->findAll();
			$data = [
				'gr' => 'jenis',
				'mn' => 'jenis_jenis',
				'title' => 'Admin',
				'lok' => '<b>Jenis jenis</b>',
				'jenis_jenis' => $jenis_jenis,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Permen/jenis_jenis', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// ---------------------------------------------------------
}
