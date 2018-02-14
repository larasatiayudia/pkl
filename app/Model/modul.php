<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Hashids;

class modul extends Model
{
<<<<<<< HEAD
	public function getRouteKey()
    {
      return Hashids::encode($this->getKey());
    }

    protected $table = 'modul';
    protected $primaryKey = 'id_modul';
    protected $fillable = [
        'id_modul','id_mat','nama', 'file','durasi','status'
=======
    protected $table = 'modul';
    protected $primaryKey = 'id_modul';
    protected $fillable = [
        'id_modul','id_mat','nama', 'file','status'
>>>>>>> fa122edbca942ccf9aae4179d40f3ee3360513ad
    ];
    public $timestamps = false;

    public function materi(){
      return $this->belongsTo('App\Model\materi_test','id_mat');
    }
}
