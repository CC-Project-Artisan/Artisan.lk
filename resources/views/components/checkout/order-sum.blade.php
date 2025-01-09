@props(['cartItems', 'subtotal'])

<div class="order-summary">
    <h2>Order Summary</h2>
    <div class="order-items">
        @foreach ($cartItems as $cartItem)
            <div class="order-item">
                <img src="{{ asset('images/' . $cartItem->image) }}" alt="{{ $cartItem->product->productName }}">
                <div class="order-item-details">
                    <h3>{{ $cartItem->product->productName }}</h3>
                    <p>Qty: {{ $cartItem->quantity }}</p>
                </div>
                <span class="order-item-price">Rs. {{ number_format($cartItem->price * $cartItem->quantity, 2) }}</span>
            </div>
        @endforeach
    </div>
    <div class="tot">
        <div class="tot-ro">
            <span>Subtotal</span>
            <span>Rs. {{ $subtotal }}</span>
        </div>
        <div class="tot-ro">
            <span>Shipping</span>
            <span>Flat Rate: Rs. 100.00</span>
        </div>
        <div class="tot-ro tot">
            <strong>Total</strong>
            <strong>
                LKR Rs. {{ $subtotal + 100 }}
            </strong>
        </div>
    </div>
</div>



