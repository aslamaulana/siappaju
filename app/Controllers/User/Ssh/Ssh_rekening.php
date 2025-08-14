<?php

namespace App\Controllers\User\Ssh;

use App\Controllers\BaseController;
use App\Models\User\Ssh\Model_ssh_rekening;
use App\Models\User\Ssh\Model_ssh;
use App\Models\Admin\Rekening\Model_rekening_akun;

class Ssh_rekening extends BaseController
{
	protected $ssh_rekening, $ssh, $akun;

	public function __construct()
	{
		$this->ssh_rekening = new Model_ssh_rekening();
		$this->akun = new Model_rekening_akun();
		$this->ssh = new Model_ssh();
	}

	public function rekening($id)
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'ssh',
				'mn' => 'ssh_pengajuan',
				'lok' => '<a href="/user/ssh/ssh_pengajuan">Pengajuan</a> -> <b>Rekening</b>',
				'rekening' => $this->ssh_rekening->ssh_rekening($id),
				'ssh' => $this->ssh->find($id),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Ssh/ssh_rekening', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// public function AmbilKelompok()
	// {
	// 	$akun_id = $this->request->getVar('id');
	// 	$data = $this->ssh_rekening->getkelompok($akun_id);

	// 	echo json_encode($data);
	// }
	// public function AmbilJenis()
	// {
	// 	$kelompok_id = $this->request->getVar('id');
	// 	$data = $this->ssh_rekening->getjenis($kelompok_id);

	// 	echo json_encode($data);
	// }
	// public function AmbilObjek()
	// {
	// 	$jenis_id = $this->request->getVar('id');
	// 	$data = $this->ssh_rekening->getobjek($jenis_id);

	// 	echo json_encode($data);
	// }
	// public function AmbilRincianObjek()
	// {
	// 	$objek_id = $this->request->getVar('id');
	// 	$data = $this->ssh_rekening->getrincianobjek($objek_id);

	// 	echo json_encode($data);
	// }
	// public function AmbilSubRincianObjek()
	// {
	// 	$rincianobjek_id = $this->request->getVar('id');
	// 	$data = $this->ssh_rekening->getsubrincianobjek($rincianobjek_id);

	// 	echo json_encode($data);
	// }
	// public function rekening_add($id)
	// {
	// 	if (has_permission('User')) :
	// 		$ssh = $this->ssh->find($id);
	// 		$akun = $this->akun->findAll();
	// 		$data = [
	// 			'gr' => 'ssh',
	// 			'mn' => 'ssh_pengajuan',
	// 			'lok' => '<a href="/user/ssh/ssh_pengajuan">Pengajuan</a> -> <b>Tambah Pengajuan</b>',
	// 			'lok' => 'Pengajuan -> <a href="/user/ssh/ssh_rekening/rekening/' . $id . '">Rekening</a> -> <b>Tambah Rekening</b>',
	// 			'akun' => $akun,
	// 			'id_ssh' => $id,
	// 			'ssh' => $ssh,
	// 			'validation' => \Config\Services::validation(),
	// 		];
	// 		echo view('user/Ssh/ssh_rekening_add', $data);
	// 	else :
	// 		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	// 	endif;
	// }

	// public function rekening_create()
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
	// 		return redirect()->to(base_url() . '/user/ssh/ssh_rekening/rekening/' . $this->request->getVar('id_ssh'));
	// 	else :
	// 		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	// 	endif;
	// }
	// public function rekening_hapus($id)
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

	// ---------------------------------------------------------
}
