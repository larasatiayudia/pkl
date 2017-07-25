<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class hasil_test extends Model
{
    protected $table = 'grading';
    protected $primaryKey = 'id_hasil';

    protected $fillable = [
        'id_hasil','id_user','id_soal','id_test','id_attempt','selected_ans','status'
    ];
    public $timestamps = false;

    public function user(){
      return $this->belongsTo('App\Model\User','id_user');
    }
    public function soal(){
      return $this->belongsTo('App\Model\soal','id_soal');
    }
    public function test(){
      return $this->belongsTo('App\Model\test','id_test');
    }
    public function attempt(){
      return $this->belongsTo('App\Model\attempt','id_attempt');
    }
}
