<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class grup extends Model
{
  protected $table = 'grup';
  protected $fillable = [
      'id_grup','Nama_grup'
  ];
  public $timestamps = false;
}
