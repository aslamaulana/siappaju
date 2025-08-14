<?php

namespace App\Controllers\Admin\Verifikasi;

// require 'vendor/autoload.php';

use App\Controllers\BaseController;
use App\Models\Admin\Verifikasi\Model_verifikasi;
use App\Models\User\Verifikasi\Model_verifikasi_ssh;
use App\Models\User\Verifikasi\Model_verifikasi_asb;

class Data extends BaseController
{
	protected $verifikasi, $verifikasi_ssh, $verifikasi_asb;

	public function __construct()
	{
		$this->verifikasi = new Model_verifikasi();
		$this->verifikasi_ssh = new Model_verifikasi_ssh();
		$this->verifikasi_asb = new Model_verifikasi_asb();
	}

	// public function verifikasi()
	// {
	// 	if (has_permission('Admin')) {
	// 		if (isset($_POST['lolos']) || isset($_POST['lolos_ubah'])) {
	// 			$this->verifikasi->save([
	// 				'hspk_id' => $this->request->getVar('id_hspk'),
	// 				'verifikasi' => 'lolos',
	// 				'nm_verifikator' => user()->full_name,
	// 				'tahun' => $_SESSION['tahun'],
	// 				'created_by' => user()->full_name,
	// 			]);
	// 			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
	// 			return redirect()->back();
	// 		} elseif (isset($_POST['dikembalikan']) || isset($_POST['dikembalikan_ubah']) || isset($_POST['dikembalikan_lolos'])) {
	// 			$this->verifikasi->save([
	// 				'hspk_id' => $this->request->getVar('id_hspk'),
	// 				'verifikasi' => 'dikembalikan',
	// 				'verifikasi_keterangan' => $this->request->getVar('verifikasi_keterangan'),
	// 				'nm_verifikator' => user()->full_name,
	// 				'tahun' => $_SESSION['tahun'],
	// 				'created_by' => user()->full_name,
	// 			]);
	// 			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
	// 			return redirect()->back();
	// 		} elseif (isset($_POST['ditolak']) || isset($_POST['ditolak_ubah']) || isset($_POST['ditolak_lolos'])) {
	// 			$this->verifikasi->save([
	// 				'hspk_id' => $this->request->getVar('id_hspk'),
	// 				'verifikasi' => 'ditolak',
	// 				'verifikasi_keterangan' => $this->request->getVar('verifikasi_keterangan'),
	// 				'nm_verifikator' => user()->full_name,
	// 				'tahun' => $_SESSION['tahun'],
	// 				'created_by' => user()->full_name,
	// 			]);
	// 			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
	// 			return redirect()->back();
	// 		}
	// 	} else {
	// 		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	// 	}
	// }
	public function verifikasi()
	{
		if (has_permission('Admin')) {
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		if (!$this->request->isAJAX()) {
			return $this->response->setStatusCode(405)
				->setJSON(['success' => false, 'message' => 'Metode tidak diizinkan']);
		}

		$id = $this->request->getPost('id_hspk');
		$status = $this->request->getPost('status');
		$keterangan = $this->request->getPost('verifikasi_keterangan');

		if (empty($id) || empty($status)) {
			return $this->response->setStatusCode(400)
				->setJSON(['success' => false, 'message' => 'Data tidak lengkap']);
		}

		// Data update
		$dataUpdate = [
			'hspk_id' => $id,
			'verifikasi' => $status,
			'verifikasi_keterangan' => $keterangan,
			'opd_id' => user()->opd_id,
			'tahun' => $_SESSION['tahun'],
			'nm_verifikator' => user()->full_name,
			'updated_by' => user()->username,
		];

		try {
			$this->verifikasi->update($id, $dataUpdate);
			return $this->response->setJSON(['success' => true]);
		} catch (\Exception $e) {
			return $this->response->setStatusCode(500)
				->setJSON(['success' => false, 'message' => $e->getMessage()]);
		}
	}
	public function verifikasi_massal_hspk()
	{
		$ids = $this->request->getPost('ids');
		$status = $this->request->getPost('status');

		if (!is_array($ids) || empty($ids)) {
			return $this->response->setStatusCode(400)->setJSON(['error' => 'Tidak ada data terpilih']);
		}

		foreach ($ids as $id) {
			$this->verifikasi->update($id, [
				'verifikasi' => $status,
				'verifikasi_keterangan' => '',
				'verifikator' => user()->full_name,
				'updated_by' => user()->full_name
			]);
		}

		return $this->response->setJSON(['success' => true]);
	}
	// public function verifikasi_ssh()
	// {
	// 	if (has_permission('Admin')) {
	// 		if (isset($_POST['lolos']) || isset($_POST['lolos_ubah'])) {
	// 			$this->verifikasi_ssh->save([
	// 				'ssh_id' => $this->request->getVar('id_ssh'),
	// 				'verifikasi' => 'lolos',
	// 				'nm_verifikator' => user()->full_name,
	// 				'tahun' => $_SESSION['tahun'],
	// 				'created_by' => user()->full_name,
	// 			]);
	// 			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
	// 			return redirect()->back();
	// 		} elseif (isset($_POST['dikembalikan']) || isset($_POST['dikembalikan_ubah']) || isset($_POST['dikembalikan_lolos'])) {
	// 			$this->verifikasi_ssh->save([
	// 				'ssh_id' => $this->request->getVar('id_ssh'),
	// 				'verifikasi' => 'dikembalikan',
	// 				'verifikasi_keterangan' => $this->request->getVar('verifikasi_keterangan'),
	// 				'nm_verifikator' => user()->full_name,
	// 				'tahun' => $_SESSION['tahun'],
	// 				'created_by' => user()->full_name,
	// 			]);
	// 			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
	// 			return redirect()->back();
	// 		} elseif (isset($_POST['ditolak']) || isset($_POST['ditolak_ubah']) || isset($_POST['ditolak_lolos'])) {
	// 			$this->verifikasi_ssh->save([
	// 				'ssh_id' => $this->request->getVar('id_ssh'),
	// 				'verifikasi' => 'ditolak',
	// 				'verifikasi_keterangan' => $this->request->getVar('verifikasi_keterangan'),
	// 				'nm_verifikator' => user()->full_name,
	// 				'tahun' => $_SESSION['tahun'],
	// 				'created_by' => user()->full_name,
	// 			]);
	// 			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
	// 			return redirect()->back();
	// 		} else {
	// 			if (isset($_POST['id_ssh_ceklis'])) {
	// 				foreach ($_POST['id_ssh_ceklis'] as $key => $val) {
	// 					$verifikasi_ceklis[] = array(
	// 						'ssh_id' => $_POST['id_ssh_ceklis'][$key],
	// 						'verifikasi' => 'lolos',
	// 						'nm_verifikator' => user()->full_name,
	// 						'tahun' => $_SESSION['tahun'],
	// 						'created_by' => user()->full_name,
	// 					);
	// 				}
	// 				// dd($verifikasi_ceklis);
	// 				$this->verifikasi_ssh->updateBatch($verifikasi_ceklis, 'ssh_id');

	// 				session()->setFlashdata('pesan', 'Data berhasil di simpan.');
	// 				return redirect()->back();
	// 			} else {
	// 				return redirect()->back();
	// 			}
	// 		}
	// 	} else {
	// 		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	// 	}
	// }

	public function verifikasi_ssh()
	{
		if (has_permission('Admin')) {
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		if (!$this->request->isAJAX()) {
			return $this->response->setStatusCode(405)
				->setJSON(['success' => false, 'message' => 'Metode tidak diizinkan']);
		}

		$id = $this->request->getPost('id_ssh');
		$status = $this->request->getPost('status');
		$keterangan = $this->request->getPost('verifikasi_keterangan');

		if (empty($id) || empty($status)) {
			return $this->response->setStatusCode(400)
				->setJSON(['success' => false, 'message' => 'Data tidak lengkap']);
		}

		// Data update
		$dataUpdate = [
			'ssh_id' => $id,
			'verifikasi' => $status,
			'verifikasi_keterangan' => $keterangan,
			'opd_id' => user()->opd_id,
			'tahun' => $_SESSION['tahun'],
			'nm_verifikator' => user()->full_name,
			'updated_by' => user()->username,
		];

		try {
			$this->verifikasi_ssh->update($id, $dataUpdate);
			return $this->response->setJSON(['success' => true]);
		} catch (\Exception $e) {
			return $this->response->setStatusCode(500)
				->setJSON(['success' => false, 'message' => $e->getMessage()]);
		}
	}

	public function verifikasi_massal_ssh()
	{
		$ids = $this->request->getPost('ids');
		$status = $this->request->getPost('status');

		if (!is_array($ids) || empty($ids)) {
			return $this->response->setStatusCode(400)->setJSON(['error' => 'Tidak ada data terpilih']);
		}

		foreach ($ids as $id) {
			$this->verifikasi_ssh->update($id, [
				'verifikasi' => $status,
				'verifikasi_keterangan' => '',
				'verifikator' => user()->full_name,
				'updated_by' => user()->full_name
			]);
		}

		return $this->response->setJSON(['success' => true]);
	}


	public function verifikasi_asb()
	{
		if (has_permission('Admin')) {
			if (isset($_POST['lolos']) || isset($_POST['lolos_ubah'])) {
				$this->verifikasi_asb->save([
					'asb_id' => $this->request->getVar('id_asb'),
					'verifikasi' => 'lolos',
					'nm_verifikator' => user()->full_name,
					'tahun' => $_SESSION['tahun'],
					'created_by' => user()->full_name,
				]);
				session()->setFlashdata('pesan', 'Data berhasil di simpan.');
				return redirect()->back();
			} elseif (isset($_POST['dikembalikan']) || isset($_POST['dikembalikan_ubah']) || isset($_POST['dikembalikan_lolos'])) {
				$this->verifikasi_asb->save([
					'asb_id' => $this->request->getVar('id_asb'),
					'verifikasi' => 'dikembalikan',
					'verifikasi_keterangan' => $this->request->getVar('verifikasi_keterangan'),
					'nm_verifikator' => user()->full_name,
					'tahun' => $_SESSION['tahun'],
					'created_by' => user()->full_name,
				]);
				session()->setFlashdata('pesan', 'Data berhasil di simpan.');
				return redirect()->back();
			} elseif (isset($_POST['ditolak']) || isset($_POST['ditolak_ubah']) || isset($_POST['ditolak_lolos'])) {
				$this->verifikasi_asb->save([
					'asb_id' => $this->request->getVar('id_asb'),
					'verifikasi' => 'ditolak',
					'verifikasi_keterangan' => $this->request->getVar('verifikasi_keterangan'),
					'nm_verifikator' => user()->full_name,
					'tahun' => $_SESSION['tahun'],
					'created_by' => user()->full_name,
				]);
				session()->setFlashdata('pesan', 'Data berhasil di simpan.');
				return redirect()->back();
			}
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
	}
}
