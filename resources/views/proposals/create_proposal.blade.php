@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$data['project']->name}}</h3>
                    </div>
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
                </div>
            </div>
        </div>
        
        <div class="row">
                <div class="col-xs-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Your Project Proposal</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-12">
                                        {!! Form::open(['action' => 'ProposalsController@store','files' => true,'enctype' => 'multipart/form-data']) !!}
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label>Content Pitch</label>
                                                {{ Form::textarea('info','',['class' => 'form-control','placeholder' => '* Enter Project Proposal','required']) }}<br>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputFile">Attachments</label>
                                                {{-- <input type="file" id="exampleInputFile"> --}}
                                                {{ Form::file('files') }} 
                                                <p class="help-block">Important files like documents that the Head of the DPWH ORG will review.</p>
                                            </div>
                                            {{ Form::hidden('project_id',$data['project']->id) }}
                                        </div>
                                        
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary btn-block btn-lg btn-flat">SUBMIT PROPOSAL</button>
                                        </div>
                            
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div> 
   </div>
@endsection