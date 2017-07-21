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
        'NIP', 'Nama', 'Kantor','Jabatan','Divisi','id_grup','username','password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public $timestamps = false;
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

}
