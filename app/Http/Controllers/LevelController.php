<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\level;
use App\Model\user;
use Hashids;

class LevelController extends Controller
{
	public function level(Request $request){
		$levels = level::orderBy('point_minimum', 'asc')->get();
		$id_grup = $request->session()->get('id_grup');
		$check = user::where([['id_grup',$id_grup], ['point', '>', 0]])->first();
		$current = array();
		if($check==null){
			$status= 1;
		}
		else{
			$status=0;
		}
		if($request['filter']==null){
	      $semualevels = user::where('id_grup',$id_grup)->orderBy('point', 'desc')->paginate(10);
	      foreach ($semualevels->items() as $index => $satulevel) {
	      	$current[$index] = level::where([['point_minimum','<=',$satulevel->point],['id_grup',$satulevel->id_grup]])->orderBy('point_minimum','desc')->first();
	      }
	      return view('admin_grup.level',['levels'=>$levels,'peringkats'=>$semualevels, 'status'=>$status,'current'=>$current]);
	    }
	    elseif($request['filter']!=null){
	    	if($request['filter']=="all"){
	    		$selectedlevels = user::where('id_grup',$id_grup)->orderBy('point', 'desc')->paginate(10);
	    		foreach ($selectedlevels->items() as $index => $satulevel) {
	      			$current[$index] = level::where([['point_minimum','<=',$satulevel->point],['id_grup',$satulevel->id_grup]])->orderBy('point_minimum','desc')->first();
	      		}
	    	}else{
	      		$filter = level::find($request['filter']);
	      		$next = level::where('point_minimum', '>', $filter->point_minimum)->orderBy('point_minimum','asc')->first();
	      		$selectedlevels = user::where([['point','>=',$filter->point_minimum],['point','<',$next->point_minimum],['id_grup',$id_grup]])->orderBy('point', 'desc')->paginate(10);
	      		foreach ($selectedlevels->items() as $index => $satulevel) {
	      			$current[$index] = level::where([['point_minimum','<=',$satulevel->point],['id_grup',$satulevel->id_grup]])->orderBy('point_minimum','desc')->first();
	      		}
	    	}
     	  return view('admin_grup.level',['levels'=>$levels,'peringkats'=>$selectedlevels,'tab'=>"peringkat",'status'=>$status,'current'=>$current]);
     	}
	}

   public function tambahlevel(Request $request)
   {
   		$id_grup = $request->session()->get('id_grup');
   		$namalevel = $request['namalevel'];
   		$syaratpoin = $request['syaratpoin'];	
   		$level = level::orderBy('id_level','desc')->first();
   		$id_level = $level->id_level +1;
   		$icon = $request->file('icon');
 	    $path = $icon->getClientOriginalName();
	    $icon->move('level/'.$id_level, $icon->getClientOriginalName());
	    level::create([
	    	'nama_level' => $namalevel,
	    	'point_minimum' => $syaratpoin,
	    	'id_grup' => $id_grup,
	    	'icon' => $path

	    ]);
	    $notification = array('tittle'=> 'Berhasil!','msg'=>$request['namalevel'].' berhasil ditambahkan!','alert-type'=>'success');
		return redirect()->back()->with($notification);
   }

   public function singlelevel($id){
   		$level = level::find($id);
   		return $level;
   }

   public function editlevel(Request $request)
    {
    	$id_level = $request['id_level'];
    	$namalevel = $request['namalevel'];
   		$syaratpoin = $request['syaratpoin'];
   		$level=level::find($id_level);
   		if(!empty($request->file('icon'))){
	      $icon = $request->file('icon');
	      $path = $icon->getClientOriginalName();
	      $icon->move('level/'.$id_level, $icon->getClientOriginalName());
	      level::where('id_level',$id_level)->update([
	        'nama_level' => $namalevel,
	        'point_minimum' => $syaratpoin,
	        'icon' => $path
	      ]);
	    }else{
	      level::where('id_level',$id_level)->update([
	        'nama_level' => $namalevel,
	        'point_minimum' => $syaratpoin
	      ]);
	    }

    	$notification = array('tittle'=> 'Berhasil!','msg'=>$level->nama_level.' berhasil diedit!','alert-type'=>'success');
		return redirect()->back()->with($notification);
    }
    public function hapuslevel($id)
	{
		$level=level::find($id)->nama_level;
		level::find($id)->delete();
		$notification = array('tittle'=> 'Berhasil!','msg'=>$level.' berhasil dihapus!','alert-type'=>'success');
		return redirect()->back()->with($notification);
	}

	public function resetlevel(Request $request)
	{
		$id_grup = $request->session()->get('id_grup');
		$level = level::where('id_grup',$id_grup)->orderBy('point_minimum', 'asc')->first();
		user::where('id_grup',$id_grup)->update([
			'id_level'=>$level->id_level,
      		'point'=> 0
      	]);
      	$notification = array('tittle'=> 'Berhasil!','msg'=>'level berhasil direset!','alert-type'=>'success');
		return redirect()->back()->with($notification);
	}

}
