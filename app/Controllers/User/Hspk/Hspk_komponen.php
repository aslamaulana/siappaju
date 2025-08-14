<?php

namespace App\Controllers\User\Hspk;

use App\Controllers\BaseController;
use App\Models\User\Hspk\Model_hspk_komponen;
use App\Models\User\Hspk\Model_hspk;

class Hspk_komponen extends BaseController
{
	protected $hspk, $hspk1;

	public function __construct()
	{
		$this->hspk = new Model_hspk_komponen();
		$this->hspk1 = new Model_hspk();
	}

	public function data($id)
	{
		if (has_permission('User')) :
			$A = $this->hspk->hspk_komponen_A($id);
			$B = $this->hspk->hspk_komponen_B($id);
			$C = $this->hspk->hspk_komponen_C($id);
			$hspk1 = $this->hspk1->find($id);
			$data = [
				'gr' => 'hspk',
				'mn' => 'hspk',
				'lok' => '<a href="/user/hspk/hspk">HSPK</a> / <b>HSPK Komponen</b>',
				'A' => $A,
				'B' => $B,
				'C' => $C,
				'hspk1' => $hspk1,
				'id_hspk' => $id,
				'db' => \Config\Database::connect(),
			];
			echo view('user/Hspk/hspk_komponen', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function ambil_ssh()
	{
		$ssh = $this->request->getVar('id');
		$data = $this->hspk->getssh($ssh);

		echo json_encode($data);
	}
	public function data_add($id)
	{
		if (has_permission('User')) :
			// $ssh = $this->hspk->ssh();
			$data = [
				'gr' => 'hspk',
				'mn' => 'hspk',
				'lok' => 'HSPK -> <a href="/user/hspk/hspk_komponen/data/' . $id . '">HSPK Komponen</a> / <b>Tambah HSPK Komponen</b>',
				// 'ssh' => $ssh,
				'id_hspk' => $id,
			];
			echo view('user/Hspk/hspk_komponen_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function data_create()
	{
		if (has_permission('User')) :
			$this->hspk->save([
				'hspk_id' => $this->request->getVar('id_hspk'),
				'ssh_id' => $this->request->getVar('ssh'),
				'index' => str_replace(",", ".", $this->request->getVar('index')),
				'group' => $this->request->getVar('group'),
				'tahun' => $_SESSION['tahun'],
				'created_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/hspk/hspk_komponen/data/' . $this->request->getVar('id_hspk'));
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function data_edit($id, $id_hspk)
	{
		if (has_permission('User')) :
			$data = $this->hspk->find($id);
			$data = [
				'gr' => 'hspk',
				'mn' => 'hspk',
				'lok' => 'HSPK -> <a href="/user/hspk/hspk_komponen/data/' . $id_hspk . '">HSPK Komponen</a> / <b>Ubah HSPK Komponen</b>',
				'data' => $data,
				'id_hspk' => $id_hspk,
			];
			echo view('user/Hspk/hspk_komponen_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function data_update()
	{
		if (has_permission('User')) :
			$this->hspk->save([
				'id_hspk_komponen' => $this->request->getVar('id'),
				'index' => str_replace(",", ".", $this->request->getVar('index')),
				'updated_by' => user()->full_name,
			]);

			session()->setFlashdata('pesan', 'Data berhasil di simpan.');
			return redirect()->to(base_url() . '/user/hspk/hspk_komponen/data/' . $this->request->getVar('id_hspk'));
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function data_hapus($id)
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

	// ---------------------------------------------------------
}
