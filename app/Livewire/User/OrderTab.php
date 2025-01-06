<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderTab extends Component
{
    public $activeTab = 'current';
    
    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

        public function render()
    {
        $user = Auth::user();
        
        $currentOrders = Order::with(['orderItems.product'])
            ->where('user_id', $user->id)
            ->whereIn('order_status', ['pending', 'processing', 'shipped'])
            ->get();
    
        $pastOrders = Order::with(['orderItems.product'])
            ->where('user_id', $user->id)
            ->where('order_status', 'delivered')
            ->get();
    
        return view('livewire.user.order-tab', [
            'currentOrders' => $currentOrders,
            'pastOrders' => $pastOrders
        ]);
    }
}
