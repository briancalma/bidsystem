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
                            @if($data["project"]->status != "IN_BIDDING")
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
                                                @if( !empty($proposals[$i]->files) )
                                                    <a href="{{asset('storage/proposalFiles')}}/{{$proposals[$i]->files}}" class="btn btn-success">
                                                       <i class="fa fa-file"></i>  DOWNLOAD FILE
                                                    </a>
                                                @else 
                                                    <span class="label label-danger" style="font-size:15px;">NO FILE</span>  
                                                @endif
                                            </td>
                                            @if($proposals[$i]->status == "PENDING")
                                                <td><a href="/proposals/approveProposal/{{$proposals[$i]->id}}" class="btn btn-info btn-block"><span class="fa fa-heart"></span>Approve</a></td>
                                            @else
                                                <td><a href="/proposals/cancelApprovedProposal/{{$proposals[$i]->id}}" class="btn btn-warning btn-block">Cancel Approval</a></td>
                                            @endif
                                            <td><a href="/proposals/disApproveProposal/{{$proposals[$i]->id}}" class="btn btn-danger btn-block" onclick="return ConfirmDelete()"><span class="fa fa-trash"></span></a></td>
                                        </tr>
                                    @endfor
                                </table>
                            @else
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <th>CLICK THE LINK BELOW TO START VIDEO CHAT SESSION</th>
                                    </thead>
                                    <tbody>
                                        <tr><td><a href="{{$data["project"]->video_link}}" target="_blank">{{$data["project"]->video_link}}</a></td></tr>
                                    </tbody>
                                </table>
                            @endif
                        @else 
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <th>No Bidder's Proposal.</th>
                                </thead>
                            </table>   
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if( count($data['approvedProposals']) > 0)
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
                                        <td><a href="/proposals/cancelApprovedProposal/{{$item['id']}}" class="btn btn-warning">Cancel</a></td>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"><a href="/proposals/sendNotification/{{ $data["project"]->id }}" class="btn btn-lg btn-success">SUBMIT PROJECT FOR BIDDING</a></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
   </div>

   @include('includes.scripts')
@endsection