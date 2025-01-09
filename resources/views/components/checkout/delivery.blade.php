<div class="left-section">

    <!-- Delivery Details Form -->
    <!-- <form id="delivery-form" action="{{ route('delivery.process') }}" method="POST">
        @csrf
        <div class="contact-section">
            <h2>Contact</h2>
            <input type="email" name="email" placeholder="Email" class="input-ar" value="{{ old('email') }}" required>
            <label>
                <input type="checkbox" name="subscribe"> Email me with news and offers
            </label>
        </div>

        <div class="delivery-section">
            <h2>Delivery</h2>
            <div class="input-gro">
                <select name="country" class="input-sec" required>
                    <option value="">Country/Region</option>
                    <option value="Sri Lanka" {{ old('country') == 'Sri Lanka' ? 'selected' : '' }}>Sri Lanka</option>
                </select>
            </div>
            <div class="input-gro">
                <input type="text" name="first_name" placeholder="First name" class="input-sec" value="{{ old('first_name') }}">
                <input type="text" name="last_name" placeholder="Last name" class="input-sec" value="{{ old('last_name') }}" required>
            </div>
            <input type="text" name="address" placeholder="Address" class="input-ar" value="{{ old('address') }}" required>
            <input type="text" name="apartment" placeholder="Apartment, suite, etc. (optional)" class="input-ar" value="{{ old('apartment') }}">
            <div class="input-gro">
                <input type="text" name="city" placeholder="City" class="input-sec" value="{{ old('city') }}" required>
                <input type="text" name="postal_code" placeholder="Postal code (optional)" class="input-sec" value="{{ old('postal_code') }}">
            </div>
            <input type="tel" name="phone" placeholder="Phone" class="input-ar" value="{{ old('phone') }}" required>
            <label>
                <input type="checkbox" name="save_info"> Save this information for next time
            </label>
        </div>
        <button id="save-delivery-button" type="submit" class="btn btn-primary">Save Delivery Details</button>
    </form> -->

    <!-- Payment Form -->
    <!-- <form id="payment-form" action="{{ route('payment.process') }}" method="POST">
        @csrf
        <div class="contact-section">
            <h2>Contact</h2>
            <input type="email" name="email" placeholder="Email" class="input-ar" value="{{ old('email') }}" required>
            <label>
                <input type="checkbox" name="subscribe"> Email me with news and offers
            </label>
        </div>

        <div class="delivery-section">
            <h2>Delivery</h2>
            <div class="input-gro">
                <select name="country" class="input-sec" required>
                    <option value="">Country/Region</option>
                    <option value="Sri Lanka" {{ old('country') == 'Sri Lanka' ? 'selected' : '' }}>Sri Lanka</option>
                </select>
            </div>
            <div class="input-gro">
                <input type="text" name="first_name" placeholder="First name" class="input-sec" value="{{ old('first_name') }}">
                <input type="text" name="last_name" placeholder="Last name" class="input-sec" value="{{ old('last_name') }}" required>
            </div>
            <input type="text" name="address" placeholder="Address" class="input-ar" value="{{ old('address') }}" required>
            <input type="text" name="apartment" placeholder="Apartment, suite, etc. (optional)" class="input-ar" value="{{ old('apartment') }}">
            <div class="input-gro">
                <input type="text" name="city" placeholder="City" class="input-sec" value="{{ old('city') }}" required>
                <input type="text" name="postal_code" placeholder="Postal code (optional)" class="input-sec" value="{{ old('postal_code') }}">
            </div>
            <input type="tel" name="phone" placeholder="Phone" class="input-ar" value="{{ old('phone') }}" required>
            <label>
                <input type="checkbox" name="save_info"> Save this information for next time
            </label>
        </div>

        
        <input type="hidden" name="subtotal" id="subtotal" value="{{ $subtotal }}">
        <input type="hidden" name="cartItems" id="cartItems" value="{{ json_encode($cartItems) }}">
        <div class="payment-section">
            <h2>Payment Method</h2>
            <div id="card-element" class="input-ar">
            </div>
            <div id="card-errors" role="alert" style="color: red;"></div>
        </div>
        <button id="submit-button" type="submit" class="btn btn-primary">Pay</button>
    </form> -->

    <div class="left-section" id="delivery-form">
        <!-- Delivery Details Form -->
        @livewire('checkout-form', ['subtotal' => $subtotal, 'cartItems' => $cartItems])

        <!-- Payment Form -->
        <!-- <form id="payment-form" action="{{ route('payment.process') }}" method="POST">
            @csrf
            <div class="contact-section">
                <h2>Contact</h2>
                <input type="email" name="email" placeholder="Email" class="input-ar" value="{{ old('email') }}" required>
                <label>
                    <input type="checkbox" name="subscribe"> Email me with news and offers
                </label>
            </div>

            <div class="delivery-section">
                <h2>Delivery</h2>
                <div class="input-gro">
                    <select name="country" class="input-sec" required>
                        <option value="">Country/Region</option>
                        <option value="Sri Lanka" {{ old('country') == 'Sri Lanka' ? 'selected' : '' }}>Sri Lanka</option>
                    </select>
                </div>
                <div class="input-gro">
                    <input type="text" name="first_name" placeholder="First name" class="input-sec" value="{{ old('first_name') }}">
                    <input type="text" name="last_name" placeholder="Last name" class="input-sec" value="{{ old('last_name') }}" required>
                </div>
                <input type="text" name="address" placeholder="Address" class="input-ar" value="{{ old('address') }}" required>
                <input type="text" name="apartment" placeholder="Apartment, suite, etc. (optional)" class="input-ar" value="{{ old('apartment') }}">
                <div class="input-gro">
                    <input type="text" name="city" placeholder="City" class="input-sec" value="{{ old('city') }}" required>
                    <input type="text" name="postal_code" placeholder="Postal code (optional)" class="input-sec" value="{{ old('postal_code') }}">
                </div>
                <input type="tel" name="phone" placeholder="Phone" class="input-ar" value="{{ old('phone') }}" required>
                <label>
                    <input type="checkbox" name="save_info"> Save this information for next time
                </label>
            </div>

            <input type="hidden" name="subtotal" id="subtotal" value="{{ $subtotal }}">
            <input type="hidden" name="cartItems" id="cartItems" value="{{ json_encode($cartItems) }}">
            <div class="payment-section">
                <h2>Payment Method</h2>
                <div id="card-element" class="input-ar">
                </div>
                <div id="card-errors" role="alert" style="color: red;"></div>
            </div>
            <button id="submit-button" type="submit" class="btn btn-primary">Pay</button>
        </form> -->
    </div>

</div>