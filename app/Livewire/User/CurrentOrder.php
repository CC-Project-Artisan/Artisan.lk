<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class CurrentOrder extends Component
{
    public $order;
    public $orderItem;
    public $product;

    public function mount(Order $order, OrderItem $orderItem)
    {
        $this->order = $order;
        $this->orderItem = $orderItem;
        $this->product = Product::find($orderItem->product_id);
    }

    public function render()
    {
        return view('livewire.user.current-order', [
            'order' => $this->order,
            'orderItem' => $this->orderItem,
            'product' => $this->product
        ]);
    }
}
