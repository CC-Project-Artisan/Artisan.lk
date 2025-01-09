@extends('layouts.frontend')
@section('pages')
<div class="breadcrumb-bar">
    <div class="breadcrumb-title">
        PRODUCT LIST
    </div>
    <div class="breadcrumb-nav">
        <a href="{{ route('welcome') }}">Home</a> &gt; <a href="{{ route('pages.shop') }}">Product List</a>
    </div>
</div>
<br>
<div class="main-content">
    
    <main class="grid w-3/4 grid-cols-1 gap-0 pl-8 border-gray-300 sm:grid-cols-2 md:grid-cols-3">

        @foreach($products as $product)
            <x-product-list 
                :productImage="json_decode($product->productImages, true)[0]"
                :productName="$product->productName"
                :productPrice="'Rs. ' . number_format($product->productPrice)"
                :categoryName="$product->category->name "
                :productId="$product->id"
            />
        @endforeach

    </main>

    <aside class="sidebar">
        <div class="filter-section">
            <h3 class="section-title">Filter</h3>

            <div class="price-range-container">
                <input type="range" id="minPriceRange" min="0" max="15000" value="0" class="price-range">
                <input type="range" id="maxPriceRange" min="0" max="15000" value="15000" class="price-range">
            </div>

            <div class="price-apply-container">
                <span id="priceDisplay" class="price-display">Rs.0.00 — Rs.15000.00</span>
                <button class="reset-button" onclick="resetPriceRange()">Reset</button>
            </div>
            <button class="apply-button">Apply</button>
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