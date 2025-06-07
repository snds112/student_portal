@extends('layouts.edit-create-layout')


@section('scripts')
     @vite('resources/js/wishlists.js')
@endsection

@section('content')
    <div class="card-body">
        <form id="wishlist-form" method="POST" action="{{ route('wishlists.update') }}">
            @csrf
            <input type="hidden" name="selected_projects" id="selected-projects-input">

            <div class="alert alert-warning d-none" id="max-warning">
                You've reached the maximum of 5 selected projects. Unselect some to add others.
            </div>

            <p>Selected projects: <span id="selected-count">0/5</span></p>

            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <h3 class="my-3">Selected Projects</h3>
                    <div class="list-group">
                        @foreach ($selectedProjects as $project)
                            <label class="list-group-item">
                                <div class="d-flex align-items-center">

                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-start">
                                            <input type="checkbox" class="form-check-input me-1 project-checkbox"
                                                value="{{ $project->id }}" checked>
                                            <h4 class="list-group-item-heading mb-2">{{ $project->title }}</h4>
                                        </div>
                                        <p class="list-group-item-text mb-2">{{ $project->description }}</p>
                                        <small class="text-muted">
                                            Created on {{ $project->created_at->format('M d, Y') }}
                                        </small>
                                    </div>

                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <h3 class="my-3">Available Projects</h3>
                    <div class="list-group">
                        @foreach ($projects as $project)
                            <label class="list-group-item">
                                <div class="d-flex align-items-center">

                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-start">
                                            <input type="checkbox" class="form-check-input me-1 project-checkbox"
                                                value="{{ $project->id }}">
                                            <h4 class="list-group-item-heading mb-2">{{ $project->title }}</h4>
                                        </div>
                                        <p class="list-group-item-text mb-2">{{ $project->description }}</p>
                                        <small class="text-muted">
                                            Created on {{ $project->created_at->format('M d, Y') }}
                                        </small>
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

           
             
            <div class="row">
                <div class="col-md-12 d-flex justify-content-between mt-3">
                    <div>
                       <button type="submit" class="btn btn-primary">Save Changes</button>
                       <a href="{{ route('wishlists.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>

                    </div>

                    
                </div>
            </div>
        </form>
    </div>
@endsection
