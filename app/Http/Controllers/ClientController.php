<?php

namespace App\Http\Controllers;

use App\Project;
use App\Status;
use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
  public function index()
  {
      $clients = Client::with('projects')->get();

      foreach ($clients as $key => $client) {
        $active_projects = Project::where([
          ['client_id', '=', $client->id],
          ['status_id', '<', 3]
        ])->get();
        $client->active_projects = count($active_projects);
        $client->total_projects = count($client->projects);
      }
      $content = collect([
        'client' => $clients
      ]);
      return response($content);
  }

  public function store(Request $request)
  {
    $client = new Client;
    $client->name = $request->input('name');
    $client->street = $request->input('street');
    $client->city = $request->input('city');
    $client->postal_code = $request->input('postal_code');
    $client->country = $request->input('country');
    $client->vat = $request->input('vat');
    $client->save();
    return response()->json(['success' => true]);
  }

  public function show($id)
  {
    $client = Client::with('projects')->find($id);
    return response($client);
  }

  public function edit($id)
  {
    $client = Client::find($id);
    $content = collect([
      'client'  => $client,
    ]);
    return response($content);
  }

  public function update(Request $request, $id)
  {
    $client = Client::find($id);
    $client->name = $request->input('name');
    $client->street = $request->input('street');
    $client->city = $request->input('city');
    $client->postal_code = $request->input('postal_code');
    $client->country = $request->input('country');
    $client->vat = $request->input('vat');
    $client->save();
    return response()->json(['success' => true]);
  }

  public function destroy($id)
  {
    $client = Client::findOrFail($id);
    $client->delete();
    return response()->json(['success' => true]);
  }
}
