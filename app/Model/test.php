<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class test extends Model
{
    protected $fillable = [
        'nama', 'durasi', 'waktu_buka','waktu_tutup','hasil','peraturan_test','attempt'
    ];
    public $timestamps = false;
}
