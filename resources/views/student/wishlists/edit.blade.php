@extends('layouts.edit-create-layout')
@section('styles')
    <style>
        .list-group-item {
            cursor: pointer;
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
        }

        .max-selected {
            color: red;
            font-weight: bold;
        }
    </style>
@endsection

@section('scripts')
    <script>
        

        document.addEventListener('DOMContentLoaded', function() {
            const maxSelected = 5;
            let selectedProjects = [];

            const selectedSection = document.querySelectorAll('.col-md-6 .list-group')[0];
            const availableSection = document.querySelectorAll('.col-md-6 .list-group')[1];
            const warning = document.getElementById('max-warning');
            const countSpan = document.getElementById('selected-count');
            const hiddenInput = document.getElementById('selected-projects-input');
            const form = document.getElementById('wishlist-form');

            // Initialize selectedProjects array
            selectedSection.querySelectorAll('.project-checkbox:checked').forEach(cb => {
                selectedProjects.push(parseInt(cb.value));
            });
            updateUI();

            document.addEventListener('change', function(e) {
                if (e.target.classList.contains('project-checkbox')) {
                    const checkbox = e.target;
                    const projectId = parseInt(checkbox.value);
                    const label = checkbox.closest('label');

                    if (checkbox.checked) {
                        if (selectedProjects.length < maxSelected && !selectedProjects.includes(
                            projectId)) {
                            selectedProjects.push(projectId);
                            selectedSection.appendChild(label);
                        } else {
                            checkbox.checked = false;
                            warning.classList.remove('d-none');
                        }
                    } else {
                        selectedProjects = selectedProjects.filter(id => id !== projectId);
                        availableSection.appendChild(label);
                    }

                    updateUI();
                }
            });

            form.addEventListener('submit', function() {
                hiddenInput.value = JSON.stringify(selectedProjects);
            });

            function updateUI() {
                countSpan.textContent = `${selectedProjects.length}/${maxSelected}`;
                if (selectedProjects.length < maxSelected) {
                    warning.classList.add('d-none');
                }
            }
        });
    </script>
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
                    <h3>Selected Projects</h3>
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
                    <h3>Available Projects</h3>
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

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
@endsection
