<?php

namespace App\Controllers\Admin\Permen;

use App\Controllers\BaseController;
use App\Models\Admin\Permen\Model_jenis_kelompok;

class Jenis_kelompok extends BaseController
{
	protected $jenis_kelompok;

	public function __construct()
	{
		$this->jenis_kelompok = new Model_jenis_kelompok();
	}

	public function index()
	{
		if (has_permission('Admin')) :
			$jenis_kelompok = $this->jenis_kelompok->findAll();
			$data = [
				'gr' => 'jenis',
				'mn' => 'jenis_kelompok',
				'title' => 'Admin',
				'lok' => '<b>Jenis kelompok</b>',
				'jenis_kelompok' => $jenis_kelompok,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Permen/jenis_kelompok', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// ---------------------------------------------------------
}
