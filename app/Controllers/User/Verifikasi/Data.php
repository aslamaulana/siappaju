<?php

namespace App\Controllers\User\Verifikasi;

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

	public function ajukan($id)
	{
		if (has_permission('User')) {
			$this->verifikasi->save([
				'hspk_id' => $id,
				'verifikasi' => 'diajukan',
				'opd_id' => user()->opd_id,
				'tahun' => $_SESSION['tahun'],
				'created_by' => user()->full_name,
			]);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->back();
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
	}
	public function ajukan_hspk_multiple()
	{
		if (has_permission('User')) {
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$ids = $this->request->getPost('ids'); // array ID SSH
		if (is_array($ids) && count($ids) > 0) {
			foreach ($ids as $hspk_id) {
				$existing = $this->verifikasi->where('hspk_id', $hspk_id)->first();

				$data = [
					'hspk_id'      => $hspk_id,
					'verifikasi'  => 'diajukan',
					'opd_id'      => user()->opd_id,
					'tahun'       => $_SESSION['tahun'],
					'created_by'  => user()->full_name,
				];

				if ($existing) {
					// Jika sudah ada, update
					$this->verifikasi->update($existing['hspk_id'], $data);
				} else {
					// Jika belum ada, insert
					$this->verifikasi->insert($data);
				}
			}
			return $this->response->setJSON(['success' => true]);
		}

		return $this->response->setStatusCode(400)->setJSON(['error' => 'Tidak ada data']);
	}
	public function ajukan_ulang()
	{
		if (has_permission('User')) {
			$this->verifikasi->save([
				'hspk_id' => $this->request->getVar('id_hspk'),
				'verifikasi' => 'edit',
				'opd_id' => user()->opd_id,
				'tahun' => $_SESSION['tahun'],
				'created_by' => user()->full_name,
			]);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->back();
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
	}
	public function ajukan_ssh($id)
	{
		if (has_permission('User')) {
			$this->verifikasi_ssh->save([
				'ssh_id' => $id,
				'verifikasi' => 'diajukan',
				'opd_id' => user()->opd_id,
				'tahun' => $_SESSION['tahun'],
				'created_by' => user()->full_name,
			]);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->back();
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
	}
	public function ajukan_ssh_multiple()
	{
		if (has_permission('User')) {
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$ids = $this->request->getPost('ids'); // array ID SSH
		if (is_array($ids) && count($ids) > 0) {
			foreach ($ids as $ssh_id) {
				$existing = $this->verifikasi_ssh->where('ssh_id', $ssh_id)->first();

				$data = [
					'ssh_id'      => $ssh_id,
					'verifikasi'  => 'diajukan',
					'opd_id'      => user()->opd_id,
					'tahun'       => $_SESSION['tahun'],
					'created_by'  => user()->full_name,
				];

				if ($existing) {
					// Jika sudah ada, update
					$this->verifikasi_ssh->update($existing['ssh_id'], $data);
				} else {
					// Jika belum ada, insert
					$this->verifikasi_ssh->insert($data);
				}
			}
			return $this->response->setJSON(['success' => true]);
		}

		return $this->response->setStatusCode(400)->setJSON(['error' => 'Tidak ada data']);
	}

	public function ajukan_ssh_ulang()
	{
		if (has_permission('User')) {
			$this->verifikasi_ssh->save([
				'ssh_id' => $this->request->getVar('id_ssh'),
				'verifikasi' => 'edit',
				'opd_id' => user()->opd_id,
				'tahun' => $_SESSION['tahun'],
				'created_by' => user()->full_name,
			]);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->back();
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
	}
	public function ajukan_asb($id)
	{
		if (has_permission('User')) {
			$this->verifikasi_asb->save([
				'asb_id' => $id,
				'verifikasi' => 'diajukan',
				'opd_id' => user()->opd_id,
				'tahun' => $_SESSION['tahun'],
				'created_by' => user()->full_name,
			]);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->back();
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
	}
	public function ajukan_asb_ulang()
	{
		if (has_permission('User')) {
			$this->verifikasi_asb->save([
				'asb_id' => $this->request->getVar('id_asb'),
				'verifikasi' => 'edit',
				'opd_id' => user()->opd_id,
				'tahun' => $_SESSION['tahun'],
				'created_by' => user()->full_name,
			]);
			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->back();
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
	}
	// public function tidak_sesuai_create()
	// {
	// 	if (has_permission('Admin') || has_permission('verifikator')) {
	// 		if (isset($_POST['submit'])) {
	// 			$this->verifikator->save([
	// 				'kla_jawaban_id' => $this->request->getVar('kla_jawaban_id'),
	// 				'verifikasi' => 'tidak',
	// 				'verifikasi_keterangan' => $this->request->getVar('verifikasi_keterangan'),
	// 				'opd_id' => user()->opd_id,
	// 				'tahun' => $_SESSION['tahun'],
	// 				'created_by' => user()->full_name,
	// 			]);
	// 			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
	// 			return redirect()->back();
	// 		} elseif (isset($_POST['submit_ubah']) || isset($_POST['submit_ubah2'])) {
	// 			$this->verifikator->save([
	// 				'id_kla_jawaban_verifikasi' => $this->request->getVar('id_kla_jawaban_verifikasi'),
	// 				'verifikasi' => 'tidak',
	// 				'verifikasi_keterangan' => $this->request->getVar('verifikasi_keterangan'),
	// 				'opd_id' => user()->opd_id,
	// 				'tahun' => $_SESSION['tahun'],
	// 				'updated_by' => user()->full_name,
	// 			]);
	// 			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
	// 			return redirect()->back();
	// 		} elseif (isset($_POST['submit_ubah2']) || isset($_POST['submit_ubah2'])) {
	// 			$this->verifikator->save([
	// 				'id_kla_jawaban_verifikasi' => $this->request->getVar('id_kla_jawaban_verifikasi'),
	// 				'verifikasi' => 'tidak',
	// 				'verifikasi_keterangan' => $this->request->getVar('verifikasi_keterangan'),
	// 				'opd_id' => user()->opd_id,
	// 				'tahun' => $_SESSION['tahun'],
	// 				'updated_by' => user()->full_name,
	// 			]);
	// 			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
	// 			return redirect()->back();
	// 		}
	// 	} else {
	// 		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	// 	}
	// }
	// public function progres($id, $nm)
	// {
	// 	if (has_permission('Admin') || has_permission('verifikator')) :
	// 		$data = [
	// 			'gr' => 'kla',
	// 			'mn' => 'data',
	// 			'title' => 'Admin | KLA Pertanyaan',
	// 			'lok' => '<a href="javascript: history.back(1)">Data</a> -> <b>Progres</b>',
	// 			'validation' => \Config\Services::validation(),
	// 			'nm' => $nm,
	// 			'opd_id' => $id,
	// 			'db' => \Config\Database::connect(),
	// 		];
	// 		echo view('admin/Kla/progres', $data);
	// 	else :
	// 		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	// 	endif;
	// }
}
