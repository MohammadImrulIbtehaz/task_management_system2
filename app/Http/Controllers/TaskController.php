<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the tasks with optional search and filter functionality.
     */
    public function index(Request $request)
    {
        // Get search term and filter by status from request
        $searchTerm = $request->input('search');
        $statusFilter = $request->input('status');

        // Fetch tasks based on search or filter criteria
        $query = Task::query();

        // Apply search filter if there's a search term
        if ($searchTerm) {
            $query->where('title', 'LIKE', '%' . $searchTerm . '%');
        }

        // Apply status filter if there's a status selected
        if ($statusFilter) {
            $query->where('status', $statusFilter);
        }

        // Get the tasks (with optional filters applied)
        $tasks = $query->get();

        // Return view with tasks, search term, and selected status filter
        return view('tasks.index', compact('tasks', 'searchTerm', 'statusFilter'));
    }

    /**
     * Show the form for creating a new task.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request)
    {
        // Validate the form inputs including deadline
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string',
            'deadline' => 'nullable|date',  // Added deadline validation (optional)
        ]);

        // Create a new task
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status ?? 'Incomplete', // Default to 'Incomplete' if not provided
            'deadline' => $request->deadline, // Store deadline if provided
        ]);

        // Redirect back with success message
        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    /**
     * Show the form for editing the specified task.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified task in storage.
     */
    public function update(Request $request, Task $task)
    {
        // Validate the form inputs including deadline
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string',
            'deadline' => 'nullable|date',  // Added deadline validation (optional)
        ]);

        // Update the task
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,  // Update status (Completed/Incomplete)
            'deadline' => $request->deadline, // Update deadline if provided
        ]);

        // Redirect to the task list with success message
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Task $task)
    {
        // Delete the task
        $task->delete();

        // Redirect to the task list with success message
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }

    /**
     * Search for tasks based on title.
     */
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        // Search for tasks by title
        $tasks = Task::where('title', 'LIKE', '%' . $searchTerm . '%')->get();

        // Return the results to the index view
        return view('tasks.index', compact('tasks', 'searchTerm'));
    }

    /**
     * Remove all tasks from storage (Optional).
     */
    public function deleteAll()
    {
        // Delete all tasks from the database
        Task::truncate();

        // Redirect to the tasks index with a success message
        return redirect()->route('tasks.index')->with('success', 'All tasks deleted successfully!');
    }
}
