<div>
    <div class="container mt-3 w-[70%]">
        <div class="row bg-white p-6 rounded shadow">
            <div class="col-md-12">

                <h1 class="text-4xl text-center my-5">Exhibitor Registration Form</h1>

                @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
                @endif

                <form wire:submit.prevent="vendorRegisterExhibition" id="exhibition-form">
                    @csrf

                    <!-- details -->
                    <h1 class="text-xl mb-6">Exhibitor Details</h1>
                    <div class="ml-5">
                        <!--Exhibitor name -->
                        <div class="form-group row">
                            <label for="exhibitor_name" class="col-sm-2 col-form-label star">Exhibitor Name</label>
                            <div class="col-sm-10">
                                <x-compo.input type="text" id="exhibitor_name" wire:model="exhibitor_name" placeholder="Enter exhibitor name" :value="old('exhibition_name')" autofocus required />
                            </div>
                        </div>

                        <!-- Exhibitor email -->
                        <div class="form-group row">
                            <label for="exhibitor_email" class="col-sm-2 col-form-label star">Exhibitor Email</label>
                            <div class="col-sm-10">
                                <x-compo.input type="text" id="exhibitor_email" wire:model="exhibitor_email" placeholder="Enter exhibitor email" :value="old('exhibition_name')" required />
                            </div>
                        </div>

                        <!-- Exhibitor phone -->
                        <div class="form-group row">
                            <label for="exhibitor_phone" class="col-sm-2 col-form-label star">Exhibitor Phone</label>
                            <div class="col-sm-10">
                                <x-compo.input type="text" id="exhibitor_phone" wire:model="exhibitor_phone" placeholder="Enter exhibitor phone number" :value="old('exhibition_name')" required />
                            </div>
                        </div>

                        <!-- Exhibitor address -->
                        <div id="one_date_input" class="form-group row">
                            <label for="exhibition_address" class="col-sm-2 col-form-label star">Exhibitor Address</label>
                            <div class="col-sm-10">
                                <x-compo.input type="text" id="exhibition_address" wire:model="exhibition_address" placeholder="Enter exhibition address" required />
                            </div>
                        </div>

                        <!-- Business name -->
                        <div id="one_date_input" class="form-group row pt-4">
                            <label for="Business_name" class="col-sm-2 col-form-label star">Business Name</label>
                            <div class="col-sm-10">
                                <x-compo.input type="text" id="Business_name" wire:model="Business_name" placeholder="Enter business name" required />
                            </div>
                        </div>

                        <!-- Business category -->
                        <div id="one_date_input" class="form-group row">
                            <label for="business_category" class="col-sm-2 col-form-label star">Business Category</label>
                            <div class="col-sm-10">
                                <x-compo.input type="text" id="business_category" wire:model="business_category" placeholder="Enter business category" required />
                            </div>
                        </div>

                        <!-- Business email -->
                        <div id="one_date_input" class="form-group row">
                            <label for="business_email" class="col-sm-2 col-form-label star">Business Email</label>
                            <div class="col-sm-10">
                                <x-compo.input type="text" id="business_email" wire:model="business_email" placeholder="Enter business email" required />
                            </div>
                        </div>

                        <!-- Business phone -->
                        <div id="one_date_input" class="form-group row">
                            <label for="business_phone" class="col-sm-2 col-form-label star">Business Phone</label>
                            <div class="col-sm-10">
                                <x-compo.input type="text" id="business_phone" wire:model="business_phone" placeholder="Enter business phone number" required />
                            </div>
                        </div>
                    </div>

                    <!-- stall -->
                    <h1 class="text-xl mt-10 mb-6">Stall Information</h1>
                    <div class="ml-5">
                        <div class="form-group row">
                            <label for="stall" class="col-sm-2 col-form-label star">Stall Size</label>
                            <div class="col-sm-10">
                                <select wire:model="stall" id="stall" class="form-control" required>
                                    <option value="">Select Stall</option>
                                    @foreach($stalls as $stall)
                                    <option value="{{ $stall->id }}" data-price="{{ $stall->price }}">
                                        {{ $stall->name }} - {{ $stall->size }} - ${{ $stall->price }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('stall') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="stall_type" class="col-sm-2 col-form-label star">Stall Type</label>
                            <div class="col-sm-10">
                                <select wire:model="stall_type" id="stall_type" class="form-control" required>
                                    <option value="">Select Stall Type</option>
                                    @foreach($stalls as $stall)
                                    <option value="{{ $stall->id }}" data-price="{{ $stall->price }}">
                                        {{ $stall->type }} - ${{ $stall->price }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('stall_type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="requirements" class="col-sm-2 col-form-label star">Requirements</label>
                            <div class="col-sm-10">
                                <x-compo.textarea id="requirements" wire:model="requirements" class="form-control" placeholder="Enter any specific requirements" required></x-compo.textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total_price" class="col-sm-2 col-form-label">Total Price</label>
                            <div class="col-sm-10">
                                <x-compo.input type="text" id="total_price" name="total_price" class="form-control" readonly />
                            </div>
                        </div>
                    </div>

                    <!-- Error Messages -->
                    <div id="error-messages" class="hidden alert alert-danger">
                        <strong class="font-bold">Submission Failed!</strong>
                        <ul id="error-list" class="list-disc list-inside"></ul>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Close</title>
                                <path d="M14.348 5.652a.5.5 0 10-.707-.707L10 8.586 6.36 4.945a.5.5 0 10-.707.708L9.293 10l-4.647 4.648a.5.5 0 00.707.708L10 11.414l3.64 3.64a.5.5 0 00.707-.707L10.707 10l4.641-4.648z" />
                            </svg>
                        </span>
                    </div>

                    <!-- submit button -->
                    <div class="flex gap-4">
                        <button type="submit" class="apply-button">Register for the exhibition</button>
                    </div>

                    @if(session()->has('error'))
                    <div class="bg-red-500 text-white p-4 rounded mb-4">
                        {{ session('error') }}
                    </div>
                    @endif

                    <!-- Success Message -->
                    <!-- <div id="success-message" class="hidden alert alert-success">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">Your exhibition has been created successfully.</span>
                        <button onclick="closeSuccessMessage()" class="absolute top-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Close</title>
                                <path d="M14.348 5.652a.5.5 0 10-.707-.707L10 8.586 6.36 4.945a.5.5 0 10-.707.708L9.293 10l-4.647 4.648a.5.5 0 00.707.708L10 11.414l3.64 3.64a.5.5 0 00.707-.707L10.707 10l4.641-4.648z" />
                            </svg>
                        </button>
                    </div> -->
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stallSelect = document.getElementById('stall');
            const stallTypeSelect = document.getElementById('stall_type');
            const totalPriceInput = document.getElementById('total_price');

            function calculateTotalPrice() {
                const stallPrice = parseFloat(stallSelect.options[stallSelect.selectedIndex].getAttribute('data-price')) || 0;
                const stallTypePrice = parseFloat(stallTypeSelect.options[stallTypeSelect.selectedIndex].getAttribute('data-price')) || 0;
                const totalPrice = stallPrice + stallTypePrice;
                totalPriceInput.value = `$${totalPrice.toFixed(2)}`;
            }

            stallSelect.addEventListener('change', calculateTotalPrice);
            stallTypeSelect.addEventListener('change', calculateTotalPrice);
        });
    </script>
</div>