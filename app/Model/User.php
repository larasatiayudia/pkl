<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  protected $table = 'user';
  protected $primaryKey = 'id_user';

  protected $fillable = [
      'NIP', 'Nama', 'id_kantor','id_jabatan','Status','id_grup','username','password','id_level', 'point','registered_pw','created_at','updated_at'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  
  protected $hidden = [
      'password'
  ];

  public function getRememberToken()
  {
    return null; // not supported
  }  

  public function setRememberToken($value)
  {
    // not supported
  }

  public function getRememberTokenName()
  {
    return null; // not supported
  }

  /**
   * Overrides the method to ignore the remember token.
   */
  public function setAttribute($key, $value)
  {
    $isRememberTokenAttribute = $key == $this->getRememberTokenName();
    if (!$isRememberTokenAttribute)
    {
      parent::setAttribute($key, $value);
    }
  }
  public function jabatan(){
    return $this->belongsTo('App\Model\jabatan','id_jabatan');
  }
  public function grading(){
    return $this->hasMany('App\Model\grading','id_user');
  }
  public function peserta(){
    return $this->hasMany('App\Model\peserta','id_user');
  }
  public function grup(){
    return $this->belongsTo('App\Model\grup','id_grup');
  }
  public function admin(){
    return $this-> hasMany('App\Model\admin','id_user');
  }
  public function kantor(){
      return $this-> belongsTo('App\Model\kantor','id_kantor');
  }

  public function level(){
      return $this-> belongsTo('App\Model\level','id_level');
  }

}
