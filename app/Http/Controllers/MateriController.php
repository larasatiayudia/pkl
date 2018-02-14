<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\materi_test;
use App\Model\enroll;
use App\Model\User;
use App\Model\grup;
use App\Model\jabatan;
use Carbon\Carbon;
use Charts;
use Session;
use Hashids;
use Jenssegers\Date\Date;

class MateriController extends Controller
{
    public function filterRekap($j,$id){
        $materi=materi_test::where([['id_jabatan',$j],['status',$id]])->get();
        if(count($materi)){
          foreach($materi as $index=>$m){
            foreach ($m->test as $t) {
              $test[$index]=$t;
            }
          }
        }
        else{
          $test=$materi;
        }
        return response()->json(['materi'=>$materi,'test'=>$test]);

    }
    public function getmateri(Request $request,$status)
    {
      if($status=="jangkapendek"){
        $status = 0;
      }elseif($status=="jangkapanjang"){
        $status = 1;
      }
      $id_user= $request->session()->get('id_user');
      $user = User::find($id_user);
      $jabatan = $user->id_jabatan;
      $materis = materi_test::where([['status',$status],['id_jabatan',$jabatan]])->orderBy('waktu_tutup','desc')->
      orderBy('waktu_buka','asc')->paginate(10);
      $waktu = Carbon::now();
      $array = array();
      $enrollstatus = array();
      $buka = array();
      foreach ($materis as $index => $materi) {
        if($materi->waktu_tutup != null){
          $materi_tutup = Carbon::createFromFormat('Y-m-d H:i:s', $materi->waktu_tutup);
          $selisih = $waktu->diffInSeconds($materi_tutup,false);
          $array[$index]= $selisih;
        }else{
          $array[$index] = null;
        }
        if($materi->waktu_buka != null){
          $materi_buka = Carbon::createFromFormat('Y-m-d H:i:s', $materi->waktu_buka);
          $selisih = $waktu->diffInSeconds($materi_buka,false);
          $buka[$index]= $selisih;
        }else{
          $buka[$index] = null;
        }
        $enroll = enroll::where([['id_user',$id_user],['id_mat',$materi->id_mat]])->get();
        if($enroll->isEmpty()){
          $enrollstatus[$index] = 0;
        }else{
          $enrollstatus[$index] = 1;
        }
      }
      return view('user.materi',['materis'=>$materis,'waktu'=>$waktu,'status' => $status,'array'=>$array,
        'enrollstatus'=>$enrollstatus,'buka'=>$buka]);
    }

    public function getbonus(Request $request)
    {
      if(Session::has('id_grup')){
        $id_grup = Session::get('id_grup');
        $grup = grup::find($id_grup);
        $jabatan = jabatan::where([['id_grup',$grup->id_grup],['nama_jabatan','all']])->first();
        $id_jabatan = $jabatan->id_jabatan;
        $materis = materi_test::where([['id_jabatan',$id_jabatan],['status',2]])->paginate(10);
        return view('admin_grup.materibonus',['materis'=>$materis,'id_jabatan'=>$id_jabatan]);
      }else{
        $id_user = Session::get('id_user');
        $user = User::find($id_user);
        $grup = $user->grup;
        $jabatan = jabatan::where([['id_grup',$grup->id_grup],['nama_jabatan','all']])->first();
        $id_jabatan = $jabatan->id_jabatan;
        $materis = materi_test::where([['id_jabatan',$id_jabatan],['status',2]])->paginate(10);
        return view('user.bonustes',['materis'=>$materis]);
      }
    }

    public function singlemateri($id)
    {
      $iddecode = Hashids::decode($id);
      $id = $iddecode[0];
      $status = $iddecode[1];
      $materi = materi_test::find($id);
      if($status){
        $modul = $materi->modul[0];
        return view('user.deskripsimateri',['materi'=>$materi,'modul'=>$modul,'status'=>$status]);  
      }else{
         return view('user.deskripsimateri',['materi'=>$materi,'status'=>$status]); 
      }
      
    }

    public function getmateriadmin($id)
    {
      $iddecode = Hashids::decode($id);
      $jabatan = $iddecode[0];
      $status = $iddecode[1];
      $materis = materi_test::where([['status',$status],['id_jabatan',$jabatan]])->orderBy('waktu_tutup','desc')->paginate(10);
      $waktu = Carbon::now();
        $array = array();
        $buka = array();
        foreach ($materis as $index => $materi) {
          if($materi->waktu_tutup!=null){
            $materi_tutup = Carbon::createFromFormat('Y-m-d H:i:s', $materi->waktu_tutup);
              $selisih = $waktu->diffInSeconds($materi_tutup,false);
              $array[$index]= $selisih;
          }else{
            $array[$index] = null;
          }
          if($materi->waktu_buka != null){
                $materi_buka = Carbon::createFromFormat('Y-m-d H:i:s', $materi->waktu_buka);
                $selisih = $waktu->diffInSeconds($materi_buka,false);
                $buka[$index]= $selisih;
            }else{
                $buka[$index] = null;
            }
        }
      if(Session::has('id_grup')){
        return view('admin_grup.materiadmin',['materis'=>$materis,'waktu'=>$waktu,'status' => $status,'array'=>$array,'jabatan'=>$jabatan,'buka'=>$buka]);
      }else{
        return view('admin.materiadmin',['materis'=>$materis,'waktu'=>$waktu,'status' => $status,'array'=>$array,'jabatan'=>$jabatan,'buka'=>$buka]);
      }
    }

  public function tambahmateri($id)
  {
    $iddecode = Hashids::decode($id);
    if(count($iddecode)>1){
      $jabatan = $iddecode[1];
      $status = $iddecode[0];
      if(\Auth::guard('superadmin')){
        return view('admin_grup.formmateri',['jabatan'=>$jabatan,'status'=>$status]);
      }else{
        return view('admin.formmateri',['jabatan'=>$jabatan,'status'=>$status]);
      }
    }else{
      $id_mat = $iddecode[0];
      $materi = materi_test::find($id_mat);
      $status = $materi->status;
      if(\Auth::guard('superadmin')){
        return view('admin_grup.formmateri',['materi'=>$materi,'status'=>$status]);
      }else{
        return view('admin.formmateri',['materi'=>$materi,'status'=>$status]);
      }
    }
  }

  public function tambahmateribonus($id)
  {
    $iddecode = Hashids::decode($id);
    if(count($iddecode)>1){
      $jabatan = $iddecode[1];
      $status = $iddecode[0];
      return view('admin_grup.formmateribonus',['jabatan'=>$jabatan,'status'=>$status]);
    }else{
      $id_mat = $iddecode[0];
      $materi = materi_test::find($id_mat);
      $status = $materi->status;
      return view('admin_grup.formmateribonus',['materi'=>$materi,'status'=>$status]);
    }
  }

  public function postmateri(Request $request)
  {
    $id_jabatan = $request['jabatan'];
    $status = $request['status'];
    $nama_test = $request['nama'];
    $deskripsi = $request['deskripsi'];
    $pass_materi = $request['pass_materi'];
    $materi = materi_test::create([
      'id_jabatan' => $id_jabatan,
      'nama_test' => $nama_test,
      'deskripsi' => $deskripsi,
      'status' => $status,
      'pass_materi' => $pass_materi
    ]);
    if($materi->status == 1){
      return redirect('admin/formmodul/'.Hashids::encode($materi->id_mat,$status));
    }elseif($materi->status ==2){
      return redirect('admin/tipetesbonus/'.Hashids::encode($materi->id_mat,$status));
    }else{
      return redirect('admin/tipetes/'.Hashids::encode($materi->id_mat,$status));
    }
  }

  public function editmateri(Request $request)
  {
    $id_mat = $request['id_mat'];
    $nama_test = $request['nama'];
    $deskripsi = $request['deskripsi'];
    $pass_materi = $request['pass_materi'];
    $materi = materi_test::find($id_mat);
    materi_test::where('id_mat',$id_mat)->update([
      'nama_test' => $nama_test,
      'deskripsi' => $deskripsi,
      'pass_materi' => $pass_materi
    ]);
    if($materi->status == 1){
      return redirect('admin/formmodul/'.Hashids::encode($materi->id_mat,$materi->status));
    }elseif($materi->status == 2){
      return redirect('admin/tipetesbonus/'.Hashids::encode($materi->id_mat,$materi->status));
    }else{
      return redirect('admin/tipetes/'.Hashids::encode($materi->id_mat,$materi->status));
    }
  }

  public function finish($id)
  {
    $materi=materi_test::find($id);
    Date::setLocale('id');
    if($materi->status ==2){
      $notification = array('tittle'=>'Sukses!',
      'msg'=>'Test bonus berhasil dibuat!',
      'alert-type'=>'success');
      return redirect('admin/soalbonus')->with($notification);      
    }else{
      $notification = array('tittle'=>'Test anda berhasil dibuat!',
      'msg'=>'Yang akan diadakan pada '.Date::parse($materi->waktu_buka)->format('l,d F Y H:i').' WIB',
      'alert-type'=>'success');
      if(\Auth::guard('superadmin')){
        return redirect('/admin/pilihjabatan')->with($notification);
      }else{
        return redirect('/home')->with($notification);
      }
    }
  }
}
