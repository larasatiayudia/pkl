<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\jabatan;
use App\Model\User;
use App\Model\admin;
use App\Model\grup;

class JabatanController extends Controller
{
    public function modalAddUser(Request $request){
        $id_grup = $request->session()->get('id_grup');
        $jabatan=jabatan::where([['id_grup',$id_grup],['nama_jabatan','!=','all']])->get();
        return $jabatan;
    }

    public function modalEditUser(Request $request,$id){
        $id_grup = $request->session()->get('id_grup');
        $jabatan=jabatan::where('id_grup',$id_grup)->get();
        $id_ja=User::find($id)->id_jabatan;
        $old_jbtn=jabatan::find($id_ja);
        return response()->json(['jabatan'=>$jabatan,'old'=>$old_jbtn]);
    }

    public function modalAddAdmin($id){
        $user=User::find($id);
        $jabatan= jabatan::where('id_jabatan','!=',$user->id_jabatan)->get();
        return $jabatan;
    }
    public function modalEditAdmin($id){
        $user=User::find($id);
        $jabatans= jabatan::where('id_jabatan','!=',$user->id_jabatan)->get();
        $admin= admin::where('id_user',$id)->get();
        $status= array();
        foreach($admin as $a){
            foreach ($jabatans as $index => $j) {
                if($a->id_ja==$j->id_jabatan){
                    $status[$index]=1;
                }
            }
        }
        return response()->json(['jabatan'=>$jabatans,'status'=>$status]);
        // return response()->json(['lala'=>($admin[0]->id_ja==$jabatans[1]->id_jabatan)]);
    }
    public function viewJabatan(Request $request){
        $id_grup = $request->session()->get('id_grup');
        $grup=grup::find($id_grup);
        $jabatans=jabatan::where([['id_grup',$id_grup],['nama_jabatan','!=','all']])->orderBy('nama_jabatan')->paginate(10);
        return view('admin_grup.jabatan',['jabatans' => $jabatans, 'grup' => $grup]);
    }
    
    public function searchJabatan(Request $request){
        $keywords=$request['q'];
        $id_grup = $request->session()->get('id_grup');
        $grup=grup::find($id_grup);
        $jabatans = jabatan::where('id_grup',$id_grup)
                           ->where('nama_jabatan','LIKE','%'.$keywords.'%')
                           ->orderBy('nama_jabatan')
                           ->paginate(10);
        return view('admin_grup.search_jabatan',['jabatans'=> $jabatans,'grup'=> $grup,'q'=>$keywords]);
    }


    public function addJabatan(Request $request){
        $id_grup = $request->session()->get('id_grup');
        $this->middleware('auth');
        $this->validate($request,[
            'jabatan'=>'required',
        ]);
        jabatan::create([
            'id_grup' => $id_grup,
            'nama_jabatan' => $request['jabatan'],
        ]);
        return redirect()->back()->with('message',$request['jabatan'].' berhasil ditambahkan!');
    }


    public function editJabatan(Request $request) {
        $this->middleware('auth');
        $this->validate($request,[
            'jabatan'=>'required',
        ]);
        $id = $request['id_jabatan'];
        jabatan::where('id_jabatan',$id)->update([
                'nama_jabatan' => $request['jabatan'],
            ]);
        return redirect()->back()->with('message', 'data berhasil diedit!');
    }
    public function deleteJabatan($id){
        jabatan::destroy($id);
        return redirect()->back()->with('message', 'group berhasil dihapus!');
    }
}
