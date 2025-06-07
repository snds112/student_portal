@extends('layouts.edit-create-layout')



@section('content')
    <div class="card-body">
        <h4 class="card-title mb-4">Edit Announcement</h4>

        <form action="{{ route('announcements.update', $announcement->id) }}" method="POST" id="editing-form">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title', $announcement->title) }}" required maxlength="100">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5"
                        required maxlength="500">{{ old('content', $announcement->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="dept" class="form-label">Department</label>
                    <select class="form-select @error('dept') is-invalid @enderror" id="dept" name="dept" required>
                        <option value="">Select Department</option>
                        <option value="general" {{ old('dept', $announcement->dept) == 'general' ? 'selected' : '' }}>
                            General</option>
                        <option value="computer_science"
                            {{ old('dept', $announcement->dept) == 'computer_science' ? 'selected' : '' }}>Computer Science
                        </option>
                        <option value="maths" {{ old('dept', $announcement->dept) == 'maths' ? 'selected' : '' }}>
                            Mathematics</option>
                        <option value="physics" {{ old('dept', $announcement->dept) == 'physics' ? 'selected' : '' }}>
                            Physics</option>
                        <option value="chemistry" {{ old('dept', $announcement->dept) == 'chemistry' ? 'selected' : '' }}>
                            Chemistry</option>
                    </select>
                    @error('dept')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-primary me-2" onclick="event.preventDefault(); document.getElementById('editing-form').submit();">
                            <i class="fas fa-save"></i> Update Announcement
                        </button>
                        <a href="{{ route('announcements.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>

                    @auth('admin')
                        <!-- Delete Button (outside the edit form) -->
                        <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    @endauth
                </div>
            </div>
        </form>
        @auth('admin')
            <form  action="{{ route('announcements.destroy', $announcement->id) }}" method="POST" id="delete-form"
                style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        @endauth
    </div>
@endsection
