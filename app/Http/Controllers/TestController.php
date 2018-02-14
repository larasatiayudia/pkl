<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\materi_test;
use App\Model\test;
use App\Model\User;
use App\Model\peserta;
use App\Model\attempt;
use App\Model\grading;
use Carbon\Carbon;
use Hashids;
use Session;
use Charts;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class TestController extends Controller
{
    public function singletest(Request $request,$id)
    {
      if(Session::has('attempt')){
        $id = Session::get('attempt');
        return redirect('/soal/'.$id);
      }else{
        $id_user = $request->session()->get('id_user');
        $iddecode = Hashids::decode($id);
        $id = $iddecode[0];
        $status = $iddecode[1];
        $materi = materi_test::find($id);
        if($status){
          if($materi->test->isEmpty()){
            $notification= array('tittle'=>"Maaf",'msg'=>"Test untuk materi belum ada",'alert-type'=>"error");
            return redirect('/deskripsimateri/'.Hashids::encode($materi->id_mat,$materi->status))->with($notification);
          }else{
            $id_test = $materi->test[0]->id_test;
          }
          $test = test::find($id_test);
          $peserta = peserta::where([['id_user',$id_user],['id_test',$id_test]])->get();
          return view('user.deskripsitest',['test'=>$test,'peserta'=>$peserta,'status'=>$status]);
        }else{
          $tests = $materi->test;
          $pretest = null;
          $posttest = null;
          foreach ($tests as $test) {
            if($test->tipe_test==0){
              $pretest = $test;
            }
            if($test->tipe_test==1){
              $posttest = $test;
            }
          }
          if($pretest!=null){
            $pesertapre = peserta::where([['id_user',$id_user],['id_test',$pretest->id_test]])->first();
          }else{
            $pesertapre = null;
          }
          if($posttest!=null){
            $pesertapost = peserta::where([['id_user',$id_user],['id_test',$posttest->id_test]])->first();
          }else{
            $pesertapost = null;
          }
          return view('user.deskripsitest',['pesertapre'=>$pesertapre,'pesertapost'=>$pesertapost,'pretest'=>$pretest,'posttest'=>$posttest,'materi'=>$materi,'status'=>$status]);
        }
      }
    }

    public function singletestbonus(Request $request,$id)
    {
      if(Session::has('attempt')){
        $id = Session::get('attempt');
        return redirect('/soal/'.$id);
      }else{
        $id_user = $request->session()->get('id_user');
        $iddecode = Hashids::decode($id);
        $id = $iddecode[0];
        $test = test::find($id);
        $peserta = peserta::where([['id_user',$id_user],['id_test',$test->id_test]])->get();
        return view('user.deskripsitestbonus',['test'=>$test,'peserta'=>$peserta]);
      }
    }

    public function kliktomboltest(Request $request,$id)
    {
      if(Session::has('attempt')){
        $id = Session::get('attempt');
        return redirect('/soal/'.$id);
      }else{
        $iddecode = Hashids::decode($id);
        $id = $iddecode[0];
        $test = test::find($id);
        $id_user  = $request->session()->get('id_user');
        $peserta = peserta::where([['id_user',$id_user],['id_test',$id]])->get();
        if($peserta->isEmpty()){
          $attempt = $test->attempt;
          $attempt = $attempt-1;
          peserta::create([
            'id_user' => $id_user,
            'id_test' => $id,
            'sisa_attempt' => $attempt
          ]);
          $peserta = peserta::where([['id_user',$id_user],['id_test',$id]])->first();
          $attempts = attempt::create([
            'id_peserta' => $peserta->id_peserta
          ]);
        }else{
          $attempt = $peserta[0]->sisa_attempt;
          if($attempt>0){
            $attempt = $attempt-1;
            peserta::where([['id_user',$id_user],['id_test',$id]])->update(['sisa_attempt'=>$attempt]);
            attempt::create([
            'id_peserta' => $peserta[0]->id_peserta
            ]);
            $attempts = attempt::where('id_peserta',$peserta[0]->id_peserta)->orderBy('id_attempt','desc')->first();
          }else{
            $notification = array('tittle'=> 'Ooppss...',
                            'msg'=>'Attempt anda sudah habis',
                            'alert-type'=>'error');
            return redirect()->back()->with($notification);
          }
        }
        $id = Hashids::encode($id,$attempts->id_attempt);
        $waktuklik = Carbon::now();
        $soals = $test->soal;
        $soals = $soals->random($test->jumlah_soal);
        $request->session()->put('waktukliktest',$waktuklik);
        $request->session()->put('soals',$soals);
        $request->session()->put('attempt',$id);
        return redirect('/soal/'.$id);
      }
    }

    public function countdowntest(Request $request,$id)
  	{
	    $iddecode = Hashids::decode($id);
	    $id = $iddecode[0];
	    $test = test::find($id);
	    $durasi = $test->durasi;
	    $waktuklik = $request->session()->get('waktukliktest');
      $waktuklik = Carbon::createFromFormat('Y-m-d H:i:s', $waktuklik);
      if($test->waktu_tutup != null){
        $waktu_tutup = Carbon::createFromFormat('Y-m-d H:i:s', $test->waktu_tutup);
      }else{
        $waktu_tutup = null;
      }
	    $bataswaktu = $waktuklik->addMinutes($durasi);
      $waktusekarang = Carbon::now();
      if($bataswaktu->diffInSeconds($waktu_tutup,false)>0 || $waktu_tutup== null){
        $countdown = $waktusekarang->diffInSeconds($bataswaktu,false);
      }else{
        $countdown = $waktusekarang->diffInSeconds($waktu_tutup,false);
      }
	    return $countdown;
  	}

    public function ngerjaintest(Request $request,$id)
    {
      $iddecode = Hashids::decode($id);
      $id_test = $iddecode[0];
      $id_attempt = $iddecode[1];
      $test = test::find($id_test);
      $gradings = grading::where('id_attempt',$id_attempt)->get();
      $soals = $request->session()->get('soals');
      $jawaban = array();
      if(!$gradings->isEmpty()){
        foreach ($soals as $index => $soal) {
          $grading=grading::where([['id_attempt',$id_attempt],['id_soal',$soal->id_soal]])->get();
          if(!$grading->isEmpty()){
            $jawaban[$index] = $grading[0]->selected_ans;
          }else{
            $jawaban[$index] = "gaada";
          }
        }
      }
      return view('user.soal',['test'=>$test,'soals'=>$soals,'id_attempt'=>$id_attempt,'jawaban'=>$jawaban]);
    }

    public function tipetes($id)
  {
    $iddecode = Hashids::decode($id);
    $id_mat = $iddecode[0];
    $status = $iddecode[1];
    $materi = materi_test::find($id_mat);
    $tests = $materi->test;
    $pretest = null;
    $posttest = null;
    if(!$tests->isEmpty()){
      foreach ($tests as $test) {
        if($test->tipe_test == 0)
          $pretest = $test;
        else
          $posttest = $test;
      }
    }
    if(\Auth::guard('superadmin')){
      return view('admin_grup.formtipesoal',['materi'=>$materi,'status'=>$status,'pretest'=>$pretest,'posttest'=>$posttest]);
    }else{
      return view('admin.formtipesoal',['materi'=>$materi,'status'=>$status,'pretest'=>$pretest,'posttest'=>$posttest]);
    }
  }

public function tipetesbonus($id)
  {
    $iddecode = Hashids::decode($id);
    $id_mat = $iddecode[0];
    $status = $iddecode[1];
    $materi = materi_test::find($id_mat);
    $tests = $materi->test;
    $easy = null;
    $medium = null;
    $hard = null;
    if(!$tests->isEmpty()){
      foreach ($tests as $test) {
        if($test->tipe_test == 2)
          $easy = $test;
        elseif($test->tipe_test == 3)
          $medium = $test;
        elseif($test->tipe_test == 4)
          $hard = $test;
      }
    }
    return view('admin_grup.formtipesoalbonus',['materi'=>$materi,'status'=>$status,'easy'=>$easy,'medium'=>$medium,'hard'=>$hard]);
  }

  public function tambahtest($id)
  {
    $iddecode = Hashids::decode($id);
    $id_mat = $iddecode[0];
    $status = $iddecode[1];
    if(count($iddecode)>2){
      $tipe = $iddecode[2];
      $materi = materi_test::find($id_mat);
      $tests = $materi ->test;
      $test = null;
      foreach ($tests as $check) {
        if($check->tipe_test == $tipe){
          $test = $check;
        }
      }
      if(\Auth::guard('superadmin')){
        return view('admin_grup.formtest',['materi'=>$materi,'test'=>$test,'status'=>$status,'tipe'=>$tipe]);
      }else{
        return view('admin.formtest',['materi'=>$materi,'test'=>$test,'status'=>$status,'tipe'=>$tipe]);
      }
    }else{
      $materi = materi_test::find($id_mat);
      $test = $materi ->test;
      if($test->isEmpty()){
        $test = null;
      }
      if(\Auth::guard('superadmin')){
        return view('admin_grup.formtest',['materi'=>$materi,'test'=>$test,'status'=>$status]);
      }else{
        return view('admin.formtest',['materi'=>$materi,'test'=>$test,'status'=>$status]);
      }
    }
  }

  public function tambahtestbonus($id)
  {
    $iddecode = Hashids::decode($id);
    $id_mat = $iddecode[0];
    $status = $iddecode[1];
    if(count($iddecode)>2){
      $tipe = $iddecode[2];
      $materi = materi_test::find($id_mat);
      $tests = $materi->test;
      $test = null;
      foreach ($tests as $check) {
        if($check->tipe_test == $tipe){
          $test = $check;
        }
      }
      return view('admin_grup.formtestbonus',['materi'=>$materi,'test'=>$test,'status'=>$status,'tipe'=>$tipe]);
    }else{
      $materi = materi_test::find($id_mat);
      $test = $materi ->test;
      if($test->isEmpty()){
        $test = null;
      }
      return view('admin_grup.formtestbonus',['materi'=>$materi,'test'=>$test,'status'=>$status]);
    }
  }

  public function posttest(Request $request)
  {
    $id_mat = $request['id_mat'];
    $nama = $request['nama'];
    $durasi = $request['durasi'];
    $jumlah = $request['jumlah'];
    $tanggalbuka = $request['tanggalbuka'];
    $jambuka = $request['jambuka'];
    $tanggaltutup = $request['tanggaltutup'];
    $jamtutup = $request['jamtutup'];
    if($tanggalbuka != null && $jambuka != null){
      $waktu_buka = $tanggalbuka.' '.$jambuka;
    }else{
      $waktu_buka = null;
    }
    if($tanggaltutup != null && $jamtutup != null){
      $waktu_tutup = $tanggaltutup.' '.$jamtutup;
    }else{
      $waktu_tutup = null;
    }
    $deskripsi = $request['deskripsi'];
    $attempt = $request['attempt'];
    $passing = $request['passing'];
    $tipe = $request['tipe'];
    $materi = materi_test::find($id_mat);
    $check = $materi->test;
    if($check->isEmpty()){
      if($tipe==null){
      $test = test::create([
        'id_mat'=>$id_mat,
        'nama'=> $nama,
        'durasi' => $durasi,
        'jumlah_soal' => $jumlah,
        'waktu_buka' => $waktu_buka,
        'waktu_tutup' => $waktu_tutup,
        'peraturan_test' => $deskripsi,
        'attempt' => $attempt,
        'passing_grade' => $passing
      ]);
      }else{
        $test = test::create([
          'id_mat'=>$id_mat,
          'nama'=> $nama,
          'durasi' => $durasi,
          'jumlah_soal' => $jumlah,
          'waktu_buka' => $waktu_buka,
          'waktu_tutup' => $waktu_tutup,
          'peraturan_test' => $deskripsi,
          'attempt' => $attempt,
          'passing_grade' => $passing,
          'tipe_test' => $tipe
        ]);
      }
    }elseif ($materi->status==1 && $check->count() == 1) {
      test::where('id_mat',$id_mat)->update([
        'id_mat'=>$id_mat,
        'nama'=> $nama,
        'durasi' => $durasi,
        'jumlah_soal' => $jumlah,
        'waktu_buka' => $waktu_buka,
        'waktu_tutup' => $waktu_tutup,
        'peraturan_test' => $deskripsi,
        'attempt' => $attempt,
        'passing_grade' => $passing
      ]);
      $test = test::where('id_mat',$id_mat)->first();
    }elseif($materi->status == 0){
      if($check->count() == 1){
        if($check[0]->tipe_test == $tipe){
          test::where([['id_mat',$id_mat],['tipe_test',$tipe]])->update([
          'id_mat'=>$id_mat,
          'nama'=> $nama,
          'durasi' => $durasi,
          'jumlah_soal' => $jumlah,
          'waktu_buka' => $waktu_buka,
          'waktu_tutup' => $waktu_tutup,
          'peraturan_test' => $deskripsi,
          'attempt' => $attempt,
          'passing_grade' => $passing,
          'tipe_test' => $tipe
          ]);
          $test = test::where([['id_mat',$id_mat],['tipe_test',$tipe]])->first();
        }else{
          $test = test::create([
            'id_mat'=>$id_mat,
            'nama'=> $nama,
            'durasi' => $durasi,
            'jumlah_soal' => $jumlah,
            'waktu_buka' => $waktu_buka,
            'waktu_tutup' => $waktu_tutup,
            'peraturan_test' => $deskripsi,
            'attempt' => $attempt,
            'passing_grade' => $passing,
            'tipe_test' => $tipe
          ]);
        }
      }
    }elseif($materi->status == 2){
      $find = 0;
      foreach($check as $c){
        if($c->tipe_test == $tipe){
          test::where([['id_mat',$id_mat],['tipe_test',$tipe]])->update([
          'id_mat'=>$id_mat,
          'nama'=> $nama,
          'durasi' => $durasi,
          'jumlah_soal' => $jumlah,
          'waktu_buka' => $waktu_buka,
          'waktu_tutup' => $waktu_tutup,
          'peraturan_test' => $deskripsi,
          'attempt' => $attempt,
          'passing_grade' => $passing,
          'tipe_test' => $tipe
          ]);
          $test = test::where([['id_mat',$id_mat],['tipe_test',$tipe]])->first();
          $find+=1;
        }
      }
      if($find==0){
        $test = test::create([
          'id_mat'=>$id_mat,
          'nama'=> $nama,
          'durasi' => $durasi,
          'jumlah_soal' => $jumlah,
          'waktu_buka' => $waktu_buka,
          'waktu_tutup' => $waktu_tutup,
          'peraturan_test' => $deskripsi,
          'attempt' => $attempt,
          'passing_grade' => $passing,
          'tipe_test' => $tipe
        ]);
      }
    }else{
        test::where([['id_mat',$id_mat],['tipe_test',$tipe]])->update([
            'id_mat'=>$id_mat,
            'nama'=> $nama,
            'durasi' => $durasi,
            'jumlah_soal' => $jumlah,
            'waktu_buka' => $waktu_buka,
            'waktu_tutup' => $waktu_tutup,
            'peraturan_test' => $deskripsi,
            'attempt' => $attempt,
            'passing_grade' => $passing,
            'tipe_test' => $tipe
        ]);
        $test = test::where([['id_mat',$id_mat],['tipe_test',$tipe]])->first();
    }

    $materi = materi_test::find($id_mat);
    $materi_tutup = null;
    $materi_buka = null;
    foreach ($materi->test as $test) {
      if($materi_tutup==null && $materi_buka==null){
        $materi_buka = $test->waktu_buka;
        $materi_tutup = $test->waktu_tutup;
      }else{
        $test_tutup = Carbon::createFromFormat('Y-m-d H:i:s', $test->waktu_tutup);
        $materi_tutup = Carbon::createFromFormat('Y-m-d H:i:s', $materi_tutup);
        $hasil_tutup = $materi_tutup->diffInSeconds($test_tutup,false);
        if($hasil_tutup>0){
          $materi_tutup = $test->waktu_tutup;
        }
        $test_buka = Carbon::createFromFormat('Y-m-d H:i:s', $test->waktu_buka);
        $materi_buka = Carbon::createFromFormat('Y-m-d H:i:s', $materi_buka);
        $hasil_buka = $materi_buka->diffInSeconds($test_buka,false);
        if($hasil_buka<0){
          $materi_buka = $test->waktu_buka;
        }
      }
    }
    materi_test::where('id_mat',$materi->id_mat)->update([
      'waktu_buka' => $materi_buka,
      'waktu_tutup' => $materi_tutup
    ]);
    if($materi->status != 2){
       if(\Auth::guard('superadmin')){
        return redirect('/admin/formsoal/'.Hashids::encode($test->id_test,$materi->status));
       }else{
        return redirect('/formsoal/'.Hashids::encode($test->id_test,$materi->status));
       }

    }else{
      return redirect('admin/formmodulbonus/'.Hashids::encode($materi->id_mat,$materi->status,$tipe,$test->id_test));
    }
  }

  public function edittest(Request $request)
  {
    $id_test = $request['id_test'];
    $nama = $request['nama'];
    $durasi = $request['durasi'];
    $jumlah = $request['jumlah'];
    $tanggalbuka = $request['tanggalbuka'];
    $jambuka = $request['jambuka'];
    $tanggaltutup = $request['tanggaltutup'];
    $jamtutup = $request['jamtutup'];
    if($tanggalbuka != null && $jambuka != null){
      $waktu_buka = $tanggalbuka.' '.$jambuka;
    }else{
      $waktu_buka = null;
    }
    if($tanggaltutup != null && $jamtutup != null){
      $waktu_tutup = $tanggaltutup.' '.$jamtutup;
    }else{
      $waktu_tutup = null;
    }
    $deskripsi = $request['deskripsi'];
    $attempt = $request['attempt'];
    $passing = $request['passing'];
    test::where('id_test',$id_test)->update([
      'nama'=> $nama,
      'durasi' => $durasi,
      'jumlah_soal' => $jumlah,
      'waktu_buka' => $waktu_buka,
      'waktu_tutup' => $waktu_tutup,
      'peraturan_test' => $deskripsi,
      'attempt' => $attempt,
      'passing_grade' => $passing
    ]);
    $test = test::find($id_test);
    $id_mat = $test->materi->id_mat;
    $materi = materi_test::find($id_mat);
    $materi_tutup = null;
    $materi_buka = null;
    foreach ($materi->test as $test) {
      if($materi_tutup==null && $materi_buka==null){
        $materi_buka = $test->waktu_buka;
        $materi_tutup = $test->waktu_tutup;
      }else{
        $test_tutup = Carbon::createFromFormat('Y-m-d H:i:s', $test->waktu_tutup);
        $materi_tutup = Carbon::createFromFormat('Y-m-d H:i:s', $materi_tutup);
        $hasil_tutup = $materi_tutup->diffInSeconds($test_tutup,false);
        if($hasil_tutup>0){
          $materi_tutup = $test->waktu_tutup;
        }
        $test_buka = Carbon::createFromFormat('Y-m-d H:i:s', $test->waktu_buka);
        $materi_buka = Carbon::createFromFormat('Y-m-d H:i:s', $materi_buka);
        $hasil_buka = $materi_buka->diffInSeconds($test_buka,false);
        if($hasil_buka<0){
          $materi_buka = $test->waktu_buka;
        }
      }
    }
    materi_test::where('id_mat',$materi->id_mat)->update([
      'waktu_buka' => $materi_buka,
      'waktu_tutup' => $materi_tutup
    ]);
    $test = test::find($id_test);
    if($materi->status != 2){
      if(\Auth::guard('superadmin')){
        return redirect('/admin/formsoal/'.Hashids::encode($id_test,$test->materi->status));
      }else{
        return redirect('/formsoal/'.Hashids::encode($test->id_test,$materi->status));
      }
    }else{
      return redirect('admin/formmodulbonus/'.Hashids::encode($materi->id_mat,$materi->status,$test->id_test));
    }
  }
  public function hapustest($id)
  {
    test::find($id)->delete();
    $notification = array('tittle'=> 'Berhasil!','msg'=>'Test telah dihapus.','alert-type'=>'success');
    return redirect()->back()->with($notification);
  }
  public function liststatistik(Request $request)
  {
    $id_user = $request->session()->get('id_user');
    $user = User::find($id_user);
    $id_jabatan = $user->id_jabatan;
    if($request['filter']==null||$request['filter']=="all"){
      $materis = materi_test::where('id_jabatan',$id_jabatan)->get();
      $tests = new \Illuminate\Database\Eloquent\Collection;
      $panjang = $tests->count()-1;
      foreach($materis as $materi){
        foreach($materi->test as $test){
          $sekarang = Carbon::now();
          $waktu_buka = Carbon::createFromFormat('Y-m-d H:i:s', $test->waktu_buka);
          $selisih = $sekarang->diffInSeconds($waktu_buka,false);
          if($selisih<0){
            $tests[$panjang] = $test;
            $panjang+=1;
          }
        }
      }

      $tests = $this->paginate($tests,['path'=>url()->current()]);
      return view('user.statistik',['tests'=>$tests]);
    }elseif($request['filter']=="pendek"){
      $status = 0;
      $materis = materi_test::where([['status',$status],['id_jabatan',$id_jabatan]])->get();
      $tests = new \Illuminate\Database\Eloquent\Collection;
      $panjang = $tests->count()-1;
      foreach($materis as $materi){
        foreach($materi->test as $test){
          $sekarang = Carbon::now();
          $waktu_buka = Carbon::createFromFormat('Y-m-d H:i:s', $test->waktu_buka);
          $selisih = $sekarang->diffInSeconds($waktu_buka,false);
          if($selisih<0){
            $tests[$panjang] = $test;
            $panjang+=1;
          }
        }
      }
      $tests = $this->paginate($tests,['path'=>url()->current()]);
      return view('user.statistik',['tests'=>$tests]);
    }elseif($request['filter']=="panjang"){
      $status = 1;
      $materis = materi_test::where([['status',$status],['id_jabatan',$id_jabatan]])->get();
      $tests = new \Illuminate\Database\Eloquent\Collection;
      $panjang = $tests->count()-1;
      foreach($materis as $materi){
        foreach($materi->test as $test){
          $sekarang = Carbon::now();
          $waktu_buka = Carbon::createFromFormat('Y-m-d H:i:s', $test->waktu_buka);
          $selisih = $sekarang->diffInSeconds($waktu_buka,false);
          if($selisih<0){
            $tests[$panjang] = $test;
            $panjang+=1;
          }
        }
      }
      $tests = $this->paginate($tests,['path'=>url()->current()]);
      return view('user.statistik',['tests'=>$tests]);
    }
  }

    public function chart(Request $request,$id)
    {
      $iddecode = Hashids::decode($id);
      $id = $iddecode[0];
      $test = test::find($id);
      $jumlahikut = $test->peserta->count();
      $jabatan = $test->materi->id_jabatan;
      $totalpeserta = User::where('id_jabatan',$jabatan)->count();
      $belumikut = $totalpeserta - $jumlahikut;
      $pesertas = $test->peserta;
      $lulus =0;
      $tidak = 0;
      $rataan = 0;

      foreach ($pesertas as $peserta) {
        if($peserta->nilai >= $test->passing_grade){
          $lulus +=1;
        }else{
          $tidak +=1;
        }
        $rataan += $peserta->nilai;
      }

      if($pesertas->count()!=0 || $rataan!=0){
        $rataan = $rataan/$pesertas->count();
        $tmp = peserta::where('id_test',$id)->orderBy('nilai','desc')->first();
        $max = $tmp->nilai;
        $tmp = peserta::where('id_test',$id)->orderBy('nilai','asc')->first();
        $min = $tmp->nilai;
      }else{
        $rataan = 0;
        $max = 0;
        $min = 0;
      }
      $users = User::all();
      if($totalpeserta !=0){
          $chart = Charts::create('pie', 'plottablejs')
        ->title('Diagram keikutsertaan\n'. $test->nama)
        // ->responsive(true)
        ->labels(['Sudah mengikuti:\n'.$jumlahikut.' ('.round(($jumlahikut/$totalpeserta)*100,2) . '%)', 'Belum mengikuti : \n'.$belumikut .' ('.round(($belumikut/$totalpeserta)*100,2) . '%)'])
        ->values([$jumlahikut,$belumikut])
        ->colors(['#2ba970','#e59e31'])
        ->dimensions(400,500);
      }else{
        $chart = null;
      }
      if($lulus == 0 && $tidak==0){
        $chart2 = null;
      }else{
        $chart2 = Charts::create('pie', 'plottablejs')
        ->title('Diagram kelulusan\n'. $test->nama)
        // ->responsive(true)
        ->labels(['Lulus:\n'.$lulus.' ('.round(($lulus/$jumlahikut)*100,2).'%)', 'Tidak lulus:\n'.$tidak.' ('.round(($lulus/$jumlahikut)*100,2).'%)'])
        ->values([$lulus,$tidak])
        ->dimensions(400,500);
      }
        if(Session::has('id_grup')){
          return view('admin_grup.chart', ['chart' => $chart,'chart2' => $chart2,'users'=>$users,'id'=>$id, 'test'=>$test,
                    'rataan'=>$rataan,'max'=>$max,'min'=>$min]);
        }
        else{
          return view('user.chart', ['chart' => $chart,'chart2' => $chart2,'users'=>$users,'id'=>$id, 'test'=>$test,
                    'rataan'=>$rataan,'max'=>$max,'min'=>$min]);
        }
    }

    public function paginate($items, $options = [], $perPage = 6, $page = null)
    {
      $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
      $items = $items instanceof Collection ? $items : Collection::make($items);
      return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
