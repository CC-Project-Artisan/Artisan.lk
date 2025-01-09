@if (isset($exhibition))

@extends('layouts.frontend')
@section('pages')

@endif

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-wrap bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Left Side - Image -->
        <div class="w-full md:w-2/5">
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

        <!-- Right Side - Details -->
        <div class="w-full md:w-3/5 p-6 flex flex-col justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">
                    <span data-key="exhibition_name">
                        {{ $exhibition->exhibition_name ?? '' }}
                    </span>
                </h1>
                <div class="mb-6 space-y-3 flex gap-3 justify-center">
                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-calendar text-blue-600 mr-3"></i>
                        <span data-key="exhibition_date">
                            {{ \Carbon\Carbon::parse($exhibition->exhibition_date ?? '')->format('d M Y') }}
                        </span>
                    </div>
                    <div class="m-0 flex items-center text-gray-700">
                        <i class="fas fa-clock text-blue-600 mr-3"></i>
                        <span data-key="start_time" id="start_time">
                            {{ \Carbon\Carbon::parse($exhibition->start_time ?? '')->format('h:i A') }}
                        </span>
                        <span class="mx-2">-</span>
                        <span data-key="end_time" id="end_time">
                            {{ \Carbon\Carbon::parse($exhibition->end_time ?? '')->format('h:i A') }}
                        </span>
                    </div>
                </div>
                <p class="text-gray-600 leading-relaxed mb-8 text-center">
                    <span data-key="exhibition_description">
                        {{ $exhibition->exhibition_description ?? '' }}
                    </span>
                </p>
            </div>

            <!-- Location Card -->
            <div class=" bg-gray-100 p-4 rounded-lg">
                <h2 class="text-xl font-semibold text-gray-800 mb-3">Exhibition Location</h2>
                <div class="flex items-center text-gray-700 pl-5">
                    <i class="fas fa-map-marker-alt text-blue-600 mr-3"></i>
                    <span data-key="exhibition_location">
                        {{ $exhibition->exhibition_location ?? '' }}
                    </span>
                </div>
            </div>

            <!-- Exhibitor Information -->
            <div class=" bg-gray-100 p-4 rounded-lg">
                <h2 class="text-xl font-semibold text-gray-800 mb-3">Exhibitor Information</h2>
                <ul class="list-disc pl-5 text-gray-600 space-y-2">
                    <li>
                        <strong>Organization:</strong>
                        <span data-key="organization_name">
                            {{ $exhibition->organization_name ?? '' }}
                        </span>
                    </li>
                    <li>
                        <strong>Category:</strong>
                        <span data-key="category_name">
                            {{ $exhibition->category_name ?? '' }}
                        </span>
                    </li>
                    <li>
                        <strong>Registration Period:</strong>
                        <span data-key="registration_start_date">
                            {{ \Carbon\Carbon::parse($exhibition->registration_start_date ?? '')->format('d M Y') }}
                        </span>
                        <span class="mx-2">-</span>
                        <span data-key="registration_end_date">
                            {{ \Carbon\Carbon::parse($exhibition->registration_end_date ?? '')->format('d M Y') }}
                        </span>
                    </li>
                    
                    <li>
                        <strong>Maximum Exhibitors:</strong>
                        <span data-key="max_exhibitors">
                            {{ $exhibition->max_exhibitors ?? '' }}
                        </span>
                    </li>

                </ul>
            </div>

            <!-- Ticket Prices -->
            <div class=" bg-gray-100 p-4 rounded-lg">
                <h2 class="text-xl font-semibold text-gray-800 mb-3">Ticket Prices</h2>
                <ul class="list-disc pl-5 text-gray-600 space-y-2">
                    <li>
                        <strong>Exhibitor Entrance Fee:</strong>
                        Rs.<span data-key="vendor_entrance_fee">
                            {{ $exhibition->vendor_entrance_fee ?? '' }}/=
                        </span>
                    </li>
                    <li>
                        <strong>Adult:</strong>
                        Rs.<span data-key="regular_price">
                            {{ $exhibition->regular_price ?? '' }}/=
                        </span>
                    </li>
                    <li>
                        <strong>Student:</strong>
                        Rs.<span data-key="student_price">
                            {{ $exhibition->student_price ?? '' }}/=
                        </span>
                    </li>
                    <li>
                        <strong>Child:</strong>
                        Rs.<span data-key="child_price">
                            {{ $exhibition->child_price ?? '' }}/=
                        </span>
                    </li>
                </ul>
            </div>

            <!-- Contact Information -->
            <div class="bg-gray-100 p-4 rounded-lg">
                <h2 class="text-xl font-semibold text-gray-800 mb-3">Connect With Us</h2>
                <div class="contact-info">
                    <!-- Get contact count -->
                    <div class="pl-5 mb-3 contacts-container" id="contacts-container">
                        <!-- Contact 1 - Always shown -->
                        <div class="contact-item" data-index="1">
                            <i class="fa-solid fa-phone-volume text-blue-600 mr-1"></i>
                            <span data-key="telephone1"></span>
                            (<span data-key="name1"></span>)
                            <i class="fa-solid fa-envelope text-blue-600 ml-3 mr-1"></i>
                            <span data-key="email1"></span>
                        </div>
                    </div>
                </div>

                <!-- social media links -->
                <div class="pl-5 text-gray-600">
                    @if(isset($exhibition->social_media_links) ?? '')
                    @foreach(json_decode($exhibition->social_media_links, true) as $platform => $url)
                    <a href="{{ $url }}" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-{{ $platform }} text-blue-600 mr-3"></i>
                    </a>
                    @endforeach
                    @endif
                </div>
            </div>

            <!-- Buttons Section -->
            <div class="flex space-x-4 mt-6">
            @if(isset($exhibition->id))
            <a href="{{ route('exhibition.vendor.register', ['id' => $exhibition->id]) }}" class="apply-button">
                Register as Vendor
            </a>
            @else
            <a href="#" class="apply-button disabled" aria-disabled="true">
                Register as Vendor
            </a>
            @endif
                <a href="http://example.com/book" target="_blank" rel="noopener noreferrer" class="apply-button">
                    Book Tickets
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function updateContacts(data) {
            const container = document.getElementById('contacts-container');
            container.innerHTML = ''; // Clear existing contacts

            // Get the number of contacts
            const contactCount = parseInt(data['contact-count'] || 1);

            // Create elements for each contact
            for (let i = 1; i <= contactCount; i++) {
                if (data[`telephone${i}`] || data[`email${i}`]) {
                    const contactDiv = document.createElement('div');
                    contactDiv.className = 'contact-item mb-2';

                    // Only add phone info if telephone exists
                    if (data[`telephone${i}`]) {
                        contactDiv.innerHTML += `
                        <i class="fa-solid fa-phone-volume text-blue-600 mr-1"></i>
                        <span>${data[`telephone${i}`] || ''}</span>
                        ${data[`name${i}`] ? `(<span>${data[`name${i}`]}</span>)` : ''}
                    `;
                    }

                    // Only add email if it exists
                    if (data[`email${i}`]) {
                        // Add spacing if phone info exists
                        if (data[`telephone${i}`]) {
                            contactDiv.innerHTML += '<span class="mx-2">|</span>';
                        }
                        contactDiv.innerHTML += `
                        <i class="fa-solid fa-envelope text-blue-600 mr-1"></i>
                        <span>${data[`email${i}`] || ''}</span>
                    `;
                    }

                    container.appendChild(contactDiv);
                }
            }
        }

        // Function to format the display
        function updateLayoutDisplay(data) {
            // Update other layout elements
            Object.keys(data).forEach(key => {
                const elements = document.querySelectorAll(`[data-key="${key}"]`);
                elements.forEach(element => {
                    if (element) {
                        // Special handling for telephone numbers
                        if (key.startsWith('telephone')) {
                            const index = key.replace('telephone', '');
                            const name = data[`name${index}`];
                            element.textContent = data[key];
                            // Add name if available
                            if (name) {
                                const nameSpan = document.createElement('span');
                                nameSpan.textContent = ` (${name})`;
                                element.parentNode.insertBefore(nameSpan, element.nextSibling);
                            }
                        } else {
                            element.textContent = data[key] || '';
                        }
                    }
                });
            });

            // Update contacts display
            updateContacts(data);
        }

        // Listen for form data updates
        window.addEventListener('message', function(event) {
            if (event.data.type === 'formData') {
                updateLayoutDisplay(event.data.formData);
            }
        });
    });
</script>

<style>
    .contact-item {
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .contact-item:last-child {
        margin-bottom: 0;
    }

    .contact-item i {
        display: inline-flex;
        align-items: center;
    }

    .contact-item span {
        display: inline-block;
    }

    .mx-2 {
        margin-left: 0.5rem;
        margin-right: 0.5rem;
    }
</style>

@if (isset($exhibition))
@endsection
@endif