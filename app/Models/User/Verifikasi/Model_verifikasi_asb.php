<?php

namespace App\Models\User\Verifikasi;

use CodeIgniter\Model;

class Model_verifikasi_asb extends Model
{
	protected $table = 'tb_asb_verifikasi';
	protected $useTimestamps = true;
	protected $useAutoIncrement = false;
	protected $primaryKey = 'asb_id';
	protected $allowedFields = ['asb_id', 'verifikasi', 'verifikasi_keterangan', 'nm_verifikator', 'tahun', 'opd_id', 'created_by', 'updated_by', 'created_at', 'updated_at'];
}
