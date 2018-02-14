<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class kantor extends Model
{
    protected $table = 'kantor';
    protected $primaryKey = 'id_kantor';


    protected $fillable = [
        'id_kantor','tipe','nama_kantor','level','id_superkantor'
    ];
    public $timestamps = false;

    public function user(){
    	return $this-> hasMany('App\Model\User','id_kantor');
	}
    
	public function operator_kantor(){
    	return $this-> hasOne('App\Model\operator_kantor','id_kantor');
	}
    public function subkantor()
    {
        return $this-> hasMany('App\Model\kantor','id_superkantor');
    }
    public function superkantor()
    {
        return $this-> belongsTo('App\Model\kantor','id_superkantor');
    }
    public function tipekantor(){
        return $this-> belongsTo('App\Model\tipekantor','tipe');
    }
    public function level(){
        return $this-> belongsTo('App\Model\tipekantor','level');
    }
}
