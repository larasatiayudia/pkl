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
<<<<<<< HEAD
      return $this->hasOne('App\Model\grading','id_soal');
=======
      return $this->hasOne('App\Model\grading');
>>>>>>> fa122edbca942ccf9aae4179d40f3ee3360513ad
    }
}
