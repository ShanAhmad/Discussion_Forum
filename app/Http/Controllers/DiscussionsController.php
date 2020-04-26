<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discussion;
use App\Reply;
use Notification;
use App\User;
use Auth;

class DiscussionsController extends Controller
{
    public function create(){
        return view('discussion');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
                'title'=>'required',
                'content'=>'required',
                'channel_id'=>'required'
        ]);
        $discuss=new Discussion;
        $discuss->title=$request->input('title');
        $discuss->channel_id=$request->input('channel_id');
        $discuss->content=$request->input('content');
        $discuss->user_id=auth()->user()->id;
        $discuss->slug=str_slug($request->input('title'));
        $discuss->save();
        return redirect()->route('discussion',['slug'=>$discuss->slug]);

    }

    public function show($slug){
        $discussion=Discussion::where('slug',$slug)->first();
        $best_answer=$discussion->replies()->where('best_answer',1)->first();
        return view('discussions.show')->with('discuss',$discussion)->with('best_answer',$best_answer);
    }
    public function reply($id){
        $discuss=Discussion::find($id);

        $reply=Reply::create([
            'user_id'=>Auth::id(),
            'discussion_id'=>$id,
            'content'=>request()->reply
        ]);

        $reply->user->points+=25;
        $reply->user->save();

        $watchers=array();
        foreach($discuss->watchers as$watcher):
            array_push($watchers,User::find($watcher->user_id));
        endforeach;

        Notification::send($watchers,new \App\Notifications\NewReplyAdded($discuss));
        return redirect()->back();
    }

    public function edit($slug){
        return view('discussions.edit',['discussion'=>Discussion::where('slug',$slug)->first()]);
    }

    public function update($id){
        $this->validate(request(),[
            'content'=>'required'
        ]);
        $d=Discussion::find($id);
        $d->content=request()->content;
        $d->save();
        return redirect()->route('discussion',['slug'=>$d->slug]);
    } 
}
