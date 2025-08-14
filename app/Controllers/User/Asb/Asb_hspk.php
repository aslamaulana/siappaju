<?php

namespace App\Controllers\User\Asb;

use App\Controllers\BaseController;
use App\Models\User\Asb\Model_asb_hspk;
use App\Models\User\Asb\Model_asb;
use App\Models\Admin\User\Model_bidang;
use App\Models\User\Hspk\Model_hspk_komponen;

class Asb_hspk extends BaseController
{
	protected $asb, $asb_hspk, $opd, $hspk_komponen;

	public function __construct()
	{
		$this->asb_hspk = new Model_asb_hspk();
		$this->asb = new Model_asb();
		$this->opd = new Model_bidang();
		$this->hspk_komponen = new Model_hspk_komponen();
	}

	public function asb($id)
	{
		if (has_permission('User')) :
			$asb_hspk = $this->asb_hspk->asb_hspk($id);
			$asb = $this->asb->find($id);
			// $opd = $this->opd->find($id);
			$data = [
				'gr' => 'asb',
				'mn' => 'asb',
				'lok' => '<a href="/user/asb/asb">ASB</a> -> <b>ASB HSPK</b>',
				'asb' => $asb,
				'asb_hspk' => $asb_hspk,
				'asb_hspk2' => $this->asb_hspk,
				'id_asb' => $id,
				// 'opd' => $opd,
				'db' => \Config\Database::connect(),
			];
			echo view('user/Asb/asb_hspk', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function asb_add($id)
	{
		if (has_permission('User')) :
			$hspk = $this->asb_hspk->hspk();
			$data = [
				'gr' => 'asb',
				'mn' => 'asb',
				'lok' => 'ASB -> <a href="/user/asb/asb_hspk/asb/' . $id . '">ASB HSPK</a> -> <b>Tambah HSPK</b>',
				'id_asb' => $id,
				'hspk' => $hspk,

				'db' => \Config\Database::connect(),
			];
			echo view('user/Asb/asb_hspk_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function asb_create()
	{
		if (has_permission('User')) :
			$this->asb_hspk->save([
				'asb_id' => $this->request->getVar('id_asb'),
				'hspk_id' => $this->request->getVar('id_hspk'),
				'jumlah' => $this->request->getVar('index'),
				'tahun' => $_SESSION['tahun'],
				'opd_id' => user()->opd_id,
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/asb/asb_hspk/asb/' . $this->request->getVar('id_asb'));
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function asb_edit($id, $id_asb)
	{
		if (has_permission('User')) :
			$hspk = $this->asb_hspk->find($id);
			$data = [
				'gr' => 'asb',
				'mn' => 'asb',
				'lok' => 'ASB -> <a href="/user/asb/asb_hspk/asb/' . $id_asb . '">ASB HSPK</a> -> <b>Ubah HSPK</b>',
				'hspk' => $hspk,
				'id_asb' => $id_asb,
				'db' => \Config\Database::connect(),
			];
			echo view('user/Asb/asb_hspk_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function asb_update()
	{
		if (has_permission('User')) :
			$this->asb_hspk->save([
				'id_asb_hspk' => $this->request->getVar('id_asb_hspk'),
				'jumlah' => $this->request->getVar('index'),
				'updated_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/asb/asb_hspk/asb/' . $this->request->getVar('id_asb'));
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function asb_hapus($id)
	{
		if (has_permission('User')) :
			try {
				$this->asb_hspk->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->back();
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
}
