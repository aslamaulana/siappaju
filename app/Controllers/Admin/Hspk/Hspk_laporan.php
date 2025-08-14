<?php

namespace App\Controllers\Admin\Hspk;

use App\Controllers\BaseController;
use App\Models\Admin\Hspk\Model_hspk;
use App\Models\Admin\User\Model_bidang;
use Dompdf\Dompdf;
use Dompdf\Options;

class Hspk_laporan extends BaseController
{
	protected $hspk, $opd;

	public function __construct()
	{
		$this->hspk = new Model_hspk();
		$this->opd = new Model_bidang();
	}

	public function index()
	{
		if (has_permission('Admin')) :
			$opd = $this->opd->skpd();
			$data = [
				'gr' => 'laporan',
				'mn' => 'a-hspk-laporan',
				'lok' => '<b>HSPK Laporan</b>',
				'opd' => $opd,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Hspk/hspk_laporan', $data);
		else :
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		endif;
	}
	public function cetak()
	{
		if (has_permission('Admin')) {
			$type = $this->request->getVar('type');
			if ($type == 'excel') {
				$filename = "Print Data" . "-" . date('Y-m-d') . ".xls";

				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment; filename="' . $filename . '";');

				$id = $this->request->getVar('opd');
				if ($id == 'all') {
					$hspk = $this->hspk->hspk_cetak();
				} else {
					$hspk = $this->hspk->hspk_cetak_filter($id);
				}
				$data = [
					'lok' => '<b>Data</b>',
					'hspk' => $hspk,
					'db' => \Config\Database::connect(),
				];
				return view('admin/Hspk/print_excel', $data);
			} elseif ($type == 'pdf') {
				$id = $this->request->getVar('opd');

				if ($id == 'all') {
					$hspk = $this->hspk->hspk_cetak();
				} else {
					$hspk = $this->hspk->hspk_cetak_filter($id);
				}

				$data = [
					'lok' => '<b>Data</b>',
					'hspk' => $hspk,
					'db' => \Config\Database::connect(),
				];
				// return view('surat/disposisi_print', $data);
				$html = view('admin/Hspk/print_pdf', $data);

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
				$dompdf->stream('Lembar Disposisi-' . date('d-m-Y H:i'), array("Attachment" => false));
			}
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
	}
}
