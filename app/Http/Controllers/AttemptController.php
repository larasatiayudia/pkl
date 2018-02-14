<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\attempt;
use Hashids;
use Carbon\Carbon;
use Jenssegers\Date\Date;
use Session;

class AttemptController extends Controller
{
    public function review($id)
    {
      $iddecode = Hashids::decode($id);
      $id = $iddecode[0];
      $attempt = attempt::find($id);
      $gradings = $attempt->grading;
      return view('user.review',['gradings'=>$gradings]);
    }

    public function hasil(Request $request,$id)
    {
      Date::setLocale('id');
      $iddecode = Hashids::decode($id);
      $id = $iddecode[0];
      $status = $iddecode[1];
      $attempt = attempt::find($id);
      if($attempt->peserta->test->waktu_tutup != null){
        $waktu_tutup = Carbon::createFromFormat('Y-m-d H:i:s',$attempt->peserta->test->waktu_tutup);
      }else{
        $waktu_tutup = null;
      }
      $sekarang = Carbon::now();
      $selisih = $sekarang->diffInSeconds($waktu_tutup,false);
      $sisa = $attempt->peserta->sisa_attempt;
      return view('user.hasiltest',['attempt'=>$attempt,'status'=>$status,'selisih'=>$selisih,'sisa'=>$sisa]);
    }

    public function daftarnilaitest($id)
    {
      $iddecode = Hashids::decode($id);
      $id = $iddecode[0];
      $attempts = attempt::where('id_peserta',$id)->get();
      $waktu_tutup = Carbon::createFromFormat("Y-m-d H:i:s",$attempts[0]->peserta->test->waktu_tutup);
      $sekarang = Carbon::now();
      $selisih = $sekarang->diffInSeconds($waktu_tutup,false);
      return view('user.attemptnilai',['attempts'=>$attempts,'selisih'=>$selisih]);
    }
}
