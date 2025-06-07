@extends('layouts.default-layout-admin')


@section('content')
<div class="card-body">
    <!-- Create Announcement Button (Top) -->
    {{-- @auth('admin')
    <div class="mb-4">
        <a href="{{ route('student.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create New Student Account
        </a>
    </div>
    @endauth --}}

   @if($accounts->isEmpty())
    <div class="alert alert-info">No accounts found.</div>
@else
    <div class="list-group">
        @foreach($accounts as $account)
            
            <a href="{{ route('student.single', $account->id) }}" class="list-group-item list-group-item-action text-reset text-decoration-none">
                <div class="d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start">
                        <h5 class="list-group-item-heading mb-2">
                            {{ $account->first_name }} {{ $account->last_name }}
                            
                        </h5>
                        {{-- <!-- Edit Button - Visible on larger screens -->
                        @auth('admin')
                        <div class="d-none d-md-block">
                            <a href="{{ route('accounts.edit', $account->id) }}" 
                               class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </div>
                        @endauth --}}
                    </div>
                    
                    <p class="list-group-item-text mb-2">
                        <i class="fas fa-envelope"></i> {{ $account->email }}
                    </p>
                    
                    <div class="d-flex justify-content-between align-items-end">
                        <small class="text-muted">
                            <i class="fas fa-calendar-alt"></i> Created on {{ $account->created_at->format('M d, Y') }}
                            <span class="ms-2">({{ $account->created_at->diffForHumans() }})</span>
                        </small>
                        
                        {{-- <!-- Edit Button - Visible on mobile screens -->
                        @auth('admin')
                        <div class="d-md-none mt-2">
                            <a href="{{ route('accounts.edit', $account->id) }}" 
                               class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </div>
                        @endauth --}}
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endif
</div>
@endsection