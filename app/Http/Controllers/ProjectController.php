<?php

namespace App\Http\Controllers;

use App\Project;
use App\Status;
use App\Client;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index()
    {
        $project = Project::with('status')->with('client')->get();
        $status = Status::all();
        $client = Client::all();
        $content = collect([
          'project' => $project,
          'status'  => $status,
          'client'  => $client,
        ]);
        return response($content);
    }

    public function store(Request $request)
    {
      $project = new Project;
      $project->name = $request->input('name');
      $project->description = $request->input('description');
      $project->start_date = $request->input('start_date');
      $project->end_date = $request->input('end_date');
      $project->client_id = $request->input('client_id');
      $project->status_id = $request->input('status_id');
      $project->save();
      return response()->json(['success' => true]);
    }

    public function show($id)
    {
      $project = Project::with('status')->find($id);
      return response($project);
    }

    public function edit($id)
    {
      $project = Project::find($id);
      $status = Status::all();
      $client = Client::all();
      $content = collect([
        'project' => $project,
        'status'  => $status,
        'client'  => $client,
      ]);
      return response($content);
    }

    public function update(Request $request, $id)
    {
      $project = Project::find($id);
      $project->name = $request->input('name');
      $project->description = $request->input('description');
      $project->start_date = $request->input('start_date');
      $project->end_date = $request->input('end_date');
      $project->client_id = $request->input('client_id');
      $project->status_id = $request->input('status_id');
      $project->save();
      return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
      $project = Project::findOrFail($id);
      $project->delete();
      return response()->json(['success' => true]);
    }
}
