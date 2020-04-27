@extends('todos.layout')

@section('content')
<form method="post" action="/todos/create" class="form-group" id="title">
  @csrf
  <label for="title"><h4>Add to todo list</h4></label>
  <input type="text" name="title" class="form-control">
  <input type="submit" value="create" class="btn btn-primary mt-4">
</form>
<x-alert />
@endsection
