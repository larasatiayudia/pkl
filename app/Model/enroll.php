<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class enroll extends Model
{
  protected $table = 'enroll';
  protected $primaryKey = 'id_enroll';

  protected $fillable = [
      'id_enroll','id_user','id_mat'
  ];
  public $timestamps = false;

  public function materi(){
    return $this->belongsTo('App\Model\jabatan','id_mat');
  }
  public function user(){
    return $this->belongsTo('App\Model\User','id_user');
  }
}
