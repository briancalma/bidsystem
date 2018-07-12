@if(!empty($errors))
    @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible">
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            {{ $error }}
        </div>
    @endforeach
@endif

@if(!empty(session('success')))
    <div class="alert alert-success alert-dismissible">
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        {{ session('success') }}
    </div>   
@endif

@if(!empty(session('error')))
    <div class="alert alert-danger alert-dismissible">
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        {{ session('error') }}
    </div>
@endif

