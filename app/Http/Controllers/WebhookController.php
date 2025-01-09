<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Event;
use App\Models\Order;

class WebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Retrieve the webhook payload
        $payload = @file_get_contents('php://input');
        $sigHeader = $request->header('Stripe-Signature');
        $webhookSecret = env('STRIPE_WEBHOOK_SECRET'); // Set this in your .env file

        try {
            // Verify the signature and construct the event
            $event = Event::constructFrom(json_decode($payload, true));

            // Handle the event type
            switch ($event->type) {
                case 'payment_intent.succeeded':
                    $paymentIntent = $event->data->object;
                    Log::info('PaymentIntent succeeded:', ['payment_intent' => $paymentIntent]);

                    // Save the order in the database
                    $this->createOrder($paymentIntent);
                    break;

                case 'payment_intent.payment_failed':
                    $paymentIntent = $event->data->object;
                    Log::error('PaymentIntent failed:', ['payment_intent' => $paymentIntent]);
                    break;

                default:
                    Log::info('Unhandled event type:', ['type' => $event->type]);
            }

            return response()->json(['status' => 'success'], 200);
        } catch (\Exception $e) {
            Log::error('Webhook handling error:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Webhook failed'], 400);
        }
    }

    private function createOrder($paymentIntent)
    {
        try {
            // Extract necessary data from PaymentIntent
            $metadata = $paymentIntent->metadata;

            // Save the order and order items (you can adjust this logic)
            $order = Order::create([
                'user_id' => $metadata->user_id,
                'total' => $metadata->total,
                'stripe_payment_id' => $paymentIntent->id,
                'status' => 'completed',
            ]);

            // Save order items if necessary
            // Use metadata or another method to get cart items and save them here

            Log::info('Order created successfully:', ['order_id' => $order->id]);
        } catch (\Exception $e) {
            Log::error('Error creating order from webhook:', ['error' => $e->getMessage()]);
        }
    }
}
