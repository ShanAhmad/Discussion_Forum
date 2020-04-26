@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Edit a Discussion</div>

    <div class="panel-body">
        {!! Form::open(['action'=> ['DiscussionsController@update',$discussion->id],'method' => 'POST']) !!}
                <div class="form-group">
                    {{Form::label('body', 'Body')}}
                    {{Form::textarea('content',$discussion->content,['class'=>'form-control','placeholder'=>'Body'])}}
                </div>
        {{Form::submit('Submit',['class'=>'pull-right btn btn-success'])}}
        {!! Form::close() !!} 
    </div>
</div>
@endsection


