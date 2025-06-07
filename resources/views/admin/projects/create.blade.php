@extends('layouts.edit-create-layout')


@section('content')
<div class="card-body">
    <h4 class="card-title mb-4">Create New Project</h4>
    
    <form action="{{ route('projects.store') }}" method="POST">
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
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="5" required maxlength="500">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
      
        
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="fas fa-save"></i> Create Porject
                </button>
                <a href="{{ route('projects.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </div>
    </form>
</div>
@endsection