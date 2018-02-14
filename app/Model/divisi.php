<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class divisi extends Model
{
  protected $table = 'divisi';
  protected $primaryKey = 'id_divisi';

  protected $fillable = [
      'id_divisi','id_grup','nama_divisi'
  ];
  public $timestamps = false;

  public function grup(){
    return $this->belongsTo('App\Model\grup','id_grup');
  }
}
