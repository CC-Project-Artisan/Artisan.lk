<section class="sub-listing-container">
    <div class="sub-listing-content">
        <div class="sub-listing-content-up">
            <div class="main-img-wrapper">
                <img src="{{ asset('images/' . json_decode($product->productImages)[0]) }}" alt="Product Image" class="savedimg">
            </div>
            <div class="sub-listing-info">
                <label class="sub-listing-title">{{ $product->productName }}</label>
                <div class="sub-listing-features-container">
                    <div class="sub-listing-features">
                        <div class="grid grid-cols-1 mt-3 sm:grid-cols-2 gap-y-5 gap-x-10">
                            <div class="sub-listing-feature">
                                <label>Product ID:</label>
                                <span>{{ $product->id }}</span>
                            </div>
                            <div class="sub-listing-feature">
                                <label>Category:</label>
                                <span>{{ $product->category->name }}</span>
                            </div>
                            <div class="sub-listing-feature">
                                <label>Quantity:</label>
                                <span>{{ $product->productQuantity }}</span>
                            </div>
                            <div class="sub-listing-feature">
                                <label>Weight:</label>
                                <span>{{ $product->weight }}</span>
                            </div>
                            <div class="sub-listing-feature">
                                <label>Created At:</label>
                                <span>{{ $product->created_at }}</span>
                            </div>
                            <div class="sub-listing-feature">
                                <label>Dimensions:</label>
                                <span>{{ $product->dimensions }}</span>
                            </div>
                            <div class="sub-listing-feature">
                                <label>Updated At:</label>
                                <span>{{ $product->updated_at }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="listing-price-label">
                <label for="vehiclePrice" class="listing-price">Rs. {{ $product->productPrice }}/=</label>
            </div>
        </div>
        
        <div class="savedAd-buttons">
            <div class="border-r border-customGray">
                <a href="" class="savedAd-view">
                <button class="savedAd-view"><i class="mr-1 fa-regular fa-eye"></i>View advert</button></a>
            </div>

            <div class="flex border-l border-customGray">
                <a href="{{ route('vendor.products.edit', $product->id) }}" class="remove-button savedAd-delete">
                    <i class="mr-1 fa-solid fa-pencil"></i>Update
                </a>
            
           
                <form action="{{ route('vendor.products.delete', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="border-l remove-button savedAd-delete">
                        <i class="mr-1 fa-regular fa-trash-can"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>


<style>
    .alert {
        padding: 10px 20px;
        margin: 10px 0;
        border-radius: 5px;
        font-size: 14px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const alerts = document.querySelectorAll('.alert');
        setTimeout(() => {
            alerts.forEach(alert => alert.style.display = 'none');
        }, 2000); 
    });

</script>
