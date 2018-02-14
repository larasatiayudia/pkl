<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\superadmin;

use App\Model\admin;
use App\Model\User;
use App\Model\test;
use App\Model\level;
use App\Model\peserta;
use App\Model\grup;
use App\Model\kantor;
use App\Model\tipekantor;
use App\Model\jabatan;
use Lava;
use Charts;
use PDF;
use Hashids;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;



class SuperadminController extends Controller
{
    public function __construct(){
        $this->middleware('auth:superadmin');
    }

    public function viewRekap(){
        
        return view('admin_grup.materirekap');
    }


    public function paginate($items, $options = [], $perPage = 15, $page = null)
    {
      $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
      $items = $items instanceof Collection ? $items : Collection::make($items);
      return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function filterKantor($Radio,$kantor,$test){
      if($Radio=='all' || $Radio==null){
        // $users = User::all();
        $id_jabatan = $test->materi->id_jabatan;
        $users = User::where('id_jabatan',$id_jabatan)->get();
        return $users;
      }
      else{
        $tipe=tipekantor::find($Radio);
        $kantors=kantor::all();
        $max=$kantors->max('level');
        if($tipe->level==$max){
          $kntr=kantor::find($kantor);
          $id_jabatan = $test->materi->id_jabatan;
          $users = User::where([['id_jabatan',$id_jabatan],['id_kantor',$kntr->id_kantor]])->get();
          return $users;
        }
        else{
          $id_jabatan = $test->materi->id_jabatan;
          $subkntr = new \Illuminate\Database\Eloquent\Collection;
          $sk=kantor::find($kantor);
          $subkntr = $subkntr->merge($sk->subkantor);
          foreach ($sk->subkantor as $sub) {
              $subkntr = $subkntr->merge($sub->subkantor);
          }
          $kantorss= new \Illuminate\Database\Eloquent\Collection;
          $kantorss = $kantorss->merge($subkntr);
          $u= User::where([['id_jabatan',$id_jabatan],['id_kantor',$kantor]])->get();
          $users=new \Illuminate\Database\Eloquent\Collection;
          $users = $users->merge($u);
          foreach($kantorss as $k){
            $u=User::where([['id_kantor',$k->id_kantor],['id_jabatan',$id_jabatan]])->get();
            $users = $users->merge($u);
          }
          return $users;
        }
      }
    }

    public function filterStatus($items,$status,$test)
    {
      $semua = new \Illuminate\Database\Eloquent\Collection;
      $users = new \Illuminate\Database\Eloquent\Collection;
      $pesertas = new \Illuminate\Database\Eloquent\Collection;
      $panjanguser = $users->count()-1;
      $panjangpeserta = $pesertas->count()-1;
      if($status == null || $status=="all"){
        foreach ($items as $item) {
          $check = peserta::where([['id_user',$item->id_user],['id_test',$test->id_test]])->first();
          if($check == null){
            $users[$panjanguser+1] = $item;
            $panjanguser += 1;
          }else{
            $pesertas[$panjangpeserta+1] = $check;
            $panjangpeserta +=1;
          }
        }
        $pesertas = $pesertas->sortByDesc('nilai');
        $semua = $semua->merge($pesertas);
        $semua = $semua->merge($users);        
        return $semua;
      }elseif($status == "lulus" || $status == "tidak_lulus"){
        foreach ($items as $item) {
          $check = peserta::where([['id_user',$item->id_user],['id_test',$test->id_test]])->first();
          if($check != null && $check->nilai >= $test->passing_grade && $status=="lulus"){
            $pesertas[$panjangpeserta+1] = $check;
            $panjangpeserta+=1;
          }elseif ($check != null && $check->nilai < $test->passing_grade && $status=="tidak_lulus") {
            $pesertas[$panjangpeserta+1] = $check;
            $panjangpeserta+=1;
          }
        }
        $pesertas = $pesertas->sortByDesc('nilai');
        $semua = $semua->merge($pesertas);
        return $semua;
      }else{
        foreach ($items as $item) {
          $check = peserta::where([['id_user',$item->id_user],['id_test',$test->id_test]])->first();
          if($check == null){
            $users[$panjanguser+1] = $item;
            $panjanguser += 1;
          } 
        }
        $semua = $semua->merge($users);        
        return $semua;
      }
    }

    public function getdataRekap(Request $request,$id){
      $iddecode = Hashids::decode($id);
      $id = $iddecode[0];
      $test = test::find($id);
      /*$users = User::all();
      $pesertas = peserta::where('id_test',$test->id_test)->orderBy('nilai','desc')->orderBy('waktu_submit','asc')->get();
      $id_jabatan = $test->materi->id_jabatan;*/
      $semua = new \Illuminate\Database\Eloquent\Collection;
      $semua = $this->filterKantor($request['Radio'],$request['kantor'],$test);
      $semua = $this->filterStatus($semua,$request['filter'],$test);
      $semuas = $semua;

      /*$semua = $semua->merge($pesertas);
      $users = User::where('id_jabatan',$id_jabatan)->get();
      $panjang = $semua->count()-1;
      foreach ($users as $user) {
        $check = peserta::where([['id_user',$user->id_user],['id_test',$id]])->first();
        if($check == null){
          $semua[$panjang+1] = $user;
          $panjang+=1;
        }
      }*/
      $semua = $this->paginate($semua,['path'=>url()->current()]);
      return view('admin_grup.rekap',['semua'=>$semua,'test'=>$test,'semuas'=>$semuas]);        
    }

    public function index(Request $request){
      $id_grup=$request->session()->get('id_grup');
      $levels=level::where('id_grup',$id_grup)->get();
      $users=User::where('id_grup',$id_grup)->get();
      $jabatan=jabatan::where('id_grup',$id_grup)->get();
      return view('admin_grup.dashboard',['levels'=>$levels, 'users'=> $users, 'jabatan'=> $jabatan]);
    }


    public function indexOperator(){
        $superadmins=superadmin::where('status',0)->get();
        $groups=grup::all();
        $kantors=kantor::all();
        return view('operator.dashboard',['superadmins'=>$superadmins,'groups'=>$groups, 'kantors'=> $kantors]);
    }
    
    public function viewSuperadmin(){
        $admingroups = superadmin::where('status',0)->orderBy('username')->paginate(10);
        return view('operator.admingroup',['admingroups'=> $admingroups]);
    }

    public function searchSuperadmin(Request $request){
        $keywords=$request['q'];
        $admingroups = superadmin::where('status',0)
                               ->where(function($q) use ($keywords){
                                    $q->where('username','LIKE','%'.$keywords.'%')
                                      ->orwhereHas('grup', function($s) use ($keywords){
                                            $s->where('nama_grup','LIKE','%'.$keywords.'%')
                                                ->orWhere('kode_grup','LIKE','%'.$keywords.'%');
                                      });
                                    
                                 })
                               ->orderBy('id_grup')
                               ->paginate(10);
        return view('operator.search_admingrup',['admingroups'=> $admingroups,'q'=>$keywords]);
    }

    public function findAction(Request $request) {
        $profile=superadmin::find($request['id_sa']);
        $user=$profile->username;
        if ($request->has('username')) {
           $this->middleware('auth');
           $this->validate($request,[
                    'id_grup'=>'required',
                    'username'=>'required|max:25|unique:superadmin,username,'.$profile->id_sa.',id_sa',
                    'email'=>'required|max:50',
                ]);
            $this->dispatch(new \App\Jobs\editSuperadmin($request));
            return redirect(route('operator.daftarSuperadmin'))->with('message', $user.' berhasil diedit dari Admin Grup!');
        } 
        else if ($request->has('id_sa')) {
            $this->dispatch(new \App\Jobs\deleteSuperadmin($request));
            return redirect(route('operator.daftarSuperadmin'))->with('message', $user.' berhasil dihapus dari Admin Grup!');
        }
        return 'no action found';
    }

    public function addSuperadmin(Request $request){
        //add modul -> nama, waktu, file
        $this->middleware('auth');
        $this->validate($request,[
            'id_grup'=>'required',
            'username'=>'required|max:25|unique:superadmin',
            'password'=>'required|min:6',
            'email'=>'required|max:25'
        ]);
        superadmin::create([
            'id_grup' => $request['id_grup'],
            'username' => $request['username'],
            'password' => bcrypt($request['password']),
            'email' => $request['email'],
            'status' => 0,
        ]); 
        grup::where('id_grup',$request['id_grup'])->update(['status'=>1]);
        jabatan::create([
          'id_grup' => $request['id_grup'],
          'nama_jabatan' => 'All',
        ]);
        return redirect(route('operator.daftarSuperadmin'))->with('message', $request['username'].' berhasil ditambahkan ke Admin Grup!');
    }

    public function viewProfile(Request $request){
        $username= $request->session()->get('username');
        $myprofile= superadmin::where('username',$username)->first();
        return view('operator.profile',['myprofile'=>$myprofile]);
    }

    public function editProfile(Request $request){
        $username= $request->session()->get('username');
        $profile=superadmin::where('username',$username)->first();
        $this->middleware('auth');
        $this->validate($request,[
            'username'=>'required|max:25|unique:superadmin,username,'.$profile->id_sa.',id_sa',
            'email'=>'required|max:50',
        ]);
        
        if(count($request['password'])){
          if(bcrypt($request['old_password'])==$profile->password){
            superadmin::where('username',$username)->update([
                'username'=>$request['username'],
                'email'=>$request['email'],
                'password'=>bcrypt($request['password']),
            ]);
            }
            else{
                return redirect()->back()->with('message','passsword yang anda masukkan salah');
            }  
        }
        else{
            superadmin::where('username',$username)->update([
                'username'=>$request['username'],
                'email'=>$request['email'],
            ]);
        }
        
        return redirect(route('operator.myProfile'))->with('message', 'Profil berhasil diperbarui!');
    }

    public function stats(){
        //nunggu arip
    }

    public function pdfview(){
        $admins = admin::all();
        $pdf = PDF::loadView('cobapdf',compact('admins'))->setPaper('A4','Portrait');
        return $pdf->stream("testing.pdf", array("Attachment" => false));
    }

    public function rekap(Request $request){
        $filter=$request['kantor'];
        $filter2=$request['test'];
        if ($filter!='all' && $filter2!='all') {
            $peserta=peserta::where('id_test',$filter2)->get();
            $user=$peserta->user;
            $userfix=$user->where('kantor',$filter)->get();
        }
        elseif($filter!='all' && $filter2=='all'){
            $peserta=peserta::all();
            $user=$peserta->user;
            $userfix=$user->where('kantor',$filter)->get();
        }
        elseif($filter=='all' && $filter2!='all'){
            $peserta=peserta::where('id_test',$filter2)->get();
            $userfix=$peserta->user;
        }
        else{
            $peserta=peserta::all();
            $userfix=$peserta->user;
        }

        $pdf = PDF::loadView('cobarekap',compact('peserta','userfix'))->setPaper('A4','Portrait');
        return $pdf->stream('rekapku', array("Attachment" => false));
    }

}