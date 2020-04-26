@extends('layouts.app')

@section('content')
    @foreach ($discussions as $discuss)
        <div class="panel panel-default">
            <div class="panel-heading">
                <img src="{{$discuss->user->avatar}}" alt="" width="40px" height="40px">&nbsp;&nbsp;&nbsp;
                <span>{{$discuss->user->name}} <b>{{$discuss->created_at->diffForHumans()}}</b></span>
                <a href="{{route('discussion',['slug'=>$discuss->slug])}}" class="btn btn-default pull-right" style="margin-left:9px;">View</a>
                @if ($discuss->hasBestAnswer())
                    <span class="btn btn pull-right btn-danger">closed</span>
                @else
                    <span class="btn btn pull-right btn-success">open</span>
                @endif
            </div>
            <div class="panel-body">
                <h4 class="text-center">
                    {{$discuss->title}}
                </h4>
                <p class="text-center">
                    {{str_limit($discuss->content,20)}}
                </p>
            </div>
            <div class="panel-footer">
                <span>
                    {{$discuss->replies->count()}} Replies
                </span>
                <a href="{{route('channel',['slug'=>$discuss->channel->slug])}}" class="pull-right btn btn-default btn-xs">{{$discuss->channel->title}}</a>
            </div>
        </div>
    @endforeach
    <div class="text-center">
        {{$discussions->links()}}
    </div>
@endsection
