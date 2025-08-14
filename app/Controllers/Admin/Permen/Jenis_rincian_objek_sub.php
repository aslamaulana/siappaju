<?php

namespace App\Controllers\Admin\Permen;

use App\Controllers\BaseController;
use App\Models\Admin\Permen\Model_jenis_rincian_objek_sub;

class Jenis_rincian_objek_sub extends BaseController
{
	protected $jenis_rincian_objek_sub;

	public function __construct()
	{
		$this->jenis_rincian_objek_sub = new Model_jenis_rincian_objek_sub();
	}

	public function index()
	{
		if (has_permission('Admin')) :
			$jenis_rincian_objek_sub = $this->jenis_rincian_objek_sub->findAll();
			$data = [
				'gr' => 'jenis',
				'mn' => 'jenis_rincian_objek_sub',
				'title' => 'Admin',
				'lok' => '<b>Jenis rincian_objek</b>',
				'jenis_rincian_objek_sub' => $jenis_rincian_objek_sub,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Permen/jenis_rincian_objek_sub', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// ---------------------------------------------------------
}
