<?php

namespace App\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class superadmin extends Authenticatable
{
  use Notifiable;
  protected $guard='superadmin';
  protected $table = 'superadmin';
  protected $primaryKey = 'id_sa';

  protected $fillable = [
      'id_sa','id_grup','username','password','email','status'
  ];
  public $timestamps = false;
  protected $hidden = [
        'password','remember_token',
  ];

  public function getRememberToken(){
	return null; // not supported
  }
  public function setRememberToken($value){
    // not supported
  }

  public function getRememberTokenName(){
  	return null; // not supported
  }

  /**
   * Overrides the method to ignore the remember token.
   */
  public function setAttribute($key, $value){
  	$isRememberTokenAttribute = $key == $this->getRememberTokenName();
  	if (!$isRememberTokenAttribute){
  		parent::setAttribute($key, $value);
  	}
  }

  public function grup(){
    return $this->belongsTo('App\Model\grup','id_grup');
  }

  public function operator_kantor(){
    return $this->hasOne('App\Model\operator_kantor', 'id_operator');
  }

}
