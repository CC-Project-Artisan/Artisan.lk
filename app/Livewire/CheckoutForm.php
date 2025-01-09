<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Log;

class CheckoutForm extends Component
{
    public $email;
    public $country;
    public $first_name;
    public $last_name;
    public $address;
    public $apartment;
    public $city;
    public $postal_code;
    public $phone;
    public $save_info = false;
    public $subtotal;
    public $cartItems;
    public $clientSecret;

    public function mount($subtotal, $cartItems)
    {
        $this->subtotal = $subtotal;
        $this->cartItems = $cartItems;

        if (Auth::check()) {
            $delivery = Delivery::where('user_id', Auth::id())->first();
            if ($delivery) {
                $this->email = $delivery->email;
                $this->country = $delivery->country;
                $this->first_name = $delivery->first_name;
                $this->last_name = $delivery->last_name;
                $this->address = $delivery->address;
                $this->apartment = $delivery->apartment;
                $this->city = $delivery->city;
                $this->postal_code = $delivery->postal_code;
                $this->phone = $delivery->phone;
            }
        }
    }

    public function processPayment()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // $paymentIntent = PaymentIntent::create([
            //     'amount' => $this->subtotal * 100, // Convert to cents
            //     'currency' => 'lkr',
            //     'automatic_payment_methods' => ['enabled' => true],
            // ]);
            $paymentIntent = PaymentIntent::create([
                'amount' => $this->subtotal * 100, // Convert to cents
                'currency' => 'lkr',
                'automatic_payment_methods' => [
                    'enabled' => true,
                    'allow_redirects' => 'never'
                ],
                'return_url' => route('pages.shop'), // Add return_url
                'confirm' => true,

            ]);

            $this->clientSecret = $paymentIntent->client_secret;

            // Save the order
            $order = Order::create([
                'user_id' => Auth::id(),
                'email' => $this->email,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'address' => $this->address,
                'city' => $this->city,
                'phone' => $this->phone,
                'total' => $this->subtotal,
                'stripe_payment_id' => $paymentIntent->id,
                'status' => 'incomplete',
            ]);

            // Save order items
            foreach ($this->cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            // Save delivery details if checkbox is checked
            if ($this->save_info) {
                Delivery::updateOrCreate(
                    ['user_id' => Auth::id()],
                    [
                        'email' => $this->email,
                        'country' => $this->country,
                        'first_name' => $this->first_name,
                        'last_name' => $this->last_name,
                        'address' => $this->address,
                        'apartment' => $this->apartment,
                        'city' => $this->city,
                        'postal_code' => $this->postal_code,
                        'phone' => $this->phone,
                    ]
                );
            }

            // Confirm the payment
            $paymentIntent->confirm();

            // Update order status based on payment result
            if ($paymentIntent->status == 'succeeded') {
                $order->update(['status' => 'succeeded']);
            } else {
                $order->update(['status' => 'incomplete']);
            }

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

    public function render()
    {
        return view('livewire.checkout-form');
    }
}
