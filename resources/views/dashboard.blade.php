@extends('layouts.app')

@section('content')
    <section class="content-header"> <h1>{{$data['title']}}</h1> </section>
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{$data['sub_title']}}</h3>
            </div>
            <div class="box-body">
                {{$data['content']}}
            </div>
        </div>
    </section>    
@endsection
