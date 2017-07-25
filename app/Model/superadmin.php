<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class superadmin extends Model
{
  protected $table = 'superadmin';
  protected $primaryKey = 'id_sa';

  protected $fillable = [
      'id_sa','id_grup','username','password','status'
  ];
  public $timestamps = false;

  public function grup(){
    return $this->belongsTo('App\Model\grup','id_grup');
  }
}
