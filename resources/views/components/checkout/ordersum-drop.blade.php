<div class="order-summary-mob">
    <div class="order-summary-header" onclick="toggleOrderSummary()">
        <span>Show order summary</span>
        <strong>LKR Rs. {{ number_format($subtotal + 100, 2) }}</strong>
    </div>
    <div class="hidden order-summary-dropdown">
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
                <span>Rs. {{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="tot-ro">
                <span>Shipping</span>
                <span>Flat Rate: Rs. 100.00</span>
            </div>
            <div class="tot-ro tot">
                <strong>Total</strong>
                <strong>LKR Rs. {{ number_format($subtotal + 100, 2) }}</strong>
            </div>
        </div>
    </div>
</div>
<script>
    function toggleOrderSummary() {
        const dropdown = document.querySelector('.order-summary-dropdown');
        dropdown.classList.toggle('hidden');
    }
</script>
