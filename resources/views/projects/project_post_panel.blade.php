<div class="row">
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Project Details</h3>
            </div>
        
        {!! Form::open(['action' => 'ProjectsController@store','files' => true,'enctype' => 'multipart/form-data']) !!}
            <div class="box-body">
                <div class="form-group">
                    <label>Project Name</label>
                    {{ Form::text('name','',['class' => 'form-control','placeholder' => '* Enter Project Name','required']) }}
                </div>
        
                <div class="form-group">
                    <label>Project Info</label>
                    {{ Form::textarea('info','',['class' => 'form-control','placeholder' => '* Enter Project Description','required']) }}<br>
                </div>
        
                <div class="form-group">
                    <label for="exampleInputFile">Project Image </label>
                    {{-- <input type="file" id="exampleInputFile"> --}}
                    {{ Form::file('image') }} 
                    <p class="help-block">Pls Enter the Cover Image of this Project.</p>
                </div>
        
                <div class="form-group">
                    <label for="exampleInputFile">Attachments</label>
                    {{-- <input type="file" id="exampleInputFile"> --}}
                    {{ Form::file('files') }} 
                    <p class="help-block">Important files like documents that a user/bidder can download.</p>
                </div>

            </div>
            
            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-block btn-lg btn-flat">POST PROJECT</button>
            </div>

        {!! Form::close() !!}
        </div>
    </div>
    
    {{--
        <div class="col-xs-4">
            <div class="box box-info" style="height:400px;">
                <div class="box-header with-border">
                </div>
                <div class="box-body">        
                </div>
            </div>
        </div>
    --}}

    


</div>
