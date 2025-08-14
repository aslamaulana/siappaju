<?php

namespace App\Controllers\Admin\asb;

use App\Controllers\BaseController;
use App\Models\Admin\User\Model_bidang;

class Opd_data_asb extends BaseController
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
				'gr' => 'a-asb',
				'mn' => 'a-asb',
				'lok' => '<b>ASB OPD</b>',
				'opd' => $opd,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Asb/opd_data_asb', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
