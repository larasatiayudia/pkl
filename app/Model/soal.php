<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class soal extends Model
{
  protected $table = 'soal';
  protected $primaryKey = 'id_soal';
  protected $fillable = [
        'id_soal','id_test','soal', 'opsi_a', 'opsi_b','opsi_c','opsi_d','kunci_jawaban'
    ];
    public $timestamps = false;

    public function test(){
      return $this->belongsTo('App\Model\test','id_test');
    }
    public function grading(){
      return $this->hasOne('App\Model\grading','id_soal');
    }
}
