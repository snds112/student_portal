@extends('layouts.default-layout-admin')


@section('content')
<div class="card-body">
    <!-- Create Announcement Button (Top) -->
    @auth('admin')
    <div class="mb-4">
        <a href="{{ route('projects.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create New Project
        </a>
    </div>
    @endauth

    @if($projects->isEmpty())
        <div class="alert alert-info">No projects found.</div>
    @else
        <div class="list-group">
            @foreach($projects as $project)
                <div class="list-group-item">
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start">
                            <h4 class="list-group-item-heading mb-2">{{ $project->title }}</h4>
                           
                            @auth('admin')
                            <div class="d-none d-md-block">
                                <a href="{{ route('projects.edit', $project->id) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </div>
                            @endauth
                        </div>
                        
                        <p class="list-group-item-text mb-2">{{ $project->description }}</p>
                        
                        <div class="d-flex justify-content-between align-items-end">
                            <small class="text-muted">
                                Created on {{ $project->created_at->format('M d, Y') }}
                            </small>
                            
                          
                            @auth('admin')
                            <div class="d-md-none mt-2">
                                <a href="{{ route('projects.edit', $project->id) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </div>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection