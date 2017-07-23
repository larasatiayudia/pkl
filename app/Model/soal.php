<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class soal extends Model
{
    protected $fillable = [
        'soal', 'opsi_a', 'opsi_b','opsi_c','opsi_d','kunci_jawaban'
    ];
    public $timestamps = false;
}
