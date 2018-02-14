<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\peserta;
use App\Model\attempt;
use App\Model\grading;
use App\Model\test;
use App\Model\grup;
use App\Model\User;
use App\Model\level;
use App\Model\jabatan;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Hashids;

class PesertaController extends Controller
{
    public function finish(Request $request,$id)
    {
      $iddecode = Hashids::decode($id);
      $id = $iddecode[0];
      $attempt = attempt::find($id);
      $hasil = 0;
      $id_user = $request->session()->get('id_user');
      $soals = $request->session()->get('soals');
      foreach ($soals as $soal) {
        $check = grading::where([['id_attempt',$id],['id_soal',$soal->id_soal]])->first();
        if($check == null){
            grading::create([           
              'id_user'=>$id_user,
              'id_soal'=>$soal->id_soal,
              'id_test'=>$soal->test->id_test,
              'id_attempt' =>$id,
              'selected_ans'=>null,
              'status'=>0
            ]);
        }
      }
      $gradings = $attempt->grading;
      foreach ($gradings as $grading) {
        $hasil += $grading->status;
      }
      $hasil = ($hasil/$gradings[0]->test->jumlah_soal)*100;
      attempt::where('id_attempt',$id)->update(['nilai'=>$hasil]);
      $peserta = $attempt->peserta;
      if($hasil > $peserta->nilai){
        if($hasil >= $peserta->test->passing_grade){
          $user = User::find($peserta->id_user);
          if($peserta->nilai >= $peserta->test->passing_grade){
            $point = ($user->point - $peserta->nilai) + $hasil;
          }else{
            $point = $user->point + $hasil;
          }
          User::where('id_user',$peserta->id_user)->update([
            'point'=>$point
          ]);
        }
        peserta::where('id_peserta',$peserta->id_peserta)->update(['nilai'=>$hasil,'waktu_submit'=>$attempt->waktu_submit]);
      }
      $status = $peserta->test->materi->status;
      $request->session()->forget('waktuklikmodul');
      $request->session()->forget('waktukliktest');
      $request->session()->forget('soals');
      $request->session()->forget('attempt');
      if($hasil >= $peserta->test->passing_grade){
        $notification = array('tittle'=> 'Selamat! Anda lulus','msg'=>'Info lebih lanjut silahkan buka informasi tes','alert-type'=>'success');
      }else{
        $notification = array('tittle'=> 'Oopss... Anda belum lulus','msg'=>'Info lebih lanjut silahkan buka informasi tes','alert-type'=>'error');
      }
      return redirect('/hasiltest/'.Hashids::encode($id,$status))->with($notification);
    }

  public function daftarnilai(Request $request)
  {
      $id_user  = $request->session()->get('id_user');
      $user = User::find($id_user);
      $jabatan = jabatan::where([['nama_jabatan','all'],['id_grup',$user->grup->id_grup]])->first();
      $pesertaz = $user->peserta;
      $pesertas = new \Illuminate\Database\Eloquent\Collection;
      $panjang = $pesertas->count()-1;
      foreach($pesertaz as $peserta){
        if($peserta->test->materi->id_jabatan != $jabatan->id_jabatan){
          $pesertas[$panjang+1] = $peserta;
          $panjang+=1;
        }
      }
      $pesertas = $this->paginate($pesertas,['path'=>url()->current()],10);
      return view('user.nilai',['pesertas'=>$pesertas]);
	}

    public function statistik(Request $request,$id)
    {
      $iddecode = Hashids::decode($id);
      $id = $iddecode[0];
      $test = test::find($id);
      if($request['filter']==null || $request['filter']=="all"){
        if($request['keywords'] == null){
          $pesertas = peserta::where('id_test',$test->id_test)->orderBy('nilai','desc')->orderBy('waktu_submit','asc')->get();
          $id_jabatan = $test->materi->id_jabatan;
          $semua = new \Illuminate\Database\Eloquent\Collection;
          $semua = $semua->merge($pesertas);
          $users = User::where('id_jabatan',$id_jabatan)->get();
          $panjang = $semua->count()-1;
          foreach ($users as $user) {
            $check = peserta::where([['id_user',$user->id_user],['id_test',$id]])->first();
            if($check == null){
              $semua[$panjang+1] = $user;
              $panjang+=1;
            }
          }
          $semua = $this->paginate($semua,['path'=>url()->current()]);
          return view('user.detailstatistik',['semua'=>$semua,'test'=>$test]);  
        }
        else{
          $id_jabatan = $test->materi->id_jabatan;
          $key = $request['keywords'];
          $users = User::where([['Nama','LIKE','%'.$key.'%'],['id_jabatan',$id_jabatan]])->get();
          $semua = new \Illuminate\Database\Eloquent\Collection;
          $pesertas = new \Illuminate\Database\Eloquent\Collection;
          $userz = new \Illuminate\Database\Eloquent\Collection;
          $panjangpeserta = $pesertas->count()-1;
          $panjanguser = $userz->count()-1;
          foreach ($users as $user) {
            $check = peserta::where([['id_user',$user->id_user],['id_test',$id]])->first();
            if($check == null){
              $userz[$panjanguser+1] = $user;
              $panjanguser+=1;
            }else{
              $pesertas[$panjangpeserta+1] = $check;
              $panjangpeserta+=1;
            }
          }
          $pesertas = $pesertas->sortByDesc('nilai');
          $semua = $semua->merge($pesertas);
          $semua = $semua->merge($userz);
          $semua = $this->paginate($semua,['path'=>url()->current()]);
          return view('user.detailstatistik',['semua'=>$semua,'test'=>$test]);
        }
      }

      elseif($request['filter']=="lulus"){
        if($request['keywords'] == null){
          $pesertas = peserta::where('id_test',$test->id_test)->orderBy('nilai','desc')->orderBy('waktu_submit','asc')->get();
          $semua = new \Illuminate\Database\Eloquent\Collection;
          $panjang =$semua->count()-1;
          foreach ($pesertas as $peserta){
            if($peserta->nilai >= $test->passing_grade){
              $semua[$panjang+1] = $peserta;
              $panjang+=1;
            }
          }
          $semua = $this->paginate($semua,['path'=>url()->current()]);
          return view('user.detailstatistik',['semua'=>$semua,'test'=>$test]);
        }
        else{
          $id_jabatan = $test->materi->id_jabatan;
          $key = $request['keywords'];
          $users = User::where([['Nama','LIKE','%'.$key.'%'],['id_jabatan',$id_jabatan]])->get();
          $semua = new \Illuminate\Database\Eloquent\Collection;
          $panjang = $semua->count()-1;
          foreach ($users as $user) {
            $check = peserta::where([['id_user',$user->id_user],['id_test',$id]])->first();
            if($check != null && $check->nilai >= $test->passing_grade){
              $semua[$panjang+1] = $check;
              $panjang+=1;
            }
          }
          $semua = $this->paginate($semua,['path'=>url()->current()]);
          return view('user.detailstatistik',['semua'=>$semua,'test'=>$test]);
        }
      }

      elseif ($request['filter']=="tidak_lulus"){
        if($request['keywords'] == null){
          $pesertas = peserta::where('id_test',$test->id_test)->orderBy('nilai','desc')->orderBy('waktu_submit','asc')->get();
          $semua = new \Illuminate\Database\Eloquent\Collection;
          $panjang =$semua->count()-1;
          foreach ($pesertas as $peserta){
            if($peserta->nilai < $test->passing_grade){
              $semua[$panjang+1] = $peserta;
              $panjang+=1;
            }
          }
          $semua = $this->paginate($semua,['path'=>url()->current()]);
          return view('user.detailstatistik',['semua'=>$semua,'test'=>$test]);
        }
        else{
          $id_jabatan = $test->materi->id_jabatan;
          $key = $request['keywords'];
          $users = User::where([['Nama','LIKE','%'.$key.'%'],['id_jabatan',$id_jabatan]])->get();
          $semua = new \Illuminate\Database\Eloquent\Collection;
          $panjang = $semua->count()-1;
          foreach ($users as $user) {
            $check = peserta::where([['id_user',$user->id_user],['id_test',$id]])->first();
            if($check != null && $check->nilai < $test->passing_grade){
              $semua[$panjang+1] = $check;
              $panjang+=1;
            }
          }
          $semua = $this->paginate($semua,['path'=>url()->current()]);
          return view('user.detailstatistik',['semua'=>$semua,'test'=>$test]);
        }
      }

      else{
        if($request['keywords'] == null){
          $id_jabatan = $test->materi->id_jabatan;
          $users = User::where('id_jabatan',$id_jabatan)->get();
          $semua = new \Illuminate\Database\Eloquent\Collection;
          $panjang =$semua->count()-1;
          foreach ($users as $user){
            $check = peserta::where([['id_user',$user->id_user],['id_test',$id]])->first();
            if($check ==null){
              $semua[$panjang+1] = $user;
              $panjang+=1;
            }
          }
          $semua = $this->paginate($semua,['path'=>url()->current()]);
          return view('user.detailstatistik',['semua'=>$semua,'test'=>$test]);
        }
        else{
          $id_jabatan = $test->materi->id_jabatan;
          $key = $request['keywords'];
          $users = User::where([['Nama','LIKE','%'.$key.'%'],['id_jabatan',$id_jabatan]])->get();
          $semua = new \Illuminate\Database\Eloquent\Collection;
          $panjang = $semua->count()-1;
          foreach ($users as $user) {
            $check = peserta::where([['id_user',$user->id_user],['id_test',$id]])->first();
            if($check == null){
              $semua[$panjang+1] = $user;
              $panjang+=1;
            }
          }
          $semua = $this->paginate($semua,['path'=>url()->current()]);
          return view('user.detailstatistik',['semua'=>$semua, 'test'=>$test]);
        }
      }
    }


    public function paginate($items, $options = [], $perPage = 15, $page = null)
    {
      $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
      $items = $items instanceof Collection ? $items : Collection::make($items);
      return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
