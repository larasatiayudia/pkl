<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Hashids;

class modul extends Model
{
	public function getRouteKey()
    {
      return Hashids::encode($this->getKey());
    }

    protected $table = 'modul';
    protected $primaryKey = 'id_modul';
    protected $fillable = [
        'id_modul','id_mat','nama', 'file','durasi','status'
    ];
    public $timestamps = false;

    public function materi(){
      return $this->belongsTo('App\Model\materi_test','id_mat');
    }
}
