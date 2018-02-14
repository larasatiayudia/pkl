<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class grup extends Model
{
  protected $table = 'grup';
  protected $primaryKey = 'id_grup';

  protected $fillable = [
      'id_grup','kode_grup','nama_grup','status'
  ];
  public $timestamps = false;

  public function user(){
<<<<<<< HEAD
    return $this->hasMany('App\Model\User','id_grup');
  }
  public function divisi(){
    return $this->hasMany('App\Model\divisi','id_grup');
  }
  public function jabatan(){
    return $this->hasMany('App\Model\jabatan','id_grup');
  }
  public function superadmin(){
    return $this->hasMany('App\Model\superadmin','id_grup');
=======
    return $this->hasMany('App\Model\User');
  }
  public function divisi(){
    return $this->hasMany('App\Model\divisi');
  }
  public function jabatan(){
    return $this->hasMany('App\Model\jabatan');
  }
  public function superadmin(){
    return $this->hasOne('App\Model\superadmin');
>>>>>>> fa122edbca942ccf9aae4179d40f3ee3360513ad
  }

}
