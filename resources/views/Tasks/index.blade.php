<h1>Task List</h1>
<a href="{{ route('tasks.create') }}">Add New Task</a>

@if($tasks->isEmpty())
    <p>Task List is empty!</p>
@else
    <table>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        @foreach($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td style="color: {{ $task->status === 'Complete' ? 'green' : 'red' }};">
                    {{ $task->status }}
                </td>
                <td>
                    <a href="{{ route('tasks.edit', $task->id) }}">Edit</a>
                    <a href="{{ route('tasks.updateStatus', $task->id) }}">
                        Mark as {{ $task->status === 'Complete' ? 'Incomplete' : 'Complete' }}
                    </a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <form action="{{ route('tasks.destroyAll') }}" method="POST">
        @csrf @method('DELETE')
        <button type="submit">Delete All</button>
    </form>
@endif
