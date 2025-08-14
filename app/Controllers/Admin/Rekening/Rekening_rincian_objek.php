<?php

namespace App\Controllers\Admin\Rekening;

use App\Controllers\BaseController;
use App\Models\Admin\Rekening\Model_rekening_rincian_objek;

class Rekening_rincian_objek extends BaseController
{
	protected $rekening_rincian_objek;

	public function __construct()
	{
		$this->rekening_rincian_objek = new Model_rekening_rincian_objek();
	}

	public function index()
	{
		if (has_permission('Admin')) :
			$rekening_rincian_objek = $this->rekening_rincian_objek->findAll();
			$data = [
				'gr' => 'rekening',
				'mn' => 'rekening_rincian_objek',
				'title' => 'Admin',
				'lok' => '<b>rekening rincian_objek</b>',
				'rekening_rincian_objek' => $rekening_rincian_objek,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Rekening/rekening_rincian_objek', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// ---------------------------------------------------------
}
