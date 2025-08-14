<?php

namespace App\Controllers\Admin\Rekening;

use App\Controllers\BaseController;
use App\Models\Admin\Rekening\Model_rekening_jenis;

class Rekening_jenis extends BaseController
{
	protected $rekening_jenis;

	public function __construct()
	{
		$this->rekening_jenis = new Model_rekening_jenis();
	}

	public function index()
	{
		if (has_permission('Admin')) :
			$rekening_jenis = $this->rekening_jenis->findAll();
			$data = [
				'gr' => 'rekening',
				'mn' => 'rekening_jenis',
				'title' => 'Admin',
				'lok' => '<b>Jenis jenis</b>',
				'rekening_jenis' => $rekening_jenis,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Rekening/rekening_jenis', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// ---------------------------------------------------------
}
