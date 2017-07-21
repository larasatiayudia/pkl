<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class materi_test extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_test','deskripsi'
    ];
}
