<!-- @if ($products->isEmpty())
    <p>No products found</p>
@else
    <div class="product-grid">
        @foreach ($products as $product)
            @php
                // Decode the product images JSON and get the first image
                $decodedImages = json_decode($product->productImages, true);
                $firstImage = $decodedImages[0] ?? 'placeholder.jpg'; // Use a placeholder if no image is found
            @endphp
            <div class="product-item">
                <a href="{{ route('products.show', $product->id) }}">
                    <img src="/{{ $firstImage }}" alt="{{ $product->productName }}" />
                    <h4>{{ $product->productName }}</h4>
                    <p>{{ 'Rs. ' . number_format($product->productPrice) }}</p>
                    <p>{{ $product->category->name }}</p>
                </a>
            </div>
        @endforeach
    </div>
@endif -->
