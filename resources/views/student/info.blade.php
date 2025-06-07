@extends('layouts.default-layout-student')


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
            
          
        
    </div>
@endsection