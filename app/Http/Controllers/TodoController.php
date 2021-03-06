<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Illuminate\Support\Facades\Validator;


class TodoController extends Controller
{

  public function delete(Todo $todo){
    $todo->delete();
    return redirect()->back()->with('message', 'item deleted successfully');
  }

    public function index(){
      $todos = auth()->user()->todos()->orderBy('completed')->get();

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

        $userId = auth()->user()->id;
        $request['user_id'] = $userId;

        $rules = ['title' => 'required|max:255'];

        $messages = [ 'title.max' => 'Todo title should not be greater than 255 chars'];
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
          return redirect()->back()->withErrors($validator)->withInput();
        }
        Todo::create($request->all());
        return redirect(route('todo.index'))->with('message', 'Item created successfully');
    }
}
