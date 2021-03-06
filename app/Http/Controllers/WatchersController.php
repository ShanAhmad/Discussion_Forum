<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Watcher;
use Auth;

class WatchersController extends Controller
{
    public function watch($id){
        Watcher::create([
            'discussion_id'=>$id,
            'user_id'=>Auth::id()
        ]);
        return redirect()->back();
    }

    public function unwatch($id){
        $watcher=Watcher::where('discussion_id',$id)->where('user_id',Auth::id());
        $watcher->delete();
        return redirect()->back();
    }
}
