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

    <!-- Search Form -->
    <div class="search-container mb-6">
        <h3 class="text-2xl font-semibold mb-4">Customize Your Artisan Search</h3>
        <form method="GET" action="{{ route('pages.map') }}" class="search-form grid grid-cols-1 gap-4 sm:grid-cols-3">
            <!-- <input 
                type="text" 
                name="keyword" 
                placeholder="Keyword" 
                value="{{ request('keyword') }}" 
                class="p-2 border rounded w-full"
            >
            <input 
                type="text" 
                name="location" 
                placeholder="Location" 
                value="{{ request('location') }}" 
                class="p-2 border rounded w-full"
            > -->
            <select 
        name="category" 
        class="p-2 border rounded w-full"
    >
        <option value="" {{ request('business_category') == '' ? 'selected' : '' }}>All Categories</option>
        <option value="1" {{ request('business_category') == '1' ? 'selected' : '' }}>Jewellery</option>
        <option value="2" {{ request('business_category') == '2' ? 'selected' : '' }}>Painting</option>
        <option value="3" {{ request('business_category') == '3' ? 'selected' : '' }}>Pottery</option>
        <option value="4" {{ request('business_category') == '4' ? 'selected' : '' }}>Sculpture</option>
        <option value="5" {{ request('business_category') == '5' ? 'selected' : '' }}>Textile</option>
    </select>
    <button 
    type="submit" 
    class="p-2 rounded w-full sm:col-span-3"
    style="background-color: grey; color: black;"
>
    Filter
</button>


        </form>
    </div>

    <!-- Map Container -->
    <div class="map-container mb-8">
        {{-- Include the Livewire component --}}
        @livewire('google-map', ['vendors' => $vendors])
    </div>

    <!-- Results Section -->
    @if ($vendors->count() > 0)
        <div class="results-container">
            <h3 class="text-xl font-bold mb-4">Results: {{ $vendors->count() }} Found</h3>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($vendors as $vendor)
                    <div class="result-item p-4 border rounded shadow-md">
                        <h4 class="font-semibold text-lg">{{ $vendor->business_name }}</h4>
                        <p>{{ $vendor->business_address }}</p>
                        <p>Category: {{ $vendor->business_category }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="results-container mt-6">
            <p class="text-center text-gray-500">No vendors found matching your criteria.</p>
        </div>
    @endif
</div>
@endsection
