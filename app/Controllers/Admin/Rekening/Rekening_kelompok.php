<?php

namespace App\Controllers\Admin\Rekening;

use App\Controllers\BaseController;
use App\Models\Admin\Rekening\Model_rekening_kelompok;

class Rekening_kelompok extends BaseController
{
	protected $rekening_kelompok;

	public function __construct()
	{
		$this->rekening_kelompok = new Model_rekening_kelompok();
	}

	public function index()
	{
		if (has_permission('Admin')) :
			$rekening_kelompok = $this->rekening_kelompok->findAll();
			$data = [
				'gr' => 'rekening',
				'mn' => 'rekening_kelompok',
				'title' => 'Admin',
				'lok' => '<b>rekening kelompok</b>',
				'rekening_kelompok' => $rekening_kelompok,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Rekening/rekening_kelompok', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// ---------------------------------------------------------
}
