<?php

namespace App\Controllers\Admin\user;

use CodeIgniter\HTTP\IncomingRequest;

/**
 * @property IncomingRequest $request
 */

use App\Controllers\BaseController;
use App\Models\Admin\User\Model_users;
use App\Models\Admin\User\Model_bidang;
use App\Models\Admin\User\Model_groups_users;

class Users extends BaseController
{
	protected $users, $bidang, $group_users;

	public function __construct()
	{
		$this->users = new Model_users();
		$this->bidang = new Model_bidang();
		$this->group_users = new Model_groups_users();
	}
	public function index()
	{
		if (in_groups('Superadmin')) :
			$users = $this->users->Users();
			$data = [
				'gr' => 'skpd',
				'mn' => 'users',
				'title' => 'Users',
				'lok' => 'User Skpd',
				'users' => $users,
			];
			return view('admin/User/users', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function user($id)
	{
		if (in_groups('Superadmin')) :
			$users = $this->users->Users2($id);
			$data = [
				'gr' => 'skpd',
				'mn' => 'skpd',
				'title' => 'Admin | OPD',
				'lok' => '<a href="/admin/user/bidang">OPD</a> -> <b>User OPD</b>',
				'users' => $users,
				'opd_id' => $id,
			];
			return view('admin/User/users', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function users_add($id = '')
	{
		if (in_groups('Superadmin')) :
			// $bidang = $this->bidang->Groups();
			$users = $this->users->buat_kode();
			$data = [
				'gr' => 'skpd',
				'mn' => 'skpd',
				'title' => 'Admin | OPD',
				'lok' => 'OPD -> <a href="/admin/user/users/user/' . $id . '">User OPD</a> -> <b>Tambah User OPD</b>',
				'validation' => \Config\Services::validation(),
				// 'bidang' => $bidang,
				'users_id' => $users,
				'opd_id' => $id,

			];
			return view('admin/User/users_add', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function users_create()
	{
		if (!$this->validate([
			'akses' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'harus di isi',
				]
			],
			'username' => [
				'rules' => 'required|is_unique[users.username]',
				'errors' => [
					'required' => 'harus di isi',
					'is_unique' => 'Username Sudah Ada'
				]
			],
			'password' => [
				'rules' => 'required|min_length[8]',
				'errors' => [
					'required' => 'harus di isi',
					'min_length' => 'Password Min 8 Digit'
				]
			],
			'password_k' => [
				'rules' => 'required|matches[password]',
				'errors' => [
					'required' => 'harus di isi',
					'matches' => 'Password Tidak Sama'
				]
			],
			'email' => [
				'rules' => 'required|valid_email|is_unique[users.email]',
				'errors' => [
					'required' => 'harus di isi',
					'is_unique' => 'Email Sudah Ada',
					'valid_email' => 'Isikan email dengan benar'
				]
			],
		])) {
			return redirect()->to(base_url() . '/admin/User/users/users_add/' . $this->request->getVar('akses'))->withInput();
		}

		$options = $this->request->getVar('password');
		// $hus = password_hash(base64_encode(hash('sha384', $options, true)), PASSWORD_DEFAULT);
		$hus = \Myth\Auth\Password::hash($options); //has password
		$this->users->save([
			'id' => buka($this->request->getVar('id')),
			'username' => $this->request->getVar('username'),
			'password_hash' => $hus,
			'full_name' => $this->request->getVar('nm'),
			'email' => $this->request->getVar('email'),
			'active' => $this->request->getVar('active'),
			'opd_id' => buka($this->request->getVar('akses')),
		]);
		$this->group_users->save([
			'group_id' => buka($this->request->getVar('akses')),
			'user_id' => buka($this->request->getVar('id')),
		]);

		session()->setFlashdata('pesan', 'Data berhasil di simpan.');
		return redirect()->to(base_url() . '/admin/user/users/user/' . $this->request->getVar('akses'));
	}
	public function users_edit($bidang, $id)
	{
		if (in_groups('Superadmin')) :
			// $bidang = $this->bidang->Groups();
			$users = $this->users->Edit($id);
			$data = [
				'gr' => 'skpd',
				'mn' => 'skpd',
				'title' => 'Admin | OPD',
				'lok' => 'OPD -> <a href="/admin/user/users/user/' . $bidang . '">User OPD</a> -> <b>Ubah User OPD</b>',
				'validation' => \Config\Services::validation(),
				'bidang' => $bidang,
				'users' => $users,
			];
			return view('admin/User/users_edit', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function users_update()
	{
		$this->users->save([
			'id' => buka($this->request->getVar('id')),
			'username' => $this->request->getVar('username'),
			'full_name' => $this->request->getVar('nm'),
			'email' => $this->request->getVar('email'),
			'active' => $this->request->getVar('active'),
		]);

		session()->setFlashdata('pesan', 'Data berhasil di simpan.');
		return redirect()->to(base_url() . '/admin/user/users/user/' . $this->request->getVar('opd_id'));
	}
	public function hapus($id)
	{
		try {
			$this->users->delete($id);
		} catch (\Exception $e) {
			session()->setFlashdata('error', 'Data Gagal di hapus.');
			return redirect()->back();
		}

		session()->setFlashdata('pesan', 'Data berhasil di hapus.');
		return redirect()->back();
	}
}
