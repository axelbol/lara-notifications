@extends('layouts.admin')

@section('content')
    <form action="{{ route('post.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label>Title</label>
      <input type="text" class="form-control" name="title" placeholder="Enter your title here">
    </div>
    <div class="form-group">
      <label>Description</label>
      <input type="text" class="form-control" name="description" placeholder="Enter description here">
    </div>
    <button class="btn btn-dark" type="submit">Submit</button>
    </form>
@endsection