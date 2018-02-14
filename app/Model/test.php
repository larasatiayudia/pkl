<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class test extends Model
{
    protected $table = 'test';
    protected $primaryKey = 'id_test';
    protected $fillable = [
<<<<<<< HEAD
        'id_test','id_mat','nama', 'durasi','jumlah_soal', 'waktu_buka','waktu_tutup','peraturan_test','attempt','passing_grade','tipe_test'
=======
        'id_test','id_mat','nama', 'durasi', 'waktu_buka','waktu_tutup','peraturan_test','attempt'
>>>>>>> fa122edbca942ccf9aae4179d40f3ee3360513ad
    ];
    public $timestamps = false;

    public function materi(){
      return $this->belongsTo('App\Model\materi_test','id_mat');
    }
    public function grading(){
<<<<<<< HEAD
      return $this->hasMany('App\Model\grading','id_test');
    }
    public function peserta(){
      return $this->hasMany('App\Model\peserta','id_test');
    }
    public function soal(){
      return $this->hasMany('App\Model\soal','id_test');
=======
      return $this->hasMany('App\Model\grading');
    }
    public function peserta(){
      return $this->hasMany('App\Model\peserta');
    }
    public function soal(){
      return $this->hasMany('App\Model\soal');
>>>>>>> fa122edbca942ccf9aae4179d40f3ee3360513ad
    }
}
