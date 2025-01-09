@if (isset($exhibition))

@extends('layouts.frontend')
@section('pages')

@endif

<div class="container mx-auto px-4 py-8">
    <!-- Image Section -->
    <div class="w-full">
        @if($exhibition->exhibitionBanner ?? '')
        @php
        $banners = json_decode($exhibition->exhibitionBanner, true);
        $firstBanner = $banners[0] ?? null;
        @endphp
        @if($firstBanner)
        <img src="{{ asset('images/' . $firstBanner) }}"
            alt="{{ $exhibition->exhibition_name }}"
            class="w-full h-full object-cover rounded-l-lg">
        @else
        <img src="https://overatours.com/wp-content/uploads/2024/05/Artistic-tours-in-Sri-Lanka-1.jpg"
            alt="Default Exhibition Banner"
            class="w-full h-full object-cover rounded-l-lg">
        @endif
        @else
        <img src="https://overatours.com/wp-content/uploads/2024/05/Artistic-tours-in-Sri-Lanka-1.jpg"
            alt="Default Exhibition Banner"
            class="w-full h-full object-cover rounded-l-lg">
        @endif
    </div>

    <!-- Details Section -->
    <div class="bg-white shadow-lg rounded-b-lg p-6 md:mt-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-2 text-center md:text-left">
            {{ $exhibition->exhibition_name ?? '' }}
        </h1>

        <!-- Date and Time -->
        <div class="flex justify-center md:justify-center gap-4 mb-6 space-y-4 items-end md:text-center">
            <div class="flex items-center justify-center md:justify-start text-gray-700">
                <i class="fas fa-calendar text-blue-600 mr-3"></i>
                <span>
                    {{ \Carbon\Carbon::parse($exhibition->exhibition_date ?? '')->format('d M Y') }}
                </span>
            </div>
            <div class="flex items-center justify-center md:justify-start text-gray-700">
                <i class="fas fa-clock text-blue-600 mr-3"></i>
                <span>
                    {{ \Carbon\Carbon::parse($exhibition->start_time ?? '')->format('h:i A') }}
                </span>
                <span class="mx-2">-</span>
                <span>
                    {{ \Carbon\Carbon::parse($exhibition->end_time ?? '')->format('h:i A') }}
                </span>
            </div>
        </div>

        <!-- Description -->
        <p class="text-gray-600 leading-relaxed mb-6 text-center md:text-left">
            {{ $exhibition->exhibition_description ?? '' }}
        </p>

        <!-- Location -->
        <div class="mb-6 bg-gray-100 p-4 rounded-lg">
            <h2 class="text-xl font-semibold text-gray-800 mb-3">Exhibition Location</h2>
            <div class="flex items-center justify-center md:justify-start text-gray-700">
                <i class="fas fa-map-marker-alt text-blue-600 mr-3"></i>
                <span>
                    {{ $exhibition->exhibition_location ?? '' }}
                </span>
            </div>
        </div>

        <!-- Exhibitor Information -->
        <div class="mb-6 bg-gray-100 p-4 rounded-lg">
            <h2 class="text-xl font-semibold text-gray-800 mb-3">Exhibitor Information</h2>
            <ul class="list-disc pl-5 text-gray-600 space-y-2">
                <li>
                    <strong>Organization:</strong>
                    <span>
                        {{ $exhibition->organization_name ?? '' }}
                    </span>
                </li>
                <li>
                    <strong>Registration Period:</strong>
                    <span>
                        {{ \Carbon\Carbon::parse($exhibition->registration_start_date ?? '')->format('h:i A') }}
                    </span>
                    <span class="mx-2">-</span>
                    <span>
                        {{ \Carbon\Carbon::parse($exhibition->registration_end_date ?? '')->format('h:i A') }}
                    </span>
                </li>
                <li>
                    <strong>Maximum Exhibitors:</strong>
                    <span>
                        {{ $exhibition->max_exhibitors ?? '' }}
                    </span>
                </li>
            </ul>
        </div>

        <!-- Ticket Prices -->
        <div class="mb-6 bg-gray-100 p-4 rounded-lg">
            <h2 class="text-xl font-semibold text-gray-800 mb-3">Ticket Prices</h2>
            <ul class="list-disc pl-5 text-gray-600 space-y-2">
                <li>
                    <strong>Exhibitor Entrance Fee:</strong>
                    <span>
                        Rs.{{ $exhibition->vendor_entrance_fee ?? '' }}/=
                    </span>
                </li>
                <li>
                    <strong>Adult:</strong>
                    <span>
                        Rs. {{ $exhibition->regular_price ?? '' }}/=
                    </span>
                </li>
                <li>
                    <strong>Student:</strong>
                    <span>
                        Rs. {{ $exhibition->student_price ?? '' }}/=
                    </span>
                </li>
                <li>
                    <strong>Child:</strong>
                    <span>
                        Rs. {{ $exhibition->child_price ?? '' }}/=
                    </span>
                </li>
            </ul>
        </div>

        <!-- Buttons -->
        <div class="flex flex-col justify-center md:justify-start gap-4 mt-6 md:flex-row">
            @if(isset($exhibition->id))
            <a href="{{ route('exhibition.vendor.register', ['id' => $exhibition->id]) }}" class="apply-button">
                Register as Vendor
            </a>
            @else
            <a href="#" class="apply-button disabled" aria-disabled="true">
                Register as Vendor
            </a>
            @endif

            <a href="#" class="apply-button">
                Book Tickets
            </a>
        </div>
    </div>
</div>

@if (isset($exhibition))
@endsection
@endif