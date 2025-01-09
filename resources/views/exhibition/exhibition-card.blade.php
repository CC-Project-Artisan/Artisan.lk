@if (isset($exhibition->status) && $exhibition->status == 'approved')
<div class="card mb-1 my-5">
    <a href="{{ route('exhibition.show', $exhibition->id) }}">
        <div class="image-container">
            @if($exhibition->exhibitionBanner)
            @php
            $banners = json_decode($exhibition->exhibitionBanner, true);
            $firstBanner = $banners[0] ?? null;
            @endphp
            @if($firstBanner)
            <img src="{{ asset('images/' . $firstBanner) }}"
                alt="{{ $exhibition->exhibition_name }}"
                class=" object-cover w-full h-full">
            @else
            <img src="{{ asset('images/default-banner.jpg') }}"
                alt="Default Exhibition Banner"
                class="savedimg object-cover w-full h-full">
            @endif
            @else
            <img src="{{ asset('images/default-banner.jpg') }}"
                alt="Default Exhibition Banner"
                class="savedimg object-cover w-full h-full">
            @endif
            <!-- <div class="icon-container">
            <i class="fas fa-heart"></i>
        </div> -->
        </div>
        <div class="card-body">
            <h5 class="exhibition-card-title">{{ $exhibition->exhibition_name }}</h5>
            <p class="card-text text-justify">{{ \Illuminate\Support\Str::limit($exhibition->exhibition_description, 200) }}</p>
            <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
            <div class="exhibition-card-details">
                <span class="exhibition-card-category">Category: {{ $exhibition->category_name }}</span>
                <span class="exhibition-card-location">Location: {{ $exhibition->category_name }}</span>
                <span class="exhibition-card-location">Date: {{ \Carbon\Carbon::parse($exhibition->exhibition_date)->format('d M Y') }}</span>
                <span class="exhibition-card-location">Time: {{ \Carbon\Carbon::parse($exhibition->start_time)->format('h:i A') }}</span>
            </div>
        </div>
    </a>
</div>
@endif