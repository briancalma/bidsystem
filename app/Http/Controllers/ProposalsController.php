<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $user_id = auth()->user()->id;
        $proposals = Proposal::where('user_id',$user_id)->get();
        $data = ['title' => 'Proposals','sub_title' => 'Proposal List','content' => '','proposals' => $proposals];
        return view('proposals.user_proposals')->with(compact('data'));
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
}
