<div>
    <div class="ud-dashboard-page bg-white dark:bg-gray-800 p-6 rounded shadow">
        <h2 class="text-5xl font-bold text-customBlue dark:text-gray-100 mb-3">
            Your Orders
        </h2>

        <span class="text-base text-gray-600 dark:text-gray-400">
            View and manage all your related orders efficiently. You can add, edit, or delete orders to keep your order history organized.
        </span>

        <div class="flex justify-center mt-3">
            <button wire:click="setActiveTab('current')" 
                class="px-4 py-2 {{ $activeTab === 'current' ? 'border-b-2 border-customBrown text-customBrown' : 'text-gray-500' }}">
                Current Orders
            </button>
            <button wire:click="setActiveTab('past')"
                class="px-4 py-2 {{ $activeTab === 'past' ? 'border-b-2 border-customBrown text-customBrown' : 'text-gray-500' }}">
                Past Orders
            </button>
        </div>
    </div>

    <div class="mt-4">
        @if ($activeTab === 'current')
            @foreach ($currentOrders as $order)
                @foreach ($order->orderItems as $orderItem)
                    @livewire(
                        'user.current-order',
                        [
                            'order' => $order,
                            'orderItem' => $orderItem,
                        ],
                        key('current-' . $order->id . '-' . $orderItem->id)
                    )
                @endforeach
            @endforeach
        @else
            @foreach ($pastOrders as $order)
                @foreach ($order->orderItems as $orderItem)
                    @livewire(
                        'user.past-order',
                        [
                            'order' => $order,
                            'orderItem' => $orderItem,
                        ],
                        key('past-' . $order->id . '-' . $orderItem->id)
                    )
                @endforeach
            @endforeach
        @endif
    </div>
</div>
