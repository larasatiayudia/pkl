<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class grup extends Model
{
  protected $table = 'grup';
  protected $primaryKey = 'id_grup';

  protected $fillable = [
      'id_grup','Nama_grup'
  ];
  public $timestamps = false;

  public function user(){
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
  }

}
