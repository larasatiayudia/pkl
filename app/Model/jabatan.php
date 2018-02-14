<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class jabatan extends Model
{
    protected $table = 'jabatan';
    protected $primaryKey = 'id_jabatan';

    protected $fillable = [
        'id_jabatan','id_grup','nama_jabatan'
    ];
    public $timestamps = false;

    public function grup(){
      return $this->belongsTo('App\Model\grup','id_grup');
    }
<<<<<<< HEAD
    public function admin(){
      return $this->hasMany('App\Model\grup','id_jabatan');
    }
    public function materi(){
      return $this->hasMany('App\Model\materi_test','id_jabatan');
    }
    public function user()
    {
        return $this->hasMany('App\Model\User','id_jabatan');
    }
=======
>>>>>>> fa122edbca942ccf9aae4179d40f3ee3360513ad
}
