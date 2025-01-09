<div>
    <div class="payment-section">
        <h2>Payment Method</h2>
        <div id="card-element" class="input-ar">
            <!-- Stripe card element will be mounted here -->
        </div>
        <div id="card-errors" role="alert" style="color: red;"></div>
    </div>
    <button id="submit-button" type="submit" class="apply-button">Pay</button>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    // Initialize Stripe
    document.addEventListener("DOMContentLoaded", () => {
        console.log("Initializing Stripe...");
        // Initialize Stripe
        const apperance = {};
        const options = {
            layout: 'accordion'
        }
        const stripe = Stripe("{{ config('services.stripe.key') }}");
        const elements = stripe.elements(apperance);
        const cardElement = elements.create('card', options);
        cardElement.mount('#card-element');

        const paymentFormBtn = document.getElementById('submit-button');
        console.log("Payment form btn:", paymentFormBtn);

        const form = document.getElementById('form-data');


        if (paymentFormBtn) {
            console.log("Payment form found!");
            paymentFormBtn.addEventListener('click', async (event) => {
                event.preventDefault();
                console.log("Starting payment process...");

                const formData = new FormData(form);
                try {
                    // Create PaymentIntent
                    const response = await fetch('/checkout/payment', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                    });

                    const data = await response.json();
                    console.log("PaymentIntent creation response:", data);

                    if (data.success) {
                        const clientSecret = data.client_secret;
                        console.log("Client Secret received:", clientSecret);

                        try {
                            // Confirm the payment
                            const {
                                paymentIntent,
                                error
                            } = await stripe.confirmCardPayment(clientSecret, {
                                payment_method: {
                                    card: cardElement,
                                },
                            });

                            if (error) {
                                console.error("Error confirming payment:", error);
                                alert("Payment Failed: " + error.message);
                            } else if (paymentIntent.status === "succeeded") {
                                console.log("Payment succeeded:", paymentIntent);
                                alert("Payment Successful!");
                                window.location.href = "{{ route('payment.success') }}"; // Redirect to success page
                            } else if (paymentIntent.status === "requires_action") {
                                console.log("Payment requires additional action (e.g., 3D Secure)");
                                const {
                                    error: authError
                                } = await stripe.handleCardAction(clientSecret);

                                if (authError) {
                                    console.error("3D Secure failed:", authError);
                                    alert("Authentication Failed: " + authError.message);
                                } else {
                                    alert("Authentication Successful! Please retry payment.");
                                }
                            } else {
                                console.error("Payment failed or is in an unknown state:", paymentIntent);
                                alert("Payment processing failed. Please try again.");
                            }
                        } catch (err) {
                            console.error("Error during Stripe confirmation:", err);
                            alert("An error occurred while confirming the payment.");
                        }
                    } else {
                        console.error("Error from server:", data.message);
                        alert("Payment Failed: " + data.message);
                    }
                } catch (err) {
                    console.error("Error initiating payment:", err);
                    alert("An error occurred during payment initialization. Please try again.");
                }
            });
        }

        // Save delivery details
            // const deliveryForm = document.getElementById('delivery-form');
            // if (deliveryForm) {
            //     deliveryForm.addEventListener('submit', async (event) => {
            //         event.preventDefault();

            //         const formData = new FormData(deliveryForm);

            //         try {
            //             const response = await fetch(deliveryForm.action, {
            //                 method: 'POST',
            //                 body: formData,
            //                 headers: {
            //                     'X-Requested-With': 'XMLHttpRequest'
            //                 },
            //             });

            //             const data = await response.json();
            //             console.log("Delivery form response:", data);

            //             if (data.success) {
            //                 alert("Delivery details saved successfully!");
            //             } else {
            //                 alert("Failed to save delivery details: " + data.message);
            //             }
            //         } catch (error) {
            //             console.error("Error saving delivery details:", error);
            //             alert("An error occurred while saving delivery details. Please try again.");
            //         }
            //     });
            // }
    });
</script>