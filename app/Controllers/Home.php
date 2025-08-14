<?php

namespace App\Controllers;

class Home extends BaseController
{
	protected $session;

	function __construct()
	{
		$this->session = \Config\Services::session();
		$this->session->start();
	}
	public function index()
	{
		if (has_permission('Admin')) :
			$data = [
				'gr' => 'home',
				'mn' => 'home',
				'title' => 'SIAPPaJu',
				'lok' => '<a href="."></b>',
				'db' => \Config\Database::connect(),
			];

			if (!isset($_SESSION['tahun'])) {
				try {
					$this->session->set('tahun', date('Y') + 1);
				} catch (\Exception $e) {
				}
				return redirect()->to(base_url('/'))->with('tahun2', date('Y') + 1);
			}

			echo view('admin/dashboard', $data);
		elseif (has_permission('User')) :
			$data = [
				'gr' => 'home',
				'mn' => 'home',
				'title' => 'SIAPPaJu',
				'lok' => '<a href="."></b>',
				'db' => \Config\Database::connect(),
			];

			if (!isset($_SESSION['tahun'])) {
				try {
					$this->session->set('tahun', date('Y') + 1);
				} catch (\Exception $e) {
				}
				return redirect()->to(base_url('/'))->with('tahun2', date('Y') + 1);
			}

			echo view('user/dashboard', $data);
		endif;
	}
	public function Set_Tahun($tahun)
	{
		$this->session->set('tahun', $tahun);

		return redirect()->to(base_url('/'))->with('tahun2', $tahun);
	}
	public function max($id)
	{
		if ($id == 'max') {
			$this->session->set('max', 'maximized-card');
		} else {
			$this->session->remove('max');
		}

		return redirect()->back();
	}
}
