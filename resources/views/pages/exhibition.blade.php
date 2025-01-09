@extends('layouts.frontend')
@section('pages')
<div class="breadcrumb-bar">
    <div class="breadcrumb-title">
        EXHIBITIONS
    </div>
    <div class="breadcrumb-nav">
        <a href="{{ route('welcome') }}">Home</a> &gt; <a href="{{ route('pages.exhibition') }}">Exhibitions</a>
    </div>
</div>
<br>
<div class="main-content">

    <main class="px-[50px] py-0 grid grid-cols-1 border-gray-300 sm:grid-cols-2 md:grid-cols-2">
        @foreach ($exhibitions as $exhibition)
        @if($exhibition->status === 'approved' && $exhibition->isActive)
        @include('exhibition.exhibition-card')
        @endif
        @endforeach
    </main>

    <aside class="sidebar">
        <div class="ud-advert-keyword-wrapper flex-[50%] mb-4">
            <div class="flex">
                <x-compo.input value="" type="text" placeholder="Exhibition name" class="ud-advert-keyword-input" />
                <a href="#"><i class="ud-advert-keyword-search fa-solid fa-magnifying-glass"></i></a>
            </div>
        </div>
        <!-- <div class="ud-advert-keyword-wrapper flex-[50%] mb-5">
            <p class="mt-2 mb-2">Keyword</p>
            <div class="flex">
                <x-compo.input value="" type="text" placeholder="Location" class="ud-advert-keyword-input" />
                <a href="#"><i class="ud-advert-keyword-search fa-solid fa-magnifying-glass"></i></a>
            </div>
        </div> -->

        <div class="filter-section">
            <h3 class="section-title mb-3">Filter</h3>

            <x-compo.input value="" type="date" class="ud-advert-keyword-input" />

            <button class="apply-button mt-3">Apply</button>
        </div>

        <div class="categories-section">
            <h3 class="section-title">Categories</h3>
            <ul class="categories-list">
                <li><a href="#" class="shop-category-item">Mask (10)</a></li>
                <li><a href="#" class="shop-category-item">Jewelry (6)</a></li>
                <li><a href="#" class="shop-category-item">Batik & Silk (11)</a></li>
                <li><a href="#" class="shop-category-item">Paintings (12)</a></li>
                <li><a href="#" class="shop-category-item">Pottery (30)</a></li>
            </ul>
        </div>
    </aside>
</div>


<div class="pagination-container">
    <div class="pagination">
        <a href="#" class="prev">&lsaquo;</a>
        <a href="#" class="active">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">4</a>
        <a href="#">5</a>
        <a href="#">6</a>
        <a href="#">7</a>
        <a href="#" class="next">&rsaquo;</a>
    </div>
</div>

<script>
    const minPriceRange = document.getElementById('minPriceRange');
    const maxPriceRange = document.getElementById('maxPriceRange');
    const priceDisplay = document.getElementById('priceDisplay');

    function updatePriceDisplay() {
        let minPrice = parseInt(minPriceRange.value);
        let maxPrice = parseInt(maxPriceRange.value);

        if (minPrice > maxPrice) {
            minPriceRange.value = maxPrice;
            minPrice = maxPrice;
        } else if (maxPrice < minPrice) {
            maxPriceRange.value = minPrice;
            maxPrice = minPrice;
        }

        priceDisplay.textContent = `Rs.${minPrice.toFixed(2)} — Rs.${maxPrice.toFixed(2)}`;
    }

    function resetPriceRange() {
        minPriceRange.value = 0;
        maxPriceRange.value = 15000;
        updatePriceDisplay();
    }

    // Event listeners for both range inputs
    minPriceRange.addEventListener('input', updatePriceDisplay);
    maxPriceRange.addEventListener('input', updatePriceDisplay);
</script>
@endsection