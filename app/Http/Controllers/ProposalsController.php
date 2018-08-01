<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Project;
use App\Proposal;

class ProposalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # Getting of all the user proposals based on the user id
        $user_id = auth()->user()->id;
        $proposals = User::find($user_id)->proposals;
        $projectNames = [];

        # Retrieving of project names
        foreach($proposals as $proposal) 
        {
            $project = Project::find($proposal->project_id);

            array_push($projectNames,["project_name" => $project->name,"status" => $project->status,"video_link" => $project->video_link]);
        }

        $data = ['title' => 'Proposals','sub_title' => 'Proposal List','content' => '','proposals' => $proposals,'project_names' => $projectNames];
        return view('proposals.user_proposals')->with(compact('data'));
        // return $projectNames;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Storing the projects information
        // $this->validate($request,['name' => 'required','info' => 'required','image' => 'image|nullable|max:1999','files' => 'nullable|max:1999']);

        $proposal = new Proposal;

        // File Upload
        if($request->hasFile('files'))
        {
            $fileNameWithExtension = $request->file('files')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension,PATHINFO_FILENAME);
            $extension = $request->file('files')->getClientOriginalExtension();
            $attachmentNameToStore = $fileName."__".time().".".$extension;
            $path = $request->file('files')->storeAs('public/proposalFiles',$attachmentNameToStore);
        }
        else
        {
            $attachmentNameToStore = '';
        }

        $proposal->content  = $request->input('info');
        $proposal->files = $attachmentNameToStore;
        $proposal->project_id = $request->input('project_id');
        $proposal->user_id = auth()->user()->id;

        if($proposal->save())
        {
            return redirect('projects')->with('success','Proposal Set!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id); 

        $data = ['title' => 'Project','sub_title' => '','content' => '','project' => $project];

        return view('proposals.create_proposal')->with(compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getAllProposalsById($id)
    {   
        $proposals = Proposal::where('project_id',$id)
                    ->where(function ($query){
                        $query->where('status','PENDING')
                              ->orWhere('status', '=', 'APPROVED');
                    })
                    ->get();
        $project = Project::find($id);
        $bidderNames = [];
        $approvedProposals = [];

        foreach ($proposals as $proposal) 
        {   
            $temp = Proposal::find($proposal->user_id)->user;
            array_push($bidderNames, $temp->name);

            if($proposal->status == "APPROVED")
            {
                array_push($approvedProposals,["id" => $proposal->id,"name" => $temp->name]);
            }
        }

        $data = ['title' =>  'Proposals','sub_title' => '','content' => '','proposals' => $proposals,'project' => $project,'bidders' => $bidderNames,'approvedProposals' => $approvedProposals];
        return view('proposals.view_proposals_by_project')->with(compact('data'));
        // return $bidderNames;
    }

    public function approveProposal($id)
    {
        $proposal = Proposal::find($id);
        $proposal->status = "APPROVED";
        if( $proposal->save() ) return redirect()->back()->with('success','Proposal is APPROVED');
    }

    public function cancelApprovedProposal($id) 
    {
        $proposal = Proposal::find($id);
        $proposal->status = "PENDING";
        if( $proposal->save() ) return redirect()->back()->with('success','Proposal is CANCELLED');
    }

    public function disApproveProposal($id) 
    {
        $proposal = Proposal::find($id);
        $proposal->status = "DISAPPROVED";
        if( $proposal->save() ) return redirect()->back()->with('success','Proposal is DISAPPROVED');
    }

    public function sendNotification($id) {
        // generate link 
        $link = "https://meet.jit.si/" . "bidsys_project_".$id;
        // send all jitsee 
        $project = Project::find($id);
        $project->video_link = $link;
        // change project status to bidding
        $project->status = "IN_BIDDING";
        $project->save();
        
        // return redirect()->back();
        // show jistsee generated links
        return redirect('projects/getProjects/IN_BIDDING')->with('success','Proposal Set!');
    }
}
