<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Task Management System</h1>

        {{-- Success message --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Search and Filter Form --}}
        <form action="{{ route('tasks.index') }}" method="GET" class="mb-4">
            <div class="form-row">
                {{-- Search Bar --}}
                <div class="col-md-6 mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Search tasks by title..." value="{{ request('search') }}">
                </div>
                
                {{-- Status Filter Dropdown --}}
                <div class="col-md-4 mb-3">
                    <select name="status" class="form-control">
                        <option value="">All Statuses</option>
                        <option value="Complete" {{ request('status') == 'Complete' ? 'selected' : '' }}>Complete</option>
                        <option value="Incomplete" {{ request('status') == 'Incomplete' ? 'selected' : '' }}>Incomplete</option>
                    </select>
                </div>

                {{-- Search Button --}}
                <div class="col-md-2">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </form>

        {{-- Task List --}}
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Deadline</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->status }}</td>
                        <td>
                            {{-- Check if task has deadline and display it --}}
                            @if($task->deadline)
                                {{-- Highlight if the deadline is past --}}
                                @if($task->deadline < now())
                                    <span class="text-danger">{{ $task->deadline }}</span>
                                @else
                                    {{ $task->deadline }}
                                @endif
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No tasks found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Delete All Button --}}
        @if ($tasks->isNotEmpty())
            <form action="{{ route('tasks.deleteAll') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete all tasks?')">Delete All</button>
            </form>
        @endif

        {{-- Add Task Button --}}
        <a href="{{ route('tasks.create') }}" class="btn btn-success mt-4">Add New Task</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
