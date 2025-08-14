<?php

namespace App\Controllers\Admin\Permen;

use App\Controllers\BaseController;
use App\Models\Admin\Permen\Model_jenis_rincian_objek;

class Jenis_rincian_objek extends BaseController
{
	protected $jenis_rincian_objek;

	public function __construct()
	{
		$this->jenis_rincian_objek = new Model_jenis_rincian_objek();
	}

	public function index()
	{
		if (has_permission('Admin')) :
			$jenis_rincian_objek = $this->jenis_rincian_objek->findAll();
			$data = [
				'gr' => 'jenis',
				'mn' => 'jenis_rincian_objek',
				'title' => 'Admin',
				'lok' => '<b>Jenis rincian_objek</b>',
				'jenis_rincian_objek' => $jenis_rincian_objek,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Permen/jenis_rincian_objek', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// ---------------------------------------------------------
}
