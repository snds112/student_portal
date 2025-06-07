@extends('layouts.edit-create-layout')



@section('content')
    <div class="card-body">
        <h4 class="card-title mb-4">Edit Project</h4>

        <form action="{{ route('projects.update', $project->id) }}" method="POST" id="editing-form">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title', $project->title) }}" required maxlength="100">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5"
                        required maxlength="500">{{ old('description', $project->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

        
            <div class="row">
                <div class="col-md-12 d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-primary me-2" onclick="event.preventDefault(); document.getElementById('editing-form').submit();">
                            <i class="fas fa-save"></i> Update Project
                        </button>
                        <a href="{{ route('projects.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>

                    @auth('admin')
                       
                        <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    @endauth
                </div>
            </div>
        </form>
        @auth('admin')
            <form  action="{{ route('projects.destroy', $project->id) }}" method="POST" id="delete-form"
                style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        @endauth
    </div>
@endsection
