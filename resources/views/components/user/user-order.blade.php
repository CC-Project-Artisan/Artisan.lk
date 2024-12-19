<section class="sub-listing-container">
    <div class="sub-listing-content">
        <div class="sub-listing-content-up">
            <div class="main-img-wrapper p-2 m-1">
                @if(isset($product->productImages) && !empty($product->productImages))
                @php
                $images = json_decode($product->productImages);
                @endphp
                @if(is_array($images) && count($images) > 0)
                <img src="{{ asset('images/' . $images[0]) }}" alt="{{ $product->productName }}" class="savedimg">
                @else
                <img src="{{ asset('images/default.png') }}" alt="Default Image" class="savedimg">
                @endif
                @else
                <img src="{{ asset('images/default.png') }}" alt="Default Image" class="savedimg">
                @endif
            </div>
            <div class="sub-listing-info">
                <lable class="sub-listing-title">{{ $product->productName }}</lable>
                <div class="sub-listing-features-container">
                    <div class="sub-listing-features">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-5 gap-x-10 mt-3">
                            <div class="sub-listing-feature">
                                <label class="sub-listing-feature-value">Product ID: {{ $product->id }}</label>
                            </div>
                            <div class="sub-listing-feature">
                                <label class="sub-listing-feature-value">Category: {{ $product->category->name }}</label>
                            </div>
                            <div class="sub-listing-feature">
                                <label class="sub-listing-feature-value">Quantity: {{ $orderItem->quantity }}</label>
                            </div>
                            <div class="sub-listing-feature">
                                <label class="sub-listing-feature-value">Weight: {{ $product->weight }}</label>
                            </div>
                            <div class="sub-listing-feature">
                                <label class="sub-listing-feature-value">Order Placed At: {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}</label>
                            </div>
                            <div class="sub-listing-feature">
                                <label class="sub-listing-feature-value">Dimensions: {{ $product->dimensions }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="listing-price-label">
                <label for="vahiclePrice" class="listing-price">Rs. {{ $order->total }}/=</label>
            </div>
        </div>
        <div class="mb-4 mx-6 flex flex-col items-center">
            <h1 class="text-customBrown font-semibold tracking-wide mb-4">Your Order Progress</h1>
            <x-compo.shipping-progess-bar :order="$order" />
            <div class="mt-4 p-4 bg-gray-50 rounded-lg w-full max-w-2xl">
                <h2 class="text-lg text-center font-semibold mb-3">Courier Details</h2>
                @if($order->courierDetails)
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @if ($order->order_status === 'shipped' || $order->order_status === 'delivered')
                    <p class="mb-2"><span>Tracking ID:</span> {{ $order->courierDetails->tracking_number ?? 'Not available' }}</p>
                    <p class="mb-2"><span>Shipping Company:</span> {{ $order->courierDetails->courier_name ?? 'Not available' }}</p>
                    <p class="mb-2"><span>Contact Number:</span> {{ $order->courierDetails->courier_contact_number ?? 'Not available' }}</p>
                    <p class="mb-2"><span>Delivery Date:</span> {{ \Carbon\Carbon::parse($order->courierDetails->delivery_date ? date('Y-m-d', strtotime($order->courierDetails->delivery_date)) : 'Not available')->format('d M Y') }}</p>
                    @endif
                </div>
                @else
                <p class="text-gray-500 text-center italic">Courier details will be available once the order is shipped.</p>
                @endif
            </div>
        </div>
        <div class="savedAd-buttons">
            <div class="border-r border-customGray">
                @foreach($order->orderItems as $item)
                <a href="{{ route('product.show', $item->product_id) }}" class="inline-block px-4 py-2 text-customBrown">
                    <button class="flex items-center">
                        <i class="fa-regular fa-eye mr-2"></i>
                        View Product
                    </button>
                </a>
                @endforeach
            </div>
            @if ($order->order_status === 'pending')
            <form action="{{ route('orders.delete', $order->id) }}" method="POST" class="remove-button savedAd-delete border-l">
                @csrf
                @method('DELETE')

                <button type="submit" class="flex items-center">
                    <i class="fa-regular fa-trash-can mr-1"></i> Cancel Order
                </button>

                <!-- sucess message -->
                @if (session()->has('message'))
                <div class="alert alert-success" id="alertMessage">
                    {{ session('message') }}
                </div>
                @endif
            </form>
            @endif
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const alert = document.getElementById('alertMessage');
        if (alert) {
            setTimeout(() => {
                alert.classList.add('fade-out');
                setTimeout(() => {
                    alert.remove();
                }, 500);
            }, 10000);
        }
    });
</script>