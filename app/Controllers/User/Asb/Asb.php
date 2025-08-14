<?php

namespace App\Controllers\User\Asb;

use App\Controllers\BaseController;
use App\Models\User\Asb\Model_asb;
use App\Models\Admin\User\Model_bidang;
use App\Models\Admin\Permen\Model_jenis_rincian_objek_sub;
use App\Models\User\Asb\Model_asb_hspk;
use App\Models\User\Hspk\Model_hspk_komponen;

class Asb extends BaseController
{
	protected $asb, $opd, $akun, $sub_rincian_objek, $hspk_komponen, $asb_hspk;

	public function __construct()
	{
		$this->asb = new Model_asb();
		$this->asb_hspk = new Model_asb_hspk();
		$this->opd = new Model_bidang();
		$this->sub_rincian_objek = new Model_jenis_rincian_objek_sub();
		$this->hspk_komponen = new Model_hspk_komponen();
	}

	public function index()
	{
		if (has_permission('User')) :
			// $asb = $this->asb->where(['opd_id' => user()->opd_id, 'tahun' => $_SESSION['tahun']])->findAll();
			// $opd = $this->opd->find($id);
			$data = [
				'gr' => 'asb',
				'mn' => 'asb',
				'lok' => '<b>ASB</b>',
				'asb' => $this->asb->where(['opd_id' => user()->opd_id])->findAll(),
				'asb_hspk' => $this->asb_hspk,
				'db' => \Config\Database::connect(),
			];
			echo view('user/Asb/asb', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}

	public function asb_add()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'asb',
				'mn' => 'asb',
				'lok' => '<a href="/user/asb/asb">ASB</a> -> <b>Tambah ASB</b>',
				'sub_rincian_objek' => $this->sub_rincian_objek->where(['kelompok_id' => 'ASB'])->findAll(),
				'hspk' => $this->asb->hspk(),
				'db' => \Config\Database::connect(),
				'validation' => \Config\Services::validation(),
			];
			// dd($data);
			echo view('user/Asb/asb_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function asb_create()
	{
		if (has_permission('User')) :

			// --------------
			$this->asb->transStart();

			// Insert data ke table1
			$data1 = [
				'asb_paket' => $this->request->getVar('nm_paket'),
				'asb_spesifikasi' => $this->request->getVar('spesifikasi'),
				'jenis_rincian_objek_sub_id' => $this->request->getVar('sub_rincian_objek'),
				'asb_satuan' => $this->request->getVar('satuan'),
				'opd_id' => user()->opd_id,
				'tahun' => $_SESSION['tahun'],
				'created_by' => user()->full_name,
			];
			$this->asb->insert($data1);
			$table1_id = $this->asb->InsertID(); // Mendapatkan ID dari insert table1

			// Insert data ke table2 dengan referensi ke table1_id
			for ($i = 0; $i < count($this->request->getVar('hspk')); $i++) {
				$data = [
					'asb_id' => $table1_id,
					'hspk_id' => $this->request->getVar('hspk')[$i],
					'jumlah' => str_replace(",", ".", $this->request->getVar('jumlah'))[$i],
					'opd_id' => user()->opd_id,
					'tahun' => $_SESSION['tahun'],
					'created_by' => user()->full_name,
				];

				$this->asb_hspk->insert($data);
			}

			// Selesaikan transaksi
			$this->asb->transComplete();
			// --------------

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/asb/asb');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function asb_edit($id)
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'asb',
				'mn' => 'asb',
				'lok' => '<a href="/user/asb/asb">ASB</a> -> <b>Ubah ASB</b>',
				'hspk' => $this->asb->hspk(),
				'asb' => $this->asb->asb($id),
				'asb_hspk' => $this->asb_hspk
					->join('tb_hspk', 'tb_asb_hspk.hspk_id = tb_hspk.id_hspk', 'LEFT')
					->where('asb_id', $id)->findAll(),
				'sub_rincian_objek' => $this->sub_rincian_objek->where(['kelompok_id' => 'ASB'])->findAll(),
				'db' => \Config\Database::connect(),
				'validation' => \Config\Services::validation(),
			];
			echo view('user/Asb/asb_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function asb_update()
	{
		if (has_permission('User')) :
			// Insert data ke table1
			$data1 = [
				'id_asb' => $this->request->getVar('id_asb'),
				'asb_paket' => $this->request->getVar('nm_paket'),
				'jenis_rincian_objek_sub_id' => $this->request->getVar('sub_rincian_objek'),
				'asb_satuan' => $this->request->getVar('satuan'),
				'asb_spesifikasi' => $this->request->getVar('spesifikasi'),
				'updated_by' => user()->full_name,
			];
			$this->asb->save($data1);

			// ------------------------------------
			for ($i = 0; $i < count($this->request->getVar('hspk')); $i++) {
				if (empty($this->request->getVar('id_asb_hspk')[$i])) {
					$data = [
						'asb_id' => $this->request->getVar('id_asb'),
						'hspk_id' => $this->request->getVar('hspk')[$i],
						'jumlah' => str_replace(",", ".", $this->request->getVar('jumlah'))[$i],
						'opd_id' => user()->opd_id,
						'tahun' => $_SESSION['tahun'],
						'created_by' => user()->full_name,
					];
					$this->asb_hspk->insert($data);
				}
			}

			for ($i = 0; $i < count($this->request->getVar('hspk')); $i++) {
				if (!empty($this->request->getVar('id_asb_hspk')[$i])) {
					$data = [
						'updated_by' => user()->full_name,
					];
					$this->asb_hspk->update($this->request->getVar('id_asb_hspk')[$i], $data);
				}
			}
			// ------------------------------------


			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/asb/asb');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function asb_hapus($id)
	{
		if (has_permission('User')) :
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
	public function hapus_asb_hspk()
	{
		// Tangkap data yang dikirim melalui AJAX
		$id = $this->request->getVar('id');

		// Lakukan validasi data jika diperlukan

		// Lakukan operasi insert data ke database
		// Misalnya:
		$this->asb_hspk->delete($id);

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
	}
}
