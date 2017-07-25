<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class modul extends Model
{
    protected $table = 'modul';
    protected $primaryKey = 'id_modul';
    protected $fillable = [
        'id_modul','id_mat','nama', 'file','status'
    ];
    public $timestamps = false;

    public function materi(){
      return $this->belongsTo('App\Model\materi_test','id_mat');
    }
}
