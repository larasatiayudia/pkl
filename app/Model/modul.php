<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class modul extends Model
{
    protected $fillable = [
        'nama', 'file'
    ];
    public $timestamps = false;
}
