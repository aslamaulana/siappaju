<?php

namespace App\Controllers\Admin\Hspk;

use App\Controllers\BaseController;
use App\Models\Admin\Hspk\Model_hspk_komponen;
use App\Models\User\Hspk\Model_hspk;
use App\Models\Admin\User\Model_bidang;

class Hspk_komponen extends BaseController
{
	protected $hspk, $hspk1, $opd;

	public function __construct()
	{
		$this->hspk = new Model_hspk_komponen();
		$this->hspk1 = new Model_hspk();
		$this->opd = new Model_bidang();
	}

	public function data($id, $opd = '')
	{
		if (has_permission('Admin')) :
			$A = $this->hspk->hspk_komponen_A($id);
			$B = $this->hspk->hspk_komponen_B($id);
			$C = $this->hspk->hspk_komponen_C($id);
			$hspk1 = $this->hspk1->find($id);
			$skpd = $this->opd->find($opd);
			$data = [
				'gr' => 'a-hspk',
				'mn' => 'a-hspk',
				'lok' => 'HSPK OPD -> <a href="/admin/hspk/hspk/paket/' . $opd . '">HSPK</a> -> <b>HSPK Komponen</b>',
				'A' => $A,
				'B' => $B,
				'C' => $C,
				'hspk1' => $hspk1,
				'id_hspk' => $id,
				'opd' => $skpd,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Hspk/hspk_komponen', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	public function data_all($id, $opd = '')
	{
		if (has_permission('Admin')) :
			$A = $this->hspk->hspk_komponen_A_all($id);
			$B = $this->hspk->hspk_komponen_B_all($id);
			$C = $this->hspk->hspk_komponen_C_all($id);
			$hspk1 = $this->hspk1->find($id);
			$skpd = $this->opd->find($opd);
			$data = [
				'gr' => 'a-hspk',
				'mn' => 'a-hspk-all',
				'lok' => '<a href="javascript:history.back()">HSPK</a> -> <b>HSPK Komponen</b>',
				'A' => $A,
				'B' => $B,
				'C' => $C,
				'hspk1' => $hspk1,
				'id_hspk' => $id,
				'opd' => $skpd,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Hspk/hspk_komponen', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
