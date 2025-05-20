@extends('layouts.default-layout')
@section('styles')
    
@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
@endsection



@section('content')
  <div class="card-body">
    @if($announcements->isEmpty())
        <div class="alert alert-info">No announcements found.</div>
    @else
        <div class="list-group">
            @foreach($announcements as $announcement)
                <div class="list-group-item">
                    <h4 class="list-group-item-heading">{{ $announcement->title }}</h4>
                    <p class="list-group-item-text">{{ $announcement->content }}</p>
                    <small class="text-muted">
                        Posted on {{ $announcement->created_at->format('M d, Y') }}
                    </small>
                </div>
            @endforeach
        </div>
    @endif

  </div>
@endsection
