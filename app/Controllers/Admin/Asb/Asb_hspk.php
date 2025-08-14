<?php

namespace App\Controllers\Admin\Asb;

use App\Controllers\BaseController;
use App\Models\User\Asb\Model_asb_hspk;
use App\Models\User\Asb\Model_asb;
use App\Models\Admin\User\Model_bidang;

class Asb_hspk extends BaseController
{
	protected $asb, $asb_hspk, $opd;

	public function __construct()
	{
		$this->asb_hspk = new Model_asb_hspk();
		$this->asb = new Model_asb();
		$this->opd = new Model_bidang();
	}

	public function asb_all($id, $opd_id)
	{
		if (has_permission('Admin')) :
			$asb_hspk = $this->asb_hspk->asb_hspk_all($id);
			$asb = $this->asb->find($id);
			// $opd = $this->opd->find($id);
			$data = [
				'gr' => 'a-asb',
				'mn' => 'a-asb-all',
				'lok' => '<a href="javascript:history.back()">ASB</a> -> <b>ASB HSPK</b>',
				'asb_hspk' => $asb_hspk,
				'asb' => $asb,
				'id_asb' => $id,
				// 'opd' => $opd,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Asb/asb_hspk_all', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function asb($id, $opd_id)
	{
		if (has_permission('Admin')) :
			$asb_hspk = $this->asb_hspk->asb_hspk($id);
			$asb = $this->asb->find($id);
			// $opd = $this->opd->find($id);
			$data = [
				'gr' => 'a-asb',
				'mn' => 'a-asb',
				'lok' => '<a href="/admin/asb/asb/asb/' . $opd_id . '">ASB</a> -> <b>ASB HSPK</b>',
				'asb_hspk' => $asb_hspk,
				'asb' => $asb,
				'id_asb' => $id,
				// 'opd' => $opd,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Asb/asb_hspk', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
