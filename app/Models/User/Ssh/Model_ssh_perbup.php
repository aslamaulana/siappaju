<?php

namespace App\Models\User\Ssh;

use CodeIgniter\Model;

class Model_ssh_perbup extends Model
{
	protected $table = 'tb_ssh_perbup';
	protected $useTimestamps = true;
	protected $primaryKey = 'id_ssh_perbup';
	protected $allowedFields = ['komponen', 'jenis_rincian_objek_sub_id', 'spesifikasi', 'satuan', 'opd_id', 'harga', 'tkdn', 'keterangan', 'kelompok', 'tahun', 'created_by', 'updated_by', 'created_at', 'updated_at'];
}
