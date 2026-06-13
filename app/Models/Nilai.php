<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = [
        'materi_id', 'nama_siswa', 'kelas', 'skor'
    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}
