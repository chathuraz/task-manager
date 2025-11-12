@extends('layouts.app')

@section('title', 'Create Task')

@section('content')
<div class="container py-5">
    <div class="content-card" style="max-width: 800px; margin: 0 auto;">
        <div class="mb-4">
            <a href="{{ route('tasks.index') }}" class="text-decoration-none text-muted d-inline-flex align-items-center mb-3">
                <i class="fas fa-arrow-left me-2"></i> Back to Tasks
            </a>
            <h2 class="page-title mb-2">Create New Task</h2>
            <p class="page-subtitle mb-0">Add a new task to your list</p>
        </div>

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="title" class="form-label fw-semibold">Task Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                       id="title" name="title" value="{{ old('title') }}" 
                       placeholder="Enter task title..." required autofocus>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="form-label fw-semibold">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="5" 
                          placeholder="Enter task description...">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_completed" 
                           name="is_completed" value="1" {{ old('is_completed') ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold" for="is_completed">
                        Mark as completed
                    </label>
                </div>
            </div>

            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Create Task
                </button>
                <a href="{{ route('tasks.index') }}" class="btn btn-outline-primary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection