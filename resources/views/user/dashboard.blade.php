@extends('layouts.frontend')
@section('pages')

<main class="user-dashboard-main-container">
    <!-- upper section -->
    <div class="dashboard-path-wrapper">
        <!-- Breadcrumb -->
        <div class="py-2 mb-4 text-sm text-customGray font-secondaryText">
            <a href="#" class="text-customBrown hover:underline" onclick="loadPage('dashboard')">Dashboard</a>
            <span id="breadcrumb"> / Dashboard</span>
        </div>
        <!-- Sign out btn -->
        <div class="mb-4 text-sm">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')" class="text-customGray hover:underline"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Sign out') }} <i class="ml-1 fa-solid fa-arrow-right-from-bracket"></i>
                </x-dropdown-link>
            </form>
        </div>
    </div>

    <!-- Dashboard -->
    <div class="user-dashboard-wrapper">
        <!-- Navbar for mobile -->
        <div class="flex items-center justify-between p-4 text-white bg-customBlue lg:hidden ">
            <div class="text-lg font-bold">Dashboard</div>
            <button id="menuToggle" class="text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>

        <!-- Sidebar for desktop -->
        <div id="sidebar" class="dashboard-sidebar-desktop-wrapper">
            <ul class="flex flex-col dashboard-sidebar-options text-secondaryText">
                <li class="u-sidebar-value rounded-t-md hover:rounded-t-md" data-page="dashboard" onclick="loadPage('dashboard')">
                    <i class="fa-regular fa-address-card ud-icon-left"></i>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    <label for="dashboard" class="dashboard-sidebar-title">Dashboard</label><br>
                    <span class="dashboard-sidebar-sub-title">Summary of your account</span>
                </li>
                <li class="u-sidebar-value" data-page="myMessages" onclick="loadPage('myMessages')">
                    <i class="fa-regular fa-envelope ud-icon-left"></i>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    <label for="myAdvert" class="dashboard-sidebar-title">My messages</label><br>
                    <span class="dashboard-sidebar-sub-title">Send and receive messages</span>
                </li>
                <li class="u-sidebar-value" data-page="myNotification" onclick="loadPage('myNotification')">
                    <i class="fa-regular fa-bell ud-icon-left"></i>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    <label for="myAdvert" class="dashboard-sidebar-title">Notification</label><br>
                    <span class="dashboard-sidebar-sub-title">Receive notifications</span>
                </li>
                <li class="u-sidebar-value" data-page="savedAdverts" onclick="loadPage('savedAdverts')">
                    <i class="fa-regular fa-heart ud-icon-left"></i>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    <label for="myAdvert" class="dashboard-sidebar-title">Saved adverts</label><br>
                    <span class="dashboard-sidebar-sub-title">Ads you have saved for later</span>
                </li>
                <li class="u-sidebar-value" data-page="myOrders" onclick="loadPage('myOrders')">
                    <i class="fa-solid fa-bag-shopping ud-icon-left"></i>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    <label for="myAdvert" class="dashboard-sidebar-title">My orders</label><br>
                    <span class="dashboard-sidebar-sub-title">View all your orders</span>
                </li>
                <li class="u-sidebar-value" data-page="personalDetails" onclick="loadPage('personalDetails')">
                    <i class="fa-regular fa-user ud-icon-left"></i>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    <label for="myAdvert" class="dashboard-sidebar-title">Personal details</label><br>
                    <span class="dashboard-sidebar-sub-title">Information about you</span>
                </li>
                <li class="u-sidebar-value" data-page="accountSecurity" onclick="loadPage('accountSecurity')">
                    <i class="fa-solid fa-shield-halved ud-icon-left"></i>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    <label for="myAdvert" class="dashboard-sidebar-title">Account security</label><br>
                    <span class="dashboard-sidebar-sub-title">Change your password</span>
                </li>
                <li class="u-sidebar-value rounded-b-md hover:rounded-b-md border-none" data-page="selling" onclick="loadPage('selling')">
                    <i class="fa-solid fa-hand-holding-dollar ud-icon-left"></i>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    <label for="myAdvert" class="dashboard-sidebar-title">Sell on Artisan.lk</label><br>
                    <span class="dashboard-sidebar-sub-title">Register as a seller</span>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="u-dashboard-content-wrapper">
            <!-- Dashboard page -->
            <div id="dashboard" class="ud-page-wrapper hidden">
                <div class="ud-dashboard-page bg-white p-6 rounded shadow">
                    <div class="flex">
                        <div class="ud-profile-image-wrapper">
                            <img src="{{ asset('https://png.pngtree.com/png-clipart/20230927/original/pngtree-man-avatar-image-for-profile-png-image_13001877.png') }}" alt="profile image" class="ud-profile-image">
                        </div>
                        <div class="pl-2 ml-3">
                            <h2 class="text-[40px] font-bold text-customBrown font-mainText">Hello! {{ ucfirst(explode(' ', Auth::user()->name)[0]) }}</h2>
                            <div class="flex gap-10 text-[#252a34] mb-4 font-secondaryText">
                                <p class="mt-2"><i class="fa-regular fa-user mr-2"></i>{{ Auth::user()->name }}</p>
                                <p class="mt-2"><i class="fa-regular fa-envelope mr-2"></i>{{ Auth::user()->email }}</p>
                                <p class="mt-2"><i class="fa-regular fa-calendar mr-2"></i>Member since {{ Auth::user()->created_at->format('d M Y') }}</p>
                            </div>
                            <button class="ud-btn font-secondaryText" onclick="loadPage('personalDetails')">Edit my details</button>
                        </div>
                    </div>
                </div>

                <div class="ud-dashboard-page bg-white p-6 rounded shadow">
                    <h2 class="text-[40px] font-bold text-customBrown font-mainText">Find your favourite arts & crafts</h2>
                    <div class="flex gap-10 text-[#252a34] mb-4 font-secondaryText">
                        <p class="mt-2">We are the fastest growing largest digital marketplace for arts and crafts in Sri Lanka.</p>
                    </div>
                    <a href="{{ route('pages.shop') }}" class="ud-btn font-secondaryText">Browse products</a>
                </div>

                <div class="ud-dashboard-page bg-white p-6 rounded shadow">
                    <h2 class="text-[40px] font-bold text-customBrown font-mainText">Looking to sell your arts & crafts?</h2>
                    <div class="flex gap-10 text-[#252a34] mb-4 font-secondaryText">
                        <p class="mt-2">Make more money by selling your unique products with Artisan.lk!</p>
                    </div>
                    <button class="ud-btn font-secondaryText" onclick="loadPage('selling')">Create vendor profile</button>
                </div>
            </div>

            <!-- messages -->
            <div id="myMessages" class="p-6 bg-white rounded shadow ud-page-wrapper hidden">
                <h2 class="text-2xl font-bold text-blue-900">My messages</h2>
                @livewire('vendor-chat')
            </div>

            <!-- notificatios -->
            <div id="myNotification" class="p-6 bg-white rounded shadow ud-page-wrapper hidden">
                <h2 class="text-2xl font-bold text-blue-900">My notifications</h2>
                <p class="mt-2">Your notificatios.</p>
            </div>

            <!-- saved ads -->
            <div id="savedAdverts" class="ud-page-wrapper hidden">
                <x-compo.search
                    :text="'Status'"
                    :options="['all' => 'All', 'live' => 'Live', 'rejected' => 'Rejected']"
                    :keyword="request('keyword', '')"
                    :placeholder="'Search saved ads...'" />
                <x-user.saved-ad />
            </div>

            <!-- orders -->
            <div id="myOrders" class="ud-page-wrapper ">
                @livewire('user.order-tab')
            </div>

            <!-- My presonal details -->
            <div id="personalDetails" class="ud-page-wrapper hidden">
                <div class="ud-personal-page bg-white p-6 rounded shadow">
                    <div class="ud-pro-change">
                        <h2 class="text-[50px] font-bold text-customBlue">Your details</h2>
                        <span>Please keep your details up to date. Your personal data is stored securely. We do not share information with third parties.</span>

                        <form id="profileForm" action="{{ route('user-profile.update') }}" method="post" class="mt-4">
                            @csrf

                            <div class="mb-4">
                                <label for="fullName" class="block text-sm font-medium text-gray-700">Full Name</label>
                                <input type="text" name="name" id="fullName" placeholder="{{ Auth::user()->name }}" value="{{ old('name', Auth::user()->name) }}" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>

                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                                <input type="email" name="email" id="email" placeholder="{{ Auth::user()->email }}" value="{{ old('email', Auth::user()->email) }}" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>

                            <div class="mb-4">
                                <label for="mobile" class="block text-sm font-medium text-gray-700">Mobile</label>
                                <input type="number" name="phone" id="mobile" placeholder="Enter your phone number" value="{{ old('phone', Auth::user()->phone) }}" min="0" oninput="this.value = Math.abs(this.value)" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>

                            <div>
                                <button type="submit" id="submitButton" class="bg-blue-500 ud-btn text-red">Save my details</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Account security page -->
            <div id="accountSecurity" class="ud-page-wrapper hidden">
                <div class="ud-security-page bg-white p-6 rounded shadow">
                    <div class="ud-pw-change">
                        <h2 class="text-[50px] font-bold text-customBlue">Your password</h2>
                        <span>Please make sure to have a secure password with at least 6 characters long.</span>
                        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')

                            <div>
                                <x-input-label for="update_password_current_password" :value="__('Current Password')" class="star" />
                                <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="update_password_password" :value="__('New Password')" class="star" />
                                <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="star" />
                                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                            </div>
                            <button type="submit" class="ud-btn">Change password</button>
                        </form>
                    </div>
                </div>

                <!-- Delete account -->
                <div class="p-6 bg-white rounded shadow ud-security-page">
                    <div class="ud-dlt-acc ">
                        <h2 class="text-[50px] font-bold text-red">Delete account</h2>
                        <span>Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</span>
                    </div>

                    <button type="submit" class="ud-btn mt-3" x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">Delete my account</button>

                </div>

                <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                        @csrf
                        @method('delete')

                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Are you sure you want to delete your account?') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                        </p>

                        <div class="mt-6">
                            <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                            <x-text-input
                                id="password"
                                name="password"
                                type="password"
                                class="mt-1 block w-3/4"
                                placeholder="{{ __('Password') }}" />

                            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                        </div>

                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Cancel') }}
                            </x-secondary-button>

                            <x-danger-button class="ms-3">
                                {{ __('Delete Account') }}
                            </x-danger-button>
                        </div>
                    </form>
                </x-modal>

            </div>

            <!-- Selling Section -->
            <div id="selling" class="ud-page-wrapper hidden">
                <div class="ud-personal-page bg-white p-6 rounded shadow">
                    <div class="ud-pro-change">
                        <h2 class="text-[50px] font-bold text-customBlue">Become An Artisan.lk Seller Today!</h2>
                        <span>Create a Artisan.lk seller account now and reach millions of customers!</span>

                        <form id="profileForm" action="{{ route('vendor.register') }}" method="post" class="mt-4">
                            @csrf

                            <div class="mb-4">
                                <label for="shopName" class="block text-sm font-medium text-gray-700">Display Name / Shop Name<span class="star"></span></label>
                                <input type="text" name="business_name" id="shopName" placeholder="Enter display name or shop name" value="" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>

                            <div class="mb-4">
                                <label for="businessDescription" class="block text-sm font-medium text-gray-700">Business Description<span class="star"></span></label>
                                <textarea name="business_description" id="businessDescription" placeholder="Enter business description" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="businessCategory" class="block text-sm font-medium text-gray-700">Business Category<span class="star"></span></label>
                                <!-- <input type="text" name="business_category" id="businessCategory" placeholder="Enter business category" value="" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"> -->
                                <x-compo.select name="business_category" id="businessCategory" :options="['' => 'Select'] + $categories->pluck('name', 'id')->toArray()" />

                            </div>

                            <div class="mb-4">
                                <label for="businessPhone" class="block text-sm font-medium text-gray-700">Business Phone<span class="star"></span></label>
                                <input type="text" name="business_phone" id="businessPhone" placeholder="Enter business phone" value="" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>

                            <div class="mb-4">
                                <label for="businessEmail" class="block text-sm font-medium text-gray-700">Business Email<span class="star"></span></label>
                                <input type="email" name="business_email" id="businessEmail" placeholder="Enter business email" value="" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>

                            <div class="mb-4">
                                <label for="businessAddress" class="block text-sm font-medium text-gray-700">Business Address<span class="star"></span></label>
                                <input type="text" name="business_address" id="businessAddress" placeholder="Enter business address" value="" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>

                            <div>
                                <button type="submit" id="submitButton" class="ud-btn bg-blue-500 text-red">Create vendor profile</button>
                            </div>
                        </form>
                        <!-- <div class="tab">
                            <button class="tab-link" onclick="openTab(event, 'tab1')">Seller</button>
                            <button class="tab-link" onclick="openTab(event, 'tab2')">Shop</button>
                        </div>

                        <div id="tab1" class="tab-content">
                            <h3>Seller</h3>
                            <p>Content for Tab 1.</p>
                        </div>

                        <div id="tab2" class="tab-content">
                            <h3>Shop</h3>
                            <p>Content for Tab 2.</p>
                        </div> -->
                    </div>
                </div>

                <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                        @csrf
                        @method('delete')

                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Are you sure you want to delete your account?') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                        </p>

                        <div class="mt-6">
                            <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                            <x-text-input
                                id="password"
                                name="password"
                                type="password"
                                class="mt-1 block w-3/4"
                                placeholder="{{ __('Password') }}" />

                            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                        </div>

                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Cancel') }}
                            </x-secondary-button>

                            <x-danger-button class="ms-3">
                                {{ __('Delete Account') }}
                            </x-danger-button>
                        </div>
                    </form>
                </x-modal>

            </div>
        </div>
    </div>

    <script>
        // Load the dashboard page in mobile view
        document.getElementById('menuToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
        });

        // Load the selected page
        function loadPage(page) {
            // Hide all pages
            var pages = document.querySelectorAll('.ud-page-wrapper');
            pages.forEach(function(p) {
                p.classList.add('hidden');
            });

            // Show the selected page if it exists
            var selectedPage = document.getElementById(page);
            if (selectedPage) {
                selectedPage.classList.remove('hidden');
            } else {
                console.error(`Page with id '${page}' not found.`);
                return;
            }

            // Update the active state in the sidebar
            var items = document.querySelectorAll('.u-sidebar-value');
            items.forEach(function(item) {
                item.classList.remove('bg-customBrown', 'text-white');
                var subTitle = item.querySelector('.dashboard-sidebar-sub-title');
                if (subTitle) {
                    subTitle.classList.remove('text-white');
                }
            });

            var activeItem = document.querySelector(`.u-sidebar-value[data-page="${page}"]`);
            if (activeItem) {
                activeItem.classList.add('bg-customBrown', 'text-white');
                var activeSubTitle = activeItem.querySelector('.dashboard-sidebar-sub-title');
                if (activeSubTitle) {
                    activeSubTitle.classList.add('text-white');
                }
            } else {
                console.error(`Sidebar item with data-page="${page}" not found.`);
            }

            // Update the breadcrumb
            var breadcrumb = document.getElementById('breadcrumb');
            if (breadcrumb) {
                breadcrumb.textContent = ` / ${page.charAt(0).toUpperCase() + page.slice(1).replace(/([A-Z])/g, ' $1').trim()}`;
            } else {
                console.error('Breadcrumb element not found.');
            }
        }

        // Load the default page on initial load
        document.addEventListener('DOMContentLoaded', function() {
            loadPage('dashboard');
        });


        // change the behaovier in the forms
        document.getElementById('profileForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent page refresh

            // Get the submit button
            const submitButton = document.getElementById('submitButton');

            // Prepare form data
            const formData = new FormData(this);

            // Send AJAX request
            fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the displayed name and email in the dashboard
                        document.querySelector('.ud-dashboard-page h2').innerText = `Hello! ${data.user.name.split(' ')[0]}`;
                        document.querySelector('.ud-dashboard-page .fa-user').nextSibling.textContent = data.user.name;
                        document.querySelector('.ud-dashboard-page .fa-envelope').nextSibling.textContent = data.user.email;
                        document.querySelector('.ud-dashboard-page .fa-calendar').nextSibling.textContent = `Member since ${data.user.created_at}`;

                        // Update button to show success
                        submitButton.innerText = 'Saved!';
                        submitButton.classList.remove('bg-blue-500');
                        submitButton.classList.add('bg-green-500');
                    } else {
                        alert('Error updating profile. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating your profile.');
                });
        });

        // Switch between tabs in selling section
        function openTab(event, tabName) {
            // Get all tab links and tab content elements
            const tabLinks = document.querySelectorAll('.tab-link');
            const tabContents = document.querySelectorAll('.tab-content');

            // Remove the active class from all tabs and tab contents
            tabLinks.forEach(link => link.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));

            // Add the active class to the clicked tab and the corresponding tab content
            event.currentTarget.classList.add('active');
            document.getElementById(tabName).classList.add('active');
        }
    </script>
</main>

@endsection