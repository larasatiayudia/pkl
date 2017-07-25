<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class materi_test extends Model
{
    protected $table = 'materi_test';
    protected $primaryKey = 'id_mat';
    protected $fillable = [
        'id_mat','nama_test','deskripsi'
    ];
    public $timestamps = false;

    public function modul(){
      return $this->hasOne('App\Model\modul');
    }
}
