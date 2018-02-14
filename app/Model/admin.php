<?php

<<<<<<< HEAD
namespace App\Model;
=======
namespace App;
>>>>>>> fa122edbca942ccf9aae4179d40f3ee3360513ad

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
<<<<<<< HEAD
    return $this->belongsTo('App\Model\jabatan','id_ja');
=======
    return $this->hasMany('App\Model\jabatan');
>>>>>>> fa122edbca942ccf9aae4179d40f3ee3360513ad
  }
  public function user(){
    return $this->belongsTo('App\Model\User','id_user');
  }
}
