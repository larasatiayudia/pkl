<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use App\Model\User;
use App\Model\admin;

class deleteAdmin implements ShouldQueue
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
        User::where('id_user',$id)->update(['status' => 0]);
        $admin=admin::where('id_user',$id)->delete();
        return redirect()->back();
    }
}
