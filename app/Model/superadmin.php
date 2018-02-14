<?php

namespace App\Model;
<<<<<<< HEAD
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class superadmin extends Authenticatable
{
  use Notifiable;
  protected $guard='superadmin';
=======

use Illuminate\Database\Eloquent\Model;

class superadmin extends Model
{
>>>>>>> fa122edbca942ccf9aae4179d40f3ee3360513ad
  protected $table = 'superadmin';
  protected $primaryKey = 'id_sa';

  protected $fillable = [
<<<<<<< HEAD
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
=======
      'id_sa','id_grup','username','password','status'
  ];
  public $timestamps = false;
>>>>>>> fa122edbca942ccf9aae4179d40f3ee3360513ad

  public function grup(){
    return $this->belongsTo('App\Model\grup','id_grup');
  }
<<<<<<< HEAD

  public function operator_kantor(){
    return $this->hasOne('App\Model\operator_kantor', 'id_operator');
  }

=======
>>>>>>> fa122edbca942ccf9aae4179d40f3ee3360513ad
}
