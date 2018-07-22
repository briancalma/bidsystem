@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Your Proposals</h3>
                    </div>
                    <div class="box-body">
                        @if(count($data['proposals']) > 0)
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <th>Project Name</th>
                                    <th>Status</th>
                                </thead>
                            
                                @foreach($data['proposals'] as $proposal)
                                    <tr>
                                        <td> {{$proposal['project_id']}} </td>
                                        <td> <label class="label bg-blue">{{$proposal['status']}}</label> </td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif 
                    </div>
                </div>
            </div>
        </div>
   </div>
@endsection