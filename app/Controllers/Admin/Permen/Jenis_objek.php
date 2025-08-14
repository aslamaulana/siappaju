<?php

namespace App\Controllers\Admin\Permen;

use App\Controllers\BaseController;
use App\Models\Admin\Permen\Model_jenis_objek;

class Jenis_objek extends BaseController
{
	protected $jenis_objek;

	public function __construct()
	{
		$this->jenis_objek = new Model_jenis_objek();
	}

	public function index()
	{
		if (has_permission('Admin')) :
			$jenis_objek = $this->jenis_objek->findAll();
			$data = [
				'gr' => 'jenis',
				'mn' => 'jenis_objek',
				'title' => 'Admin',
				'lok' => '<b>Jenis objek</b>',
				'jenis_objek' => $jenis_objek,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Permen/jenis_objek', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// ---------------------------------------------------------
}
