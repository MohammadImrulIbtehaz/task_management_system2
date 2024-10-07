

@extends('layouts.layout')

@section('title', 'Create Task')

@section('content')
<div class="container">
    <h1>Create a New Task</h1>

    <!-- Display validation errors -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
    
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>
    
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="Incomplete">Incomplete</option>
                <option value="Complete">Complete</option>
            </select>
        </div>
    
        <button type="submit" class="btn btn-primary">Create Task</button>
    </form>
    
</div>
@endsection
