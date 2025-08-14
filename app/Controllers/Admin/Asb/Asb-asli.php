<?php

namespace App\Controllers\Admin\Asb;

use App\Controllers\BaseController;
use App\Models\Admin\Asb\Model_asb;
use App\Models\Admin\User\Model_bidang;

class Asb extends BaseController
{
	protected $asb, $opd;

	public function __construct()
	{
		$this->asb = new Model_asb();
		$this->opd = new Model_bidang();
	}

	public function index()
	{
		if (has_permission('Admin')) :
			$asb = $this->asb->findAll();
			// $opd = $this->opd->find($id);
			$data = [
				'gr' => 'a-asb',
				'mn' => 'a-asb',
				'lok' => '<b>ASB</b>',
				'asb' => $asb,
				// 'opd' => $opd,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Asb/asb', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function asb_add()
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'a-asb',
				'mn' => 'a-asb',
				'lok' => '<a href="/admin/asb/asb">ASB</a> -> <b>Tambah ASB</b>',
			];
			echo view('admin/Asb/asb_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function asb_create()
	{
		if (has_permission('Admin')) :
			$this->asb->save([
				'asb_paket' => $this->request->getVar('nm_paket'),
				'opd_id' => user()->opd_id,
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
