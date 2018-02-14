<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\grading;
use App\Model\soal;
use Hashids;

class GradingController extends Controller
{
    public function submitjawaban(Request $request)
  	{
	    $id_soaldecode = Hashids::decode($request['id_soal']);
	    $id_soal = $id_soaldecode[0];
	    $id_testdecode = Hashids::decode($request['id_test']);
	    $id_test = $id_testdecode[0];
	    $jawaban = $request['jawaban'];
	    $id_attemptdecode = Hashids::decode($request['id_attempt']);
	    $id_attempt = $id_attemptdecode[0];
	    $soal = soal::find($id_soal);
	    $id_user = $request->session()->get('id_user');
	    if($soal->kunci_jawaban == $jawaban){
	        $status = 1;
	    }else{
	        $status = 0;
	    }
	    $grading = grading::where([['id_user',$id_user],['id_soal',$id_soal],['id_test',$id_test],['id_attempt',$id_attempt]])->get();
	    if($grading->isEmpty()){
	        grading::create([
	            'id_user'=>$id_user,
	            'id_soal'=>$id_soal,
	            'id_test'=>$id_test,
	            'id_attempt' =>$id_attempt,
	            'selected_ans'=>$jawaban,
	            'status'=>$status
	        ]);
	    }else{
	        grading::where([['id_user',$id_user],['id_soal',$id_soal],['id_test',$id_test],['id_attempt',$id_attempt]])->update(['selected_ans'=>$jawaban,'status'=>$status]);
	    }
	    return null;
  	}
}
