<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\tipekantor;

class TipekantorController extends Controller
{	
    public function getTipe(){
        $tipe=tipekantor::orderBy('level')->get();
        return response()->json($tipe);
    }

    public function filterTipe(Request $request){
        $id_grup=$request->session()->get('id_grup');
        $all=tipekantor::where(function($q) use ($id_grup){
                            $q->where('id_grup',$id_grup)
                              ->orWhere('id_grup',1);
                         })
                       ->get();
        $max=$all->max('level');
        $tipe=tipekantor::where(function($q) use ($id_grup){
                            $q->where('id_grup',$id_grup)
                              ->orWhere('id_grup',1);
                         })
                        ->orderBy('level')->get();
        return response()->json(['tipe'=>$tipe,'max'=>$max]);
    }
    
	public function addTipekantor(Request $request){
        $this->middleware('auth');
        $this->validate($request,[
            'tipe'=>'required',
            'level'=>'required',
            'grup'=>'required',
        ]);
        tipekantor::create([
            'tipe_kantor'   => $request['tipe'],
            'level'			=> $request['level'],
            'id_grup'		=> $request['grup'],
        ]);
        return redirect(route('operator.daftarKantor'))->with(['message'=>$request['tipe'].' berhasil ditambahkan!','tab'=>'tipe']);
    }

    public function editTipekantor(Request $request) {
        $this->middleware('auth');
        $this->validate($request,[
            'tipe'=>'required',
            'level'=>'required',
            'grup'=>'required',
        ]);
        $tipe=tipekantor::find($request['id_tipe'])->tipe_kantor;
        tipekantor::where('id_tipe', $request['id_tipe'])->update([
            'tipe_kantor'   => $request['tipe'],
            'level'			=> $request['level'],
            'id_grup'		=> $request['grup'],
        ]);
        return redirect()->back()->with(['message'=> $tipe.' berhasil diedit!','tab'=>'tipe']);
    }
    public function deleteTipekantor($id){
        $tipe=tipekantor::find($id)->tipe_kantor;
        tipekantor::destroy($id);
        return redirect()->back()->with(['message'=> $tipe.' berhasil dihapus!','tab'=>'tipe']);
    }
}
