@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1 class="hero-title">Understand <span class="hero-gradient-text">Anything</span></h1>
        <p class="hero-subtitle">Your task management partner, grounded in the organization you trust, built for productivity.</p>
        <div class="mt-4">
            <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-lg">Try TaskManager</a>
        </div>
    </div>
</section>

<!-- Feature Section -->
<section class="feature-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="feature-card text-center">
                    <div class="feature-icon mx-auto" style="background: linear-gradient(135deg, #60a5fa, #3b82f6); color: white;">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h5 class="fw-semibold mb-2">Smart Organization</h5>
                    <p class="text-secondary mb-0" style="font-size: 14px;">Automatically organize and prioritize your tasks</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-card text-center">
                    <div class="feature-icon mx-auto" style="background: linear-gradient(135deg, #34d399, #10b981); color: white;">
                        <i class="fas fa-sync"></i>
                    </div>
                    <h5 class="fw-semibold mb-2">Real-time Sync</h5>
                    <p class="text-secondary mb-0" style="font-size: 14px;">Access your tasks anywhere, anytime</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-card text-center">
                    <div class="feature-icon mx-auto" style="background: linear-gradient(135deg, #a78bfa, #8b5cf6); color: white;">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h5 class="fw-semibold mb-2">Secure & Private</h5>
                    <p class="text-secondary mb-0" style="font-size: 14px;">Your data is encrypted and protected</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-card text-center">
                    <div class="feature-icon mx-auto" style="background: linear-gradient(135deg, #fb923c, #f97316); color: white;">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h5 class="fw-semibold mb-2">Track Progress</h5>
                    <p class="text-secondary mb-0" style="font-size: 14px;">Monitor your productivity with insights</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tasks Section -->
<section class="py-5">
    <div class="container">
        <div class="content-card">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h2 class="page-title mb-2">My Tasks</h2>
                    <p class="page-subtitle mb-0">Manage your daily tasks efficiently</p>
                </div>
                <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add Task
                </a>
            </div>

            <!-- Filter Form -->
            <form method="GET" class="row g-3 mb-4">
                <div class="col-md-5">
                    <input type="text" name="q" class="form-control" placeholder="Search tasks..." value="{{ request('q') }}">
                </div>
                <div class="col-md-4">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-secondary w-100">
                        <i class="fas fa-filter me-2"></i>Filter
                    </button>
                </div>
            </form>

            <!-- Tasks Table -->
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Task</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tasks as $task)
                            <tr>
                                <td>
                                    <div class="fw-semibold mb-1">{{ $task->title }}</div>
                                    @if($task->description)
                                        <small class="text-muted">{{ Str::limit($task->description, 60) }}</small>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $task->is_completed ? 'bg-success' : 'bg-warning' }}">
                                        {{ $task->is_completed ? 'Completed' : 'Pending' }}
                                    </span>
                                </td>
                                <td class="text-muted">{{ $task->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <form action="{{ route('tasks.toggle-complete', $task) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm {{ $task->is_completed ? 'btn-outline-warning' : 'btn-outline-success' }} border-0" title="{{ $task->is_completed ? 'Mark as Pending' : 'Mark as Completed' }}">
                                                <i class="fas {{ $task->is_completed ? 'fa-undo' : 'fa-check-circle' }}"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-primary border-0" title="Edit Task">
                                            <i class="fas fa-pencil"></i>
                                        </a>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('Are you sure you want to delete this task?')" title="Delete Task">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                                    <p class="text-muted mb-0">No tasks found. Create your first task to get started!</p>
                                </td>
                            </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $tasks->links() }}
    </div>
</div>
@endsection
