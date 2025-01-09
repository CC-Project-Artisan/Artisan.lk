<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\PaymentIntent;
use App\Models\Cart;
use App\Models\Delivery;
use App\Models\SavedDeliveryData;
use App\Notifications\Order\OrderPlaced;

class CheckoutController extends Controller
{
    // Display the checkout page with cart items and subtotal

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Checkout()
    {
        $cartItems = [];
        $subtotal = 0;

        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

            foreach ($cartItems as $item) {
                Log::info('Cart Item:', [
                    'quantity' => $item->quantity,
                    'price' => optional($item->product)->price,
                ]);
            }
            $subtotal = $cartItems->sum(function ($item) {
                if ($item->product) {
                    return $item->product->productPrice * $item->quantity;
                }
                return 0; // Skip items without a valid product
            });
        } else {
            $cart = session()->get('cart', []);
            foreach ($cart as $item) {
                $subtotal += $item['price'] * $item['quantity'];
                $cartItems[] = (object) $item;
            }
        }

        Log::info('Cart Items:', ['cartItems' => $cartItems->toArray()]);
        Log::info('Subtotal:', ['subtotal' => $subtotal]);

        return view('pages.checkout', compact('cartItems', 'subtotal'));
    }

    // Handle payment processing
    public function Payment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        Log::info('Payment request payload:', $request->all());

        // Retrieve subtotal from the request
        $subtotal = $request->input('subtotal', 0);

        // Ensure subtotal is a valid numeric value
        if (!is_numeric($subtotal)) {
            Log::error('Invalid subtotal provided:', ['subtotal' => $subtotal]);
            return response()->json([
                'success' => false,
                'message' => 'Invalid subtotal value.',
            ]);
        }

        if ($subtotal < 50) { // Minimum order amount
            return response()->json([
                'success' => false,
                'message' => 'Minimum order amount is $0.50.',
            ]);
        }

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $subtotal * 100, // Convert to cents
                'currency' => 'lkr',
                'automatic_payment_methods' => ['enabled' => true],
            ]);
            Log::info('PaymentIntent data:', [
                'amount' => $subtotal * 100,
                'currency' => 'lkr',
            ]);

            Log::info('Payment Intent Created:', ['client_secret' => $paymentIntent->client_secret]);

            // Save the order
            $order = Order::create([
                'user_id' => Auth::id(),
                'email' => $request->email,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'city' => $request->city,
                'phone' => $request->phone,
                'total' => $subtotal,
                'stripe_payment_id' => $paymentIntent->id,
                'status' => 'completed',
            ]);

            // Save order items
            $cartItems = json_decode($request->input('cartItems'), true);
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                // Get vendor from product and send notification
                    // $product = Product::find($item->product_id);
                    // if ($product && $product->vendor) {
                    //     $product->vendor->user->notify(new OrderPlaced($order));
                    // }
            }

            // Save order items and send notifications
            // $cartItems = json_decode($request->input('cartItems'), true);
            // foreach ($cartItems as $item) {
            //     OrderItem::create([
            //         'order_id' => $order->id,
            //         'product_id' => $item->product_id,
            //         'quantity' => $item->quantity,
            //         'price' => $item->price,
            //     ]);

            //     // Get vendor from product and send notification
            //     $product = Product::find($item->product_id);
            //     if ($product && $product->vendor) {
            //         $product->vendor->user->notify(new OrderPlaced($order));
            //     }
            // }

            return response()->json([
                'success' => true,
                'client_secret' => $paymentIntent->client_secret,
            ]);
        } catch (\Exception $e) {
            Log::error('Payment processing error:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Payment processing error. Please try again.',
            ]);
        }
    }

    //Save delivery details
    public function saveDeliveryDetails(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|email',
        //     'country' => 'required|string',
        //     'first_name' => 'nullable|string',
        //     'last_name' => 'required|string',
        //     'address' => 'required|string',
        //     'city' => 'required|string',
        //     'phone' => 'required|string',
        //     'postal_code' => 'nullable|string',
        //     'apartment' => 'nullable|string',
        // ]);

        // $delivery = Delivery::create([
        //     'user_id' => Auth::id(),
        //     'email' => $request->email,
        //     'country' => $request->country,
        //     'first_name' => $request->first_name,
        //     'last_name' => $request->last_name,
        //     'address' => $request->address,
        //     'city' => $request->city,
        //     'phone' => $request->phone,
        //     'postal_code' => $request->postal_code,
        //     'apartment' => $request->apartment,
        // ]);

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Delivery details saved successfully.',
        // ]);
        $request->validate([
            'email' => 'required|email',
            'country' => 'required|string',
            'first_name' => 'nullable|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'phone' => 'required|string',
            'postal_code' => 'nullable|string',
            'apartment' => 'nullable|string',
        ]);

        Delivery::updateOrCreate(
            ['user_id' => Auth::id()],
            $request->only('email', 'country', 'first_name', 'last_name', 'address', 'city', 'phone', 'postal_code', 'apartment')
        );

        return response()->json([
            'success' => true,
            'message' => 'Delivery details saved successfully.',
        ]);
    }

    // public function Payment(Request $request)
    // {
    //     Stripe::setApiKey(env('STRIPE_SECRET'));
    //     Log::info('Payment request payload:', $request->all());

    //     // Retrieve subtotal from the request
    //     $subtotal = $request->input('subtotal', 0);

    //     // Ensure subtotal is a valid numeric value
    //     if (!is_numeric($subtotal)) {
    //         Log::error('Invalid subtotal provided:', ['subtotal' => $subtotal]);
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Invalid subtotal value.',
    //         ]);
    //     }

    //     if ($subtotal < 50) { // Minimum order amount
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Minimum order amount is $0.50.',
    //         ]);
    //     }

    //     try {
    //         $paymentIntent = PaymentIntent::create([
    //             'amount' => $subtotal * 100, // Convert to cents
    //             'currency' => 'lkr',
    //             'automatic_payment_methods' => ['enabled' => true],
    //         ]);
    //         Log::info('PaymentIntent data:', [
    //             'amount' => $subtotal * 100,
    //             'currency' => 'lkr',
    //         ]);

    //         Log::info('Payment Intent Created:', ['client_secret' => $paymentIntent->client_secret]);

    //         // Save the order
    //         Orders::create([
    //             'user_id' => Auth::id(),
    //             'email' => $request->email,
    //             'first_name' => $request->first_name,
    //             'last_name' => $request->last_name,
    //             'address' => $request->address,
    //             'city' => $request->city,
    //             'phone' => $request->phone,
    //             'total' => $subtotal,
    //             'stripe_payment_id' => $paymentIntent->id,
    //             'status' => 'completed',
    //         ]);

    //         return response()->json([
    //             'success' => true,
    //             'client_secret' => $paymentIntent->client_secret,
    //         ]);

    //     } catch (\Exception $e) {
    //         Log::error('Payment processing error:', ['error' => $e->getMessage()]);
    //         return response()->json([
    //             'success' => false,
    //             'message' => $e->getMessage(),
    //         ]);
    //     }
    // }

    // Handle payment completion


    // public function handlePaymentComplete(Request $request)
    // {
    //     Stripe::setApiKey(env('STRIPE_SECRET'));

    //     $paymentIntentId = $request->query('payment_intent');
    //     $paymentStatus = $request->query('redirect_status');

    //     if ($paymentStatus === 'succeeded') {
    //         try {
    //             DB::beginTransaction(); // Start a database transaction

    //             $deliveryDetails = session('delivery_details');
    //             $cartItems = Auth::check()
    //                 ? Cart::where('user_id', Auth::id())->with('product')->get()
    //                 : session('cart', []);

    //             if (!$cartItems || count($cartItems) === 0) {
    //                 throw new \Exception('Cart is empty. Unable to process the order.');
    //             }

    //             if (!$deliveryDetails) {
    //                 throw new \Exception('Delivery details are missing. Unable to process the order.');
    //             }

    //             // Calculate subtotal
    //             $subtotal = $cartItems->sum(fn($item) => optional($item->product)->productPrice * $item->quantity);

    //             // Save the order
    //             $order = Orders::create([
    //                 'user_id' => Auth::id(),
    //                 'email' => $request->email,
    //                 'first_name' => $request->first_name,
    //                 'last_name' => $request->last_name,
    //                 'address' => $request->address,
    //                 'city' => $request->city,
    //                 'phone' => $request->phone,
    //                 'total' => $subtotal,
    //                 'stripe_payment_id' => $paymentIntentId,
    //                 'status' => 'completed',
    //             ]);

    //             // Save order items
    //             foreach ($cartItems as $item) {
    //                 if ($item->product) {
    //                     OrderItem::create([
    //                         'order_id' => $order->id,
    //                         'product_id' => $item->product->id,
    //                         'quantity' => $item->quantity,
    //                         'price' => $item->product->productPrice,
    //                     ]);
    //                 }
    //             }

    //             // Clear the cart and session data
    //             if (Auth::check()) {
    //                 Cart::where('user_id', Auth::id())->delete();
    //             } else {
    //                 session()->forget('cart');
    //             }

    //             session()->forget('delivery_details');

    //             DB::commit();

    //             return redirect()->route('payment.success')->with('success', 'Payment successful! Order placed.');
    //         } catch (\Exception $e) {
    //             DB::rollBack();
    //             Log::error('Order creation failed:', ['error' => $e->getMessage()]);
    //             return redirect()->route('pages.checkout')->withErrors('Order creation failed: ' . $e->getMessage());
    //         }
    //     }

    //     return redirect()->route('payment.failed')->withErrors('Payment failed. Please try again.');
    // }
}
