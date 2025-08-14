<?php

namespace App\Controllers\Admin\Asb;

use App\Controllers\BaseController;
use App\Models\User\Asb\Model_asb;
use App\Models\Admin\User\Model_bidang;
use App\Models\Admin\Permen\Model_jenis_rincian_objek_sub;

class Asb extends BaseController
{
	protected $asb, $opd, $akun, $sub_rincian_objek;

	public function __construct()
	{
		$this->asb = new Model_asb();
		$this->opd = new Model_bidang();
		$this->sub_rincian_objek = new Model_jenis_rincian_objek_sub();
	}

	public function index()
	{
		if (has_permission('Admin')) :
			$asb = $this->asb
				->select('tb_asb.*')
				->select('auth_groups.id,auth_groups.name,tb_jenis_rincian_objek_sub.kode_jenis_rincian_objek_sub, tb_jenis_rincian_objek_sub.jenis_rincian_objek_sub')
				->join('tb_jenis_rincian_objek_sub', 'tb_asb.jenis_rincian_objek_sub_id = tb_jenis_rincian_objek_sub.id_jenis_rincian_objek_sub', 'LEFT')
				->join('auth_groups', 'tb_asb.opd_id = auth_groups.id', 'LEFT')
				->join('tb_asb_verifikasi', 'tb_asb.id_asb = tb_asb_verifikasi.asb_id', 'LEFT')
				->where("tb_asb.keterangan = '1' OR tb_asb_verifikasi.verifikasi = 'lolos'")->get()->getResultArray();
			$data = [
				'gr' => 'a-asb',
				'mn' => 'a-asb-all',
				'lok' => '<b>ASB</b>',
				'asb' => $asb,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Asb/asb_all', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function asb($id)
	{
		if (has_permission('Admin')) :
			$asb = $this->asb
				->join('tb_jenis_rincian_objek_sub', 'tb_asb.jenis_rincian_objek_sub_id = tb_jenis_rincian_objek_sub.id_jenis_rincian_objek_sub', 'LEFT')
				->where(['tb_asb.opd_id' => $id, 'tb_asb.tahun' => $_SESSION['tahun']])->findAll();
			$opd = $this->opd->find($id);
			$data = [
				'gr' => 'a-asb',
				'mn' => 'a-asb',
				'lok' => '<b>ASB</b>',
				'asb' => $asb,
				'opd_id' => $id,
				'opd' => $opd,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Asb/asb', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
