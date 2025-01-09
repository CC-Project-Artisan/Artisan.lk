@extends('layouts.frontend')
@section('pages')

<div class="container mt-3 w-[70%]">
    <div class="row bg-white p-6 rounded shadow">
        <div class="col-md-12">
            <h1 class="text-4xl text-center my-4">Book Tickets</h1>
            <form action="" method="POST" id="ticket-booking-form" enctype="multipart/form-data">
                @csrf

                <!-- Exhibition Details -->
                <h1 class="text-xl mb-6">Exhibition Details</h1>
                <div class="ml-5">
                    <p><strong>Exhibition Name:</strong> </p>
                    <p><strong>Date:</strong> </p>
                    <p><strong>Location:</strong> </p>
                </div>

                <!-- Visitor Details -->
                <h1 class="text-xl mt-10 mb-6">Your Details</h1>
                <div class="ml-5">
                    <div class="form-group row">
                        <label for="visitor_name" class="col-sm-2 col-form-label">Name<span class="star"></span></label>
                        <div class="col-sm-10">
                            <x-compo.input type="text" id="visitor_name" name="visitor_name" placeholder="Enter your name" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="visitor_email" class="col-sm-2 col-form-label">Email<span class="star"></span></label>
                        <div class="col-sm-10">
                            <x-compo.input type="email" id="visitor_email" name="visitor_email" placeholder="Enter your email" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="visitor_phone" class="col-sm-2 col-form-label">Phone<span class="star"></span></label>
                        <div class="col-sm-10">
                            <x-compo.input type="text" id="visitor_phone" name="visitor_phone" placeholder="Enter your phone number" required />
                        </div>
                    </div>
                </div>

                <!-- Ticket Options with Prices -->
                <h1 class="text-xl mt-10 mb-6">Select Tickets</h1>
                <div class="ml-5">
                    <!-- Display ticket prices -->
                    <div class="ticket-price-info flex flex-col md:flex-row md:gap-24 mb-4">
                        <p><strong>Adult Ticket:</strong> USD</p>
                        <p><strong>Student Ticket:</strong> USD</p>
                        <p><strong>Child Ticket:</strong> USD</p>
                    </div>

                    <div class="form-group row">
                        <label for="adult_tickets" class="col-sm-2 col-form-label">Adult Tickets</label>
                        <div class="col-sm-10">
                            <x-compo.input type="number" id="adult_tickets" name="adult_tickets" min="0" placeholder="Enter quantity" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="student_tickets" class="col-sm-2 col-form-label">Student Tickets</label>
                        <div class="col-sm-10">
                            <x-compo.input type="number" id="student_tickets" name="student_tickets" min="0" placeholder="Enter quantity" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="child_tickets" class="col-sm-2 col-form-label">Child Tickets</label>
                        <div class="col-sm-10">
                            <x-compo.input type="number" id="child_tickets" name="child_tickets" min="0" placeholder="Enter quantity" />
                        </div>
                    </div>
                </div>

                <!-- Total Price -->
                <div class="mt-6">
                    <h2 class="text-lg">Total Price: <span id="total-price">0</span> USD</h2>
                </div>

                <!-- Payment Details -->
                <h1 class="text-xl mt-10 mb-6">Payment</h1>
                <div class="ml-5">
                    <div class="form-group row">
                        <label for="payment_method" class="col-sm-2 col-form-label">Payment Method</label>
                        <div class="col-sm-10">
                            <select id="payment_method" name="payment_method" class="form-control">
                                <option value="card">Credit/Debit Card</option>
                                <option value="paypal">PayPal</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <label for="card_details" class="col-sm-2 col-form-label">Card Details</label>
                        <div class="col-sm-10">
                            <x-compo.input type="text" id="card_details" name="card_details" placeholder="Enter your card details" />
                        </div>
                    </div>
                </div>

                <button type="submit" class="apply-button mt-5">Book Tickets</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('#adult_tickets, #student_tickets, #child_tickets').forEach(input => {
        input.addEventListener('input', calculateTotal);

        function calculateTotal() {
            // const adultPrice = {{ $exhibition->adult_price ?? 0 }};
            // const studentPrice = {{ $exhibition->student_price ?? 0 }};
            // const childPrice = {{ $exhibition->child_price ?? 0 }};

            const adults = parseInt(document.getElementById('adult_tickets').value || 0);
            const students = parseInt(document.getElementById('student_tickets').value || 0);
            const children = parseInt(document.getElementById('child_tickets').value || 0);

            const totalPrice = (adults * adultPrice) + (students * studentPrice) + (children * childPrice);
            document.getElementById('total-price').innerText = totalPrice.toFixed(2);
        }
    });
</script>

@endsection