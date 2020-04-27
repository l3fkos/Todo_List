@extends('todos.layout')

@section('content')

<h4>Update item</h4><br>


<form method="post" action="{{route('todo.update', $todo->id)}}" class="form-group" id="title">
  @csrf
  @method('patch')
  <label for="title"><h6>New value</h6></label>
  <input type="text" name="title" value="{{$todo->title}}" class="form-control">
  <input type="submit" value="edit" class="btn btn-primary mt-4">
</form>
<x-alert />

@endsection
