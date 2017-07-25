<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class test extends Model
{
    protected $table = 'test';
    protected $primaryKey = 'id_test';
    protected $fillable = [
        'id_test','id_mat','nama', 'durasi', 'waktu_buka','waktu_tutup','peraturan_test','attempt'
    ];
    public $timestamps = false;

    public function materi(){
      return $this->belongsTo('App\Model\materi_test','id_mat');
    }
    public function grading(){
      return $this->hasMany('App\Model\grading');
    }
    public function peserta(){
      return $this->hasMany('App\Model\peserta');
    }
    public function soal(){
      return $this->hasMany('App\Model\soal');
    }
}
