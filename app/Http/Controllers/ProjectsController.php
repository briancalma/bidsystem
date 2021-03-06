<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Proposal;
use Illuminate\Support\Facades\Storage;



class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # TODO : Check for more robust way of accessing records with relationship
        # TODO : Think if i should create another controller for the client user and admin user. 

        if(auth()->user()->accout_type === "admin")
        {
            // Getting of all the pending posts 
            $projects = Project::where('status','PENDING')->orderBy('id','desc')->get();
            
        }
        else 
        {
            // Get all posts that have no client/user proposal 
            $projects = Project::where('status','PENDING')->orderBy('id','desc')->get();
            $project_list = [];

            foreach ($projects as $project) 
            {
                // This loop will iterate to every project in the projects table
                // and will check if such proposal with user_id and project_id exist 
                // if no proposal is found then add this project to the project list array
                $project_id = $project->id;
                $user_id = auth()->user()->id;
                $temp = Proposal::where('project_id',$project_id)->where('user_id',$user_id)->count();
                
                if($temp == 0) array_push($project_list,$project);
            }

            $projects = $project_list;
        }

        $data = ['title' => 'Projects','sub_title' => 'Project List','content' => '','projects' => $projects];
        return view('projects.project_list')->with(compact('data'));
        // return $projects;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = ['title' => 'Projects','sub_title' => 'Add New Project','content' => ''];

        return view('projects/add_project_form')->with(compact('data'));
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

        $project = new Project;

        // Image Upload process
        if($request->hasFile('image'))
        {
            $fileNameWithExtension = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension,PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();

            $fileNameToStore = "";

            if($this->checkIfValidImage($extension)) {
                $fileNameToStore = $fileName."__".time().".".$extension;
                $path = $request->file('image')->storeAs('public/coverImages',$fileNameToStore);
            } 
            else $fileNameToStore = 'noimage.jpg';    
        }
        else
        {
            $fileNameToStore = 'noimage.jpg';
        }

        // File Upload
        if($request->hasFile('files'))
        {
            $fileNameWithExtension = $request->file('files')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension,PATHINFO_FILENAME);
            $extension = $request->file('files')->getClientOriginalExtension();
            $attachmentNameToStore = $fileName."__".time().".".$extension;
            $path = $request->file('files')->storeAs('public/attachments',$attachmentNameToStore);
        }
        else
        {
            $attachmentNameToStore = '';
        }

        $project->name  = $request->input('name');
        $project->info  = $request->input('info');
        $project->image = $fileNameToStore;
        $project->files = $attachmentNameToStore;

        if($project->save())
        {
            return redirect('projects')->with('success','Sucess In Adding a New Post!');
        }
    }

    private function checkIfValidImage($ext) {
        
        if( !empty($ext) ) {
            return ( $ext == 'jpg' ) || ( $ext == 'jpeg' ) || ( $ext == 'png' );
        }

        return false;
    
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

        $data = ['title' => 'Projects','sub_title' => '','content' => '','project' => $project];

        return view('projects.view_project')->with(compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);

        $data = ['title' => 'Projects','sub_title' => '','content' => '','project' => $project];

        return view('projects.edit_project')->with(compact('data'));
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
        $project = Project::find($id);

        $project->name = $request->input('name');
        $project->info = $request->input('info');

         // Image Upload process
        if($request->hasFile('image'))
        {
            // Getting the image file
            $fileNameWithExtension = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension,PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();

            $fileNameToStore = "";

            // Checks if the file being upload is valid
            if($this->checkIfValidImage($extension)) {
                $fileNameToStore = $fileName."__".time().".".$extension;
                $path = $request->file('image')->storeAs('public/coverImages',$fileNameToStore);
            } 
            else $fileNameToStore = 'noimage.jpg';       

            if($project->image != 'noimage.jpg')
                Storage::delete('public/coverImages/'.$project->image);
        }
        else
        {
            $fileNameToStore = $project->image;

            if( empty($fileNameToStore) )
                $fileNameToStore = 'noimage.jpg';
        }



        // File Upload
        if($request->hasFile('files'))
        {
            // Retrieving file
            $fileNameWithExtension = $request->file('files')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension,PATHINFO_FILENAME);
            $extension = $request->file('files')->getClientOriginalExtension();
            $attachmentNameToStore = $fileName."__".time().".".$extension;
            $path = $request->file('files')->storeAs('public/attachments',$attachmentNameToStore);

            if($project->files != '')
                Storage::delete('public/attachments/'.$project->files);
        }
        else
        {
            $attachmentNameToStore = $project->files;

            if(empty($attachmentNameToStore))
                $attachmentNameToStore = '';
        }


        $project->image = $fileNameToStore;
        $project->files = $attachmentNameToStore;


        if($project->save()) return redirect('projects')->with('success','Success In Updating a Project');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);

        if($project->image != "noimage.jpg")
            Storage::delete('public/coverImages/'.$project->image);

        if($project->files != "")
            Storage::delete('public/attachments/'.$project->files);
        
        if($project->delete()) return redirect('projects')->with('success','Project REMOVED');
    }


    public function getProjects($type)
    {
        $projects = Project::where('status',$type)
                            ->orderBy('id','desc')
                            ->get();

        $data = ['title' => 'Projects','sub_title' => '','content' => '','projects' => $projects];

        return view('projects.project_list')->with(compact('data'));
    }

    
    public function finishedProject($projectId)
    {
        $project = Project::find($projectId);

        $project->status = 'FINISHED';
        
        $project->save();

        return redirect('projects/getProjects/FINISHED')->with('success','Project Bidding is now ended!');
    }

}
