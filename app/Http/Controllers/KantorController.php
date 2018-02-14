<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\kantor;
use App\Model\tipekantor;
use App\Model\superadmin;

class KantorController extends Controller
{
    public function filterkantor($id){
        $tipe=tipekantor::find($id);
        $kantors=kantor::orderBy('level')->orderBy('nama_kantor')->get();
        $max=$kantors->max('level');
        if($tipe->level==$max){
            return $kantors;
        }
        $kantor=kantor::where('tipe',$id)->orderBy('nama_kantor')->get();
        return $kantor;
    }

    public function modaltambah($id)
    {
        $tipe=tipekantor::find($id);
        if($tipe->level-1>0){
            $super=tipekantor::where('level','<',$tipe->level)->where('id_grup',1)->orderBy('level','desc')->first();
            $kantor=kantor::where('level','>=',$super->level)->where('level','<',$tipe->level)->get();
            
        }
        else{
            $kantor=kantor::where('level',-1)->get();
        }
        return response()->json($kantor);
    }

    public function modaledit($id)
    {
        $kantor=kantor::find($id);
        $tipe=tipekantor::find($kantor->tipe);
        if($tipe->level-1>0){
           $super=tipekantor::where('level','<',$tipe->level)->where('id_grup',1)->orderBy('level','desc')->first();
            $superkantor=kantor::where('level','>=',$super->level)->where('level','<',$tipe->level)->get(); 
        }
        else{
            $superkantor=kantor::where('level',-1)->get();
        }
        return response()->json(['superkantor'=>$superkantor,'kantor'=>$kantor]);
    }

    public function modalAddOperator(){
        $kantors= kantor::all();
        return $kantors;
    }

    public function modalEditOperator($id){
        $superadmin=superadmin::where('username',$id)->first();
        $kantor = kantor::find($superadmin->operator_kantor->id_kantor);
        $kantors= kantor::where('id_kantor','!=',$superadmin->operator_kantor->id_kantor)->get();
        return response()->json(['kantors'=>$kantors,'kantor'=>$kantor]);
    }
    public function modalAddUser($id){
        $kantor=kantor::where('tipe',$id)->get();
        return $kantor;
    }
    public function modalEditUser($id){
        $kantor=kantor::find($id);
        return $kantor;
    }

    public function viewKantor(Request $request){
        $kantors=kantor::orderBy('level')->orderBy('nama_kantor')->paginate(10);
        $tipekantor=tipekantor::all();
        return view('operator.kantor',['kantors' => $kantors,'tipekantor' => $tipekantor]);
    }
    
    public function searchkantor(Request $request){
        $keywords=$request['q'];
        $kantors = kantor::where(function($q) use ($keywords){
                            $q->where('nama_kantor','LIKE','%'.$keywords.'%')
                              ->orWhereHas('tipekantor',function($r) use($keywords){
                                    $r->where('tipe_kantor','LIKE','%'.$keywords.'%');
                                });
                            })
                         ->orderBy('level')
                         ->orderBy('nama_kantor')
                         ->paginate(10);
        $tipekantor=tipekantor::all();
        return view('operator.search_kantor',['kantors'=> $kantors,'tipekantor' => $tipekantor,'q'=>$keywords]);
    }

	public function addKantor(Request $request){
        $this->middleware('auth');
        $this->validate($request,[
            'tipe'=>'required',
            'kantor'=>'required|max:50',
        ]);
        $level=tipekantor::find($request['tipe'])->level;
        kantor::create([
            'tipe'          => $request['tipe'],
            'nama_kantor'   => $request['kantor'],
            'level'         => $level,
            'id_superkantor'=> $request['superkantor']
        ]);

        return redirect(route('operator.daftarKantor'))->with('message',$request['kantor'].' berhasil ditambahkan!');
    }

    public function editkantor(Request $request) {
        $this->middleware('auth');
        $this->validate($request,[
            'tipe'=>'required',
            'kantor'=>'required|max:50',
        ]);
        $level=tipekantor::find($request['tipe'])->level;
        $kantor=kantor::find($request['id_kantor'])->nama_kantor;
        kantor::where('id_kantor', $request['id_kantor'])->update([
            'tipe'          => $request['tipe'],
            'nama_kantor'   => $request['kantor'],
            'level'         => $level,
            'id_superkantor'=> $request['superkantor']
        ]);
        return redirect()->back()->with('message', $kantor.' berhasil diedit!');
    }

    public function deletekantor($id){
        $kantor=kantor::find($id)->nama_kantor;
        kantor::destroy($id);
        return redirect()->back()->with('message', $kantor.' berhasil dihapus!');
    }
}
