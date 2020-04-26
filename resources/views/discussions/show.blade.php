@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <img src="{{$discuss->user->avatar}}" alt="" width="40px" height="40px">&nbsp;&nbsp;&nbsp;
        <span>{{$discuss->user->name}} <b>({{$discuss->user->points}})</b></span>
        
        @if ($discuss->hasBestAnswer())
            <span class="btn btn pull-right btn-danger">closed</span>
        @else
            <span class="btn btn pull-right btn-success">open</span>
        @endif

        @if (Auth::id()==$discuss->user->id)
            @if (!$discuss->hasBestAnswer())
                <a href="{{route('discussion.edit',['slug'=>$discuss->slug])}}" class="btn btn-info pull-right" style="margin-right:8px;">Edit</a>
            @endif
        @endif
        
        @if ($discuss->is_being_watched_by_auth_user())
            <a href="{{route('discussion.unwatch',['id'=>$discuss->id])}}" class="btn btn-default pull-right" style="margin-right:8px;">UnWatch</a>
        @else
            <a href="{{route('discussion.watch',['id'=>$discuss->id])}}" class="btn btn-default pull-right" style="margin-right:8px;">Watch</a>
        @endif
    </div>
    <div class="panel-body">
        <h4 class="text-center">
            {{$discuss->title}}
        </h4>
        <p class="text-center">
            {!!Markdown::convertToHtml($discuss->content)!!}
        </p>
        <hr>
        @if ($best_answer)
            <div class="text-center" style="padding: 40px;">
                <h3 class="text-center">Best Answer</h3>
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <img src="{{$best_answer->user->avatar}}" alt="" width="40px" height="40px">&nbsp;&nbsp;&nbsp;
                        <span>{{$best_answer->user->name}} <b>({{$best_answer->user->points}})</b></span>
                    </div>
                    <div class="panel-body">
                        {!!Markdown::convertToHtml($best_answer->content)!!}
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="panel-footer">
        <span>
            {{$discuss->replies->count()}} Replies
        </span>
        <a href="{{route('channel',['slug'=>$discuss->channel->slug])}}" class="pull-right btn btn-default btn-xs">{{$discuss->channel->title}}</a>
    </div>
</div>
    @foreach ($discuss->replies as $reply)
    <div class="panel panel-default">
        <div class="panel-heading">
            <img src="{{$reply->user->avatar}}" alt="" width="40px" height="40px">&nbsp;&nbsp;&nbsp;
            <span>{{$reply->user->name}} <b>({{$reply->user->points}})</b></span>
            @if (!$best_answer)
                @if (Auth::id()==$reply->user->id)
                    <a href="{{route('discussion.best.answer',['id'=>$reply->id])}}" class="btn btn-xs btn-primary pull-right" style="margin-left:8px;">Mark as best Answer</a>    
                @endif
            @endif    
            @if (Auth::id()==$reply->user->id)
                @if (!$reply->best_answer)
                    <a href="{{route('reply.edit',['id'=>$reply->id])}}" class="btn btn-xs btn-info pull-right">Edit</a>
                @endif
            @endif
        </div>
        <div class="panel-body">
            <p class="text-center">
                {!!Markdown::convertToHtml($reply->content)!!}
            </p>
        </div>
        <div class="panel-footer">
            @if (Auth::check())
                @if ($reply->is_liked_by_auth_user())
                   <a href="{{route('reply.unlike',['id'=>$reply->id])}}" class="btn btn-danger">Unlike</a>
                @else
                    <a href="{{route('reply.like',['id'=>$reply->id])}}" class="btn btn-success">Like</a>
                @endif    
            @else
                <div class="text-center">Sign in to like a Post</div>
            @endif
            <span class="badge badge-primary ">Number of Likes:{{$reply->likes->count()}}</span>
        </div> 
    </div> 
    @endforeach
    <div class="panel panel-default">
        <div class="panel-body">
            @if (Auth::check())
                <form action="{{route('discussion.reply',['id'=>$discuss->id])}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="reply">Leave a Reply</label>
                        <textarea name="reply" id="reply" cols="30" rows="10" class="form-control" placeholder="Enter Your Reply..."></textarea>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary pull-right">Reply</button>
                    </div>
                
                </form>
            @else
                <div class="text-center">Sign in to leave a reply</div>
            @endif
        </div>
    </div>
</div>
@endsection
