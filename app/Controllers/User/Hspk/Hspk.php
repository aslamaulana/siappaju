<?php

namespace App\Controllers\User\Hspk;

use App\Controllers\BaseController;
use App\Models\User\Hspk\Model_hspk;
use App\Models\Admin\Permen\Model_jenis_akun;
use App\Models\Admin\Permen\Model_jenis_rincian_objek_sub;
use App\Models\User\Hspk\Model_hspk_komponen;
use App\Models\User\Ssh\Model_ssh;

class Hspk extends BaseController
{
	protected $hspk, $akun, $hspk_komponen, $ssh, $jenis_rincian_objek_sub;

	public function __construct()
	{
		$this->hspk = new Model_hspk();
		$this->hspk_komponen = new Model_hspk_komponen();
		$this->akun = new Model_jenis_akun();
		$this->ssh = new Model_ssh();
		$this->jenis_rincian_objek_sub = new Model_jenis_rincian_objek_sub();
	}

	public function index()
	{
		if (has_permission('User')) :
			$data = [
				'gr' => 'hspk',
				'mn' => 'hspk',
				'lok' => '<b>HSPK</b>',
				'hspk' => $this->hspk->hspk(),
				'db' => \Config\Database::connect(),
			];
			echo view('user/Hspk/hspk', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function AmbilSubRincianObjekFilter()
	{
		$search = $this->request->getPost('search');

		$builder = $this->jenis_rincian_objek_sub;
		$builder->where('kelompok_id', 'HSPK');

		if (!empty($search)) {
			$builder->groupStart()
				->like('jenis_rincian_objek_sub', $search)
				->orLike('kode_jenis_rincian_objek_sub', $search)
				->groupEnd();
		}

		$query = $builder->get()->getResultArray();

		return $this->response->setJSON($query);
	}

	public function hspk_add()
	{
		if (has_permission('User')) :
			$data = [
				'gr'     => 'hspk',
				'mn'     => 'hspk',
				'lok'    => '<a href="/user/hspk/hspk">HSPK</a> / <b>Tambah HSPK</b>',
				'satuan' => $this->hspk->getsatuan()->getResultArray(),
				'ssh'    => $this->ssh
					->join('tb_ssh_verifikasi', 'tb_ssh.id_ssh = tb_ssh_verifikasi.ssh_id', 'LEFT')
					->whereIn('verifikasi', ['lolos', 'perbup'])
					->findAll(),
			];
			echo view('user/Hspk/hspk_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function hspk_create()
	{
		if (has_permission('User')) :

			$this->hspk->transStart();

			// Insert data ke table1
			$data1 = [
				'hspk_paket'  => $this->request->getVar('nm_paket'),
				'jenis_rincian_objek_sub_id' => $this->request->getVar('sub_rincian_objek'),
				'hspk_satuan' => $this->request->getVar('satuan'),
				'hspk_spesifikasi' => $this->request->getVar('hspk_spesifikasi'),
				'opd_id'      => user()->opd_id,
				'tahun'       => $_SESSION['tahun'],
				'created_by'  => user()->full_name,
			];
			$this->hspk->insert($data1);
			$table1_id = $this->hspk->InsertID(); // Mendapatkan ID dari insert table1

			// Insert data ke table2 dengan referensi ke table1_id
			for ($i = 0; $i < count($this->request->getVar('ssh')); $i++) {
				$data = [
					'hspk_id' => $table1_id,
					'ssh_id'  => $this->request->getVar('ssh')[$i],
					'index'   => str_replace(",", ".", $this->request->getVar('index'))[$i],
					'group'   => $this->request->getVar('group')[$i],
					'opd_id'  => user()->opd_id,
					'tahun'   => $_SESSION['tahun'],
					'created_by' => user()->full_name,
				];

				$this->hspk_komponen->insert($data);
			}

			// Selesaikan transaksi
			$this->hspk->transComplete();

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/hspk/hspk');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	// ---------------------
	public function hspk_groupA($id)
	{
		// Ambil data yang sudah dikelompokkan
		$dataGrouped = $this->hspk_komponen->hspk_komponen_grouped($id);

		// Pastikan group A ada
		$groupA = isset($dataGrouped['A']) ? $dataGrouped['A'] : [];

		// Kirim JSON ke AJAX
		return $this->response->setJSON($groupA);
	}
	public function hspk_groupB($id)
	{
		// Ambil data yang sudah dikelompokkan
		$dataGrouped = $this->hspk_komponen->hspk_komponen_grouped($id);

		// Pastikan group A ada
		$groupA = isset($dataGrouped['B']) ? $dataGrouped['B'] : [];

		// Kirim JSON ke AJAX
		return $this->response->setJSON($groupA);
	}
	public function hspk_groupC($id)
	{
		// Ambil data yang sudah dikelompokkan
		$dataGrouped = $this->hspk_komponen->hspk_komponen_grouped($id);

		// Pastikan group A ada
		$groupA = isset($dataGrouped['C']) ? $dataGrouped['C'] : [];

		// Kirim JSON ke AJAX
		return $this->response->setJSON($groupA);
	}
	// ---------------------
	public function hspk_edit($id)
	{
		if (has_permission('User')) :
			$komponen = $this->hspk_komponen->hspk_komponen_grouped($id);

			$data = [
				'gr'     => 'hspk',
				'mn'     => 'hspk',
				'lok'    => '<a href="/user/hspk/hspk">HSPK</a> / <b>Edit HSPK</b>',
				'hspk'   => $this->hspk->hspk_edit($id),
				'satuan' => $this->hspk->getsatuan()->getResultArray(),

				'A' => $komponen['A'], // data group A
				'B' => $komponen['B'], // data group B
				'C' => $komponen['C'], // data group C

				'ssh' => $this->ssh
					->join('tb_ssh_verifikasi', 'tb_ssh.id_ssh = tb_ssh_verifikasi.ssh_id', 'LEFT')
					->Where(['verifikasi' =>  'lolos'])
					->orWhere(['verifikasi' => 'perbup'])->findAll(),
			];
			// dd($data);
			echo view('user/Hspk/hspk_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function hspk_update()
	{
		if (has_permission('User')) :

			// Insert data ke table1
			$data1 = [
				'id_hspk'     => $this->request->getVar('id_hspk'),
				'hspk_paket'  => $this->request->getVar('nm_paket'),
				'jenis_rincian_objek_sub_id' => $this->request->getVar('sub_rincian_objek'),
				'hspk_satuan' => $this->request->getVar('satuan'),
				'hspk_spesifikasi' => $this->request->getVar('hspk_spesifikasi'),
				'updated_by'  => user()->full_name,
			];
			$this->hspk->save($data1);

			// ------------------------------------
			for ($i = 0; $i < count($this->request->getVar('ssh')); $i++) {
				if (empty($this->request->getVar('id_hspk_komponen')[$i])) {
					$data = [
						'hspk_id' => $this->request->getVar('id_hspk'),
						'ssh_id'  => $this->request->getVar('ssh')[$i],
						'index'   => str_replace(",", ".", $this->request->getVar('index'))[$i],
						'group'   => $this->request->getVar('group')[$i],
						'opd_id'  => user()->opd_id,
						'tahun'   => $_SESSION['tahun'],
						'created_by' => user()->full_name,
					];
					$this->hspk_komponen->insert($data);
				}
			}

			for ($i = 0; $i < count($this->request->getVar('ssh')); $i++) {
				if (!empty($this->request->getVar('id_hspk_komponen')[$i])) {
					$data = [
						'updated_by' => user()->full_name,
					];
					$this->hspk_komponen->update($this->request->getVar('id_hspk_komponen')[$i], $data);
				}
			}
			// ------------------------------------

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/hspk/hspk');
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function hspk_hapus($id)
	{
		if (has_permission('User')) :
			try {
				$this->hspk->delete($id);
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
	public function hapus_hspk_komponen()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getPost('id');

			if ($id) {
				$delete = $this->hspk_komponen->where('id_hspk_komponen', $id)->delete();

				if ($delete) {
					return $this->response->setJSON([
						'status' => 'success',
						'message' => 'Data berhasil dihapus'
					]);
				}
			}

			return $this->response->setJSON([
				'status' => 'error',
				'message' => 'Gagal menghapus data'
			]);
		}
	}

	// ---------------------------------------------------------
}
