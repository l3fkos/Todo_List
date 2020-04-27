@extends('todos.layout')


@section('content')
<div><h4 class="display-4 mx-auto text-center">Todo List<h4></div><br>
  <x-alert />
<a href="/todos/create"><button type="button" class="btn btn-primary mb-2 w-100" >Add + </button></a>
<ul class="list-group">
  @foreach($todos as $todo)
    <li class="list-group-item list-group-item-action d-inline-block">
      <div>
        <button type="button" class="btn btn-sm btn-secondary float-right" onclick="event.preventDefault();
                                                                                    if(confirm('Are you sure you would like to delete?')){
                                                                                    document.getElementById('form-delete-{{$todo->id}}').submit()}">delete</button>
        <a href="{{'/todos/' . $todo->id . '/edit'}}"><button type="button" class="btn btn-sm btn-secondary float-right mr-3">edit</button></a>
        @if($todo->completed)
        <span style="text-decoration: line-through;">{{$todo->title}}</span>
        @else
        {{$todo->title}}
        @endif
        @if($todo->completed)
        <input type="checkbox" class="float-right mt-2 mr-3" checked onchange="document.getElementById('form-incomplete-{{$todo->id}}').submit()">
        <form style ="display:none;" id="{{'form-incomplete-' . $todo->id }}" method="post" action="{{route('todo.incomplete', $todo->id)}}">
          @csrf
          @method('delete')
        </form>
        @else
        <input type="checkbox" class="float-right mt-2 mr-3" unchecked onchange="document.getElementById('form-complete-{{$todo->id}}').submit()">
        @endif
        <form style ="display:none;" id="{{'form-complete-' . $todo->id }}" method="post" action="{{route('todo.complete', $todo->id)}}">
          @csrf
          @method('put')
        </form>
        <form style ="display:none;" id="{{'form-delete-' . $todo->id }}" method="post" action="{{route('todo.delete', $todo->id)}}">
          @csrf
          @method('delete')
        </form>


      </div>
    </li>
  @endforeach
</ul>
@endsection
