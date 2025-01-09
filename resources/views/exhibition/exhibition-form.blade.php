@extends('layouts.frontend')
@section('pages')

<div class="container mt-3 w-[70%]">
    <div class="row bg-white p-6 rounded shadow">
        <div class="col-md-12">

            <h1 class="text-4xl text-center my-5">Exhibition Form</h1>

            @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('exhibitions.store') }}" method="POST" id="exhibition-form" enctype="multipart/form-data">
                @csrf

                <!-- details -->
                <h1 class="text-xl mb-6">Exhibition Details</h1>
                <div class="ml-5">
                    <!-- name -->
                    <div class="form-group row">
                        <label for="exhibition_name" class="col-sm-2 col-form-label star">Exhibition Name</label>
                        <div class="col-sm-10">
                            <x-compo.input type="text" id="exhibition_name" name="exhibition_name" placeholder="Enter exhibition name" :value="old('exhibition_name')" required autofocus />
                        </div>
                    </div>

                    <!-- Exhibition description -->
                    <div class="form-group row">
                        <label for="exhibition_description" class="col-sm-2 col-form-label star">Exhibition Description</label>
                        <div class="col-sm-10">
                            <x-compo.textarea id="exhibition_description" name="exhibition_description" placeholder="Enter description" required />
                        </div>
                    </div>

                    <!-- date option -->
                    <!-- <div class="form-group row">
                        <label for="date_option" class="col-sm-2 col-form-label">Date Option</label>
                        <div class="col-sm-10">
                            <select id="date_option" name="date_option" class="form-control block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" onchange="toggleDateInputs()" required>
                                <option value="one_date">One Date</option>
                                <option value="few_dates">Few Dates</option>
                            </select>
                        </div>
                    </div> -->

                    <!-- one day -->
                    <div id="one_date_input" class="form-group row">
                        <label for="exhibition_date" class="col-sm-2 col-form-label star">Exhibition Date</label>
                        <div class="col-sm-10">
                            <x-compo.input
                                type="date"
                                id="exhibition_date"
                                name="exhibition_date"
                                placeholder="Exhibition Date"
                                min="{{ date('Y-m-d') }}"
                                required />
                        </div>
                    </div>

                    <!-- start date -->
                    <!-- <div id="few_dates_input" class="form-group row hidden">
                        <label for="start_date" class="col-sm-2 col-form-label">Start Date</label>
                        <div class="col-sm-10">
                            <x-compo.input type="date" id="start_date" name="start_date" placeholder="Start Date" required />
                        </div>
                    </div> -->

                    <!-- end date -->
                    <!-- <div id="few_dates_input_end" class="form-group row hidden">
                        <label for="end_date" class="col-sm-2 col-form-label">End Date</label>
                        <div class="col-sm-10">
                            <x-compo.input type="date" id="end_date" name="end_date" placeholder="End Date" required />
                        </div>
                    </div> -->

                    <!-- Start time -->
                    <div class="form-group row">
                        <label for="start_time" class="col-sm-2 col-form-label star">Start Time</label>
                        <div class="col-sm-10">
                            <x-compo.input
                                type="time"
                                id="start_time"
                                name="start_time"
                                onchange="validateTime(this)"
                                required />
                        </div>
                    </div>

                    <!-- End time -->
                    <div class="form-group row">
                        <label for="end_time" class="col-sm-2 col-form-label star">End Time</label>
                        <div class="col-sm-10">
                            <x-compo.input 
                            type="time" 
                            id="end_time" 
                            name="end_time" 
                            placeholder="End Time" 
                            onchange="validateTime(this)"
                            required />
                        </div>
                    </div>

                    <!-- Exhibition Location -->
                    <div class="form-group row">
                        <label for="exhibition_location" class="col-sm-2 col-form-label star">Exhibition Location</label>
                        <div class="col-sm-10">
                            <x-compo.input type="text" id="exhibition_location" name="exhibition_location" placeholder="Enter location" required />
                        </div>
                    </div>

                    <!-- Organizaton name -->
                    <div class="form-group row">
                        <label for="organization_name" class="col-sm-2 col-form-label">Organization Name</label>
                        <div class="col-sm-10">
                            <x-compo.input type="text" id="organization_name" name="organization_name" placeholder="Enter organization name" required />
                        </div>
                    </div>

                    <!-- Telephone Numbers -->
                    <div class="form-group row">
                        <label for="contact-count" class="col-sm-2 col-form-label star">Number of Contacts</label>
                        <div class="col-sm-10">
                            <x-compo.select id="contact-count" name="contact-count" :options="[1 => '1', 2 => '2', 3 => '3']" class="flex-grow-1" style="flex: 0 0 25%;" required />
                        </div>
                    </div>
                    <div id="contact-fields">
                        <div class="form-group row">
                            <label for="telephone1" class="col-sm-2 col-form-label star">Contact 1</label>
                            <div class="col-sm-10 d-flex gap-2">
                                <x-compo.input type="text" id="name1" name="name1" placeholder="Enter contact name" class="flex-grow-1" style="flex: 0 0 75%;" required />
                                <x-compo.input type="text" id="telephone1" name="telephone1" placeholder="Enter mobile number" class="flex-grow-1" min="0" style="flex: 0 0 25%;" required />
                            </div>
                        </div>
                    </div>

                    <!-- Email Addresses -->
                    <div class="form-group row">
                        <label for="email-count" class="col-sm-2 col-form-label star">Number of Emails</label>
                        <div class="col-sm-10">
                            <x-compo.select id="email-count" name="email-count" :options="[1 => '1', 2 => '2', 3 => '3']" class="flex-grow-1" style="flex: 0 0 25%;" />
                        </div>
                    </div>
                    <div id="email-fields">
                        <div class="form-group row">
                            <label for="email1" class="col-sm-2 col-form-label star">Email 1</label>
                            <div class="col-sm-10">
                                <x-compo.input type="email" id="email1" name="email1" placeholder="Enter email address" class="flex-grow-1" required />
                            </div>
                        </div>
                    </div>

                    <!-- Exhibition banner -->
                    <div class="form-group">
                        <label for="exhibitionBanner" class="star">Upload exhibition banner</label>
                        <div class="sec-box img-up">
                            <div class="image-uploader">
                                <input type="file" name="exhibitionBanner[]" id="image-input" accept="image/*" multiple required />
                                <label for="image-input"><i class="fa-solid fa-plus" style="color: grey;"></i><br>Add banner</label>
                                <div class="image-preview" id="image-preview"></div>
                                @error('exhibitionBanner.*') <div class="error">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- category -->
                <h1 class="text-xl mt-10 mb-6">Exhibition Category</h1>
                <div class="ml-5">
                    <!-- category type -->
                    <div class="form-group row">
                        <label for="category" class="col-sm-2 col-form-label star">Category</label>
                        <div class="col-sm-10">
                            <!-- <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="category_all" id="category_all" value="all">
                                    <label class="form-check-label" for="category_art">All</label>
                                </div> -->
                            <x-compo.input type="text" id="category_name" name="category_name" placeholder="Enter category name" class="flex-grow-1" required />
                        </div>
                    </div>
                </div>

                <h1 class="text-xl mt-10 mb-6">Stall Information</h1>
                <div class="ml-5">
                    <!-- Stall Size and Price -->
                    <div class="form-group row">
                        <label for="contact-count" class="col-sm-2 col-form-label star">Stall Size</label>
                        <div class="col-sm-10">
                            <x-compo.select id="stall-count" name="stall-count" :options="[1 => 'Stall 01', 2 => 'Stall 02', 3 => 'Stall 03']" class="flex-grow-1" style="flex: 0 0 25%;" required />
                        </div>
                    </div>
                    <div id="stall-size-fields">
                        <div class="form-group row">
                            <label for="stall_name" class="col-sm-2 col-form-label star">Stall 1</label>
                            <div class="col-sm-10 gap-2">
                                <x-compo.input type="text" id="stall-name" name="stall_name" placeholder="Enter stall name (e.g., small stall)" class="flex-grow-1 mb-2" required />
                                <div class="d-flex gap-2">
                                    <x-compo.input type="text" id="stall-size" name="stall_size" placeholder="Enter stall size (e.g., 2m x 2m)" class="flex-grow-1" style="flex: 0 0 75%;" required />
                                    <x-compo.input type="number" id="stall-size-price" name="stall_size_price" placeholder="Enter price" class="flex-grow-1" min="0" style="flex: 0 0 25%;" required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stall Type and Price -->
                    <div class="form-group row">
                        <label for="stall-type" class="col-sm-2 col-form-label star">Stall Type</label>
                        <div class="col-sm-10">
                            <x-compo.select id="stall-type-count" name="stall-type-count" :options="[1 => 'Type 01', 2 => 'Type 02', 3 => 'Type 03']" class="flex-grow-1 mb-2" style="flex: 0 0 25%;" required />
                        </div>
                    </div>
                    <div id="stall-type-fields">
                        <div class="form-group row">
                            <label for="stall_name" class="col-sm-2 col-form-label star">Type 1</label>
                            <div class="col-sm-10 gap-2">
                                <div class="d-flex gap-2 mb-2">
                                    <x-compo.input type="text" id="stall-type" name="stall_type" placeholder="Enter stall type (e.g., Standard Stall)" class="flex-grow-1" style="flex: 0 0 75%;" required />
                                    <x-compo.input type="number" id="stall-type-price" name="stall_type_price" placeholder="Enter price" class="flex-grow-1" min="0" style="flex: 0 0 25%;" required />
                                </div>
                                <x-compo.textarea id="requirements" name="stall_type_requirements" placeholder="Enter any specific requirements" class="flex-grow-1" style="flex: 0 0 100%;" required></x-compo.textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- exhibitor information -->
                <h1 class="text-xl mt-10 mb-6">Exhibitor Information</h1>
                <div class="ml-5">
                    <!-- registration start date -->
                    <div class="form-group row">
                        <label for="registration_start_date" class="col-sm-2 col-form-label">Registration Start Date</label>
                        <div class="col-sm-10">
                            <x-compo.input 
                            type="date" 
                            id="registration_start_date" 
                            name="registration_start_date" 
                            min="{{ date('Y-m-d') }}"
                            placeholder="Registration Start Date" />
                        </div>
                    </div>
                    <!-- end date -->
                    <div class="form-group row">
                        <label for="registration_end_date" class="col-sm-2 col-form-label">Registration End Date</label>
                        <div class="col-sm-10">
                            <x-compo.input 
                            type="date" 
                            id="registration_end_date" 
                            name="registration_end_date" 
                            min="{{ date('Y-m-d') }}"
                            placeholder="Registration End Date" />
                        </div>
                    </div>

                    <!-- maximum nuber of exhibitors -->
                    <div class="form-group row">
                        <div class="flex flex-col lg:max-w-[16.5%] sm:max-w-full md:max-w-full">
                            <label for="max_exhibitors">Maximum Exhibitors</label>
                            <small>(If limited)</small>
                        </div>
                        <div class="col-sm-10">
                            <x-compo.input type="number" id="max_exhibitors" name="max_exhibitors" min="0" placeholder="Enter maximum exhibitors" />
                        </div>
                    </div>

                </div>

                <!-- Price information -->
                <h1 class="text-xl mt-10">Price Information</h1>
                <div class="ml-5">
                    <!-- exhibitors -->
                    <h2 class=" text-lg mt-3 mb-3">For Exhibitors</h2>
                    <!-- Entrance Fee -->
                    <div class="form-group row">
                        <div class="flex flex-col lg:max-w-[16.5%] sm:max-w-full md:max-w-full">
                            <label for="entrance_fee">Entrance Fee</label>
                            <small>(If applicable)</small>
                        </div>

                        <div class="col-sm-10">
                            <x-compo.input type="number" id="entrance_fee" name="vendor_entrance_fee" min="0" placeholder="Enter entrance fee" />
                        </div>
                    </div>

                    <!-- visitors -->
                    <h2 class=" text-lg mt-3 mb-3">For Visitors</h2>
                    <!-- Regular Price -->
                    <div class="form-group row">
                        <div class="flex flex-col lg:max-w-[16.5%] sm:max-w-full md:max-w-full">
                            <label for="regular_price">Adult Price</label>
                            <small>(If applicable)</small>
                        </div>
                        <div class="col-sm-10">
                            <x-compo.input type="number" id="regular_price" name="regular_price" min="0" placeholder="Enter regular price" />
                        </div>
                    </div>

                    <!-- Student Price -->
                    <div class="form-group row">
                        <div class="flex flex-col lg:max-w-[16.5%] sm:max-w-full md:max-w-full">
                            <label for="student_price">Student Price</label>
                            <small>(If applicable)</small>
                        </div>
                        <div class="col-sm-10">
                            <x-compo.input type="number" id="student_price" name="student_price" min="0" placeholder="Enter student price" />
                        </div>
                    </div>

                    <!-- Child Price -->
                    <div class="form-group row">
                        <div class="flex flex-col lg:max-w-[16.5%] sm:max-w-full md:max-w-full">
                            <label for="child_price">Child Price</label>
                            <small>(If applicable)</small>
                        </div>
                        <div class="col-sm-10">
                            <x-compo.input type="number" id="child_price" name="child_price" min="0" placeholder="Enter child price" />
                        </div>
                    </div>
                </div>

                <!-- Media Section -->
                <h1 class="text-xl mt-10 mb-6">Media</h1>
                <div class="ml-5">
                    <!-- Social Media Links -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Social Media Links</label>
                        <div class="col-sm-10 flex flex-wrap gap-5">
                            @foreach(['facebook', 'instagram', 'tiktok', 'youtube', 'other'] as $platform)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="{{ $platform }}-checkbox" name="social-media-checkboxes[]" value="{{ $platform }}">
                                <label class="form-check-label" for="{{ $platform }}-checkbox">{{ ucfirst($platform) }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div id="social-media-fields"></div>
                </div>

                <!-- Layout Selection Display -->
                <!-- <div class="mb-4 flex">
                    <label class="block text-gray-700">Selected Layout:</label>
                    <span class="text-gray-900 ml-2">
                        {{ ucfirst(str_replace('layout', 'Layout ', request('layout'))) }}
                    </span>
                </div> -->
                <h1 class="text-xl mt-10 mb-3">Preview</h1>
                <div class="mb-4 form-group">
                    <label class="col-sm-2 col-form-label">Selected Layout:</label>
                    <span class="text-gray-900 ml-2">
                        {{ ucfirst(str_replace('layout', 'Layout ', request('layout', 'layout1'))) }}
                    </span>
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

                <!-- Hidden Input for Layout -->
                <input type="hidden" name="layout" id="selected-layout" value="{{ request('layout', 'layout1') }}">

                <!-- submit button -->
                <div class="flex gap-4">
                    <button type="submit" class="apply-button w-3/4">Apply Exhibition</button>
                    <button type="button" class="apply-button w-1/4" onclick="showPreview()">Preview Post</button>
                </div>

                <!-- Success Message -->
                <div id="success-message" class="hidden alert alert-success">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">Your exhibition has been created successfully.</span>
                    <button onclick="closeSuccessMessage()" class="absolute top-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <title>Close</title>
                            <path d="M14.348 5.652a.5.5 0 10-.707-.707L10 8.586 6.36 4.945a.5.5 0 10-.707.708L9.293 10l-4.647 4.648a.5.5 0 00.707.708L10 11.414l3.64 3.64a.5.5 0 00.707-.707L10.707 10l4.641-4.648z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .border-red-500 {
        border-color: rgb(239, 68, 68) !important;
    }

    .text-red-600 {
        color: rgb(220, 38, 38);
    }

    .star::after {
        content: " *";
        color: red;
    }
</style>

<script>
    // preview
    function showPreview() {
        const form = document.getElementById('exhibition-form');
        const formData = new FormData(form);
        let queryString = '';

        formData.forEach((value, key) => {
            queryString += `${encodeURIComponent(key)}=${encodeURIComponent(value)}&`;
        });

        const previewWindow = window.open(`/preview?${queryString}`, '_blank');
    }

    //store data into the session
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('exhibition-form');

        function saveFormData() {
            const formData = new FormData(form);
            const formObj = {
                images: [],
                contacts: [],
                emails: [],
                socialMedia: {}
            };

            // Handle regular inputs
            formData.forEach((value, key) => {
                if (key.startsWith('contact_name') || key.startsWith('contact_telephone')) {
                    const index = key.slice(-1);
                    if (!formObj.contacts[index - 1]) {
                        formObj.contacts[index - 1] = {};
                    }
                    if (key.startsWith('contact_name')) {
                        formObj.contacts[index - 1].name = value;
                    } else {
                        formObj.contacts[index - 1].telephone = value;
                    }
                } else if (key.startsWith('email')) {
                    const index = key.slice(-1);
                    formObj.emails[index - 1] = value;
                } else if (key.endsWith('-url')) {
                    const platform = key.replace('-url', '');
                    formObj.socialMedia[platform] = value;
                } else {
                    formObj[key] = value;
                }
            });

            // Handle image files
            const imageInput = document.getElementById('image-input');
            if (imageInput && imageInput.files.length > 0) {
                formObj.imageCount = imageInput.files.length;
                // Store image preview data
                const imagePreview = document.getElementById('image-preview');
                if (imagePreview) {
                    formObj.imagePreviews = Array.from(imagePreview.children).map(container => {
                        return container.querySelector('img').src;
                    });
                }
            }

            // Handle social media checkboxes
            document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                if (checkbox.checked && checkbox.name === 'social-media-checkboxes[]') {
                    const platform = checkbox.value;
                    const urlInput = document.querySelector(`[name="${platform}-url"]`);
                    if (urlInput) {
                        formObj.socialMedia[platform] = urlInput.value;
                    }
                }
            });

            sessionStorage.setItem('exhibitionFormData', JSON.stringify(formObj));
        }

        // Restore saved data
        function restoreFormData() {
            const savedData = sessionStorage.getItem('exhibitionFormData');
            if (!savedData) return;

            const formObj = JSON.parse(savedData);

            // Restore regular inputs
            Object.entries(formObj).forEach(([key, value]) => {
                if (!['images', 'contacts', 'emails', 'socialMedia'].includes(key)) {
                    const input = form.querySelector(`[name="${key}"]`);
                    if (input && input.type !== 'file') {
                        input.value = value;
                    }
                }
            });

            // Restore contacts
            if (formObj.contacts.length) {
                document.getElementById('contact-count').value = formObj.contacts.length;
                document.getElementById('contact-count').dispatchEvent(new Event('change'));
                formObj.contacts.forEach((contact, index) => {
                    const nameInput = form.querySelector(`[name="contact_name${index + 1}"]`);
                    const telInput = form.querySelector(`[name="contact_telephone${index + 1}"]`);
                    if (nameInput && contact.name) nameInput.value = contact.name;
                    if (telInput && contact.telephone) telInput.value = contact.telephone;
                });
            }

            // Restore emails
            if (formObj.emails.length) {
                document.getElementById('email-count').value = formObj.emails.length;
                document.getElementById('email-count').dispatchEvent(new Event('change'));
                formObj.emails.forEach((email, index) => {
                    const emailInput = form.querySelector(`[name="email${index + 1}"]`);
                    if (emailInput && email) emailInput.value = email;
                });
            }

            // Restore social media
            Object.entries(formObj.socialMedia).forEach(([platform, url]) => {
                const checkbox = form.querySelector(`input[type="checkbox"][value="${platform}"]`);
                if (checkbox) {
                    checkbox.checked = true;
                    checkbox.dispatchEvent(new Event('change'));
                    const urlInput = form.querySelector(`[name="${platform}-url"]`);
                    if (urlInput) urlInput.value = url;
                }
            });

            // Restore image previews
            if (formObj.imagePreviews) {
                const imagePreview = document.getElementById('image-preview');
                formObj.imagePreviews.forEach(src => {
                    const container = document.createElement('div');
                    container.className = 'image-container';
                    container.innerHTML = `
                        <img src="${src}" class="preview-image">
                        <button type="button" class="remove-image">&times;</button>
                    `;
                    imagePreview.appendChild(container);
                });
            }
        }

        // Save on input change
        form.addEventListener('input', saveFormData);
        form.addEventListener('change', saveFormData);

        // Restore on page load
        restoreFormData();

        // Clear storage on successful submission
        form.addEventListener('submit', function() {
            sessionStorage.removeItem('exhibitionFormData');
        });
    });

    // Success Message Handling
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('exhibition-form');

        form.addEventListener('submit', function(event) {
            event.preventDefault();
            clearErrors();

            fetch("{{ route('exhibitions.store') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: new FormData(this)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showSuccess();
                        form.reset();
                        sessionStorage.removeItem('exhibitionFormData');
                    } else {
                        showErrors(data.errors);
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        function showSuccess() {
            const successMessage = document.getElementById('success-message');
            successMessage.classList.remove('hidden');
            successMessage.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });

            // Auto hide after 5 seconds
            setTimeout(() => {
                closeSuccessMessage();
            }, 10000);
        }

        function closeSuccessMessage() {
            document.getElementById('success-message').classList.add('hidden');
        }

        function clearErrors() {
            document.querySelectorAll('.error-message').forEach(el => {
                el.textContent = '';
                el.classList.add('hidden');
            });
            document.querySelectorAll('input').forEach(input => {
                input.classList.remove('border-red-500');
            });
        }

        function showErrors(errors) {
            let firstErrorField = null;

            Object.keys(errors).forEach(field => {
                const input = document.querySelector(`[name="${field}"]`);
                if (input) {
                    input.classList.add('border-red-500');
                    const errorDiv = input.parentElement.querySelector('.error-message');
                    errorDiv.textContent = errors[field][0];
                    errorDiv.classList.remove('hidden');

                    if (!firstErrorField) {
                        firstErrorField = input;
                    }
                }
            });

            if (firstErrorField) {
                firstErrorField.focus();
                firstErrorField.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        }
    });

    function closeSuccessMessage() {
        document.getElementById('success-message').classList.add('hidden');
        sessionStorage.removeItem('exhibitionFormData');
        window.location.reload();
    }

    // date option selection
    // function toggleDateInputs() {
    //     const dateOption = document.getElementById('date_option').value;
    //     const oneDateInput = document.getElementById('one_date_input');
    //     const fewDatesInput = document.getElementById('few_dates_input');
    //     const fewDatesInputEnd = document.getElementById('few_dates_input_end');

    //     if (dateOption === 'one_date') {
    //         oneDateInput.classList.remove('hidden');
    //         fewDatesInput.classList.add('hidden');
    //         fewDatesInputEnd.classList.add('hidden');
    //     } else {
    //         oneDateInput.classList.add('hidden');
    //         fewDatesInput.classList.remove('hidden');
    //         fewDatesInputEnd.classList.remove('hidden');
    //     }
    // }

    // contact number selecetion
    document.getElementById('contact-count').addEventListener('change', function() {
        const count = parseInt(this.value);
        const contactFields = document.getElementById('contact-fields');
        contactFields.innerHTML = '';

        for (let i = 1; i <= count; i++) {
            const fieldGroup = document.createElement('div');
            fieldGroup.className = 'form-group row';
            fieldGroup.innerHTML = `
                <label for="telephone${i}" class="col-sm-2 col-form-labe star">Contact ${i}</label>
                <div class="col-sm-10 d-flex gap-2">
                    <x-compo.input type="text" id="name${i}" name="name${i}" placeholder="Enter contact name" class="flex-grow-1" style="flex: 0 0 75%;" />
                    <x-compo.input type="text" id="telephone${i}" name="telephone${i}" placeholder="Enter mobile number" class="flex-grow-1" style="flex: 0 0 25%;" />
                </div>
            `;
            contactFields.appendChild(fieldGroup);
        }
    });

    function validateTime(input) {
        const selectedDate = document.getElementById('exhibition_date').value;
        const today = new Date().toISOString().split('T')[0];

        if (selectedDate === today) {
            const now = new Date();
            const currentTime = `${String(now.getHours()).padStart(2, '0')}:${String(now.getMinutes()).padStart(2, '0')}`;
            input.min = currentTime;

            if (input.value < currentTime) {
                input.value = currentTime;
            }
        } else {
            input.min = '';
        }
    }

    // Validate on date change
    document.getElementById('exhibition_date').addEventListener('change', function() {
        validateTime(document.getElementById('start_time'));
        validateTime(document.getElementById('end_time'));

    });

    // email number selecetion
    document.getElementById('email-count').addEventListener('change', function() {
        const count = parseInt(this.value);
        const emailFields = document.getElementById('email-fields');
        emailFields.innerHTML = '';

        for (let i = 1; i <= count; i++) {
            const fieldGroup = document.createElement('div');
            fieldGroup.className = 'form-group row';
            fieldGroup.innerHTML = `
                <label for="email${i}" class="col-sm-2 col-form-label star">Email ${i}</label>
                <div class="col-sm-10">
                    <x-compo.input type="email" id="email${i}" name="email${i}" placeholder="Enter email address" class="flex-grow-1" />
                </div>
            `;
            emailFields.appendChild(fieldGroup);
        }
    });

    //stall selection
    document.addEventListener('DOMContentLoaded', function() {
        const stallCountSelect = document.getElementById('stall-count');
        const stallSizeFields = document.getElementById('stall-size-fields');
        const stallTypeCountSelect = document.getElementById('stall-type-count');
        const stallTypeFields = document.getElementById('stall-type-fields');

        function updateStallSizeFields() {
            const count = parseInt(stallCountSelect.value);
            stallSizeFields.innerHTML = '';
            for (let i = 1; i <= count; i++) {
                const fieldHTML = `
                    <div class="form-group row">
                        <label for="stall_name_${i}" class="col-sm-2 col-form-label star">Stall ${i}</label>
                        <div class="col-sm-10 gap-2">
                            <x-compo.input type="text" id="stall_name_${i}" name="stall_name_${i}" placeholder="Enter stall name (e.g., small stall)" class="flex-grow-1 mb-2" required />
                            <div class="d-flex gap-2">
                                <x-compo.input type="text" id="stall_size_${i}" name="stall_size_${i}" placeholder="Enter stall size (e.g., 2m x 2m)" class="flex-grow-1" style="flex: 0 0 75%;" required />
                                <x-compo.input type="number" id="stall_size_price_${i}" name="stall_size_price_${i}" placeholder="Enter price" class="flex-grow-1" min="0" style="flex: 0 0 25%;" required />
                            </div>
                        </div>
                    </div>
                `;
                stallSizeFields.insertAdjacentHTML('beforeend', fieldHTML);
            }
        }

        function updateStallTypeFields() {
            const count = parseInt(stallTypeCountSelect.value);
            stallTypeFields.innerHTML = '';
            for (let i = 1; i <= count; i++) {
                const fieldHTML = `
                    <div class="form-group row">
                        <label for="stall_type_${i}" class="col-sm-2 col-form-label star">Type ${i}</label>
                        <div class="col-sm-10 gap-2">
                            <div class="d-flex gap-2 mb-2">
                                <x-compo.input type="text" id="stall_type_${i}" name="stall_type_${i}" placeholder="Enter stall type (e.g., Standard Stall)" class="flex-grow-1" style="flex: 0 0 75%;" required />
                                <x-compo.input type="number" id="stall_type_price_${i}" name="stall_type_price_${i}" placeholder="Enter price" class="flex-grow-1" min="0" style="flex: 0 0 25%;" required />
                            </div>
                            <x-compo.textarea id="requirements_${i}" name="stall_type_requirements_${i}" placeholder="Enter any specific requirements" class="flex-grow-1" style="flex: 0 0 100%;" required></x-compo.textarea>
                        </div>
                    </div>
                `;
                stallTypeFields.insertAdjacentHTML('beforeend', fieldHTML);
            }
        }

        stallCountSelect.addEventListener('change', updateStallSizeFields);
        stallTypeCountSelect.addEventListener('change', updateStallTypeFields);

        // Initialize fields on page load
        updateStallSizeFields();
        updateStallTypeFields();
    });

    // social media links
    document.addEventListener('DOMContentLoaded', function() {
        // Handle changes to social media checkboxes
        document.querySelectorAll('input[name="social-media-checkboxes[]"]').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const socialMediaFields = document.getElementById('social-media-fields');

                // Clear existing fields
                socialMediaFields.innerHTML = '';

                // Iterate over checked checkboxes to create corresponding URL inputs
                document.querySelectorAll('input[name="social-media-checkboxes[]"]:checked').forEach(function(checkedBox) {
                    const platform = checkedBox.value;
                    const fieldGroup = document.createElement('div');
                    fieldGroup.className = 'form-group row mb-3';

                    fieldGroup.innerHTML = `
                        <label for="${platform}-url" class="col-sm-2 col-form-label">${platform.charAt(0).toUpperCase() + platform.slice(1)} URL</label>
                        <div class="col-sm-10">
                            <x-compo.input type="url" id="${platform}-url" name="${platform}-url" placeholder="Enter your ${platform} URL" class="form-control" required />
                        </div>
                    `;

                    socialMediaFields.appendChild(fieldGroup);
                });
            });
        });
    });

    // image uploader
    document.getElementById('image-input').addEventListener('change', function() {
        const imagePreview = document.getElementById('image-preview');
        const files = Array.from(this.files);

        files.forEach(file => {
            // Check file size
            if (file.size > 2 * 1024 * 1024) {
                alert('Each image must be less than 2MB');
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;

                const imageContainer = document.createElement('div');
                imageContainer.classList.add('image-container');

                const removeBtn = document.createElement('button');
                removeBtn.innerText = 'X';
                removeBtn.classList.add('remove-btn');
                removeBtn.addEventListener('click', function() {
                    imageContainer.remove();
                });

                imageContainer.appendChild(img);
                imageContainer.appendChild(removeBtn);
                imagePreview.appendChild(imageContainer);
            };

            reader.readAsDataURL(file);
        });
    });

    // Allow image reordering
    const imagePreview = document.getElementById('image-preview');
    let dragSrcEl = null;

    function handleDragStart(e) {
        dragSrcEl = this;
        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/html', this.innerHTML);
    }

    function handleDragOver(e) {
        if (e.preventDefault) {
            e.preventDefault();
        }
        e.dataTransfer.dropEffect = 'move';
        return false;
    }

    function handleDragEnter() {
        this.classList.add('over');
    }

    function handleDragLeave() {
        this.classList.remove('over');
    }

    function handleDrop(e) {
        if (e.stopPropagation) {
            e.stopPropagation();
        }

        if (dragSrcEl !== this) {
            dragSrcEl.innerHTML = this.innerHTML;
            this.innerHTML = e.dataTransfer.getData('text/html');
        }

        return false;
    }

    function handleDragEnd() {
        const imageContainers = document.querySelectorAll('.image-preview .image-container');
        imageContainers.forEach(container => {
            container.classList.remove('over');
        });
    }

    function addDnDHandlers(container) {
        container.addEventListener('dragstart', handleDragStart, false);
        container.addEventListener('dragenter', handleDragEnter, false);
        container.addEventListener('dragover', handleDragOver, false);
        container.addEventListener('dragleave', handleDragLeave, false);
        container.addEventListener('drop', handleDrop, false);
        container.addEventListener('dragend', handleDragEnd, false);
    }

    // imagePreview.addEventListener('DOMNodeInserted', function(e) {
    //     if (e.target.className === 'image-container') {
    //         e.target.setAttribute('draggable', 'true');
    //         addDnDHandlers(e.target);
    //     }
    // });

    document.addEventListener('DOMContentLoaded', (event) => {
        // Callback function to execute when mutations are observed
        const callback = function(mutationsList, observer) {
            for (let mutation of mutationsList) {
                if (mutation.type === 'childList') {
                    console.log('A child node has been added or removed.');
                    // Your existing code here
                }
            }
        };

        // Create an observer instance linked to the callback function
        const observer = new MutationObserver(callback);

        // Options for the observer (which mutations to observe)
        const config = {
            childList: true,
            subtree: true
        };

        // Target element to observe
        const imagePreview = document.getElementById('imagePreview');

        // Start observing the target element for configured mutations
        if (imagePreview) {
            observer.observe(imagePreview, config);
        }
    });

    // Restore Form Data from sessionStorage
    // document.addEventListener('DOMContentLoaded', function() {
    //     // Restore form data from sessionStorage
    //     const savedData = sessionStorage.getItem('exhibitionFormData');
    //     if (savedData) {
    //         const formData = JSON.parse(savedData);
    //         const form = document.getElementById('exhibition-form');

    //         for (const key in formData) {
    //             if (formData.hasOwnProperty(key)) {
    //                 const field = form.querySelector(`[name="${key}"]`);
    //                 if (field) {
    //                     if (field.type === 'checkbox') {
    //                         if (Array.isArray(formData[key])) {
    //                             formData[key].forEach(value => {
    //                                 const checkbox = form.querySelector(`[name="${key}"][value="${value}"]`);
    //                                 if (checkbox) checkbox.checked = true;
    //                             });
    //                         } else {
    //                             field.checked = true;
    //                         }
    //                     } else if (field.type === 'radio') {
    //                         const radioToCheck = form.querySelector(`[name="${key}"][value="${formData[key]}"]`);
    //                         if (radioToCheck) radioToCheck.checked = true;
    //                     } else if (field.tagName.toLowerCase() === 'select') {
    //                         field.value = formData[key];
    //                         // Trigger change event if necessary
    //                         field.dispatchEvent(new Event('change'));
    //                     } else {
    //                         field.value = formData[key];
    //                     }
    //                 }
    //             }
    //         }

    //         // Handle dynamic fields like contacts and emails
    //         if (formData['contact-count']) {
    //             const contactCount = parseInt(formData['contact-count']);
    //             const contactFields = document.getElementById('contact-fields');

    //             // Set the contact-count select field
    //             const contactCountField = form.querySelector('[name="contact-count"]');
    //             if (contactCountField) {
    //                 contactCountField.value = contactCount;
    //                 contactCountField.dispatchEvent(new Event('change'));
    //             }

    //             for (let i = 1; i <= contactCount; i++) {
    //                 const nameField = form.querySelector(`[name="name${i}"]`);
    //                 const telephoneField = form.querySelector(`[name="telephone${i}"]`);
    //                 if (nameField && telephoneField) {
    //                     nameField.value = formData[`name${i}`];
    //                     telephoneField.value = formData[`telephone${i}`];
    //                 }
    //             }
    //         }

    //         if (formData['email-count']) {
    //             const emailCount = parseInt(formData['email-count']);
    //             const emailFields = document.getElementById('email-fields');

    //             // Set the email-count select field
    //             const emailCountField = form.querySelector('[name="email-count"]');
    //             if (emailCountField) {
    //                 emailCountField.value = emailCount;
    //                 emailCountField.dispatchEvent(new Event('change'));
    //             }

    //             for (let i = 1; i <= emailCount; i++) {
    //                 const emailField = form.querySelector(`[name="email${i}"]`);
    //                 if (emailField) {
    //                     emailField.value = formData[`email${i}`];
    //                 }
    //             }
    //         }

    //         // Clear the saved data after restoring
    //         sessionStorage.removeItem('exhibitionFormData');
    //     }

    //     // Existing initialization code...

    //     toggleDateInputs();
    // });
</script>
@endsection