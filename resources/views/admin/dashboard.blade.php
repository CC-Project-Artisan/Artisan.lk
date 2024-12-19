<!-- Vendor Dashboard -->
@extends('layouts.frontend')
@section('pages')

<div class="breadcrumb-bar">
    <div class="breadcrumb-title float-right">
        Artisan.lk Admin Center
    </div>
</div>
<main class="user-dashboard-main-container" style="margin-top: 2%;">
    <!-- upper section -->
    <div class="dashboard-path-wrapper">
        <!-- Breadcrumb -->
        <div class="text-sm text-customGray font-secondaryText mb-4 py-2">
            <a href="#" class="text-customBrown  hover:underline" onclick="loadPage('dashboard')">Dashboard</a>
            <span id="breadcrumb"> / Dashboard</span>
        </div>
        <!-- Sign out btn -->
        <div class="text-sm mb-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')" class="text-customGray hover:underline"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Sign out') }} <i class="fa-solid fa-arrow-right-from-bracket ml-1"></i>
                </x-dropdown-link>
            </form>
        </div>
    </div>

    <!-- Dashboard -->
    <div class="user-dashboard-wrapper">
        <!-- Navbar for mobile -->
        <!-- <div class="bg-customBlue text-white p-4 flex justify-between items-center lg:hidden ">
            <div class="text-lg font-bold">Dashboard</div>
            <button id="menuToggle" class="text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div> -->



        <!-- Sidebar for desktop -->
        <div id="sidebar" class="dashboard-sidebar-desktop-wrapper">
            <ul class="dashboard-sidebar-options flex flex-col text-secondaryText">
                <li class="u-sidebar-value rounded-t-md hover:rounded-t-md" data-page="dashboard" onclick="loadPage('dashboard')">
                    <i class="fa-regular fa-address-card ud-icon-left"></i>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    <label for="dashboard" class="dashboard-sidebar-title">Dashboard</label><br>
                    <span class="dashboard-sidebar-sub-title">Summary of your account</span>
                </li>
                <li class="u-sidebar-value" data-page="listings" onclick="loadPage('listings')">
                    <i class="fa-solid fa-rectangle-ad ud-icon-left"></i>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    <label for="listings" class="dashboard-sidebar-title">Advertisments</label><br>
                    <span class="dashboard-sidebar-sub-title">Manage all advertisments</span>
                </li>
                <li class="u-sidebar-value" data-page="users" onclick="loadPage('users')">
                    <i class="fa-solid fa-users-viewfinder ud-icon-left"></i>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    <label for="users" class="dashboard-sidebar-title">Users</label><br>
                    <span class="dashboard-sidebar-sub-title">Manage all users</span>
                </li>
                <li class="u-sidebar-value" data-page="admin" onclick="loadPage('admin')">
                    <i class="fa-solid fa-user-tie ud-icon-left"></i>
                    <i class=" fa-solid fa-arrow-right-long"></i>
                    <label for="admin" class="dashboard-sidebar-title">Admin</label><br>
                    <span class="dashboard-sidebar-sub-title">Manage all admins</span>
                </li>
                <li class="u-sidebar-value" data-page="category" onclick="loadPage('category')">
                    <i class="fa-solid fa-list ud-icon-left"></i>
                    <i class=" fa-solid fa-arrow-right-long"></i>
                    <label for="admin" class="dashboard-sidebar-title">Categories</label><br>
                    <span class="dashboard-sidebar-sub-title">Manage all product categories</span>
                </li>
                <li class="u-sidebar-value" data-page="exhibitions" onclick="loadPage('exhibitions')">
                    <i class="fa-solid fa-shop ud-icon-left"></i>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    <label for="myAdvert" class="dashboard-sidebar-title">Exhibitions</label><br>
                    <span class="dashboard-sidebar-sub-title">Manage all exhibitions</span>
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

                <div>
                    <div class="plt-summery">
                        <a onclick="loadPage('exhibitions')">
                            <div class="plt-summery-lists">
                                <div class="absolute top-2 left-2">
                                    <p class="summery-title">Total Exhibitions</p>
                                </div>
                                <div class="flex justify-center items-center h-full">
                                    <p class="summary-amount">100</p>
                                </div>
                                <div class="summery-icon">
                                    <i class="fa-solid fa-signal"></i>
                                </div>
                            </div>
                        </a>
                        <a onclick="loadPage('exhibitions')">
                            <div class="plt-summery-lists">
                                <div class="absolute top-2 left-2">
                                    <p class="summery-title">Pending Exhibitions</p>
                                </div>
                                <div class="flex justify-center items-center h-full">
                                    <p class="summary-amount">100</p>
                                </div>
                                <div class="summery-icon">
                                    <i class="fa-solid fa-hourglass-half"></i>
                                </div>
                            </div>
                        </a>
                        <a onclick="loadPage('listings')">
                            <div class="plt-summery-lists">
                                <div class="absolute top-2 left-2">
                                    <p class="summery-title">Total Listings</p>
                                </div>
                                <div class="flex justify-center items-center h-full">
                                    <p class="summary-amount">100</p>
                                </div>
                                <div class="summery-icon">
                                    <i class="fa-solid fa-clipboard-check"></i>
                                </div>
                            </div>
                        </a>
                        <a onclick="loadPage('users')">
                            <div class="plt-summery-lists">
                                <div class="absolute top-2 left-2">
                                    <p class="summery-title">Total Users</p>
                                </div>
                                <div class="flex justify-center items-center h-full">
                                    <p class="summary-amount">{{ $totalUsers }}</p>
                                </div>
                                <div class="summery-icon">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- listings page -->
            <div id="listings" class="ud-page-wrapper hidden">
                <x-compo.search
                    :text="'Category'"
                    :options="['all' => 'All', 'vendor' => 'Vendor', 'user' => 'User']"
                    :keyword="request('keyword', '')"
                    :placeholder="'Search adverts...'" />
                <x-admin.admin-listings />
                <!-- <div class="ud-empty-body">
                    <i class="fa-solid fa-magnifying-glass text-[#6C757D] text-[80px]"></i>
                    <h2 class="text-[#6C757D] text-[40px] font-bold">No adverts found</h2>
                    <span class="text-[#6C757D]">We couldn't find any records. Try changing search filters</span>
                    <a href="./createAds.php" class="border bg-customRed text-white px-7 py-2 rounded-[50px] hover:shadow-4xl transition-all duration-300 ease-in-out">Create a new advert</a>
                </div> -->
            </div>

            <!-- users -->
            <div id="users" class="ud-page-wrapper hidden">

                <x-compo.search
                    :text="'User'"
                    :options="['all' => 'All', 'vendor' => 'Vendor', 'user' => 'User']"
                    :keyword="request('keyword', '')"
                    :placeholder="'Search users...'" />


                @if(isset($users) && $users->count() > 0)
                @foreach($users as $user)
                @if($user->role === 'user')
                <div class="my-4">
                    <x-admin.admin-user :user="$user" />
                </div>
                @elseif($user->role === 'vendor')
                @php
                $vendor = $vendors->where('user_id', $user->id)->first();
                @endphp
                <div class="my-4">
                    <x-admin.admin-vendor :user="$user" :vendor="$vendor" :categories="$categories" />
                </div>
                @endif
                @endforeach
                @else
                <div class="ud-dashboard-page bg-white p-6 rounded shadow">
                    <h2 class="text-[40px] font-bold text-customBrown font-mainText">Looking to sell your arts & crafts?</h2>
                    <div class="flex gap-10 text-[#252a34] mb-4 font-secondaryText">
                        <p class="mt-2">Make more money by selling your unique products with Artisan.lk!</p>
                    </div>
                    <button class="ud-btn font-secondaryText" onclick="loadPage('selling')">Create vendor profile</button>
                </div>
                @endif
            </div>

            <!-- categories -->
            <div id="category" class="ud-page-wrapper hidden">
                <div class="ud-presonal-page bg-white p-6 rounded shadow">
                    <h2 class="text-[50px] font-bold text-customBlue">Categories</h2>
                    <span>Manage all product categories efficiently by adding, editing, or deleting categories to organize your products effectively.</span>
                    <div class="tab">
                        <button class="tab-link" onclick="openTab(event, 'tab1')">Add Category</button>
                        <button class="tab-link" onclick="openTab(event, 'tab2')">Manage Category</button>
                    </div>

                    <div id="tab1" class="tab-content">
                        <x-admin.category-form />
                    </div>
                </div>
                <div id="tab2" class="tab-content mt-3">
                    <div class="ud-advert-keyword-wrapper bg-white p-6 mb-3 rounded shadow-inner">
                        <p class="mt-2 mb-2"></i>Keyword</p>
                        <div class="flex">
                            <x-compo.input value="" type="text" placeholder="Search category..." class="ud-advert-keyword-input" />
                            <a href="#"><i class="ud-advert-keyword-search fa-solid fa-magnifying-glass"></i></a>
                        </div>
                    </div>
                    @if(isset($categories) && $categories->count() > 0)
                    @foreach($categories as $category)
                    <div class="my-4">
                        <x-admin.admin-category :category="$category" />
                    </div>
                    @endforeach
                    @else
                    <p>No categories available.</p>
                    @endif
                </div>
            </div>

            <!-- admin -->
            <div id="admin" class="ud-page-wrapper bg-white p-6 rounded shadow hidden">
                <div class="ud-presonal-page">
                    <div class="ud-pro-change">
                        <h2 class="text-[50px] font-bold text-customBlue">Add admin</h2>
                        <span>Fill out the form below to add a new admin. Ensure that all information is accurate and complete.</span>
                        <form action="{{ route('admin.create') }}" method="POST" class="mt-4">
                            @csrf
                            <div class="mb-4">
                                <span class="required"></span>
                                <label for="fullName" class="block text-sm font-medium text-gray-700 required">Full Name<span class="star"></span></label>
                                <x-compo.input type="text" name="admName" placeholder="Enter admin name" required />
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700 required">Email address<span class="star"></span></label>
                                <x-compo.input type="text" name="admEmail" placeholder="Enter admin email" required />
                            </div>
                            <div class="mb-4">
                                <label for="password" class="block text-sm font-medium text-gray-700 required">Password<span class="star"></span></label>
                                <x-compo.input type="password" name="admPwd" placeholder="Enter password" required />
                            </div>
                            <div class="mb-4">
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 required">Confirm Password<span class="star"></span></label>
                                <x-compo.input type="password" name="admPwd_confirmation" placeholder="Enter repeat password" required />
                            </div>
                            <button type="submit" class="ud-btn">Add admin</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- exhibitions -->
            <div id="exhibitions" class="ud-page-wrapper hidden">
                <x-compo.search
                    :text="'Status'"
                    :options="['all' => 'All', 'live' => 'Live', 'pending' => 'Pending', 'rejected' => 'Rejected', 'expired' => 'Expired']"
                    :keyword="request('keyword', '')"
                    :placeholder="'Search exhibitions...'" />

                <div>
                    @if(isset($exhibitions) && $exhibitions->count() > 0)
                    @foreach ($exhibitions as $exhibition)
                    <div class="my-4">
                        <x-admin.exhibition-card
                            :exhibition="$exhibition"
                            :vendor="$vendor"
                            :categories="$categories"
                            :exhibitionContacts="$exhibitionContacts"
                            :exhibitionEmails="$exhibitionEmails" />
                    </div>
                    @endforeach

                    <!-- Pagination Links -->
                    <div class="pagination-container">
                        {{ $exhibitions->links() }}
                    </div>
                    @else
                    <div class="ud-empty-body">
                        <i class="fa-solid fa-magnifying-glass text-[#6C757D] text-[80px]"></i>
                        <h2 class="text-[#6C757D] text-[40px] font-bold">No exhibitions found</h2>
                        <span class="text-[#6C757D]">We couldn't find any records. Try changing search filters</span>
                    </div>
                    @endif
                </div>


            </div>

            <!-- My presonal details -->
            <div id="personalDetails" class="ud-page-wrapper bg-white p-6 rounded shadow hidden">
                <h2 class="text-[50px] font-bold text-customBlue">Your details</h2>
                <span>Please keep your details up to date. Your personal data is stored securely. We do not share information with third parties.</span>

                <form id="profileForm" action="{{ route('user-profile.update') }}" method="post" class="mt-4">
                    @csrf

                    <div class="mb-4">
                        <label for="fullName" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" name="name" id="fullName" placeholder="{{ Auth::user()->name }}" value="{{ old('name', Auth::user()->name) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                        <input type="email" name="email" id="email" placeholder="{{ Auth::user()->email }}" value="{{ old('email', Auth::user()->email) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="mobile" class="block text-sm font-medium text-gray-700">Mobile</label>
                        <input type="number" name="phone" id="mobile" placeholder="Enter your phone number" value="{{ old('phone', Auth::user()->phone) }}" min="0" oninput="this.value = Math.abs(this.value)" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
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
                        <button type="submit" id="submitButton" class="ud-btn bg-blue-500 text-red">Save my details</button>
                    </div>
                </form>
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
                <div class="ud-security-page bg-white p-6 rounded shadow">
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