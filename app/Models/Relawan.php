<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relawan extends Model
{
    protected $table = 'relawans';

    protected $fillable = [
        'user_id',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_telepon',
        'pekerjaan',
        'pendidikan',
        'motivasi',
        'keahlian',
        'pengalaman_organisasi',
        'foto_ktp',
        'status',
        'catatan_admin',
        'disetujui_oleh',
        'disetujui_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getJenisKelaminLabelAttribute()
    {
        return match ($this->jenis_kelamin) {
            'L' => 'Laki-laki',
            'P' => 'Perempuan',
            default => '-',
        };
    }
}
