<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','DashboardController@index');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
Route::resource('projects', 'ProjectsController');
Route::get('projects/showProjectForm','ProjectsController@showProjectForm');
Route::get('projects/getProjects/{type}','ProjectsController@getProjects');

Route::resource('proposals', 'ProposalsController');
Route::get('proposals/getAllProposalsById/{id}','ProposalsController@getAllProposalsById');
Route::get('proposals/approveProposal/{id}','ProposalsController@approveProposal');
Route::get('/proposals/cancelApprovedProposal/{id}','ProposalsController@cancelApprovedProposal');
Route::get('/proposals/disApproveProposal/{id}','ProposalsController@disApproveProposal');
Route::get('/proposals/sendNotification/{id}','ProposalsController@sendNotification');