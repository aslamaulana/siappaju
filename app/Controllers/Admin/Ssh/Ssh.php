<?php

namespace App\Controllers\Admin\Ssh;

use App\Controllers\BaseController;
use App\Models\Admin\Ssh\Model_ssh;
use App\Models\Admin\User\Model_bidang;

class Ssh extends BaseController
{
	protected $ssh, $opd;

	public function __construct()
	{
		$this->ssh = new Model_ssh();
		$this->opd = new Model_bidang();
	}

	public function ssh_pengajuan($id)
	{
		if (has_permission('Admin')) :
			$ssh = $this->ssh->ssh_pengajuan($id);
			$opd = $this->opd->find($id);
			$data = [
				'gr' => 'ssh',
				'mn' => 'ssh_pengajuan',
				'lok' => '<a href="/admin/ssh/opd_data_ssh">SSH OPD</a> / <b>SSH</b>',
				'ssh' => $ssh,
				'opd' => $opd,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Ssh/ssh_pengajuan', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	public function index()
	{
		if (has_permission('Admin')) :
			$ssh = $this->ssh->ssh();
			$data = [
				'gr' => 'ssh',
				'mn' => 'ssh',
				'title' => 'Admin',
				'lok' => '<b>Jenis jenis</b>',
				'ssh' => $ssh,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Ssh/ssh', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function ssh_add()
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'ssh',
				'mn' => 'ssh',
				'title' => 'Admin',
				'lok' => '<a href=".">SSH</a> / <b>Tambah ssh</b>',
			];
			echo view('admin/Ssh/ssh_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function ssh_create()
	{
		if (has_permission('Admin')) :
			$this->ssh->save([
				'komponen' => $this->request->getVar('komponen'),
				'spesifikasi' => $this->request->getVar('spesifikasi'),
				'satuan' => $this->request->getVar('satuan'),
				'harga' => $this->request->getVar('harga'),
				'kelompok' => $this->request->getVar('type'),
				'tahun' => $_SESSION['tahun'],
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/ssh/ssh');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function ssh_edit($id)
	{
		if (has_permission('Admin')) :
			$ssh = $this->ssh->find($id);
			$data = [
				'gr' => 'ssh',
				'mn' => 'ssh',
				'title' => 'Admin',
				'lok' => '<a href=".">SSH</a> / <b>Ubah ssh</b>',
				'ssh' => $ssh,
			];
			echo view('admin/Ssh/ssh_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function ssh_update()
	{
		if (has_permission('Admin')) :
			$this->ssh->save([
				'id_ssh' => $this->request->getVar('id'),
				'komponen' => $this->request->getVar('komponen'),
				'spesifikasi' => $this->request->getVar('spesifikasi'),
				'satuan' => $this->request->getVar('satuan'),
				'harga' => $this->request->getVar('harga'),
				'tahun' => $_SESSION['tahun'],
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/admin/ssh/ssh');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function ssh_hapus($id)
	{
		if (has_permission('Admin')) :
			try {
				$this->ssh->delete($id);
			} catch (\Exception $e) {
				session()->setFlashdata('error', 'Data Gagal di hapus.');
				return redirect()->back();
			}
			session()->setFlashdata('pesan', 'Data berhasil di hapus.');
			return redirect()->to(base_url() . '/admin/ssh/ssh');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	// ---------------------------------------------------------
}
