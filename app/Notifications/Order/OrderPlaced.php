<?php

namespace App\Notifications\Order;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class OrderPlaced extends Notification
{
    use Queueable;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['database', 'mail', 'broadcast'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('You have received a new order!')
            ->line('Order ID: #' . $this->order->id)
            ->action('View Order', url('/vendor/orders/' . $this->order->id))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'message' => 'New order received',
            'details' => [
                'order_amount' => $this->order->total,
                'customer_name' => $this->order->first_name . ' ' . $this->order->last_name,
                // 'view_url' => url('/vendor/orders/' . $this->order->id)
            ]
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'order_id' => $this->order->id,
            'message' => 'New order received'
        ]);
    }
}
