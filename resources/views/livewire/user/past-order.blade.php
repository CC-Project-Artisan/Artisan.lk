<div>
    <section class="savedAd-listing-container shadow">
        <div class="sub-listing-content">
            <div class="savedAd-listing-wrapper">
                <div class="savedAd-img">
                    @if(isset($product->productImages))
                        @php
                            $images = json_decode($product->productImages);
                        @endphp
                        @if(is_array($images) && count($images) > 0)
                            <img src="{{ asset('images/' . $images[0]) }}" alt="{{ $product->productName }}" class="savedimg">
                        @else
                            <img src="{{ asset('images/default.png') }}" alt="Default" class="savedimg">
                        @endif
                    @endif
                </div>
                <div class="savedAd-details">
                    <div class="savedAd-title">
                        <h3>{{ $product->productName }}</h3>
                    </div>
                    <div class="savedAd-price">
                        <label>Rs. {{ number_format($order->total, 2) }}</label>
                    </div>
                    <div class="savedAd-location">
                        <p>Status: {{ ucfirst($order->order_status) }}</p>
                    </div>
                    <div class="savedAd-location">
                        <p>Delivered At: {{ $order->updated_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
            <div class="savedAd-buttons">
                <div class="border-r border-customGray pb-2">
                    <a href="{{ route('pages.product-info', $product->id) }}" class="savedAd-view">
                        <i class="fa-regular fa-eye mr-1"></i>View Product
                    </a>
                </div>
                @if($order->order_status === 'delivered')
                    <div class="border-l border-customGray pb-2">
                        <span class="text-green-600 px-4 py-2">
                            <i class="fas fa-check-circle mr-1"></i>Delivered
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>