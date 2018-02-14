<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\soal;
use App\Model\test;
use Hashids;

class SoalController extends Controller
{
    public function editmodal($id)
  	{
      $soal=soal::find($id);
      return $soal;
  	}

  	public function tambahsoal($id)
	{
		$iddecode = Hashids::decode($id);
		$id_test = $iddecode[0];
		$status = $iddecode[1];
		$test = test::find($id_test);
		$soals = soal::where('id_test',$id_test)->orderBy('id_soal','desc')->paginate(5);
		if(\Auth::guard('superadmin')){
			return view('admin_grup.formsoal',['test'=>$test,'soals'=>$soals,'status'=>$status]);
		}else{
			return view('admin.formsoal',['test'=>$test,'soals'=>$soals,'status'=>$status]);
		}
	}

	public function tambahsoalbonus($id)
	{
		$iddecode = Hashids::decode($id);
		$id_test = $iddecode[0];
		$status = $iddecode[1];
		$test = test::find($id_test);
		$soals = soal::where('id_test',$id_test)->orderBy('id_soal','desc')->paginate(5);
		return view('admin_grup.formsoalbonus',['test'=>$test,'soals'=>$soals,'status'=>$status]);
	}

	public function postsoal(Request $request)
	{
		$id_test = $request['id_test'];
		$soal = $request['soal'];
		$opsi_a = $request['opsi_a'];
		$opsi_b = $request['opsi_b'];
		$opsi_c = $request['opsi_c'];
		$opsi_d = $request['opsi_d'];
		$kunci = $request['kunci_jawaban'];
		soal::create([
			'id_test'=>$id_test,
			'soal'=>$soal,
			'opsi_a'=>$opsi_a,
			'opsi_b'=>$opsi_b,
			'opsi_c'=>$opsi_c,
			'opsi_d'=>$opsi_d,
			'kunci_jawaban'=>$kunci
		]);
		return redirect()->back();
	}
	public function editsoal(Request $request)
	{
		$id_soal = $request['id_soal'];
		$soal = $request['soal'];
		$opsi_a = $request['opsi_a'];
		$opsi_b = $request['opsi_b'];
		$opsi_c = $request['opsi_c'];
		$opsi_d = $request['opsi_d'];
		$kunci = $request['kunci_jawaban'];
		soal::where('id_soal',$id_soal)->update([
			'soal'=>$soal,
			'opsi_a'=>$opsi_a,
			'opsi_b'=>$opsi_b,
			'opsi_c'=>$opsi_c,
			'opsi_d'=>$opsi_d,
			'kunci_jawaban'=>$kunci
		]);
		return redirect()->back();
	}
	public function hapussoal($id)
	{
		soal::find($id)->delete();
		$notification = array('tittle'=> 'Berhasil!','msg'=>'Soal telah dihapus.','alert-type'=>'success');
		return redirect()->back()->with($notification);
	}
}
