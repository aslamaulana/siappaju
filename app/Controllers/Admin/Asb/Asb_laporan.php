<?php

namespace App\Controllers\Admin\Asb;

use App\Controllers\BaseController;
use App\Models\Admin\Asb\Model_asb;
use App\Models\Admin\User\Model_bidang;
use Dompdf\Dompdf;
use Dompdf\Options;

class Asb_laporan extends BaseController
{
	protected $asb, $opd;

	public function __construct()
	{
		$this->asb = new Model_asb();
		$this->opd = new Model_bidang();
	}

	public function index()
	{
		if (has_permission('Admin')) :
			$opd = $this->opd->skpd();
			$data = [
				'gr' => 'laporan',
				'mn' => 'a-asb-laporan',
				'lok' => '<b>ASB Laporan</b>',
				'opd' => $opd,
				'db' => \Config\Database::connect(),
			];
			echo view('admin/Asb/asb_laporan', $data);
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
					$asb = $this->asb->asb_cetak();
				} else {
					$asb = $this->asb->asb_cetak_filter($id);
				}
				$data = [
					'lok' => '<b>Data</b>',
					'asb' => $asb,
					'db' => \Config\Database::connect(),
				];
				return view('admin/Asb/print_excel', $data);
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
				$html = view('admin/Asb/print_pdf', $data);

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
