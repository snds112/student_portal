@extends('layouts.default-layout-admin')



@section('content')
<div class="card-body">
    <!-- Create Announcement Button (Top) -->
    @auth('admin')
    <div class="mb-4">
        <a href="{{ route('announcements.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create New Announcement
        </a>
    </div>
    @endauth

    @if($announcements->isEmpty())
        <div class="alert alert-info">No announcements found.</div>
    @else
        <div class="list-group">
            @foreach($announcements as $announcement)
                <div class="list-group-item">
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start">
                            <h4 class="list-group-item-heading mb-2">{{ $announcement->title }}</h4>
                            <!-- Edit Button - Visible on larger screens -->
                            @auth('admin')
                            <div class="d-none d-md-block">
                                <a href="{{ route('announcements.edit', $announcement->id) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </div>
                            @endauth
                        </div>
                        
                        <p class="list-group-item-text mb-2">{{ $announcement->content }}</p>
                        
                        <div class="d-flex justify-content-between align-items-end">
                            <small class="text-muted">
                                Posted on {{ $announcement->created_at->format('M d, Y') }}
                            </small>
                            
                            <!-- Edit Button - Visible on mobile screens -->
                            @auth('admin')
                            <div class="d-md-none mt-2">
                                <a href="{{ route('announcements.edit', $announcement->id) }}" 
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