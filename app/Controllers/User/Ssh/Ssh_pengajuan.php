<?php

namespace App\Controllers\User\Ssh;

use App\Controllers\BaseController;
use App\Models\User\Ssh\Model_ssh;
use App\Models\Admin\Permen\Model_jenis_akun;
use App\Models\Admin\Permen\Model_jenis_rincian_objek_sub;
use App\Models\Admin\Rekening\Model_rekening_rincian_objek_sub;
use App\Models\User\Ssh\Model_ssh_rekening;

class Ssh_pengajuan extends BaseController
{
	protected $ssh, $akun, $rekening, $ssh_rekening, $jenis_rincian_objek_sub;

	public function __construct()
	{
		$this->ssh = new Model_ssh();
		$this->akun = new Model_jenis_akun();
		$this->rekening = new Model_rekening_rincian_objek_sub();
		$this->ssh_rekening = new Model_ssh_rekening();
		$this->jenis_rincian_objek_sub = new Model_jenis_rincian_objek_sub();
	}

	public function index()
	{
		if (!has_permission('User')) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$data = [
			'gr'  => 'ssh',
			'mn'  => 'ssh_pengajuan',
			'lok' => '<b>Pengajuan</b>',
			'ssh' => $this->ssh->ssh_opd(),
			'rek' => $this->rekening->findAll(),
			'db'  => \Config\Database::connect(),
		];

		return view('user/Ssh/ssh', $data);
	}

	public function AmbilType()
	{
		$subrincianobjek_id = $this->request->getVar('id');
		$data = $this->ssh->gettype($subrincianobjek_id);

		echo json_encode($data);
	}
	public function AmbilSubRincianObjekFilter() //Filter Berdasarkan SSH/SBU
	{
		$id = $this->request->getVar('id');
		$data = $this->jenis_rincian_objek_sub->where('kelompok_id', $id)->get()->getResult();

		echo json_encode($data);
	}

	public function getRekeningBySsh($id_ssh)
	{
		$rekening = $this->ssh_rekening->ssh_rekening_findAll($id_ssh);
		// getRekening ambil join tabel rekening dari database

		return $this->response->setJSON($rekening);
	}

	public function ssh_create()
	{
		if (!has_permission('User')) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		// Mulai transaksi
		$this->ssh->transStart();
		// Insert data ke table1
		$data1 = [
			'komponen' 	  => $this->request->getVar('komponen'),
			'spesifikasi' => $this->request->getVar('spesifikasi'),
			'satuan'	  => $this->request->getVar('satuan'),
			'harga' 	  => $this->request->getVar('harga'),
			'tkdn' 		  => $this->request->getVar('tkdn'),
			'kelompok' 	  => $this->request->getVar('jenis'),
			'jenis_rincian_objek_sub_id' => $this->request->getVar('sub_rincian_objek'),
			'opd_id'	  => user()->opd_id,
			'tahun' 	  => $_SESSION['tahun'],
			'created_by'  => user()->full_name,
		];
		$this->ssh->insert($data1);
		$table1_id = $this->ssh->InsertID(); // Mendapatkan ID dari insert table1

		// Insert data ke table2 dengan referensi ke table1_id
		for ($i = 0; $i < count($this->request->getVar('rekening')); $i++) {
			$data = [
				'ssh_id' 	 => $table1_id,
				'rekening_rincian_objek_sub_id' => $this->request->getVar('rekening')[$i],
				'opd_id' 	 => user()->opd_id,
				'tahun' 	 => $_SESSION['tahun'],
				'created_by' => user()->full_name,
			];

			$this->ssh_rekening->insert($data);
		}

		// Selesaikan transaksi
		$this->ssh->transComplete();

		session()->setFlashdata('pesan', 'Data berhasil di simpan.');
		return redirect()->to(base_url() . '/user/ssh/ssh_pengajuan');
	}

	public function ssh_update($id)
	{
		if (!has_permission('User')) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$this->ssh->save([
			'id_ssh' 	  => $id,
			'komponen'    => $this->request->getVar('komponen'),
			'spesifikasi' => $this->request->getVar('spesifikasi'),
			'satuan' 	  => $this->request->getVar('satuan'),
			'harga' 	  => $this->request->getVar('harga'),
			'tkdn' 		  => $this->request->getVar('tkdn'),
			'kelompok'    => $this->request->getVar('jenis'),
			'jenis_rincian_objek_sub_id' => $this->request->getVar('sub_rincian_objek'),
			'updated_by'  => user()->full_name,
		]);

		// ------------------------------------
		for ($i = 0; $i < count($this->request->getVar('rekening')); $i++) {
			if (empty($this->request->getVar('id')[$i])) {
				$data = [
					'ssh_id' 	 => $id,
					'rekening_rincian_objek_sub_id' => $this->request->getVar('rekening')[$i],
					'opd_id' 	 => user()->opd_id,
					'tahun'  	 => $_SESSION['tahun'],
					'created_by' => user()->full_name,
				];
				$this->ssh_rekening->insert($data);
			}
		}

		for ($i = 0; $i < count($this->request->getVar('rekening')); $i++) {
			if (!empty($this->request->getVar('id')[$i])) {
				$data = [
					'rekening_rincian_objek_sub_id' => $this->request->getVar('rekening')[$i],
					'updated_by' => user()->full_name,
				];
				$this->ssh_rekening->update($this->request->getVar('id')[$i], $data);
			}
		}
		// ------------------------------------

		session()->setFlashdata('pesan', 'Data berhasil di simpan.');
		return redirect()->to(base_url() . '/user/ssh/ssh_pengajuan');
	}
	public function ssh_hapus($id)
	{
		if (!has_permission('User')) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		try {
			$this->ssh->delete($id);
		} catch (\Exception $e) {
			session()->setFlashdata('error', 'Data Gagal di hapus.');
			return redirect()->back();
		}
		session()->setFlashdata('pesan', 'Data berhasil di hapus.');
		return redirect()->back();
	}

	// ---------------------------------------------------------
	public function deleteRekening($id_ssh_rekening)
	{
		$deleted = $this->ssh_rekening->table('tb_ssh_rekening')
			->where('id_ssh_rekening', $id_ssh_rekening)
			->delete();

		if ($deleted) {
			return $this->response->setJSON(['status' => 'success']);
		} else {
			return $this->response->setJSON(['status' => 'error']);
		}
	}

	// ---------------------------------------------------------
}
