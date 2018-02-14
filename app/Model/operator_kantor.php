<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class operator_kantor extends Model
{
    
    protected $table = 'operator_kantor';
    protected $primaryKey = 'id_ok';

    protected $fillable = [
        'id_ok', 'id_operator', 'id_kantor'
    ];
    public $timestamps = false;

    public function superadmin(){
    	return $this-> belongsTo('App\Model\superadmin','id_sa');
	}

	public function kantor(){
    	return $this-> belongsTo('App\Model\kantor','id_kantor');
	}
}
