<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use App\Model\admin;

class editAdmin implements ShouldQueue
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
        $id = $request['id_user'];
        $admin=admin::where('id_user',$id)->delete();
        $jabatans = $request['jabatan'];
        if(count($jabatans)){
            foreach ($jabatans as $j) {
              admin::create([
                  'id_user'=>$id,
                  'id_ja'=>$j
              ]);
            }
        }
        return redirect()->back();
    }
}
