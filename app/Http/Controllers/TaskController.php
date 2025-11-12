<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $query = Task::where('user_id', auth()->id());

        // Filter by status
        if ($request->has('status') && in_array($request->status, ['completed', 'pending'])) {
            $query->where('is_completed', $request->status === 'completed');
        }

        // Search by title (trimmed and case-insensitive)
        if ($request->has('q') && !empty(trim($request->q))) {
            $query->where('title', 'like', '%' . trim($request->q) . '%');
        }

        // Order by latest and paginate
        $tasks = $query->latest()->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TaskRequest  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(TaskRequest $request)
    {
        $validated = $request->validated();
        $validated['is_completed'] = $request->has('is_completed');
        $validated['user_id'] = auth()->id();

        Task::create($validated);

        return redirect('/')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(TaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);
        $validated = $request->validated();
        $validated['is_completed'] = $request->has('is_completed');

        $task->update($validated);

        return redirect('/')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();

        return redirect('/')->with('success', 'Task deleted successfully.');
    }

    /**
     * Toggle the completion status of the specified task.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleComplete(Task $task)
    {
        $this->authorize('update', $task);
        $task->update(['is_completed' => !$task->is_completed]);

        return back()->with('success', 'Task status updated.');
    }
}
