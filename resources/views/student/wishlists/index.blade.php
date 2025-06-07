@extends('layouts.default-layout-student')


@section('content')
<div class="card-body">
   
   <div class="mb-4">
        <a href="{{ route('wishlists.edit') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Edit Wishlist
        </a>
    </div>

    @if($projects->isEmpty())
        <div class="alert alert-info">Wishlist Empty....</div>
    @else
        <div class="list-group">
            @foreach($projects as $project)
                <div class="list-group-item">
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start">
                            <h4 class="list-group-item-heading mb-2">{{ $project->title }}</h4>
                            
                            
                        </div>
                        
                        <p class="list-group-item-text mb-2">{{ $project->description }}</p>
                        
                        <div class="d-flex justify-content-between align-items-end">
                            <small class="text-muted">
                                Created on {{ $project->created_at->format('M d, Y') }}
                            </small>
                            
                          
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection