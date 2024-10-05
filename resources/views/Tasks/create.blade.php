<h1>Create Task</h1>
<form action="{{ route('tasks.store') }}" method="POST">
    @csrf
    <label for="title">Title:</label>
    <input type="text" name="title" value="{{ old('title') }}">
    @error('title') <p>{{ $message }}</p> @enderror

    <label for="description">Description:</label>
    <textarea name="description">{{ old('description') }}</textarea>
    @error('description') <p>{{ $message }}</p> @enderror

    <button type="submit">Add Task</button>
</form>
