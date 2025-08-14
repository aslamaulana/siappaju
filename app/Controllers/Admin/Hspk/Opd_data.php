<?php

namespace App\Controllers\Admin\Hspk;

use App\Controllers\BaseController;
use App\Models\Admin\User\Model_bidang;

class Opd_data extends BaseController
{
	protected $opd;

	public function __construct()
	{
		$this->opd = new Model_bidang();
	}

	public function index()
	{
		if (has_permission('Admin')) :
			$opd = $this->opd->notLike('auth_groups.id', '0001')->findAll();
			$data = [
				'gr' => 'a-hspk',
				'mn' => 'a-hspk',
				'lok' => '<b>HSPK OPD</b>',
				'opd' => $opd,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Hspk/opd_data', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
