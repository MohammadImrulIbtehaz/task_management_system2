<h1>Edit Task</h1>

<form action="{{ route('tasks.update', $task->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="title">Title:</label>
    <input type="text" name="title" value="{{ old('title', $task->title) }}">
    @error('title')
        <p>{{ $message }}</p>
    @enderror

    <label for="description">Description:</label>
    <textarea name="description">{{ old('description', $task->description) }}</textarea>
    @error('description')
        <p>{{ $message }}</p>
    @enderror

    <button type="submit">Update Task</button>
</form>

<a href="{{ route('tasks.index') }}">Back to Task List</a>
