<?php

namespace App\Controllers\Admin\Rekening;

use App\Controllers\BaseController;
use App\Models\Admin\Rekening\Model_rekening_rincian_objek_sub;

class rekening_rincian_objek_sub extends BaseController
{
	protected $rekening_rincian_objek_sub;

	public function __construct()
	{
		$this->rekening_rincian_objek_sub = new Model_rekening_rincian_objek_sub();
	}

	public function index()
	{
		if (has_permission('Admin')) :
			$rekening_rincian_objek_sub = $this->rekening_rincian_objek_sub->findAll();
			$data = [
				'gr' => 'rekening',
				'mn' => 'rekening_rincian_objek_sub',
				'title' => 'Admin',
				'lok' => '<b>rekening rincian_objek</b>',
				'rekening_rincian_objek_sub' => $rekening_rincian_objek_sub,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Rekening/rekening_rincian_objek_sub', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// ---------------------------------------------------------
}
