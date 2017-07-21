<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class soal extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'soal', 'opsi_a', 'opsi_b','opsi_c','opsi_d','kunci_jawaban'
    ];
}
