@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4">Make a Donation</h1>

        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-3 mb-4 rounded">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="bg-red-200 text-red-800 p-3 mb-4 rounded">{{ session('error') }}</div>
        @endif

        <form action="{{ route('donations.store') }}" method="POST" id="donation-form">
            @csrf

            <div class="mb-4">
                <label for="donation_area_id" class="block text-sm font-medium text-gray-700">Donation Area</label>
                <select name="donation_area_id" id="donation_area_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                    @foreach ($donationAreas as $area)
                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                    @endforeach
                </select>
                @error('donation_area_id') <span class="text-red-500">{{ $message }}</span> @enderror

            </div>

            <div class="mb-4">
                <label for="donor_name" class="block text-sm font-medium text-gray-700">Donor Name (Optional)</label>
                <input type="text" name="donor_name" id="donor_name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" value="{{ old('donor_name') }}">
                @error('donor_name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="donor_email" class="block text-sm font-medium text-gray-700">Donor Email (Optional)</label>
                <input type="email" name="donor_email" id="donor_email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" value="{{ old('donor_email') }}">
                @error('donor_email') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="donor_mobile" class="block text-sm font-medium text-gray-700">Donor Mobile (Optional)</label>
                <input type="text" name="donor_mobile" id="donor_mobile" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" value="{{ old('donor_mobile') }}">
                @error('donor_mobile') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                <input type="number" name="amount" id="amount" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" step="0.01" value="{{ old('amount') }}" required>
                @error('amount') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="payment_gateway" class="block text-sm font-medium text-gray-700">Payment Gateway</label>
                <select name="payment_gateway" id="payment_gateway" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                @foreach ($paymentGateways as $gateway)
                    <option value="{{ $gateway->name }}">{{ $gateway->name }}</option>
                @endforeach
                </select>
                @error('payment_gateway') <span class="text-red-500">{{ $message }}</span> @enderror

            </div>

             <div id="stripe-payment-fields" class="mb-4" style="display: none;">
                <label for="card-element" class="block text-sm font-medium text-gray-700">Credit or debit card</label>
                <div id="card-element" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    </div>

                <div id="card-errors" role="alert" class="text-red-500 mt-2"></div>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Submit Donation
            </button>
        </form>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentGatewaySelect = document.getElementById('payment_gateway');
            const stripePaymentFields = document.getElementById('stripe-payment-fields');
            const donationForm = document.getElementById('donation-form');

            paymentGatewaySelect.addEventListener('change', function() {
                if (this.value === 'Stripe') {
                    stripePaymentFields.style.display = 'block';
                    initializeStripe();
                } else {
                    stripePaymentFields.style.display = 'none';
                }
            });

            function initializeStripe() {
                const stripe = Stripe('YOUR_STRIPE_PUBLISHABLE_KEY'); // Replace with your publishable key
                const elements = stripe.elements();
                const card = elements.create('card');
                card.mount('#card-element');

                card.on('change', function(event) {
                    const displayError = document.getElementById('card-errors');
                    if (event.error) {
                        displayError.textContent = event.error.message;
                    } else {
                        displayError.textContent = '';
                    }
                });

                donationForm.addEventListener('submit', function(event) {
                    if (paymentGatewaySelect.value === 'Stripe') {
                        event.preventDefault();

                        stripe.createToken(card).then(function(result) {
                            if (result.error) {
                                const errorElement = document.getElementById('card-errors');
                                errorElement.textContent = result.error.message;
                            } else {
                                stripeTokenHandler(result.token);
                            }
                        });
                    }
                });

                function stripeTokenHandler(token) {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', token.id);
                    donationForm.appendChild(hiddenInput);

                    donationForm.submit();
                }

            }
        });
    </script>
@endsection