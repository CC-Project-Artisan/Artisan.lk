<!-- @props(['productImage', 'productName', 'productPrice', 'categoryName', 'productId']) -->
<div class="product-item">
    <a href="{{ route('pages.product-display', ['id' => $productId]) }}" class="card">
        <div class="image-container">
            <img src="{{ asset('images/' . $productImage) }}" alt="{{ $productName }}">
            <!-- <div class="hover-content">Add to Cart</div> -->
        </div>
        <div class="product-details">
            <h3>{{ $productName }}</h3>
            <p class="category">{{ $categoryName }}</p>
            <p class="price">{{ $productPrice }}</p>
        </div>
    </a>
</div>