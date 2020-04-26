@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Create a Discussion</div>

    <div class="panel-body">
        {!! Form::open(['action'=> 'DiscussionsController@store','method' => 'POST']) !!}
                <div class="form-group">
                    {{Form::label('title', 'Title')}}
                    {{Form::text('title','',['class'=>'form-control','placeholder'=>'Title'])}}
                </div>
                <div class="form-group">
                    <label for="channel">Pick a Channel</label>
                    <select name="channel_id" id="channel_id" class="form-control">
                        @foreach ($channels as $channel)
                            <option value="{{$channel->id}}">{{$channel->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    {{Form::label('body', 'Body')}}
                    {{Form::textarea('content','',['class'=>'form-control','placeholder'=>'Body'])}}
                </div>
        {{Form::submit('Submit',['class'=>'pull-right btn btn-success'])}}
        {!! Form::close() !!} 
    </div>
</div>
@endsection


