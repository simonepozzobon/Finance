<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{

    public function index()
    {
        $status = Status::all();
        return response()->json($status);
    }

    public function store(Request $request)
    {
      $status = new Status;
      $status->class = $request->input('class');
      $status->message = $request->input('message');
      $status->save();
      return response()->json(['success' => true]);
    }

    public function show($id)
    {
      $status = Status::find($id);
      return response($status);
    }

    public function edit($id)
    {
      $status = Status::find($id);
      return response($status);
    }

    public function update(Request $request, $id)
    {
      $status = Status::find($id);
      $status->class = $request->input('class');
      $status->message = $request->input('message');
      $status->save();
      return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
      $status = Status::findOrFail($id);
      $status->delete();
      return response()->json(['success' => true]);
    }
}
