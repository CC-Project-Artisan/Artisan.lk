<div class="mb-4">
    <section class="sub-listing-container">
        <div class="sub-listing-content">
            <div class="sub-listing-content-up">
                <div class="main-img-wrapper">
                    @if($exhibition->exhibitionBanner)
                    @php
                    $banners = json_decode($exhibition->exhibitionBanner, true);
                    $firstBanner = $banners[0] ?? null;
                    @endphp
                    @if($firstBanner)
                    <img src="{{ asset('images/' . $firstBanner) }}"
                        alt="{{ $exhibition->exhibition_name }}"
                        class="savedimg object-cover w-full h-full">
                    @else
                    <img src="{{ asset('images/default-banner.jpg') }}"
                        alt="Default Exhibition Banner"
                        class="savedimg object-cover w-full h-full">
                    @endif
                    @else
                    <img src="{{ asset('images/default-banner.jpg') }}"
                        alt="Default Exhibition Banner"
                        class="savedimg object-cover w-full h-full">
                    @endif
                </div>
                <div class="sub-listing-info">
                    <div class="flex justify-between items-start">
                        <lable class="sub-listing-title">{{ $exhibition->exhibition_name }}</lable>
                        @if($exhibition->status === 'approved')
                        @if($exhibition->isActive)
                        <label for="active" class="status-label py-1 px-3 rounded-md float-right mr-3" style="color: white; background-color: green; font-size: medium;">Active Post</label>
                        @else
                        <label for="deactive" class="status-label py-1 px-3 rounded-md float-right mr-3" style="color: white; background-color: #A82E23; font-size: medium;">Deactivated Post</label>
                        @endif
                        @elseif($exhibition->status === 'pending')
                        <label for="pending" class="status-label py-1 px-3 rounded-md float-right mr-3" style="color: white; background-color: rgb(208, 208, 53); font-size: medium;">Pending Post</label>
                        @elseif($exhibition->status === 'rejected')
                        <label for="rejected" class="status-label py-1 px-3 rounded-md float-right mr-3" style="color: white; background-color: #A82E23; font-size: medium;">Rejected Post</label>
                        @elseif($exhibition->status === 'expired')
                        <label for="expired" class="status-label py-1 px-3 rounded-md float-right mr-3" style="color: white; background-color: #A82E23; font-size: medium;">Expired Post</label>
                        @endif
                    </div>
                    <div class="sub-listing-features-container">
                        <div class="sub-listing-features">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-5 gap-x-10 mt-3">
                                <div class="sub-listing-feature">
                                    <label class="sub-listing-feature-value">Title: {{ $exhibition->exhibition_name }}</label>
                                </div>
                                <div class="sub-listing-feature">
                                    <label class="sub-listing-feature-value">Category: {{ $exhibition->category_name }}</label>
                                </div>
                                <div class="sub-listing-feature">
                                    <label class="sub-listing-feature-value">Location: {{ $exhibition->exhibition_location }}</label>
                                </div>
                                <div class="sub-listing-feature">
                                    <label class="sub-listing-feature-value">Date: {{ \Carbon\Carbon::parse($exhibition->exhibition_date)->format('d M Y') }}</label>
                                </div>
                                <div class="sub-listing-feature">
                                    <label class="sub-listing-feature-value">Posted At: {{ \Carbon\Carbon::parse($exhibition->created_at)->format('d M Y') }}</label>
                                </div>
                                <div class="sub-listing-feature">
                                    <label class="sub-listing-feature-value">Time: {{ \Carbon\Carbon::parse($exhibition->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($exhibition->end_time)->format('h:i A') }}</label>
                                </div>
                                <div class="sub-listing-feature">
                                    <label class="sub-listing-feature-value">Updated At: {{ \Carbon\Carbon::parse($exhibition->updated_at)->format('d M Y') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Display Flash Message -->
            @if (session()->has('message'))
            <div id="flash-message" class="alert alert-success ehibition-status-mg">
                {{ session('message') }}
            </div>
            @endif
            <div class="savedAd-buttons">
                <div class="border-r border-customGray">
                    <a href="" class="savedAd-view">
                        <button class="savedAd-view"><i class="fa-regular fa-eye mr-1"></i>View Post</button></a>
                </div>
                <div class="border-l border-customGray flex">

                    @if($status === 'approved')
                    <!-- Update btn -->
                    <a href="#" wire:click.prevent="editExhibition" class="remove-button savedAd-delete">
                        <i class="fa-solid fa-pencil mr-1"></i>Update
                    </a>
                    <!-- Activate/Deactivate Buttons -->
                    <button wire:click="toggleActiveStatus" type="submit" class="remove-button savedAd-delete border-l">
                        <i class="{{ $isActive ? 'fa-solid fa-toggle-off mr-1' : 'fa-solid fa-toggle-on mr-1' }}"></i>{{ $isActive ? 'Deactivate' : 'Activate' }} Post
                    </button>
                    @endif

                    <!-- Delete btn -->
                    <button wire:click="deleteExhibition" class="remove-button savedAd-delete border-l"><i class="fa-regular fa-trash-can mr-1"></i>
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>