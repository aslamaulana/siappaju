<?php

namespace App\Controllers\User\Ssh;

use App\Controllers\BaseController;
use App\Models\User\Ssh\Model_ssh;
use App\Models\Admin\Permen\Model_jenis_akun;
use App\Models\Admin\Rekening\Model_rekening_akun;
use App\Models\Admin\Rekening\Model_rekening_rincian_objek_sub;
use App\Models\User\Ssh\Model_ssh_rekening;
use App\Models\User\Verifikasi\Model_verifikasi_ssh;

class Ssh_acuan extends BaseController
{
	protected $ssh, $akun, $verifikasi_ssh, $ssh_rekening, $akun_rekening, $rekening;

	public function __construct()
	{
		$this->ssh = new Model_ssh();
		$this->akun = new Model_jenis_akun();
		$this->verifikasi_ssh = new Model_verifikasi_ssh();
		$this->rekening = new Model_rekening_rincian_objek_sub();
		$this->ssh_rekening = new Model_ssh_rekening();
		$this->akun_rekening = new Model_rekening_akun();
	}

	public function index()
	{
		if (has_permission('User')) :
			$ssh = $this->ssh->ssh_perbup();
			$data = [
				'gr' => 'ssh',
				'mn' => 'ssh_acuan',
				'lok' => '<b>Acuan</b>',
				'ssh' => $ssh,
				'db' => \Config\Database::connect(),
			];
			echo view('user/Ssh/ssh_acuan', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function acuan_edit($id)
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'ssh',
				'mn' => 'ssh_acuan',
				'lok' => '<a href="/user/ssh/ssh_acuan"> SSH Acuan </a>-> <b>Ubah acuan</b>',
				'akun' => $this->akun->findAll(),
				'ssh' => $this->ssh->ssh_edit($id),
				'ssh_rekening' => $this->ssh_rekening->ssh_rekening_findAll($id),
				'rekening' => $this->rekening->findAll(),
				'validation' => \Config\Services::validation(),
			];
			echo view('user/Ssh/ssh_acuan_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function acuan_update()
	{
		if (has_permission('User')) :
			$this->ssh->save([
				'id_ssh' => $this->request->getVar('id_ssh'),
				'komponen' => $this->request->getVar('komponen'),
				'spesifikasi' => $this->request->getVar('spesifikasi'),
				'satuan' => $this->request->getVar('satuan'),
				'harga' => $this->request->getVar('harga'),
				'tkdn' => $this->request->getVar('tkdn'),
				'kelompok' => $this->request->getVar('type'),
				'jenis_rincian_objek_sub_id' => $this->request->getVar('sub_rincian_objek'),
				'opd_id' => user()->opd_id,
				'created_by' => user()->full_name,
			]);
			$this->verifikasi_ssh->save([
				'ssh_id' => $this->request->getVar('id_ssh'),
				'verifikasi' => 'perbup_edit',
				'opd_id' => user()->opd_id,
				'updated_by' => user()->full_name,
			]);

			// ------------------------------------
			for ($i = 0; $i < count($this->request->getVar('rekening')); $i++) {
				if (empty($this->request->getVar('id')[$i])) {
					$data = [
						'ssh_id' => $this->request->getVar('id_ssh'),
						'rekening_rincian_objek_sub_id' => $this->request->getVar('rekening')[$i],
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'created_by' => user()->full_name,
					];
					$this->ssh_rekening->insert($data);
				}
			}

			for ($i = 0; $i < count($this->request->getVar('rekening')); $i++) {
				if (!empty($this->request->getVar('id')[$i])) {
					$data = [
						'rekening_rincian_objek_sub_id' => $this->request->getVar('rekening')[$i],
						'opd_id' => user()->opd_id,
						'updated_by' => user()->full_name,
					];
					$this->ssh_rekening->update($this->request->getVar('id')[$i], $data);
				}
			}
			// ------------------------------------

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/ssh/ssh_pengajuan');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function hapus_rekening()
	{
		// Tangkap data yang dikirim melalui AJAX
		$id = $this->request->getVar('id');

		// Lakukan validasi data jika diperlukan

		// Lakukan operasi insert data ke database
		// Misalnya:
		$this->ssh_rekening->delete($id);

		// Jika operasi insert berhasil
		$response = [
			'status' => 'success',
			'message' => 'Data berhasil Dihapus',
		];

		// Jika operasi insert gagal
		// $response = [
		//     'status' => 'error',
		//     'message' => 'Gagal menyimpan data',
		// ];

		// Kembalikan respons dalam format JSON
		return $this->response->setJSON($response);
	}
	// public function rekening_acuan($id)
	// {
	// 	if (has_permission('User')) :
	// 		$ssh = $this->ssh->find($id);
	// 		$rekening = $this->ssh_rekening->ssh_rekening($id);
	// 		$data = [
	// 			'gr' => 'ssh',
	// 			'mn' => 'ssh_acuan',
	// 			'lok' => '<a href="/user/ssh/ssh_acuan">Acuan</a> -> <b>Rekening</b>',
	// 			'rekening' => $rekening,
	// 			'ssh' => $ssh,
	// 			'db' => \Config\Database::connect(),
	// 		];
	// 		echo view('user/Ssh/ssh_rekening_acuan', $data);
	// 	else :
	// 		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	// 	endif;
	// }
	// public function rekening_acuan_add($id)
	// {
	// 	if (has_permission('User')) :
	// 		$ssh = $this->ssh->find($id);
	// 		$akun = $this->akun_rekening->findAll();
	// 		$data = [
	// 			'gr' => 'ssh',
	// 			'mn' => 'ssh_acuan',
	// 			'lok' => 'Acuan -> <a href="/user/ssh/ssh_acuan/rekening_acuan/' . $id . '">Rekening</a> -> <b>Tambah Rekening</b>',
	// 			'akun' => $akun,
	// 			'id_ssh' => $id,
	// 			'ssh' => $ssh,
	// 			'validation' => \Config\Services::validation(),
	// 		];
	// 		echo view('user/Ssh/ssh_rekening_acuan_add', $data);
	// 	else :
	// 		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	// 	endif;
	// }

	// public function rekening_acuan_create()
	// {
	// 	if (has_permission('User')) :
	// 		$this->ssh_rekening->save([
	// 			'ssh_id' => $this->request->getVar('id_ssh'),
	// 			'rekening_rincian_objek_sub_id' => $this->request->getVar('sub_rincian_objek'),
	// 			'opd_id' => user()->opd_id,
	// 			'tahun' => $_SESSION['tahun'],
	// 			'created_by' => user()->full_name,
	// 		]);

	// 		session()->setFlashdata('pesan', 'Data berhasil di simpan.');
	// 		return redirect()->to(base_url() . '/user/ssh/ssh_acuan/rekening_acuan/' . $this->request->getVar('id_ssh'));
	// 	else :
	// 		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	// 	endif;
	// }
	// public function rekening_acuan_hapus($id)
	// {
	// 	if (has_permission('User')) :
	// 		try {
	// 			$this->ssh_rekening->delete($id);
	// 		} catch (\Exception $e) {
	// 			session()->setFlashdata('error', 'Data Gagal di hapus.');
	// 			return redirect()->back();
	// 		}
	// 		session()->setFlashdata('pesan', 'Data berhasil di hapus.');
	// 		return redirect()->back();
	// 	else :
	// 		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	// 	endif;
	// }
	// public function AmbilKelompok()
	// {
	// 	$akun_id = $this->request->getVar('id');
	// 	$data = $this->ssh->getkelompok($akun_id);

	// 	echo json_encode($data);
	// }
	// public function AmbilJenis()
	// {
	// 	$kelompok_id = $this->request->getVar('id');
	// 	$data = $this->ssh->getjenis($kelompok_id);

	// 	echo json_encode($data);
	// }
	// public function AmbilObjek()
	// {
	// 	$jenis_id = $this->request->getVar('id');
	// 	$data = $this->ssh->getobjek($jenis_id);

	// 	echo json_encode($data);
	// }
	// public function AmbilRincianObjek()
	// {
	// 	$objek_id = $this->request->getVar('id');
	// 	$data = $this->ssh->getrincianobjek($objek_id);

	// 	echo json_encode($data);
	// }
	// public function AmbilSubRincianObjek()
	// {
	// 	$rincianobjek_id = $this->request->getVar('id');
	// 	$data = $this->ssh->getsubrincianobjek($rincianobjek_id);

	// 	echo json_encode($data);
	// }
	// public function AmbilType()
	// {
	// 	$subrincianobjek_id = $this->request->getVar('id');
	// 	$data = $this->ssh->gettype($subrincianobjek_id);

	// 	echo json_encode($data);
	// }
	// public function pengajuan_add()
	// {
	// 	if (has_permission('User')) :
	// 		// $akun = $this->akun->where(['kode_jenis_akun' => '1'])->findAll();
	// 		$akun = $this->akun->findAll();
	// 		$data = [
	// 			'gr' => 'ssh',
	// 			'mn' => 'ssh_pengajuan',
	// 			'lok' => '<a href="/user/ssh/ssh_pengajuan">Pengajuan</a> -> <b>Tambah Pengajuan</b>',
	// 			'akun' => $akun,
	// 			'validation' => \Config\Services::validation(),
	// 		];
	// 		echo view('user/Ssh/ssh_add', $data);
	// 	else :
	// 		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	// 	endif;
	// }
	// public function ssh_create()
	// {
	// 	if (has_permission('User')) :
	// 		$this->ssh->save([
	// 			'komponen' => $this->request->getVar('komponen'),
	// 			'spesifikasi' => $this->request->getVar('spesifikasi'),
	// 			'satuan' => $this->request->getVar('satuan'),
	// 			'harga' => $this->request->getVar('harga'),
	// 			'tkdn' => $this->request->getVar('tkdn'),
	// 			'kelompok' => $this->request->getVar('type'),
	// 			'jenis_rincian_objek_sub_id' => $this->request->getVar('sub_rincian_objek'),
	// 			'opd_id' => user()->opd_id,
	// 			'tahun' => $_SESSION['tahun'],
	// 			'created_by' => user()->full_name,
	// 		]);

	// 		session()->setFlashdata('pesan', 'Data berhasil di simpan.');
	// 		return redirect()->to(base_url() . '/user/ssh/ssh_pengajuan');
	// 	else :
	// 		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	// 	endif;
	// }

	// public function pengajuan_edit($id)
	// {
	// 	if (has_permission('User')) :
	// 		//$akun = $this->akun->where(['kode_jenis_akun' => '1'])->findAll();
	// 		$akun = $this->akun->findAll();
	// 		$ssh = $this->ssh->ssh_edit($id);
	// 		$data = [
	// 			'gr' => 'ssh',
	// 			'mn' => 'ssh_pengajuan',
	// 			'lok' => '<a href="/user/ssh/ssh_pengajuan">Pengajuan</a> -> <b>Ubah Pengajuan</b>',
	// 			'akun' => $akun,
	// 			'ssh' => $ssh,
	// 			'validation' => \Config\Services::validation(),
	// 		];
	// 		//dd($ssh);
	// 		echo view('user/Ssh/ssh_acuan_edit', $data);
	// 	else :
	// 		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	// 	endif;
	// }
	// public function ssh_update()
	// {
	// 	if (has_permission('User')) :
	// 		$this->ssh->save([
	// 			'id_ssh' => $this->request->getVar('id_ssh'),
	// 			'komponen' => $this->request->getVar('komponen'),
	// 			'spesifikasi' => $this->request->getVar('spesifikasi'),
	// 			'satuan' => $this->request->getVar('satuan'),
	// 			'harga' => $this->request->getVar('harga'),
	// 			'tkdn' => $this->request->getVar('tkdn'),
	// 			'kelompok' => $this->request->getVar('type'),
	// 			'jenis_rincian_objek_sub_id' => $this->request->getVar('sub_rincian_objek'),
	// 			'opd_id' => user()->opd_id,
	// 			'tahun' => $_SESSION['tahun'],
	// 			'created_by' => user()->full_name,
	// 		]);

	// 		$this->verifikasi_ssh->save([
	// 			'ssh_id' => $this->request->getVar('id_ssh'),
	// 			'verifikasi' => 'perbup_edit',
	// 			'opd_id' => user()->opd_id,
	// 			'tahun' => $_SESSION['tahun'],
	// 			'created_by' => user()->full_name,
	// 		]);

	// 		session()->setFlashdata('pesan', 'Data berhasil di simpan.');
	// 		return redirect()->to(base_url() . '/user/ssh/ssh_pengajuan');
	// 	else :
	// 		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	// 	endif;
	// }
	// public function ssh_hapus($id)
	// {
	// 	if (has_permission('User')) :
	// 		try {
	// 			$this->ssh->delete($id);
	// 		} catch (\Exception $e) {
	// 			session()->setFlashdata('error', 'Data Gagal di hapus.');
	// 			return redirect()->back();
	// 		}
	// 		session()->setFlashdata('pesan', 'Data berhasil di hapus.');
	// 		return redirect()->back();
	// 	else :
	// 		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	// 	endif;
	// }

	// ---------------------------------------------------------
}
