<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\grup;
use App\Model\superadmin;
use App\Model\jabatan;

class GrupController extends Controller
{
    public function getSA($id){
        $sa=superadmin::where('status',0)->where('id_grup',$id)->get();
        return $sa;
    }
    public function getkontakgrup(){
        $groups= grup::where('status',1)->where('id_grup','!=',1)
                   ->orderBy('nama_grup')
                   ->get();
        return response()->json($groups);
    }
    public function modalgrup(){
        $grup= grup::where('status',0)
                   ->orderBy('nama_grup')
                   ->get();
        return $grup;
    }

	public function modaleditgrup($id){
        $superadmin=superadmin::where('username',$id)->first();
        $groups= grup::where('status',0)
                   ->orderBy('nama_grup')
                   ->get();
        $grup = grup::find($superadmin->id_grup);
        return response()->json(['groups'=>$groups,'grup'=>$grup]);
    }

    public function getGroup(){
        $grup= grup::orderBy('kode_grup')->get();
        return $grup;
    }

	public function viewGroup(){
		$groups=grup::where('kode_grup','!=','ALL')->orderBy('nama_grup')->paginate(10);
		return view('operator.group',['groups'=> $groups]);
	}
	
    public function searchGroup(Request $request){
        $keywords=$request['q'];
        $groups = grup::where(function($q) use ($keywords){
	                                $q->where('nama_grup','LIKE','%'.$keywords.'%')
	                                  ->orWhere('kode_grup','LIKE','%'.$keywords.'%');
                                 })
                         ->orderBy('id_grup')
                         ->paginate(10);
        return view('operator.search_group',['groups'=> $groups,'q'=>$keywords]);
    }

    public function addGroup(Request $request){
        $this->middleware('auth');
        $this->validate($request,[
            'kode_grup'=>'required|max:10',
            'nama_grup'=>'required',
        ]);
        $grup = grup::create([
            'kode_grup' => $request['kode_grup'],
            'nama_grup' => $request['nama_grup'],
            'status' => 0,
        ]);
        return redirect(route('operator.daftarGroup'))->with('message',$request['kode_grup'].'  berhasil ditambahkan!');
    }

    public function findAction(Request $request) {
        $grup=grup::find($request['id_grup'])->kode_grup;
        if ($request->has('nama_grup')) {
            $this->middleware('auth');
            $this->validate($request,[
                'kode_grup'=>'required|max:10',
                'nama_grup'=>'required',
            ]);
            $this->dispatch(new \App\Jobs\editGroup($request));
            return redirect(route('operator.daftarGroup'))->with('message', $grup.' berhasil diedit!');
        } 
        else if ($request->has('id_grup')) {
            $this->dispatch(new \App\Jobs\deleteGroup($request));
            return redirect(route('operator.daftarGroup'))->with('message', $grup.' berhasil dihapus!');
        }
        else{
            return 'no action found';
        }
    }
}
