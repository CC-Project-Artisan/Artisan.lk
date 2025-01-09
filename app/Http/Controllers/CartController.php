<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\GuestCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Delivery;

class CartController extends Controller
{
    
   // Display cart items
   public function index()
   {
       $cartItems = [];

       if (Auth::check()) {
           
           $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
       } else {
           
           $guestToken = session('guest_token');
           if ($guestToken) {
               $cartItems = GuestCart::with('product')->where('guest_token', $guestToken)->get();
           }
       }

       return view('pages.cart', compact('cartItems'));
   }

   
   public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);//

        
        $quantity = (int) $request->input('quantity', 1);//
        $calculatedPrice = $quantity * $product -> productPrice;

        if (Auth::check()) {
            
            $cartItem = Cart::where('product_id', $product->id)
                ->where('user_id', Auth::id())
                ->first();

            if ($cartItem) {
                
                $cartItem->quantity += $quantity;//
                $cartItem->price = $cartItem->quantity * $product->productPrice;
                $cartItem->save();
            } else {
                
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $calculatedPrice,
                    'image' => json_decode($product->productImages)[0] ?? 'placeholder.png',
                ]);
            }
        } else {
            
            $guestToken = $this->getGuestToken(); 

            $cartItem = GuestCart::where('product_id', $product->id)
                ->where('guest_token', $guestToken)
                ->first();

            if ($cartItem) {
                
                $cartItem->quantity += $quantity;
                
                $cartItem->save();
            } else {
                
                GuestCart::create([
                    'guest_token' => $guestToken,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->productPrice,
                    'image' => json_decode($product->productImages)[0] ?? 'placeholder.png',
                ]);
            }
        }

        return redirect()->route('pages.cart')->with('success', 'Product added to cart!');
    }

   
    public function updateAll(Request $request)
    {
        Log::info('updateAll called', ['request' => $request->all()]);
        $validated = $request->validate([
            'cart' => 'required|array',
            'cart.*.id' => 'required|exists:products,id',
            'cart.*.quantity' => 'required|integer|min:1|max:100',
        ]);
    
        foreach ($validated['cart'] as $item) {
            $productId = $item['id'];
            $quantity = $item['quantity'];
    
            if (Auth::check()) {
                Cart::where('product_id', $productId)
                    ->where('user_id', Auth::id())
                    ->update(['quantity' => $quantity]);
            } else {
                $cart = session()->get('cart', []);
                if (isset($cart[$productId])) {
                    $cart[$productId]['quantity'] = $quantity;
                    session()->put('cart', $cart);
                }
            }
        }
    
        return redirect()->route('pages.cart')->with('success', 'Cart updated successfully!');
    }
    
    

   // Remove from cart
   public function removeFromCart($productId)
    {
        Log::info('removeFromCart called', ['product_id' => $productId]);
        if (Auth::check()) {
            Cart::where('product_id', $productId)
                ->where('user_id', Auth::id())
                ->delete();
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$productId])) {
                unset($cart[$productId]);
                session()->put('cart', $cart);
            }
        }
    
       
        return redirect()->route('pages.cart')->with('success', 'Product removed from cart!');
    }

   


   private function getGuestToken()
   {
       if (!session()->has('guest_token')) {
           $guestToken = uniqid('guest_', true);
           session(['guest_token' => $guestToken]);
           cookie()->queue(cookie('guest_token', $guestToken, 60 * 24 * 30)); 
       }

       return session('guest_token');
   }

  

}