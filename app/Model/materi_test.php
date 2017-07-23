<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class materi_test extends Model
{
    protected $fillable = [
        'nama_test','deskripsi'
    ];
    public $timestamps = false;
}
