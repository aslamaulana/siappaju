<?php

namespace App\Controllers\Admin\Asb;

use App\Controllers\BaseController;
use App\Models\Admin\Asb\Model_asb_hspk;
use App\Models\Admin\Asb\Model_asb;
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

	public function asb($id)
	{
		if (has_permission('Admin')) :
			$asb_hspk = $this->asb_hspk->asb_hspk($id);
			$asb = $this->asb->find($id);
			// $opd = $this->opd->find($id);
			$data = [
				'gr' => 'a-asb',
				'mn' => 'a-asb',
				'lok' => '<a href="/admin/asb/asb">ASB</a> -> <b>ASB HSPK</b>',
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
	public function asb_add($id)
	{
		if (has_permission('Admin')) :
			$hspk = $this->asb_hspk->hspk();
			$data = [
				'gr' => 'a-asb',
				'mn' => 'a-asb',
				'lok' => 'ASB -> <a href="/admin/asb/asb_hspk/asb/' . $id . '">ASB HSPK</a> -> <b>Tambah HSPK</b>',
				'id_asb' => $id,
				'hspk' => $hspk,
			];
			echo view('admin/Asb/asb_hspk_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function asb_create()
	{
		if (has_permission('Admin')) :
			$this->asb_hspk->save([
				'asb_id' => $this->request->getVar('id_asb'),
				'hspk_id' => $this->request->getVar('id_hspk'),
				'jumlah' => $this->request->getVar('index'),
				'tahun' => $_SESSION['tahun'],
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/asb/asb');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function asb_edit($id)
	{
		if (has_permission('Admin')) :
			$asb = $this->asb->find($id);
			$data = [
				'gr' => 'a-asb',
				'mn' => 'a-asb',
				'lok' => '<a href="/admin/asb/asb">ASB</a> -> <b>Ubah ASB</b>',
				'asb' => $asb,
			];
			echo view('admin/Asb/asb_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function asb_update()
	{
		if (has_permission('Admin')) :
			$this->asb->save([
				'id_asb' => $this->request->getVar('id'),
				'asb_paket' => $this->request->getVar('nm_paket'),
				'updated_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/asb/asb');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function asb_hapus($id)
	{
		if (has_permission('Admin')) :
			try {
				$this->asb->delete($id);
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
