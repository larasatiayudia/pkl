<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tipekantor extends Model
{
    protected $table = 'tipekantor';
    protected $primaryKey = 'id_tipe';

    protected $fillable = [
        'id_tipe','tipe_kantor','level','id_grup'
    ];
    public $timestamps = false;

    public function kantor()
    {
        return $this-> hasMany('App\Model\kantor','id_tipe');
    }
    public function levelkantor()
    {
        return $this-> hasMany('App\Model\kantor','level');
    }
    public function grup()
    {
        return $this-> belongsTo('App\Model\grup','id_grup');
    }
}
