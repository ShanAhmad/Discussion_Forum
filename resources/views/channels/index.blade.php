@extends('layouts.app')

@section('content')
          <div class="panel panel-default">
                <div class="panel-heading">Channels</div>

                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <th>Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            @foreach ($channels as $channel)
                                <tr>
                                    <td>{{$channel->title}}</td>
                                    <td>
                                        <a href="{{route('channels.edit',['channel'=>$channel->id])}}" class="btn btn-xs btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        {!!Form::open(['action'=> ['ChannelsController@destroy',$channel->id],'method' => 'POST', 'class'=>'pull-right']) !!}
                                            {{Form::hidden('_method','DELETE')}}
                                            {{Form::submit('Delete',['class'=>'btn btn-xs btn-danger'])}}
                                        {!!Form::close() !!}
                                    </td>
                                </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
@endsection

