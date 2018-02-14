<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Model\User;
use App\Model\level;
use App\Model\superadmin;
use Session;

class UserController extends Controller
{
    public function profil(Request $request)
    {
      $id_user  = $request->session()->get('id_user');
      $user = User::find($id_user);
      $current_level = level::where([['point_minimum','<=',$user->point],['id_grup',$user->id_grup]])->orderBy('point_minimum','desc')->first();
      $next_level = level::where('point_minimum', '>', $current_level->point_minimum)->orderBy('point_minimum','asc')->first(); 
      $levels = level::orderBy('point_minimum', 'asc')->get();
      return view('user.profil',['user'=>$user,'next_level'=>$next_level, 'levels'=>$levels,'current'=>$current_level]);
    }

    public function compareusername(Request $request){
      $username = $request['username']; //username hasil ketik
      $id_user  = $request->session()->get('id_user');
      $users = User::find($id_user);
      $user = $users->username; //username yg lagi login
      $usersdb = User::where('username', $username)->get(); //username yang ada di db
      $status = "tidak ada";
      foreach ($usersdb as $userdb) {
        if($userdb->username == $username && $username!=$user){
          $status = "ada";
          return $status;
        }
        return $status;
      }
    }

    public function editusername(Request $request)
    {
    	$id_user = $request->session()->get('id_user');
    	$username = $request['username'];
    	user::where('id_user',$id_user)->update([
    		'username'=> $username
    	]);
    	$notification = array('tittle'=> 'Berhasil!','msg'=>'Username anda telah diganti.','alert-type'=>'success');
		return redirect()->back()->with($notification);
    }

    public function comparepass(Request $request){
	    $passuser = $request['password'];
	    $id_user = $request->session()->get('id_user');
	    $user = User::find($id_user);
	    $passdb = $user->password;
	    // return response()->json(['pass'=>$passuser,'passdb'=>$passdb]);
	    if(hash::check($passuser, $passdb)){
	      return "bener";
	    }
	    else{
	      return "salah";
	    }
	}

  	public function editpassword(Request $request){
  		$id_user = $request->session()->get('id_user');
      	$passbaru = $request['passbaru'];
      	user::where('id_user',$id_user)->update([
      		'password'=> bcrypt($passbaru)
      	]);
      	$notification = array('tittle'=> 'Berhasil!','msg'=>'Password anda telah diganti.','alert-type'=>'success');
  		return redirect()->back()->with($notification);
  	}
		
	public function viewUsers(Request $request){
    	$id_grup = $request->session()->get('id_grup');
    	$users = User::where('id_grup',$id_grup)
    				 ->orderBy('Nama')->paginate(10);
        return view('admin_grup.user',['users'=> $users]);
    }

    public function viewUsers_sa(Request $request){
        $id_grup = $request->session()->get('id_grup');
        $users = User::where('Status',0)
                     ->where('id_grup',$id_grup)
                     ->where(function($q){
                        $q->where('id_kantor','KP')
                          ->orWhere('id_kantor','LIKE','%KA%')
                          ->orderBy('id_kantor');
                       })
                     ->orderBy('Nama')
                     ->paginate(10);
        return view('admin_grup.user_admin',['users'=> $users]);
    }

        public function added_user(Request $request){
        $id_grup = $request->session()->get('id_grup');
        $users=User::where('registered_pw','!=','')->where('id_grup',$id_grup)
                   ->orderBy('created_at','desc')
                   ->paginate(10);
        $printusr= User::where('registered_pw','!=','')->where('id_grup',$id_grup)
                   ->orderBy('created_at','desc') ->get();        
        return view('admin_grup.added_user',['users'=> $users,'printusr' => $printusr]);
    }

    public function searchAdded_user(Request $request){
      $keywords=$request['q'];
      $id_grup = $request->session()->get('id_grup');
      $users = User::where('id_grup',$id_grup)
                   ->where('registered_pw','!=','')
                   ->where(function($q) use ($keywords){
                              $q->where('Nama','LIKE','%'.$keywords.'%')
                                ->orWhere('NIP','LIKE','%'.$keywords.'%');
                                
                      })
                   ->orderBy('created_at','desc')->paginate(10);
        $printusr = User::where('id_grup',$id_grup)
                   ->where(function($q) use ($keywords){
                                  $q->where('Nama','LIKE','%'.$keywords.'%')
                                    ->orWhere('NIP','LIKE','%'.$keywords.'%');
                                    
                          })
                   ->orderBy('created_at','desc')->paginate(10);
        return view('admin_grup.search_added_user',['users'=> $users,'q'=>$keywords,'printusr'=>$printusr]);
    }

    public function searchUsers(Request $request){
        $keywords=$request['q'];
        $id_grup = $request->session()->get('id_grup');
    	$username= $request->session()->get('username');
    	$operator= superadmin::where('username',$username)->first();
    	$users = User::where('id_grup',$id_grup)
    				 ->where(function($q) use ($keywords){
	                                $q->where('Nama','LIKE','%'.$keywords.'%')
	                                  ->orWhere('NIP','LIKE','%'.$keywords.'%')
                                      ->orWhereHas('kantor',function($r) use ($keywords){
                                            $r->where('nama_kantor','LIKE','%'.$keywords.'%');
                                      });
                            })
    				 ->orderBy('Nama')->paginate(10);
        return view('admin_grup.search_user',['users'=> $users,'q'=>$keywords]);
    }

    public function searchUsers_sa(Request $request){
        $keywords = $request['q'];
        $id_grup = $request->session()->get('id_grup');
        $users = User::where('Status',0)
                      ->where('id_grup',$id_grup)
                      ->where('Nama','LIKE','%'.$keywords.'%')
                      ->where(function($q){
                            $q->where('id_kantor','KP')
                              ->orWhere('id_kantor','LIKE','%KA%');
                        })
                      ->orderBy('Nama')
                      ->paginate(10);
        return view('admin_grup.search_user_admin',['users'=> $users,'q'=>$keywords]);
    }

    public function editUser(Request $request){
        $id=$request['id_user'];
        $user=User::find($id);
      $this->middleware('auth');
        $this->validate($request,[
            'nama'=>'required',
            'NIP'=>'required',
            'id_kantor'=>'required',
            'id_jabatan'=>'required',
                'username'=>'required|max:25|unique:user,username,'.$user->id_user.',id_user',
        ]);
        $uname=$user->username;
        if($request['password']!=null){
            User::where('id_user',$id)->update([
                'Nama' => $request['nama'],
                'NIP' => $request['NIP'],
                'id_kantor' => $request['id_kantor'],
                'id_jabatan' => $request['id_jabatan'],
                'username' => $request['username'],
                'password' => bcrypt($request['password']),
            ]);
        }
        else{
            User::where('id_user',$id)->update([
                'Nama' => $request['nama'],
                'NIP' => $request['NIP'],
                'id_kantor' => $request['id_kantor'],
                'id_jabatan' => $request['id_jabatan'],
                'username' => $request['username'],
            ]);
        }
        return redirect(route('admingrup.daftarUser'))->with('message', $uname.' berhasil diedit!');
    }

    public function deleteUser($id){
        $uname=User::find($id)->Nama;
        User::destroy($id);
        return redirect(route('admingrup.daftarUser'))->with('message', $uname.' berhasil dihapus!');
    }

}
