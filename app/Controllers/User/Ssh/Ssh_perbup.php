<?php

namespace App\Controllers\User\Ssh;

use App\Controllers\BaseController;
use App\Models\User\Ssh\Model_ssh_perbup;

class Ssh_perbup extends BaseController
{
	protected $ssh, $akun;

	public function __construct()
	{
		$this->ssh = new Model_ssh_perbup();
	}

	public function index()
	{
		if (has_permission('User')) :
			$ssh = $this->ssh->orderBy('jenis_rincian_objek_sub_id', 'ASC')->findAll();
			$data = [
				'gr' => 'ssh',
				'mn' => 'ssh_perbup',
				'lok' => '<b>Perbup</b>',
				'ssh' => $ssh,
				'db' => \Config\Database::connect(),
			];
			echo view('user/Ssh/ssh_perbup', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// ---------------------------------------------------------
}
