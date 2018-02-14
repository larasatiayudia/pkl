<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\jabatan;
use App\Model\test;
use App\Model\modul;
use App\Model\soal;
use App\Model\grading;
use App\Model\grup;
use Carbon\Carbon;
use Hashids;

class AjaxController extends Controller
{
  public function jabatanform($id){
    $grup = grup::find($id);
    $jabatan =  jabatan::where([['id_grup',$id],['nama_jabatan','!=','all']])->get();
    return $jabatan;
  }

}
