<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class materi_test extends Model
{
    protected $table = 'materi_test';
    protected $primaryKey = 'id_mat';
    protected $fillable = [
        'id_mat','id_jabatan','nama_test','deskripsi','status','pass_materi','waktu_buka','waktu_tutup'
    ];
    public $timestamps = false;

    public function modul(){
      return $this->hasMany('App\Model\modul','id_mat');
    }
    public function test(){
      return $this->hasMany('App\Model\test','id_mat');
    }
    public function enroll(){
      return $this->hasMany('App\Model\enroll','id_mat');
    }
    public function jabatan(){
      return $this->belongsTo('App\Model\jabatan','id_jabatan');
    }
}
