<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply;
use App\Like;
use Auth;

class RepliesController extends Controller
{
    public function like($id){
        Like::create([
            'reply_id'=>$id,
            'user_id'=>Auth::id()
        ]);
        return redirect()->back();
    }

    public function unlike($id){
        $like=Like::where('reply_id',$id)->where('user_id',Auth::id())->first();
        $like->delete();
        return redirect()->back();
    }

    public function best_answer($id){
        $reply=Reply::find($id);
        $reply->best_answer=1;
        $reply->save();
        $reply->user->points+=100;
        $reply->user->save();
        return redirect()->back();
    }

    public function edit($id){
        return view('reply.edit',['reply'=>Reply::find($id)]);
    } 

    public function update($id){
        $this->validate(request(),[
            'content'=>'required'
        ]);
        $reply=Reply::find($id);
        $reply->content=request()->content;
        $reply->save();
        return redirect()->route('discussion',['slug'=>$reply->discussion->slug]);
    } 
}
