<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\divisi;

class AjaxController extends Controller
{
  public function divisiform($id){
    $divisi =  divisi::where('id_grup',$id)->get();
    return $divisi;
  }
}
