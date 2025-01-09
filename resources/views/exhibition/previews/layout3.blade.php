@if (isset($exhibition))

@extends('layouts.frontend')
@section('pages')

@endif

<div class="container mx-auto px-4 py-8">
    <!-- Details Section -->
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-4 text-center">
            {{ $exhibition->exhibition_name ?? '' }}
        </h1>

        <!-- Event Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Date and Time -->
            <div class="bg-gray-100 p-4 rounded-lg">
                <h2 class="text-xl font-semibold text-gray-800 mb-3">Event Schedule</h2>
                <div class="flex items-center text-gray-700 pl-5">
                    <i class="fas fa-calendar text-blue-600 mr-3"></i>
                    <span>
                        {{ \Carbon\Carbon::parse($exhibition->exhibition_date ?? '')->format('d M Y') }}
                    </span>
                </div>
                <div class="flex items-center text-gray-700 mt-2 pl-5">
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

            <!-- Location -->
            <div class="bg-gray-100 p-4 rounded-lg">
                <h2 class="text-xl font-semibold text-gray-800 mb-3">Exhibition Location</h2>
                <div class="flex items-center text-gray-700 pl-5">
                    <i class="fas fa-map-marker-alt text-blue-600 mr-3"></i>
                    <span>
                        {{ $exhibition->exhibition_location ?? '' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="mb-6 bg-gray-100 p-4 rounded-lg">
            <h2 class="text-xl font-semibold text-gray-800 mb-3">About the Exhibition</h2>
            <p class="text-gray-600 leading-relaxed pl-5">
                {{ $exhibition->exhibition_description ?? '' }}
            </p>
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
                <li><strong>Registration Period:</strong>
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
                <li><strong>Adult:</strong>
                    <span>
                        Rs. {{ $exhibition->regular_price ?? '' }}/=
                    </span>
                </li>
                <li><strong>Student:</strong>
                    <span>
                        Rs. {{ $exhibition->student_price ?? '' }}/=
                    </span>
                </li>
                <li><strong>Child:</strong>
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