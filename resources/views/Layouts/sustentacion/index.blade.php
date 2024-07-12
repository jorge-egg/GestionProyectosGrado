@extends('dashboard')

@section('dashboard_content')
<div class="grid">
    <div class="modal fade" tabindex="-1" id="modal">
        @component('components.sustentacion.modal')
        @endcomponent
    </div>
<div class="card">
    <div class="card-header">
      Featured
    </div>
    <div class="card-body">
      <h5 class="card-title">Special title treatment</h5>
      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
      </button>
    </div>
  </div>

@section('js')
    <script></script>
@endsection
@stop
