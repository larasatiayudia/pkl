<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class peserta extends Model
{
  protected $table = 'peserta';
  protected $primaryKey = 'id_peserta';

  protected $fillable = [
      'id_peserta','id_user','id_test','sisa_attempt','nilai'
  ];
  public $timestamps = false;

  public function user(){
    return $this->belongsTo('App\Model\User','id_user');
  }
  public function test(){
    return $this->belongsTo('App\Model\test','id_test');
  }
  public function attempt(){
    return $this->hasMany('App\Model\attempt','id_peserta');
  }
}
