@extends('layouts.app')

@section('content')
    <div class="content">
        @if(auth()->user()->account_type === 'admin')
            {{-- @include('projects.project_post_panel') --}}
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

                                    @if($project["status"] != "IN_BIDDING" && $project["status"] != "FINISHED")
                                        <td> <a href="proposals/getAllProposalsById/{{$project['id']}}" class="btn btn-primary btn-sm"> View Propsals </a></td>
                                        <td> <a href="/projects/{{$project['id']}}" class="btn btn-success btn-sm">View Project</a> </td>
                                        <td> <a href="/projects/{{$project['id']}}/edit" class="btn btn-info btn-sm">Edit Project</a> </td>
                                        <td>  
                                                {{-- Form::open(['action' => ['ProjectsController@destroy',$data['project']->id],'onsubmit' => 'return ConfirmDelete()' ],     --}}
                                            {!! Form::open(['action' => ['ProjectsController@destroy',$project['id']], 'onsubmit' => 'return ConfirmDelete()' ],['class' => 'pull-right']  ) !!}
                                                {{ Form::submit('REMOVE PROJECT',['class' => 'btn btn-danger btn-sm']) }}
                                                {{ Form::hidden('_method','DELETE') }}
                                            {!! Form::close() !!} 
                                        </td>
                                    @elseif($project["status"] == "IN_BIDDING" )
                                        <td> <a href="{{$project["video_link"]}}" target="_blank" class="btn btn-info btn-sm">VIDEO CHAT</a> </td> 
                                        <td> <a href="/projects/finishedProject/{{ $project['id'] }}" class="btn btn-success btn-sm">Terminate Bidding Session</a> </td> 
                                    @endif
                                </tr>
                            @endforeach
                        </table>
                    @else 
                        <div class="alert alert-info">
                            <p style="font-size:20px;"><span class="fa fa-info-circle"></span> Hmmm. . . There is no project record you can add a new project by click the add project on the sidebar menu.</p>
                        </div>
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
                    @else
                        <div class="alert alert-info">
                            <p style="font-size:20px;"><span class="fa fa-info-circle"></span> There is no new PROJECTS you can apply. Just be patient and wait for further posts of DPWH. Thank you!</p>
                        </div>
                    @endif    
                </div>
            </div>  
        @endif
    </div>

    @include('includes.scripts')
@endsection