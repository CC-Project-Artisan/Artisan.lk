<div class="notification-item p-4 mb-4 bg-white rounded-lg shadow">
    <div class="flex justify-between items-start">
        @if(isset($notification->data['details']))
        <div class="notification-content">
            <h3 class="text-lg font-semibold text-gray-800">{{ $notification->data['message'] ?? 'No message' }}</h3>
            <div class="mt-2 text-sm text-gray-600">
                <p><span class="font-medium">Exhibition Name:</span> {{ $notification->data['details']['name'] ?? 'N/A' }}</p>
                <p><span class="font-medium">Status:</span> {{ $notification->data['details']['status'] ?? 'N/A' }}</p>
                <p><span class="font-medium">Date:</span> {{ $notification->data['details']['date_accepted'] ?? 'N/A' }}</p>
                <p><span class="font-medium">Payment Amount:</span> ${{ number_format($notification->data['details']['payment_amount'] ?? 0, 2) }}</p>
            </div>

            @if(isset($notification->data['details']['view_url']))
            <a href="{{ $notification->data['details']['view_url'] }}"
                class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                View Exhibition
            </a>
            @endif

            <!-- payment -->
            @else
            <p class="mt-2 text-sm text-gray-600">{{ $notification->data['exhibition_id'] ? 'Exhibition ID: ' . $notification->data['exhibition_id'] : 'No details available' }}</p>
        </div>
        @endif

        @if(isset($notification->data['message']) && $notification->data['message'] === 'New order received')
        <div class="notification-content">
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
        </div>
        @endif
    </div>
</div>

<style>
    .notification-item {
        border-left: 4px solid #a55e3f;
        transition: all 0.3s ease;
    }

    .notification-item:hover {
        transform: translateX(5px);
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const toggleButton = document.getElementById('toggle-payment-form');
        const paymentFormContainer = document.getElementById('payment-form-container');

        toggleButton.addEventListener('click', () => {
            if (paymentFormContainer.style.display === 'none') {
                paymentFormContainer.style.display = 'block';
                toggleButton.textContent = 'Hide Payment Form';
            } else {
                paymentFormContainer.style.display = 'none';
                toggleButton.textContent = 'Show Payment Form';
            }
        });
    });
</script>