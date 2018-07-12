<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Illuminate\Support\Facades\Storage;



class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $projects = Project::where('status','PENDING')->orderBy('id','desc')->get();

        $data = ['title' => 'Projects','sub_title' => 'Project List','content' => '','projects' => $projects];

        return view('projects.project_list')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $fileNameToStore = $fileName."__".time().".".$extension;
            $path = $request->file('image')->storeAs('public/coverImages',$fileNameToStore);
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
             $fileNameWithExtension = $request->file('image')->getClientOriginalName();
             $fileName = pathinfo($fileNameWithExtension,PATHINFO_FILENAME);
             $extension = $request->file('image')->getClientOriginalExtension();
             $fileNameToStore = $fileName."__".time().".".$extension;
             $path = $request->file('image')->storeAs('public/coverImages',$fileNameToStore);

             if($project->image != 'noimage.jpg')
                Storage::delete('public/coverImages/'.$project->image);
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

             if($project->files != '')
                Storage::delete('public/attachments/'.$project->files);
         }
         else
         {
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
}
