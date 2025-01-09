<div class="cart-totals centered">
    <h2>Cart Totals</h2>
    <div class="totals-row">
        <h3>Subtotal</h3>
        <span>Rs.{{ number_format($subtotal, 2) }}</span>
    </div>

    <div class="shipping">
        <h3>Shipping</h3>
        <span class="shipping-options">
            <label><input type="radio" name="shipping" checked> Flat rate (Rs.100)</label>
            <label><input type="radio" name="shipping"> Free shipping</label>
            <label><input type="radio" name="shipping"> Local pickup</label>
        </span>
    </div>

    <div class="totals-row">
        <h3>Total</h3>
        <span>Rs.{{ number_format($subtotal + 100, 2) }}</span>
    </div>
    <a href="{{ route('pages.checkout') }}" class="checkout-btn">Proceed to Checkout</a>

</div>


