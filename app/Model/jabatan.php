<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class jabatan extends Model
{
    protected $table = 'jabatan';
    protected $primaryKey = 'id_jabatan';

    protected $fillable = [
        'id_jabatan','id_grup','nama_jabatan'
    ];
    public $timestamps = false;

    public function grup(){
      return $this->belongsTo('App\Model\grup','id_grup');
    }
}
