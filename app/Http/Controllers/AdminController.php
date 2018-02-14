<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Model\admin;
use App\Model\User;
use App\Model\materi_test;
use App\Model\modul;
use App\Model\test;
use App\Model\soal;
use App\Model\jabatan;
use App\Model\grup;
use Hashids;
use Carbon\Carbon;
use Jenssegers\Date\Date;
use Charts;

class AdminController extends Controller
{
    public function viewAdmin(Request $request){
        $id_grup = $request->session()->get('id_grup');
        $users = User::where('Status',1)
                     ->where('id_grup',$id_grup)
                     ->paginate(10);
        return view('admin_grup.admin', ['users' => $users]);
    }

    public function assignAdmin(Request $request){
    	$id = $request['id_user'];
		User::where('id_user',$id)->update(['status' => 1]);
		$jabatans = $request['id_jabatan'];
		foreach ($jabatans as $j) {
		  admin::create([
			  'id_user'=>$id,
			  'id_ja'=>$j
		  ]);
		}
		return redirect(route('superadmin.daftarAdmin'));
	}

    public function searchAdmin(Request $request){
        $keywords=$request['q'];
        $id_grup = $request->session()->get('id_grup');
        $grup = grup::find($id_grup);
        $users = User::where('Status',1)
                     ->where('id_grup',$id_grup)
                     ->where(function($q) use ($keywords){
                        $q->where('Nama','LIKE','%'.$keywords.'%')
                          ->orWhere('NIP','LIKE','%'.$keywords.'%');
                     })
                     ->get();
        return view('admin_grup.search_admin', ['users' => $users]);
    }

	public function pilihjabatan(Request $request)
	{
        if(\Auth::guard('superadmin')){
            $id_grup = $request->session()->get('id_grup');
            $jabatans = jabatan::where([['id_grup',$id_grup],['nama_jabatan','!=','all']])->get();
            return view('admin_grup.pilihjabatan',['jabatans'=>$jabatans]);
        }else{
            $id_user= $request->session()->get('id_user');
            $user = User::find($id_user);
            return view('admin.pilihjabatan',['user'=>$user]);
        }
	}

    public function findAction(Request $request) {
        if ($request->has('jabatan')) {
            $this->dispatch(new \App\Jobs\editAdmin($request));
            return redirect(route('admingrup.daftarAdmin'))->with('message', 'data berhasil diedit!');
        } else if ($request->has('id_user')) {
            $this->dispatch(new \App\Jobs\deleteAdmin($request));
            return redirect(route('admingrup.daftarAdmin'))->with('message', 'admin berhasil dinonaktifkan!');
        }
        return 'no action found';
    }

    

}
