@extends('layouts.app')

@section('content')
    <div class="content">
        @if(auth()->user()->account_type === 'admin')
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Project Details</h3>
                    </div>
                
                {!! Form::open(['action' => ['ProjectsController@update',$data['project']->id],'files' => true,'enctype' => 'multipart/form-data']) !!}
                    <div class="box-body">
                        <div class="form-group">
                            <label>Project Name</label>
                            {{ Form::text('name',$data['project']->name,['class' => 'form-control','placeholder' => '* Enter Project Name','required']) }}
                        </div>
                
                        <div class="form-group">
                            <label>Project Info</label>
                            {{ Form::textarea('info',$data['project']->info,['class' => 'form-control','placeholder' => '* Enter Project Description','required']) }}<br>
                        </div>
                        
                        {{ Form::hidden('_method','PUT') }}
                        <div class="form-group">
                            <label for="exampleInputFile">Project Image </label>
                            {{-- <input type="file" id="exampleInputFile"> --}}
                            {{ Form::file('image') }} 
                            <p class="help-block">Pls Enter the Front Image of your Project.</p>
                        </div>
                
                        <div class="form-group">
                            <label for="exampleInputFile">Attachments</label>
                            {{-- <input type="file" id="exampleInputFile"> --}}
                            {{ Form::file('files') }} 
                            <p class="help-block">Important files like documents that a user/bidder can download.</p>
                        </div>
                    
                
                    </div>
                    
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-block btn-lg btn-flat">UPDATE PROJECT</button>
                    </div>
        
                {!! Form::close() !!}
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection