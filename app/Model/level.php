<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class level extends Model
{
    protected $table = 'level';
    protected $primaryKey = 'id_level';


    protected $fillable = [
        'id_level', 'nama_level', 'point_minimum', 'id_grup','icon'
    ];
    public $timestamps = false;

    public function user(){
        return $this-> hasMany('App\Model\User','id_level');
    }
}
