<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discussion;
use App\Channel;
use Auth;

class ForumsController extends Controller
{
    public function index(){
        //$discussions=Discussion::orderBy('created_at','desc')->paginate(2);
        switch (request('filter')) {
            case 'me':
                $results=Discussion::where('user_id',Auth::id())->paginate(2);
                break;
            
            default:
                $results=Discussion::orderBy('created_at','desc')->paginate(2);
                break;
        }
        return view('forum')->with('discussions',$results);
    }

    public function channel($slug){
        $channel=Channel::where('slug',$slug)->first();
        return view('channel')->with('discussions',$channel->discussions()->paginate(3));
    }
}
