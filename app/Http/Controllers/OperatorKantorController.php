<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\superadmin;
use App\Model\operator_kantor;
use App\Model\grup;

class OperatorKantorController extends Controller
{
    public function viewOK(Request $request){
    	$id_grup = $request->session()->get('id_grup');
        $grup = grup::find($id_grup);
    	$operators = superadmin::where('status',2)
    						   ->where('id_grup',$id_grup)
                               ->orderBy('username')
                               ->paginate(10);
        return view('admin_grup.operatorkantor',['operators'=> $operators, 'grup'=> $grup]);
    }
    public function addOK(Request $request){
        $id_grup = $request->session()->get('id_grup');
        $this->middleware('auth');
        $this->validate($request,[
            'username'=>'required|max:25|unique:superadmin',
            'password'=>'required|min:6',
            'kantor'=>'required',
        ]);
        superadmin::create([
            'id_grup' => $id_grup,
            'username' => $request['username'],
            'password' => bcrypt($request['password']),
            'status' => 2,
        ]);
        $sa=superadmin::where('username',$request['username'])->first();
        operator_kantor::create([
            'id_operator' => $sa->id_sa,
            'id_kantor' => $request['kantor'],
        ]);
        return redirect(route('admingrup.daftarOperator'))->with('message', 'Operator berhasil ditambahkan!');
    }
    public function editOK(Request $request){
        $this->middleware('auth');
        $this->validate($request,[
                'username'=>'required|max:25|unique:superadmin',
                'kantor'=>'required'
            ]);
        $id=$request['id_sa'];

        if($request['password']!=null){
            superadmin::where('id_sa',$id)->update([
                'username' => $request['username'],
                'password' => bcrypt($request['password']),
                'status' => 2,
            ]);
        }
        else{
            superadmin::where('id_sa',$id)->update([
                'username' => $request['username'],
                'status' => 2,
            ]);
        }
        operator_kantor::where('id_operator',$id)->update([
                'id_kantor' => $request['kantor'],
        ]);
        return redirect(route('admingrup.daftarOperator'))->with('message', 'Operator berhasil diedit!');
    }
    public function deleteOK($id){
        operator_kantor::where('id_operator',$id)->delete();
        superadmin::destroy($id);
        return redirect(route('admingrup.daftarOperator'))->with('message', 'Operator berhasil dihapus!');
    }
    public function searchOK(Request $request){
        $keywords=$request['q'];
        $id_grup = $request->session()->get('id_grup');
        $grup=grup::find($id_grup);
        $operators = superadmin::where('status',2)
                               ->where('id_grup',$id_grup)
                               ->where(function($q) use ($keywords){
                                    $q->where('username','LIKE','%'.$keywords.'%')
                                      ->orwhereHas('operator_kantor', function($s) use ($keywords){
                                            $s->where('id_kantor','LIKE','%'.$keywords.'%')
                                              ->orwhereHas('kantor',function($r) use ($keywords){
                                                    $r->where('nama_kantor','LIKE','%'.$keywords.'%');
                                                }); 
                                        });     
                                 })
                               ->paginate(10);
        return view('admin_grup.search_operator',['operators'=> $operators,'grup'=> $grup,'q'=>$keywords]);
    }
}
