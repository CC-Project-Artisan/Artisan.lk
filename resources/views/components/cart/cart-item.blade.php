<div class="cart-items centered">
    <table class="shop_table">
        <thead>
            <tr>
                <th class="product-remove"></th>
                <th class="product-thumbnail"></th>
                <th class="product-name">Product</th>
                <th class="product-pri">Price</th>
                <th class="product-quan">Quantity</th>
                <th class="product-subtotal">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cartItems as $cartItem)
                <tr class="cart-item">
                    <!-- Remove Button -->
                    <td class="product-remove">
                        <form action="{{ route('cart.remove', $cartItem->product_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="" onclick="this.disabled = true; this.form.submit();">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1-.708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                                </svg>
                            </button>
                        </form>
                    </td>

                    <!-- Product Thumbnail -->
                    <td class="product-thumbnail">
                        <img src="{{ asset('images/' . $cartItem->image) }}" alt="{{ $cartItem->product->productName }}">
                    </td>

                    <!-- Product Name -->
                    <td class="product-name">{{ $cartItem->product->productName }}</td>

                    <!-- Product Price -->
                    <td class="product-pri">Rs.{{ number_format($cartItem->price) }}</td>

                    <!-- Quantity and Update Button -->
                    <td class="product-quan">
                        <form action="{{ route('cart.updateAll') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="cart[{{ $cartItem->product_id }}][id]" value="{{ $cartItem->product_id }}">
                            <input type="number" name="cart[{{ $cartItem->product_id }}][quantity]" value="{{ $cartItem->quantity }}" min="1">
                            <button type="submit" class="btn btn-primary update-cart-btn" onclick="this.disabled = true; this.form.submit();">
                                Update
                            </button>
                        </form>
                    </td>

                    <!-- Subtotal -->
                    <td class="product-subtotal">Rs.{{ number_format($cartItem->price * $cartItem->quantity) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No items in cart.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


   
        
