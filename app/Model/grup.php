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
  }

}
