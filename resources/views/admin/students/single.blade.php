@extends('layouts.default-layout-admin')
@section('styles')
@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
@endsection



@section('content')
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <h3 class="mb-3">Information :</h3>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">First Name:</div>
                    <div class="col-md-8">{{ $account->first_name }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Last Name:</div>
                    <div class="col-md-8">{{ $account->last_name }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Email:</div>
                    <div class="col-md-8">
                        {{ $account->email }}

                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Account Created:</div>
                    <div class="col-md-8">
                        {{ $account->created_at->format('M j, Y \a\t g:i a') }}
                        <small class="text-muted">({{ $account->created_at->diffForHumans() }})</small>
                    </div>
                </div>

                {{-- Security note about password --}}
                <div class="alert alert-info mt-4">
                    <i class="fas fa-lock"></i> For security reasons, passwords are never displayed and are stored
                    encrypted.
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <h3 class="mb-3">Wishlist: </h3>
                @if ($projects->isEmpty())
                    <div class="alert alert-info">Wishlist Empty....</div>
                @else
                    <div class="list-group">
                        @foreach ($projects as $project)
                            <label class="list-group-item">
                                <div class="d-flex align-items-center">

                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-start">

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
                @endif
            </div>

        </div>




    </div>
@endsection
