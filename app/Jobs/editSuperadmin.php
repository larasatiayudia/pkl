<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use App\Model\superadmin;
use App\Model\grup;

class editSuperadmin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
    {
        $id=$request['id_sa'];
        $sa=superadmin::where('id_sa',$id)->first();
        grup::where('id_grup',$sa->id_grup)->update(['status'=>0]);
        if($request['password']!=null){
            superadmin::where('id_sa',$id)->update([
                'id_grup' => $request['id_grup'],
                'username' => $request['username'],
                'password' => bcrypt($request['password']),
                'email' => $request['email'],
                'status' => 0,
            ]);
        }
        else{
            superadmin::where('id_sa',$id)->update([
                'id_grup' => $request['id_grup'],
                'username' => $request['username'],
                'email' => $request['email'],
                'status' => 0,
            ]);
        }
        
        grup::where('id_grup',$request['id_grup'])->update(['status'=>1]);
        return redirect()->back();
    }
}
