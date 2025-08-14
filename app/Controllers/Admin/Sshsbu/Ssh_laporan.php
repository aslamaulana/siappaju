<?php

namespace App\Controllers\Admin\Sshsbu;

use App\Controllers\BaseController;
use App\Models\Admin\Sshsbu\Model_ssh;
use App\Models\Admin\User\Model_bidang;
use Dompdf\Dompdf;
use Dompdf\Options;

class Ssh_laporan extends BaseController
{
	protected $ssh, $opd;

	public function __construct()
	{
		$this->ssh = new Model_ssh();
		$this->opd = new Model_bidang();
	}

	public function index()
	{
		if (has_permission('Admin')) :
			$opd = $this->opd->skpd();
			$data = [
				'gr' => 'laporan',
				'mn' => 'ssh_laporan',
				'lok' => '<b>SSH Laporan</b>',
				'opd' => $opd,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Sshsbu/ssh_laporan', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function cetak()
	{
		if (has_permission('Admin')) {
			$type = $this->request->getVar('type');
			if ($type == 'excel') {
				$filename = "SSH-SBU" . "-" . date('Y-m-d') . ".xls";

				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment; filename="' . $filename . '";');

				$id = $this->request->getVar('jenis');
				if ($id == 'sshsbu') {
					$ssh = $this->ssh->ssh_cetak_all();
				} elseif ($id == 'ssh') {
					$ssh = $this->ssh->ssh_cetak_ssh($id);
				} else {
					$ssh = $this->ssh->ssh_cetak_sbu($id);
				}
				$data = [
					'lok' => '<b>Data</b>',
					'ssh' => $ssh,
					'db' => \Config\Database::connect(),
				];
				return view('admin/Sshsbu/print_excel', $data);
			} elseif ($type == 'pdf') {
				$id = $this->request->getVar('jenis');
				$filename = "SSH-SBU" . "-" . date('Y-m-d');

				if ($id == 'sshsbu') {
					$ssh = $this->ssh->ssh_cetak_all();
				} elseif ($id == 'ssh') {
					$ssh = $this->ssh->ssh_cetak_ssh($id);
				} else {
					$ssh = $this->ssh->ssh_cetak_sbu($id);
				}
				$data = [
					'lok' => '<b>Data</b>',
					'ssh' => $ssh,
					'db' => \Config\Database::connect(),
				];
				// return view('surat/disposisi_print', $data);
				$html = view('admin/Sshsbu/print_excel', $data);

				$options = new Options();
				$options->set('defaultFont', 'serif');

				// $dompdf = new Dompdf($options);
				$dompdf = new Dompdf($options);
				$dompdf->loadHtml($html, 'UTF-8');

				// (Optional) Setup the paper size and orientation
				$dompdf->setPaper('8.5x13', 'portrait');
				// Render the HTML as PDF
				$dompdf->render();

				// Output the generated PDF to Browser
				// $dompdf->stream();
				$dompdf->stream($filename . date('d-m-Y H:i'), array("Attachment" => false));
			}
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
	}
}
