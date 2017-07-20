<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class test extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'durasi', 'waktu_buka','waktu_tutup','hasil','peraturan_test','attempt'
    ];

}
