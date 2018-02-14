<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class attempt extends Model
{
  protected $table = 'attempt';
  protected $primaryKey = 'id_attempt';

  protected $fillable = [
      'id_attempt','id_peserta','nilai'
  ];
  public $timestamps = false;

  public function peserta(){
    return $this->belongsTo('App\Model\peserta','id_peserta');
  }
  public function grading(){
<<<<<<< HEAD
    return $this->hasMany('App\Model\grading','id_attempt');
=======
    return $this->hasMany('App\Model\grading');
>>>>>>> fa122edbca942ccf9aae4179d40f3ee3360513ad
  }
}
