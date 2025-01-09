<div class="p-4">
    <!-- Search Bar -->
    <div class="flex items-center mb-4 space-x-4">
        <select wire:model="selectedCategory" class="px-4.5 py-2 text-black bg-gray-800 rounded-md">
            <option value="all">All Categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <input
            type="text"
            wire:model.live="search"
            placeholder="Search products..."
            class="w-full px-4 py-2 text-black bg-gray-800 rounded-md focus:outline-none"
            autofocus
        />
        <button onclick="toggleSearchModal()" class="text-2xl text-white">&times;</button>
    </div>

    <!-- Search Results -->
    <div>
        @if (!empty($products) && count($products) > 0)
        <h2 class="text-lg font-bold"> Products</h2>
            <div class="grid grid-cols-4 gap-4">
                @foreach ($products as $product)
                <a href="{{ route('pages.product-display', ['id' => $product->id]) }}" class="card">
                    <div class="p-4 bg-gray-800 rounded-md">
                        <img 
                            src="/images/{{ json_decode($product->productImages)[0] ?? 'default.jpg' }}" 
                            alt="{{ $product->productName }}" 
                            class="object-cover w-full h-32 rounded-md"
                        >
                        <h3 class="mt-2 font-bold">{{ $product->productName }}</h3>
                        <p class="text-sm">Rs. {{ number_format($product->productPrice) }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">Enter a keyword or select a category to search.</p>
        @endif
    </div>





</div>
