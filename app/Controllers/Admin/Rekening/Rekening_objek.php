<?php

namespace App\Controllers\Admin\Rekening;

use App\Controllers\BaseController;
use App\Models\Admin\Rekening\Model_rekening_objek;

class Rekening_objek extends BaseController
{
	protected $rekening_objek;

	public function __construct()
	{
		$this->rekening_objek = new Model_rekening_objek();
	}

	public function index()
	{
		if (has_permission('Admin')) :
			$rekening_objek = $this->rekening_objek->findAll();
			$data = [
				'gr' => 'rekening',
				'mn' => 'rekening_objek',
				'title' => 'Admin',
				'lok' => '<b>rekening objek</b>',
				'rekening_objek' => $rekening_objek,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Rekening/rekening_objek', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// ---------------------------------------------------------
}
