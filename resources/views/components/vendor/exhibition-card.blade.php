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
                <lable class="sub-listing-title">{{ $exhibition->exhibition_name }}</lable>
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
            <!-- <div class="listing-price-label"> -->
                <!-- <label for="vahiclePrice" class="listing-price py-1 px-3 rounded-md" style="color: white; background-color: green; font-size: small;">Active Post</label> -->
                <!-- <label for="vahiclePrice" class="listing-price py-1 px-3 rounded-md" style="color: white; background-color: #A82E23; font-size: small;">Deactivate Post</label> -->
                <!-- <label for="vahiclePrice" class="listing-price py-1 px-3 rounded-md" style="color: white; background-color: rgb(208, 208, 53); font-size: small;">Pending Post</label> -->
                <!-- <label for="vahiclePrice" class="listing-price py-1 px-3 rounded-md" style="color: white; background-color: #A82E23; font-size: small;">Rejected Post</label> -->
                <!-- <label for="vahiclePrice" class="listing-price py-1 px-3 rounded-md" style="color: white; background-color: #A82E23; font-size: small;">Expired Post</label> -->
            <!-- </div> -->
        </div>
        <div class="savedAd-buttons">
            <div class="border-r border-customGray">
                <a href="" class="savedAd-view">
                    <button class="savedAd-view"><i class="fa-regular fa-eye mr-1"></i>View Post</button></a>
            </div>
            <div class="border-l border-customGray flex">
                <a href="" class="remove-button savedAd-delete"><i class="fa-solid fa-pencil mr-1"></i>
                    Update
                </a>
                <a href="" class="remove-button savedAd-delete border-l"><i class="fa-solid fa-toggle-off mr-1"></i>
                    Deactivate
                </a>
                <!-- <a href="" class="remove-button savedAd-delete border-l"><i class="fa-solid fa-toggle-on mr-1"></i>
                    Activate
                </a> -->
                <a href="" class="remove-button savedAd-delete border-l"><i class="fa-regular fa-trash-can mr-1"></i>
                    Delete
                </a>
            </div>
        </div>
    </div>
</section>