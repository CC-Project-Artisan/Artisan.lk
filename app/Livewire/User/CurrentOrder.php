<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\OrderCourierDetails;

class CurrentOrder extends Component
{
    public $order;
    public $orderItem;
    public $product;
    public $courierDetails;


    public function mount(Order $order, OrderItem $orderItem)
    {
        $this->order = $order;
        $this->orderItem = $orderItem;
        $this->product = Product::find($orderItem->product_id);
        $this->courierDetails = OrderCourierDetails::where('order_id', $order->id)->first();

    }

    public function render()
    {
        return view('livewire.user.current-order', [
            'order' => $this->order,
            'orderItem' => $this->orderItem,
            'product' => $this->product,
            'courierDetails' => $this->courierDetails
        ]);
    }
}
