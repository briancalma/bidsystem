@extends('layouts.app')

@section('content')
    <div class="content">
            <div class="box">
                <div class="box-header"><h3>{{$data['project']->name}}</h3></div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="{{asset('storage/coverImages')}}/{{$data['project']->image}}" style="width:100%">
                        </div>
                        <div class="col-sm-8"> 
                            <h4>Project Description</h4>
                            <h5>{{$data['project']->info}}</h5> 
                            <br>
                            <small>{{$data['project']->created_at}}</small>
                            <hr>
                            <h5>Files</h5>

                            @if($data['project']->files != "")
                                <a href="{{asset('storage/attachments')}}/{{$data['project']->files}}" class="btn btn-success">
                                    <i class="fa fa-file"></i>  {{$data['project']->files}}
                                </a>
                            @else 
                                <h5>No Available Files.</h5>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="box-footer">
                    @if(auth()->user()->account_type === 'admin')
                        <a href="/projects/{{$data['project']->id}}/edit" class="btn btn-info">Edit</a>
                        {!! Form::open(['action' => ['ProjectsController@destroy',$data['project']->id]],['class' => 'pull-right']) !!}
                            <br>
                            {{ Form::submit('Delete',['class' => 'btn btn-danger']) }}
                            {{ Form::hidden('_method','DELETE') }}
                        {!! Form::close() !!}
                    @else
                        <a href="/projects/{{$data['project']->id}}/edit" class="btn btn-info"><i class="fa fa-star"></i>  Im Interested</a>
                        <a href="/projects" class="btn btn-warning"><i class="fa fa-arrow-left"></i>  Back</a>
                    @endif
                </div>
            </div>        
    </div>
@endsection