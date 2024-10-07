

@extends('layouts.layout')

@section('title', 'Edit Task')

@section('content')
<div class="container">
    <h1>Edit Task</h1>

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

    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
        @csrf
        @method('PUT')
    
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ $task->title }}" class="form-control" required>
        </div>
    
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ $task->description }}</textarea>
        </div>
    
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="Incomplete" {{ $task->status == 'Incomplete' ? 'selected' : '' }}>Incomplete</option>
                <option value="Complete" {{ $task->status == 'Complete' ? 'selected' : '' }}>Complete</option>
            </select>
        </div>
    
        <button type="submit" class="btn btn-primary">Update Task</button>
    </form>
    
</div>
@endsection
