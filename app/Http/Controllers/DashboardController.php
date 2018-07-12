<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ['title' => 'Home','sub_title' => 'DPWH Bidding System','content' => 'Welcome to the online DPWH Bidding System.'];

        return view('dashboard')->with(compact('data'));
    }

    public function projects()
    {
        $data = ['title' => 'Projects','sub_title' => 'Project List','content' => ''];
        
        return view('projects.project_list')->with(compact('data'));
    }
}
