@extends('layouts.frontend')
@section('pages')
    <section class="container mt-3 w-[70%]">
        <div class="row bg-white p-6 rounded shadow">
            <h1 class="text-4xl text-center my-5">Order Details</h1>

            <div class="order-details-content md:px-24 pb-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-5 gap-x-10 mt-3">
                    <div class="order-detail">
                        <label class="order-detail-label">Order ID:</label>
                        <span class="order-detail-value">{{ $order->id }}</span>
                    </div>
                    <div class="order-detail">
                        <label class="order-detail-label">Order Placed At:</label>
                        <span class="order-detail-value">{{ $order->created_at->format('Y-m-d') }}</span>
                    </div>
                    @foreach ($order->orderItems as $orderItem)
                        <div class="order-detail">
                            <label class="order-detail-label">Order Quantity:</label>
                            <span class="order-detail-value">{{ $orderItem->quantity }}</span>
                        </div>
                    @endforeach
                    <div class="order-detail">
                        <label class="order-detail-label">Order Amount:</label>
                        <span class="order-detail-value">Rs. {{ number_format($order->total, 2) }}/=</span>
                    </div>
                    <div class="order-detail">
                        <label class="order-detail-label">Payment Status:</label>
                        <span class="order-detail-value">{{ ucfirst($order->status) }}</span>
                    </div>
                    <div class="order-detail">
                        <label class="order-detail-label">Payment ID:</label>
                        <span class="order-detail-value">{{ $order->stripe_payment_id }}</span>
                    </div>
                </div>
            </div>

            <!-- update order status -->
            <div class="order-details-content md:px-24 pb-5">
                <h1 class="text-customBrown font-semibold tracking-wide mt-2">Update Order Status</h1>
                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="order_status" class="form-select mt-3" id="order_status">
                        <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pendding</option>
                        <option value="accepted" {{ $order->order_status == 'accepted' ? 'selected' : '' }}>Accepted
                        </option>
                        <option value="rejected" {{ $order->order_status == 'rejected' ? 'selected' : '' }}>Rejected
                        </option>
                        <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing
                        </option>
                        <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Delivered
                        </option>
                    </select>

                    @if (session('success'))
                        <div class="alert alert-success mt-2" id="success-message">
                            {{ session('success') }}
                            <button onclick="closeSuccessMessage()" class="absolute top-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6 text-green-500" role="button"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <title>Close</title>
                                    <path
                                        d="M14.348 5.652a.5.5 0 10-.707-.707L10 8.586 6.36 4.945a.5.5 0 10-.707.708L9.293 10l-4.647 4.648a.5.5 0 00.707.708L10 11.414l3.64 3.64a.5.5 0 00.707-.707L10.707 10l4.641-4.648z" />
                                </svg>
                            </button>
                        </div>
                    @endif

                    @if ($order->order_status == 'shipped' ? 'selected' : '')
                        <div id="courier-details" style="display: none;">
                            <div class="mt-3">
                                <label for="courier_name" class="star">Courier Name</label>
                                <x-compo.input type="text" id="courier_name" name="courier_name"
                                    placeholder="Enter Courier Name"
                                    value="{{ $order->courierDetail->courier_name ?? '' }}" required />
                                @error('courier_name')
                                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="courier_contact_number" class="star">Courier Contact Number</label>
                                <x-compo.input type="text" id="courier_contact_number" name="courier_contact_number"
                                    placeholder="Enter Courier Contact Number"
                                    value="{{ $order->courierDetail->courier_contact_number ?? '' }}" required />
                                @error('courier_contact_number')
                                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="tracking_number" class="star">Courier Tracking Number</label>
                                <x-compo.input type="text" id="tracking_number" name="tracking_number"
                                    placeholder="Enter Tracking Number"
                                    value="{{ $order->courierDetail->tracking_number ?? '' }}" required />
                                @error('tracking_number')
                                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="delivery_date" class="star">Delivery Date</label>
                                <x-compo.input type="date" id="delivery_date" name="delivery_date"
                                    placeholder="Enter Delivery Date" min="{{ date('Y-m-d') }}"
                                    value="{{ $order->courierDetail->delivery_date ?? '' }}" required />
                                @error('delivery_date')
                                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endif

                    <button type="submit" class="apply-button">Submit</button>
                </form>
            </div>

            <div class="order-details-content md:px-24 pb-5">
                <h1 class="text-customBrown font-semibold tracking-wide mt-2">Product Details</h1>
                @foreach ($order->orderItems as $orderItem)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-5 gap-x-10 mt-3 ml-3">
                        <div class="order-detail">
                            <label class="order-detail-label">Product ID:</label>
                            <span class="order-detail-value">{{ $orderItem->product->id }}</span>
                        </div>
                        <div class="order-detail">
                            <label class="order-detail-label">Product Name:</label>
                            <span class="order-detail-value">{{ $orderItem->product->productName }}</span>
                        </div>
                        <div class="order-detail">
                            <label class="order-detail-label">Product Category:</label>
                            <span class="order-detail-value">{{ $orderItem->product->category->name }}</span>
                        </div>
                        <div class="order-detail">
                            <label class="order-detail-label">Product Price:</label>
                            <span class="order-detail-value">Rs.
                                {{ number_format($orderItem->product->productPrice, 2) }}/=</span>
                        </div>
                        <div class="order-detail">
                            <label class="order-detail-label">Dimensions:</label>
                            <span class="order-detail-value">{{ $orderItem->product->dimensions }}</span>
                        </div>
                        <div class="order-detail">
                            <label class="order-detail-label">Product Weight:</label>
                            <span class="order-detail-value">{{ $orderItem->product->weight }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="order-details-content md:px-24 pb-5">
                <h1 class="text-customBrown font-semibold tracking-wide mt-2">Customer Details</h1>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-5 gap-x-10 mt-3 ml-3">
                    <div class="order-detail">
                        <label class="order-detail-label">Customer Name:</label>
                        <span class="order-detail-value">{{ $order->first_name }} {{ $order->last_name }}</span>
                    </div>
                    <div class="order-detail">
                        <label class="order-detail-label">Email:</label>
                        <span class="order-detail-value">{{ $order->email }}</span>
                    </div>
                    <div class="order-detail">
                        <label class="order-detail-label">Phone:</label>
                        <span class="order-detail-value">{{ $order->phone }}</span>
                    </div>
                    <div class="order-detail">
                        <label class="order-detail-label">Address:</label>
                        <span class="order-detail-value">{{ $order->address }}</span>
                    </div>
                    <div class="order-detail">
                        <label class="order-detail-label">City:</label>
                        <span class="order-detail-value">{{ $order->city }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const orderStatusSelect = document.getElementById('order_status');
            const courierDetailsDiv = document.getElementById('courier-details');

            orderStatusSelect.addEventListener('change', function() {
                if (this.value === 'shipped') {
                    courierDetailsDiv.style.display = 'block';
                } else {
                    courierDetailsDiv.style.display = 'none';
                }
            });

            // Trigger change event on page load to handle pre-selected value
            orderStatusSelect.dispatchEvent(new Event('change'));
        });



        function closeSuccessMessage() {
            document.getElementById('success-message').style.display = 'none';
        }
    </script>
@endsection
