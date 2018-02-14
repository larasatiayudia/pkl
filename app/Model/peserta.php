<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class peserta extends Model
{
  protected $table = 'peserta';
  protected $primaryKey = 'id_peserta';

  protected $fillable = [
<<<<<<< HEAD
      'id_peserta','id_user','id_test','sisa_attempt','nilai'
=======
      'id_peserta','id_user','id_test','sisa_attempt'
>>>>>>> fa122edbca942ccf9aae4179d40f3ee3360513ad
  ];
  public $timestamps = false;

  public function user(){
    return $this->belongsTo('App\Model\User','id_user');
  }
  public function test(){
    return $this->belongsTo('App\Model\test','id_test');
  }
  public function attempt(){
<<<<<<< HEAD
    return $this->hasMany('App\Model\attempt','id_peserta');
=======
    return $this->hasMany('App\Model\attempt');
>>>>>>> fa122edbca942ccf9aae4179d40f3ee3360513ad
  }
}
