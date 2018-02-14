<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class materi_test extends Model
{
    protected $table = 'materi_test';
    protected $primaryKey = 'id_mat';
    protected $fillable = [
<<<<<<< HEAD
        'id_mat','id_jabatan','nama_test','deskripsi','status','pass_materi','waktu_buka','waktu_tutup'
=======
        'id_mat','nama_test','deskripsi'
>>>>>>> fa122edbca942ccf9aae4179d40f3ee3360513ad
    ];
    public $timestamps = false;

    public function modul(){
<<<<<<< HEAD
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
=======
      return $this->hasOne('App\Model\modul');
>>>>>>> fa122edbca942ccf9aae4179d40f3ee3360513ad
    }
}
