@extends('layouts.app')

@section('content')
<div class="panel panel-default">
<div class="panel-heading">Edit channel</div>

<div class="panel-body">
    {!! Form::open(['action'=> ['ChannelsController@update',$channels->id],'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title',$channels->title,['class'=>'form-control','placeholder'=>'Title'])}}
    </div>
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit',['class'=>'btn btn-success'])}}
    {!! Form::close() !!}    
</div>
</div>

@endsection


