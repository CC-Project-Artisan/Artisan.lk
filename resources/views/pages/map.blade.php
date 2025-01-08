@extends('layouts.frontend')

@section('pages')
<div class="breadcrumb-bar">
    <div class="breadcrumb-title">
        Map
    </div>
    <div class="breadcrumb-nav">
        <a href="{{ route('welcome') }}">Home</a> &gt; 
        <a href="{{ route('pages.map') }}">Map</a>
    </div>
</div>

<br>

<div class="container mx-auto py-10">
    <h2 class="text-3xl font-bold text-center mb-6">Vendor Galleries Map</h2>
    <div class="map-container">
        {{-- Include the Livewire component --}}
        @livewire('google-map')
    </div>
</div>
@endsection
