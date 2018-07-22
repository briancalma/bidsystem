@extends('layouts.app')

@section('content')
    <div class="content">
        @if(auth()->user()->account_type === 'admin')
            @include('projects.project_post_panel')
            <div class="box">
                <div class="box-header"><h3>Project List</h3></div>
                <div class="box-body">
                    @if(count($data['projects']) > 0)
                        <table class="table table-bordered table-hover">
                            <thead>
                                <th>Project Name</th>
                                <th>Description</th>
                            </thead>
                        
                            @foreach($data['projects'] as $project)
                                <tr>
                                    <td> {{$project['name']}} </td>
                                    <td> {{$project['info']}} </td>
                                    <td> <a href="/projects/{{$project['id']}}" class="btn btn-success btn-sm">View Project</a> </td>
                                    <td> <a href="/projects/{{$project['id']}}/edit" class="btn btn-info btn-sm">Edit Project</a> </td>
                                    <td>  
                                        {!! Form::open(['action' => ['ProjectsController@destroy',$project['id']]],['class' => 'pull-right']) !!}
                                            {{ Form::submit('REMOVE PROJECT',['class' => 'btn btn-danger btn-sm']) }}
                                            {{ Form::hidden('_method','DELETE') }}
                                        {!! Form::close() !!} </td>
                                </tr>
                            @endforeach
             
                        </table>
                    @endif    
                </div>
            </div>        
        @else
            <div class="box">
                <div class="box-header"><h3>PROJECTS You can apply</h3></div>
                <div class="box-body">
                    @if(count($data['projects']) > 0)
                        <table class="table table-bordered table-hover">
                            <thead>
                                <th>Project Name</th>
                                <th>Description</th>
                            </thead>
                        
                            @foreach($data['projects'] as $project)
                                <tr>
                                    <td> {{$project['name']}} </td>
                                    <td> {{$project['info']}} </td>
                                    <td> <a href="/projects/{{$project['id']}}" class="btn btn-success btn-sm">View Project</a> </td>
                                    <td> <a href="/proposals/{{$project['id']}}" class="btn btn-primary btn-sm">I'm Interested</a> </td>
                                    {{-- 
                                        <td> <a href="/projects/{{$project['id']}}/edit" class="btn btn-info btn-sm">Edit Project</a> </td>
                                        <td>  
                                            {!! Form::open(['action' => ['ProjectsController@destroy',$project['id']]],['class' => 'pull-right']) !!}
                                                {{ Form::submit('REMOVE PROJECT',['class' => 'btn btn-danger btn-sm']) }}
                                                {{ Form::hidden('_method','DELETE') }}
                                            {!! Form::close() !!} 
                                        </td> 
                                    --}}
                                </tr>
                            @endforeach
                        </table>
                    @endif    
                </div>
            </div>  
        @endif
    </div>
@endsection