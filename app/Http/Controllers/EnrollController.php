<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\enroll;
use App\Model\materi_test;
use Hashids;


class EnrollController extends Controller
{
    public function enroll(Request $request)
    {
      $id = $request['id_mat'];
      $materi = materi_test::find($id);
      $enroll = $materi->pass_materi;
      $input = $request['enroll'];
      if($enroll == $input){
        $id_user  = $request->session()->get('id_user');
        enroll::create([
          'id_user' => $id_user,
          'id_mat' => $id,
        ]);
        $notification = array('message' => 'Berhasil!',
          'alert-type' => 'success' );
        $id = Hashids::encode($id,$materi->status);
        return redirect('/deskripsimateri/'.$id)->with($notification);
      }else{
        $notification = array('message' => 'Kata kunci salah!',
          'alert-type' => 'error' );
        return redirect()->back()->with($notification);
      }
    }
}
