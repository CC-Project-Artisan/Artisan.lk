<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderItem;

class PastOrder extends Component
{
    public Order $order;
    public OrderItem $orderItem;

    public function mount(Order $order, OrderItem $orderItem)
    {
        $this->order = $order;
        $this->orderItem = $orderItem;
    }

    public function render()
    {
        return view('livewire.user.past-order', [
            'order' => $this->order,
            'orderItem' => $this->orderItem,
            'product' => $this->orderItem->product
        ]);
    }
}