@extends('layouts.edit-create-layout')
@section('styles')
    
@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
@endsection



@section('content')
<div class="card-body">
    <h4 class="card-title mb-4">Create New Announcement</h4>
    
    <form action="{{ route('announcements.store') }}" method="POST">
        @csrf
        
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                       id="title" name="title" value="{{ old('title') }}" required maxlength="100">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control @error('content') is-invalid @enderror" 
                          id="content" name="content" rows="5" required maxlength="500">{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="dept" class="form-label">Department</label>
                <select class="form-select @error('dept') is-invalid @enderror" 
                        id="dept" name="dept" required>
                    <option value="">Select Department</option>
                    <option value="general" {{ old('dept') == 'general' ? 'selected' : '' }}>General</option>
                    <option value="computer_science" {{ old('dept') == 'computer_science' ? 'selected' : '' }}>Computer Science</option>
                    <option value="maths" {{ old('dept') == 'maths' ? 'selected' : '' }}>Mathematics</option>
                    <option value="physics" {{ old('dept') == 'physics' ? 'selected' : '' }}>Physics</option>
                    <option value="chemistry" {{ old('dept') == 'chemistry' ? 'selected' : '' }}>Chemistry</option>
                </select>
                @error('dept')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="fas fa-save"></i> Create Announcement
                </button>
                <a href="{{ route('announcements.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </div>
    </form>
</div>
@endsection