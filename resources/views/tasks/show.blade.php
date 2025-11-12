@extends('layouts.app')

@section('title', 'Task Details')

@section('content')
<div class="container py-5">
    <div class="content-card" style="max-width: 900px; margin: 0 auto;">
        <div class="mb-4">
            <a href="{{ route('tasks.index') }}" class="text-decoration-none text-muted d-inline-flex align-items-center mb-3">
                <i class="fas fa-arrow-left me-2"></i> Back to Tasks
            </a>
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h2 class="page-title mb-2">{{ $task->title }}</h2>
                    <p class="text-muted mb-0">
                        Created: {{ $task->created_at->format('F d, Y') }}
                    </p>
                </div>
                <span class="badge {{ $task->is_completed ? 'bg-success' : 'bg-warning' }} fs-6">
                    {{ $task->is_completed ? 'Completed' : 'Pending' }}
                </span>
            </div>
        </div>

        <div class="border rounded-3 p-4 mb-4" style="background: var(--bg-light);">
            <h5 class="fw-semibold mb-3">Description</h5>
            @if($task->description)
                <p class="mb-0">{{ $task->description }}</p>
            @else
                <p class="mb-0 text-muted fst-italic">No description provided.</p>
            @endif
        </div>

        <div class="border rounded-3 p-4 mb-4">
            <h5 class="fw-semibold mb-3">Task Information</h5>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <p class="mb-1 text-muted small">Status</p>
                    <span class="badge {{ $task->is_completed ? 'bg-success' : 'bg-warning' }}">
                        {{ $task->is_completed ? 'Completed' : 'Pending' }}
                    </span>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="mb-1 text-muted small">Created</p>
                    <p class="mb-0">{{ $task->created_at->format('M d, Y h:i A') }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Last Updated:</strong> {{ $task->updated_at->format('M d, Y h:i A') }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Owner:</strong> {{ $task->user->name }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex gap-2 flex-wrap">
        <form action="{{ route('tasks.toggle-complete', $task) }}" method="POST" class="d-inline">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-{{ $task->is_completed ? 'warning' : 'success' }} btn-lg">
                <i class="fas fa-{{ $task->is_completed ? 'undo' : 'check' }} me-2"></i>
                {{ $task->is_completed ? 'Mark as Pending' : 'Mark as Complete' }}
            </button>
        </form>
        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary btn-lg">
            <i class="fas fa-edit me-2"></i>Edit Task
        </a>
        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('Are you sure you want to delete this task?')">
                <i class="fas fa-trash me-2"></i>Delete Task
            </button>
        </form>
        <a href="{{ route('home') }}" class="btn btn-secondary btn-lg">
            <i class="fas fa-arrow-left me-2"></i>Back to Tasks
        </a>
    </div>
</div>
@endsection
