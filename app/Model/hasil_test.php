<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hasil_test extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'selected_ans'
    ];
}
