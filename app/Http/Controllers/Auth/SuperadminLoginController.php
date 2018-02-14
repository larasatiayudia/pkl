<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class SuperadminLoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:superadmin');
    }
    public function showLoginForm()
    {
      return view('admin_grup.superadmin_login');
    }
    public function login(Request $request)
    {
      // Validate the form data
     $this->validate($request, [
        'username'   => 'required',
        'password' => 'required|min:6'
      ]);

      // Attempt to log the user in
      if (Auth::guard('superadmin')->attempt(['username' => $request->username, 'password' => $request->password])) {
        //if successful, then redirect to their intended location
        $request->session()->put('id_grup',\Auth::guard('superadmin')->user()->id_grup);
        $request->session()->put('username',\Auth::guard('superadmin')->user()->username);
        if(\Auth::guard('superadmin')->user()->status==1){
          return redirect()->intended(route('operator.dashboard'));
        }
        return redirect()->intended(route('admingrup.dashboard'));
      }
      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('username'))->with('message', 'username atau password salah, silahkan coba lagi');
    }
}