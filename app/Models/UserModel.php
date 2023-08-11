<?php

// app/Models/PaguModel.php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'lampiran_st_sheet1'; // Ganti dengan nama tabel yang sesuai
    protected $allowedFields = ['Nama_Pegawai', 'NIP_Pegawai']; // Kolom yang diizinkan untuk diisi
}