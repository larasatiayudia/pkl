<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\modul;
use App\Model\enroll;
use App\Model\materi_test;
use App\Model\test;
use Carbon\Carbon;
use Session;
use Hashids;
use File;

class ModulController extends Controller
{
    public function kliktombolmodul(Request $request,$id)
    {
      if(Session::has('waktuklikmodul')){
        return redirect('/bacamateri/'.$id);
      }else{
        $waktuklik = Carbon::now();
        $request->session()->put('waktuklikmodul',$waktuklik);
        return redirect('/bacamateri/'.$id);
      }
    }

    public function bacamodul(Request $request,$id)
    {
      $iddecode = Hashids::decode($id);
      $id = $iddecode[0];
      $status = $iddecode[1];
      $modul = modul::find($id);
      $materi = $modul->materi;
      $id_user= $request->session()->get('id_user');
      $enroll = enroll::where([['id_user',$id_user],['id_mat',$materi->id_mat]])->get();
      if($enroll->isEmpty()){
        return redirect('/');
      }
      $id_mat = $materi->id_mat;
      $id_mat = Hashids::encode($id_mat,$status);
      $id = Hashids::encode($id);
      return view('user.bacamateri',['modul'=>$modul,'id'=>$id,'id_mat'=>$id_mat,'status'=>$status]);
    }

    public function countdownmodul(Request $request,$id)
  	{
	    $iddecode = Hashids::decode($id);
	    $id = $iddecode[0];
	    $modul = modul::find($id);
	    $durasi = $modul->durasi;
	    $waktuklik = $request->session()->get('waktuklikmodul');
	    $waktuklik = Carbon::createFromFormat('Y-m-d H:i:s', $waktuklik);
	    $waktusekarang = Carbon::now();
	    $countdown = $waktuklik->diffInSeconds($waktusekarang,false);
      $bataswaktu = $waktuklik->addMinutes($durasi);
      $waktuklik = $request->session()->get('waktuklikmodul');
      $waktuklik = Carbon::createFromFormat('Y-m-d H:i:s', $waktuklik);
      $batas = $waktuklik->diffInSeconds($bataswaktu,false);
	    return response()->json(['batas'=>$batas,'countdown'=>$countdown]);
  	}

  public function tambahmodul($id)
  {
    $iddecode = Hashids::decode($id);
    $id = $iddecode[0];
    $status = $iddecode[1];
    $materi = materi_test::find($id);
    if(\Auth::guard('superadmin')){
      return view('admin_grup.formmodul',['materi'=>$materi,'status'=>$status]);
    }else{
      return view('admin.formmodul',['materi'=>$materi,'status'=>$status]);
    }
  }

  public function tambahmodulbonus($id)
  {
    $iddecode = Hashids::decode($id);
    if(count($iddecode)>3){
      $id = $iddecode[0];
      $status = $iddecode[1];
      $tipe = $iddecode[2];
      $id_test = $iddecode[3];
      $materi = materi_test::find($id);
      return view('admin_grup.formmodulbonus',['materi'=>$materi,'status'=>$status,'tipe'=>$tipe,'id_test'=>$id_test]);
    }else{
      $id = $iddecode[0];
      $status = $iddecode[1];
      $id_test = $iddecode[2];
      $materi = materi_test::find($id);
      $test = test::find($id_test);
      $check = null;
      foreach($materi->modul as $modul){
        if($modul->status == $test->tipe_test)
          $check = $modul;
      }
      $modul = $check;
      return view('admin_grup.formmodulbonus',['materi'=>$materi,'modul'=>$modul,'status'=>$status,'id_test'=>$id_test,'tipe'=>$test->tipe_test]);
    }
  }

  public function postmodul(Request $request)
  {
    $id_mat = $request['id_mat'];
    $materi = materi_test::find($id_mat);
    $status_modul = $request['status_modul'];
    $nama = $request['nama'];
    $durasi = $request['durasi'];
    $file = $request->file('modul');
    $path = $file->getClientOriginalName();
    $file->move('modul/'.$id_mat, $file->getClientOriginalName());
    if($status_modul ==null){
      $check = $materi->modul;
      if($check->isEmpty()){
        $modul = modul::create([
          'id_mat' => $id_mat,
          'nama' => $nama,
          'file' => $path,
          'durasi' => $durasi
        ]);
      }else{
        $modul = $check;
        $id_modul = $modul->id_modul;
        modul::where('id_modul',$id_modul)->update([
          'id_mat' => $id_mat,
          'nama' => $nama,
          'file' => $path,
          'durasi' => $durasi
        ]);
      }
      if(\Auth::guard('superadmin')){
        return redirect('/admin/formtest/'.Hashids::encode($id_mat,$modul->materi->status));
      }else{
        return redirect('/formtest/'.Hashids::encode($id_mat,$modul->materi->status));
      }
    }else{
      $check = modul::where([['id_mat',$id_mat],['status',$status_modul]])->first();
      if($check==null){
        $modul = modul::create([
          'id_mat' => $id_mat,
          'nama' => $nama,
          'file' => $path,
          'durasi' => $durasi,
          'status' => $status_modul
        ]);
      }else{
        $modul = $check;
        $id_modul = $modul->id_modul;
        modul::where('id_modul',$id_modul)->update([
          'id_mat' => $id_mat,
          'nama' => $nama,
          'file' => $path,
          'durasi' => $durasi
        ]);
      }
      $id_test = $request['id_test'];
      return redirect('admin/formsoalbonus/'.Hashids::encode($id_test,$materi->status));
    }
  }

  public function editmodul(Request $request)
  {
    $id_modul = $request['id_modul'];
    $nama = $request['nama'];
    $durasi = $request['durasi'];
    $modul = modul::find($id_modul);
    if(!empty($request->file('modul'))){
      $old = public_path().'/modul/'.$modul->materi->id_mat.'/'.$modul->file;
      File::delete($old);
      $file = $request->file('modul');
      $path = $file->getClientOriginalName();
      $file->move('modul/'.$modul->materi->id_mat, $file->getClientOriginalName());
      modul::where('id_modul',$id_modul)->update([
        'nama' => $nama,
        'file' => $path,
        'durasi' => $durasi
      ]);
    }else{
      modul::where('id_modul',$id_modul)->update([
        'nama' => $nama,
        'durasi' => $durasi
      ]);
    }
    $modul = modul::find($id_modul);
    if($modul->materi->status == 1){
      if(\Auth::guard('superadmin')){
        $modul = modul::find($id_modul);
    return redirect('/admin/formtest/'.Hashids::encode($modul->materi->id_mat,$modul->materi->status));
      }else{
        return redirect('/formtest/'.Hashids::encode($modul->materi->id_mat,$modul->materi->status));
      }
    }else{
      $id_test = $request['id_test'];
      return redirect('admin/formsoalbonus/'.Hashids::encode($id_test,$modul->materi->status));
    }
  }
}
