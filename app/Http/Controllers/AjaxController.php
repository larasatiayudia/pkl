<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\jabatan;
<<<<<<< HEAD
use App\Model\test;
use App\Model\modul;
use App\Model\soal;
use App\Model\grading;
use App\Model\grup;
use Carbon\Carbon;
use Hashids;
=======
>>>>>>> fa122edbca942ccf9aae4179d40f3ee3360513ad

class AjaxController extends Controller
{
  public function jabatanform($id){
<<<<<<< HEAD
    $grup = grup::find($id);
    $jabatan =  jabatan::where([['id_grup',$id],['nama_jabatan','!=','all']])->get();
=======
    $jabatan =  jabatan::where('id_grup',$id)->get();
>>>>>>> fa122edbca942ccf9aae4179d40f3ee3360513ad
    return $jabatan;
  }

}
