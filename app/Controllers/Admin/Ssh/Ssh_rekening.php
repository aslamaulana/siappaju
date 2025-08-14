<?php

namespace App\Controllers\Admin\Ssh;

use App\Controllers\BaseController;
use App\Models\User\Ssh\Model_ssh_rekening;
use App\Models\User\Ssh\Model_ssh;
use App\Models\Admin\Rekening\Model_rekening_akun;

class Ssh_rekening extends BaseController
{
	protected $ssh_rekening, $ssh;

	public function __construct()
	{
		$this->ssh_rekening = new Model_ssh_rekening();
		$this->akun = new Model_rekening_akun();
		$this->ssh = new Model_ssh();
	}

	public function rekening($id, $opd_id)
	{
		if (has_permission('Admin')) :
			$ssh = $this->ssh->find($id);
			$rekening = $this->ssh_rekening->ssh_rekening($id);
			$data = [
				'gr' => 'ssh',
				'mn' => 'ssh_pengajuan',
				'lok' => '<a href="/admin/ssh/ssh/ssh_pengajuan/' . $opd_id . '">Pengajuan</a> -> <b>Rekening</b>',
				'rekening' => $rekening,
				'ssh' => $ssh,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Ssh/ssh_rekening', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// ---------------------------------------------------------
}
