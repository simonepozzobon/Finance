<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
  public function index()
  {
    $todo = Todo::all();
    return response()->json($todo);
  }

  public function store(Request $request)
  {
    $todo = new Todo;
    $todo->name = $request->input('name');
    $todo->description = $request->input('description');
    $todo->start_date = $request->input('start_date');
    $todo->end_date = $request->input('end_date');
    $todo->completed = $request->input('completed') === 'true' ? 1 : 0;
    $todo->save();
    return response()->json(['success' => true]);
  }

  public function show($id)
  {
    $todo = Todo::find($id);
    return response($todo);
  }

  public function edit($id)
  {
    $todo = Todo::find($id);
    return response($todo);
  }

  public function update(Request $request, $id)
  {
    $todo = Todo::find($id);
    $todo->name = $request->input('name');
    $todo->description = $request->input('description');
    $todo->start_date = $request->input('start_date');
    $todo->end_date = $request->input('end_date');
    $todo->completed = $request->input('completed') === 'true' ? 1 : 0;
    $todo->save();
    return response()->json(['success' => true]);
  }

    public function destroy($id)
    {
      $todo = Todo::findOrFail($id);
      $todo->delete();
      return response()->json(['success' => true]);
    }

}
