<!-- Vendor Dashboard -->
@extends('layouts.frontend')
@section('pages')

    <div class="breadcrumb-bar">
        <div class="breadcrumb-title">
            Artisan.lk Seller Center
        </div>
        <div class="create-ads">
            <a href="{{ route('product.create') }}" class="create-ads-btn font-secondaryText">Create Advert</a>
        </div>
    </div>
    <main class="user-dashboard-main-container" style="margin-top: 2%;">
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
            <!-- <div class="flex items-center justify-between p-4 text-white bg-customBlue lg:hidden ">
                <div class="text-lg font-bold">Dashboard</div>
                <button id="menuToggle" class="text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div> -->

            <!-- Sidebar for desktop -->
            <div id="sidebar" class="dashboard-sidebar-desktop-wrapper">
                <ul class="flex flex-col dashboard-sidebar-options text-secondaryText">
                    <li class="u-sidebar-value rounded-t-md hover:rounded-t-md" data-page="dashboard"
                        onclick="loadPage('dashboard')">
                        <i class="fa-regular fa-address-card ud-icon-left"></i>
                        <i class="fa-solid fa-arrow-right-long"></i>
                        <label for="dashboard" class="dashboard-sidebar-title">Dashboard</label><br>
                        <span class="dashboard-sidebar-sub-title">Summary of your account</span>
                    </li>
                    <li class="u-sidebar-value" data-page="myAdverts" onclick="loadPage('myAdverts')">
                        <i class="fa-solid fa-rectangle-ad ud-icon-left"></i>
                        <i class="fa-solid fa-arrow-right-long"></i>
                        <label for="myAdvert" class="dashboard-sidebar-title">My adverts</label><br>
                        <span class="dashboard-sidebar-sub-title">Products you are selling</span>
                    </li>
                    <li class="u-sidebar-value" data-page="myMessages" onclick="loadPage('myMessages')">
                        <i class="fa-regular fa-envelope ud-icon-left"></i>
                        <i class="fa-solid fa-arrow-right-long"></i>
                        <label for="myAdvert" class="dashboard-sidebar-title">My messages</label><br>
                        <span class="dashboard-sidebar-sub-title">Send and receive messages</span>
                    </li>
                    <li class="u-sidebar-value" data-page="myNotifications" onclick="loadPage('myNotifications')">
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
                        <label for="myAdvert" class="dashboard-sidebar-title">Orders</label><br>
                        <span class="dashboard-sidebar-sub-title">Manage all your orders</span>
                    </li>
                    <li class="u-sidebar-value" data-page="myExhibitions" onclick="loadPage('myExhibitions')">
                        <i class="fa-solid fa-shop ud-icon-left"></i>
                        <i class="fa-solid fa-arrow-right-long"></i>
                        <label for="myAdvert" class="dashboard-sidebar-title">Exhibitions</label><br>
                        <span class="dashboard-sidebar-sub-title">Manage your exhibitions</span>
                    </li>
                    <li class="u-sidebar-value" data-page="myStore" onclick="loadPage('myStore')">
                        <i class="fa-solid fa-store ud-icon-left"></i>
                        <i class="fa-solid fa-arrow-right-long"></i>
                        <label for="store" class="dashboard-sidebar-title">My Store</label><br>
                        <span class="dashboard-sidebar-sub-title">Manage your store</span>
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
                </ul>
            </div>

            <!-- Main Content -->
            <div class="u-dashboard-content-wrapper">
                <!-- Dashboard page -->
                <div id="dashboard" class="ud-page-wrapper ">
                    <div class="p-6 bg-white rounded shadow ud-dashboard-page">
                        <div class="flex">
                            <div class="ud-profile-image-wrapper">
                                <img src="{{ asset('https://png.pngtree.com/png-clipart/20230927/original/pngtree-man-avatar-image-for-profile-png-image_13001877.png') }}"
                                    alt="profile image" class="ud-profile-image">
                            </div>
                            <div class="pl-2 ml-3">
                                <h2 class="text-[40px] font-bold text-customBrown font-mainText">Hello!
                                    {{ ucfirst(explode(' ', Auth::user()->name)[0]) }}</h2>
                                <div class="flex gap-10 text-[#252a34] mb-4 font-secondaryText">
                                    <p class="mt-2"><i class="mr-2 fa-regular fa-user"></i>{{ Auth::user()->name }}</p>
                                    <p class="mt-2"><i class="mr-2 fa-regular fa-envelope"></i>{{ Auth::user()->email }}
                                    </p>
                                    <p class="mt-2"><i class="mr-2 fa-regular fa-calendar"></i>Member since
                                        {{ Auth::user()->created_at->format('d M Y') }}</p>
                                </div>
                                <button class="ud-btn font-secondaryText" onclick="loadPage('personalDetails')">Edit my
                                    details</button>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-white rounded shadow ud-dashboard-page">
                        <h2 class="text-[40px] font-bold text-customBrown font-mainText">Looking to sell your arts &
                            crafts?</h2>
                        <div class="flex gap-10 text-[#252a34] mb-4 font-secondaryText">
                            <p class="mt-2">Make more money by selling your unique products with Artisan.lk!</p>
                        </div>
                        <a href="{{ route('product.create') }}" class="ud-btn font-secondaryText">Create your advert</a>
                    </div>

                    <div class="p-6 bg-white rounded shadow ud-dashboard-page">
                        <h2 class="text-[40px] font-bold text-customBrown font-mainText"> Find Arts & Crafts Exhibitions
                        </h2>
                        <div class="flex gap-10 text-[#252a34] mb-4 font-secondaryText">
                            <p class="mt-2">Discover the best arts and crafts exhibitions in Sri Lanka, showcasing local
                                talent and creativity.</p>
                        </div>
                        <a href="{{ route('pages.shop') }}" class="ud-btn font-secondaryText">Browse exhibitions</a>
                    </div>
                </div>

                <!-- My advert page -->
                <div id="myAdverts" class=" ud-page-wrapper hidden">
                    <x-compo.search :text="'Status'" :options="['all' => 'All', 'live' => 'Live', 'rejected' => 'Rejected']" :keyword="request('keyword', '')" :placeholder="'Search adverts...'" />

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @forelse ($products as $product)
                        <div class="mb-4">
                            <x-vendor.vendor-ad :product="$product" />
                        </div>
                    @empty
                        <div class="ud-empty-body">
                            <i class="fa-solid fa-magnifying-glass text-[#6C757D] text-[80px]"></i>
                            <h2 class="text-[#6C757D] text-[40px] font-bold">No adverts found</h2>
                            <span class="text-[#6C757D]">We couldn't find any records. Try changing search filters</span>
                            <a href="{{ route('product.create') }}"
                                class="border border-customBrown text-customBrown px-7 py-2 rounded-[50px] hover:shadow-4xl hover:bg-customBrown hover:text-white transition-all duration-300 ease-in-out">Create
                                a new advert</a>
                        </div>
                    @endforelse
                </div>

                <!-- messages -->
                <div id="myMessages" class="hidden p-6 bg-white rounded shadow ud-page-wrapper">
                    <h2 class="text-2xl font-bold text-blue-900">Messages</h2>
                    @livewire('vendor-chat')
                </div>

                <!-- notifications -->
                <div id="myNotifications" class="ud-page-wrapper hidden">
                    <h2 class="text-2xl font-bold text-blue-900">My Notifications</h2>
                    <ul>
                        @forelse (Auth::user()->notifications as $notification)
                            <x-notification.notification-card :notification="$notification" />
                        @empty
                            <p class="text-gray-500">No notifications found.</p>
                        @endforelse
                    </ul>
                </div>

                <!-- orders -->
                <div id="myOrders" class="ud-page-wrapper hidden">
                    <x-compo.search :text="'Orders'" :options="[
                        'all' => 'All Orders',
                        'pending' => 'Pending',
                        'accepted' => 'Accepted',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                    ]" :keyword="request('keyword', '')" :placeholder="'Search orders...'" />

                    @forelse ($orders as $order)
                        @foreach ($order->orderItems as $orderItem)
                            <div class="mb-4">
                                <x-vendor.vendor-order :order="$order" :orderItem="$orderItem" :product="$orderItem->product" />
                            </div>
                        @endforeach
                    @empty
                        <div class="ud-empty-body">
                            <i class="fa-solid fa-magnifying-glass text-[#6C757D] text-[80px]"></i>
                            <h2 class="text-[#6C757D] text-[40px] font-bold">No orders found</h2>
                            <span class="text-[#6C757D]">We couldn't find any records. Try changing search filters</span>
                        </div>
                    @endforelse
                </div>

                <!-- exhibitions -->
                <div id="myExhibitions" class="ud-page-wrapper hidden">
                    <div class="p-6 bg-white rounded shadow mb-4">
                        <h2 class="text-2xl font-bold text-blue-900">My Exhibitions</h2>
                        <a href="{{ route('exhibition.create') }}" class="ud-btn">Create new exhibition</a>
                    </div>
                    @forelse($exhibitions as $exhibition)
                        <livewire:vendor.exhition-card :exhibition-id="$exhibition->id" />
                    @empty
                        <div class="ud-empty-body">
                            <i class="fa-solid fa-magnifying-glass text-[#6C757D] text-[80px]"></i>
                            <h2 class="text-[#6C757D] text-[40px] font-bold">No exhibition found</h2>
                            <span class="text-[#6C757D]">We couldn't find any records. Try create new exhibition
                                post.</span>
                            <a href="{{ route('exhibition.create') }}"
                                class="border bg-customRed text-customBrown px-7 py-2 rounded-[50px] hover:shadow-4xl transition-all duration-300 ease-in-out">Create
                                a new advert</a>
                        </div>
                    @endforelse
                </div>

                <!-- saved Ad -->
                <div id="savedAdverts" class="hidden ud-page-wrapper">
                    <x-compo.search :text="'Category'" :options="['' => 'All'] + $categories->pluck('name', 'id')->toArray()" :keyword="request('keyword', '')" :placeholder="'Search saved ads...'" />

                    <x-user.saved-ad />
                </div>

                <!-- Store -->
                <div id="myStore" class="hidden p-6 bg-white rounded shadow ud-page-wrapper">
                    <h2 class="text-[50px] font-bold text-customBlue">Store details</h2>
                    <span>Please keep store details up to date. Your store data is stored securely. We do not share
                        information with third parties.</span>
                    <form id="" action="{{ route('vendor.update') }}" method="post" class="mt-4">
                        @csrf

                        <div class="mb-4">
                            <label for="shopName" class="block text-sm font-medium text-gray-700">Display Name / Shop
                                Name</label>
                            <input type="text" name="business_name" id="shopName" placeholder=""
                                value="{{ $vendor->business_name ?? '' }}"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <div class="mb-4">
                            <label for="businessDescription" class="block text-sm font-medium text-gray-700">Business
                                Description</label>
                            <textarea name="business_description" id="businessDescription" placeholder="Enter business description"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ $vendor->business_description ?? '' }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="businessCategory" class="block text-sm font-medium text-gray-700">Business
                                Category</label>
                            <input type="text" name="business_category" id="businessCategory"
                                placeholder="Enter business category" value="{{ $vendor->business_category ?? '' }}"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <div class="mb-4">
                            <label for="businessPhone" class="block text-sm font-medium text-gray-700">Business
                                Phone</label>
                            <input type="text" name="business_phone" id="businessPhone"
                                placeholder="Enter business phone" value="{{ $vendor->business_phone ?? '' }}"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <div class="mb-4">
                            <label for="businessEmail" class="block text-sm font-medium text-gray-700">Business
                                Email</label>
                            <input type="email" name="business_email" id="businessEmail"
                                placeholder="Enter business email" value="{{ $vendor->business_email ?? '' }}"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <div class="mb-4">
                            <label for="businessAddress" class="block text-sm font-medium text-gray-700">Business
                                Address</label>
                            <input type="text" name="business_address" id="businessAddress"
                                placeholder="Enter business address" value="{{ $vendor->business_address ?? '' }}"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <div class="flex justify-between">
                            <button type="submit" id="submitButton" class="bg-blue-500 ud-btn text-red">Update store
                                details</button>
                            <a href="#" class="bg-blue-500 ud-btn text-red">Preview of the store</a>
                        </div>
                    </form>
                </div>

                <!-- My presonal details -->
                <div id="personalDetails" class="hidden p-6 bg-white rounded shadow ud-page-wrapper">
                    <h2 class="text-[50px] font-bold text-customBlue">Your details</h2>
                    <span>Please keep your details up to date. Your personal data is stored securely. We do not share
                        information with third parties.</span>

                    <form id="profileForm" action="{{ route('user-profile.update') }}" method="post" class="mt-4">
                        @csrf

                        <div class="mb-4">
                            <label for="fullName" class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" name="name" id="fullName" placeholder="{{ Auth::user()->name }}"
                                value="{{ old('name', Auth::user()->name) }}"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                            <input type="email" name="email" id="email" placeholder="{{ Auth::user()->email }}"
                                value="{{ old('email', Auth::user()->email) }}"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <div class="mb-4">
                            <label for="mobile" class="block text-sm font-medium text-gray-700">Mobile</label>
                            <input type="number" name="phone" id="mobile" placeholder="Enter your phone number"
                                value="{{ old('phone', Auth::user()->phone) }}" min="0"
                                oninput="this.value = Math.abs(this.value)"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <!-- Profile Images -->
                        <!-- <div class="form-group">
                            <label for="productDescription">Upload Images</label>
                            <div class="sec-box img-up">
                                <div class="image-uploader">
                                    <input type="file" name="images[]" id="image-input" multiple />
                                    <label for="image-input"><i class="fa-solid fa-plus" style="color: grey;"></i><br>Add photo</label>
                                    <div class="image-preview" id="image-preview"></div>
                                </div>
                            </div>
                        </div> -->

                        <div>
                            <button type="submit" id="submitButton" class="bg-blue-500 ud-btn text-red">Save my
                                details</button>
                        </div>
                    </form>
                </div>

                <!-- Account security page -->
                <div id="accountSecurity" class="hidden ud-page-wrapper">
                    <div class="p-6 bg-white rounded shadow ud-security-page">
                        <div class="ud-pw-change">
                            <h2 class="text-[50px] font-bold text-customBlue">Your password</h2>
                            <span>Please make sure to have a secure password with at least 6 characters long.</span>
                            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                                @csrf
                                @method('put')

                                <div>
                                    <x-input-label for="update_password_current_password" :value="__('Current Password')"
                                        class="star" />
                                    <x-text-input id="update_password_current_password" name="current_password"
                                        type="password" class="block w-full mt-1" autocomplete="current-password" />
                                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="update_password_password" :value="__('New Password')" class="star" />
                                    <x-text-input id="update_password_password" name="password" type="password"
                                        class="block w-full mt-1" autocomplete="new-password" />
                                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')"
                                        class="star" />
                                    <x-text-input id="update_password_password_confirmation" name="password_confirmation"
                                        type="password" class="block w-full mt-1" autocomplete="new-password" />
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
                            <span>Once your account is deleted, all of its resources and data will be permanently deleted.
                                Before deleting your account, please download any data or information that you wish to
                                retain.</span>
                        </div>
                        <button type="submit" class="mt-3 ud-btn" x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">Delete my
                            account</button>
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

                                <x-text-input id="password" name="password" type="password" class="block w-3/4 mt-1"
                                    placeholder="{{ __('Password') }}" />

                                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                            </div>

                            <div class="flex justify-end mt-6">
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
                    breadcrumb.textContent =
                        ` / ${page.charAt(0).toUpperCase() + page.slice(1).replace(/([A-Z])/g, ' $1').trim()}`;
                } else {
                    console.error('Breadcrumb element not found.');
                }
            }

            // Load the default page on initial load
            document.addEventListener('DOMContentLoaded', function() {
                loadPage('dashboard');
            });

            document.addEventListener('DOMContentLoaded', function() {
                // Retrieve the redirect section from the server-side session data
                let redirectSection = "{{ session('redirect_section', 'dashboard') }}"; // Default to 'dashboard'

                // Call loadPage with the specified redirect section
                loadPage(redirectSection);
            });


            //change the behaovier in the forms
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
                            document.querySelector('.ud-dashboard-page h2').innerText =
                                `Hello! ${data.user.name.split(' ')[0]}`;
                            document.querySelector('.ud-dashboard-page .fa-user').nextSibling.textContent = data
                                .user.name;
                            document.querySelector('.ud-dashboard-page .fa-envelope').nextSibling.textContent = data
                                .user.email;
                            document.querySelector('.ud-dashboard-page .fa-calendar').nextSibling.textContent =
                                `Member since ${data.user.created_at}`;

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

            // JavaScript to toggle the sidebar on mobile view
            document.getElementById('menuToggle').addEventListener('click', function() {
                var sidebar = document.getElementById('sidebar');
                if (sidebar.style.display === 'block') {
                    sidebar.style.display = 'none';
                } else {
                    sidebar.style.display = 'block';
                }
            });


            // image uploader
        </script>
    </main>

@endsection
