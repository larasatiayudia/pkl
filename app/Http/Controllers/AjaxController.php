<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\jabatan;

class AjaxController extends Controller
{
  public function jabatanform($id){
    $jabatan =  jabatan::where('id_grup',$id)->get();
    return $jabatan;
  }
}
