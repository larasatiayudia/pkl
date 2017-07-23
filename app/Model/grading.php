<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class hasil_test extends Model
{
    protected $fillable = [
        'id_user','id_user','id_soal','id_test','selected_ans'
    ];
    public $timestamps = false;
}
