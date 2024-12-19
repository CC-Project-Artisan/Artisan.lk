@if(isset($notification->data['message']) && $notification->data['message'] === 'New order received')
    <div class="notification-item p-4 mb-4 bg-white rounded-lg shadow">
        <div class="flex items-center">
            <div class="flex-1">
                <p class="font-semibold">{{ $notification->data['message'] }}</p>
                <p class="text-sm text-gray-600">
                    Order #{{ $notification->data['order_id'] }} - 
                    Amount: Rs. {{ number_format($notification->data['details']['order_amount'], 2) }}
                </p>
                <p class="text-sm text-gray-600">
                    Customer: {{ $notification->data['details']['customer_name'] }}
                </p>
                <div class="mt-2">
                    <a href="{{ $notification->data['details']['view_url'] }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        View Order
                    </a>
                </div>
            </div>
            <div class="text-sm text-gray-500">
                {{ $notification->created_at->diffForHumans() }}
            </div>
        </div>
    </div>
@endif