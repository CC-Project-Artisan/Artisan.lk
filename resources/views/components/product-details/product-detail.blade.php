@props(['product', 'productId', 'productName', 'productPrice', 'productImage'])
<div class="product-display-container">
    <div class="product-image-container">
        <img src="{{ asset('images/' . json_decode($product->productImages)[0]) }}" alt="{{ $product->productName }}">
    </div>

    <div class="product-details-container">
        <h2 class="product-title">{{ $product->productName }}</h2>
        <p class="product-price">Rs.{{ number_format($product->productPrice) }}</p>
        <p class="product-description">{{ $product->productDescription }}</p>

        <form action="{{ route('cart.add', $product->id) }}" method="POST">
            @csrf
            <div class="quantity-and-cart">
                <input type="number" name="quantity" min="1" max="10" value="1" class="product-quantity">
                <button type="submit" class="add-to-cart-btn">Add to Cart</button>
            </div>
        </form>
        <ul class="product-meta">
            <li><strong>SKU:</strong> {{ $product->id }}</li>
            <li><strong>Category:</strong> {{ $product->category->name }}</li>
            <li><strong>Tags:</strong> Crafts, Pottery, Homemade</li>
        </ul>
    </div>
</div>


