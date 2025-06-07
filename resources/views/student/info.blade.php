@extends('layouts.default-layout-student')
@section('styles')
    
@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
@endsection



@section('content')
<div class="card-body">
       
        
       
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
                <i class="fas fa-lock"></i> For security reasons, passwords are never displayed and are stored encrypted.
            </div>
            
           
        
    </div>
@endsection