<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;


class TodoController extends Controller
{

  public function delete(Todo $todo){
    $todo->delete();
    return redirect()->back()->with('message', 'item deleted successfully');
  }

    public function index(){
      $todos = Todo::orderBy('completed')->get();
      return view('todos.index')->with(['todos' => $todos]);
    }

    public function update(Request $request, Todo $todo){
      $request->validate([
        'title' => 'required|max:255',
      ]);
      $todo->update( ['title' => $request->title] );
      return redirect(route('todo.index'))->with('message', 'updated');
    }

    public function create(){
      return view('todos.create');
    }

    public function edit(Todo $todo){
      return view('todos.edit', compact('todo'));
    }

    public function complete(Todo $todo){
      $todo->update(['completed' => true]);
      return redirect()->back();
    }

    public function incomplete(Todo $todo){
      $todo->update(['completed' => false]);
      return redirect()->back();
    }

    public function store(Request $request){
        $request->validate([
          'title' => 'required|max:255',
        ]);
        Todo::create($request->all());
        return redirect()->back()->with('message', 'Item created successfully');
    }
}
