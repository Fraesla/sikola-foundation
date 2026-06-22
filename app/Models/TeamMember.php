<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
       protected $fillable = [
        'nama',
        'jabatan',
        'foto',
        'bio',
        'sosial_media',
        'urutan',
        'is_aktif'
    ];

    protected $casts = [
        'sosial_media'=>'array',
        'is_aktif'=>'boolean'
    ];
}
