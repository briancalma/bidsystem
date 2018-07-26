@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                    <h3 class="box-title">Project : {{ $data["project"]->name }}</h3>
                    </div>
                    <div class="box-body">
                        @if(count($data["proposals"]) > 0)
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <th>Bidder</th>
                                    <th>Content</th>
                                    <th>Files</th>
                                </thead>
                                <?php 
                                    $proposals = $data['proposals'];
                                    $bidders = $data["bidders"];
                                ?>

                                @for ($i = 0; $i < count($proposals); $i++)
                                    <tr>
                                        <td>{{$bidders[$i]}}</td>
                                        <td>{{$proposals[$i]->content}}</td>
                                        <td>
                                            <a href="{{asset('storage/attachments')}}/{{$proposals[$i]->file}}" class="btn btn-success">
                                                <i class="fa fa-file"></i>  DOWNLOAD FILE
                                            </a>
                                        </td>
                                        @if($proposals[$i]->status == "PENDING")
                                            <td><a href="/proposals/approveProposal/{{$proposals[$i]->id}}" class="btn btn-info btn-block"><span class="fa fa-heart"></span>Approve</a></td>
                                        @else
                                            <td><a href="/proposals/cancelApprovedProposal/{{$proposals[$i]->id}}" class="btn btn-warning btn-block">Cancel Approval</a></td>
                                        @endif

                                        <td><a href="/proposals/disApproveProposal/{{$proposals[$i]->id}}" class="btn btn-danger btn-block"><span class="fa fa-trash"></span></a></td>
                                        {{-- @if($proposals[$i]->status == "PENDING")
                                            <td><a href="/proposals/disApproveProposal/{{$proposals[$i]->id}}" class="btn btn-danger btn-block"><span class="fa fa-trash"></span></a></td>
                                        @elseif($proposals[$i]->status == "APPROVED") 
                                            <td><a href="/proposals/disApproveProposal/{{$proposals[$i]->id}}" class="btn btn-success btn-block"><span class="fa fa-email"></span>SEND NOTIFICATION</a></td>
                                        @endif --}}
                                    </tr>
                                @endfor
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
                <div class="col-xs-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                        <h3 class="box-title">APPROVED PROPOSALS</h3>
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                     <th>Bidder</th>
                                     <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php $approvedList = $data["approvedProposals"]?>
                                    @foreach($approvedList as $item)
                                        <td>{{ $item["name"] }}</td>
                                        <td><a href="#" class="btn btn-warning">Cancel</a></td>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"><a href="#" class="btn btn-lg btn-success">SEND NOTIFICATION</a></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
   </div>
@endsection