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
                            
                                {{-- @foreach($data['proposals'] as $proposal)
                                    <tr>
                                        <td> {{$proposal['project_id']}} </td>
                                        <td> <label class="label bg-blue">{{$proposal['status']}}</label> </td>
                                    </tr>
                                @endforeach --}}

                                @for ($i = 0; $i < count($data['proposals']); $i++)
                                    <tr>
                                        <td> {{$data['project_names'][$i]["project_name"]}} </td>
                                        <td>     
                                            <label class="label bg-blue">{{$data['proposals'][$i]["status"]}}</label> 
                                        </td>
                                        @if( $data['project_names'][$i]["status"] == "IN_BIDDING" )
                                            <td><a href="{{$data['project_names'][$i]["video_link"]}}" target="_blank" class="btn btn-success btn-sm">Go to video chat</a>  </td>
                                        @elseif( $data['proposals'][$i]["status"] == "APPROVED" )
                                            @if( $data['project_names'][$i]["status"] == "FINISHED" )
                                                <td class="text-green">BIDDING SESSION IS FINISHED</td>
                                            @else    
                                                <td class="text-aqua">FINALIZING</td>
                                            @endif
                                        @else 
                                            <td class="text-warning">Waiting for ADMIN's Approval</td>
                                        @endif
                                    </tr>
                                @endfor

                            </table>
                        @endif 
                    </div>
                </div>
            </div>
        </div>
   </div>
@endsection