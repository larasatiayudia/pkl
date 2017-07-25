<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
  protected $table = 'admin';
  protected $primaryKey = 'id_admin';

  protected $fillable = [
      'id_admin','id_user','id_ja'
  ];
  public $timestamps = false;

  public function jabatan(){
    return $this->hasMany('App\Model\jabatan');
  }
  public function user(){
    return $this->belongsTo('App\Model\User','id_user');
  }
}
