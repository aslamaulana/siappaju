<?php

namespace App\Controllers\Admin\Sshsbu;

use App\Controllers\BaseController;
use App\Models\Admin\Sshsbu\Model_ssh;
use App\Models\Admin\User\Model_bidang;
use Dompdf\Dompdf;
use Dompdf\Options;

class Sshhspk_laporan extends BaseController
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
				'mn' => 'sshhspk_laporan',
				'lok' => '<b>SSH,ASB,HSPK,ASB Laporan</b>',
				'opd' => $opd,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Sshsbu/sshhspk_laporan', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function cetak()
	{
		if (has_permission('Admin')) {
			$type = $this->request->getVar('type');
			if ($type == 'excel') {
				$filename = "SSH-SBU-HSPK" . "-" . date('Y-m-d') . ".xls";

				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment; filename="' . $filename . '";');

				$id = $this->request->getVar('opd');

				$data = [
					'lok' => '<b>Data</b>',
					'opd' => $id,
					'db' => \Config\Database::connect(),
				];
				return view('admin/Sshsbu/sshhspk_laporan_excel_all', $data);
			} elseif ($type == 'pdf') {
				$id = $this->request->getVar('opd');
				$filename = "SSH-SBU-HSPK" . "-" . date('Y-m-d');

				$data = [
					'lok' => '<b>Data</b>',
					'opd' => $id,
					'db' => \Config\Database::connect(),
				];
				// return view('surat/disposisi_print', $data);
				$html = view('admin/Sshsbu/sshhspk_laporan_excel', $data);

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
