<?php

namespace App\Controllers\Admin\Ssh;

use App\Controllers\BaseController;
use App\Models\Admin\User\Model_bidang;

class Opd_data_ssh extends BaseController
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
				'gr' => 'ssh',
				'mn' => 'ssh_pengajuan',
				'lok' => '<b>SSH OPD</b>',
				'opd' => $opd,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Ssh/opd_data_ssh', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
