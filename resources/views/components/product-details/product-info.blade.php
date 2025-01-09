<div class="mt-8 product-tabs-container">
    <div class="flex flex-col mb-4 border-b product-tabs-header lg:flex-row">
        <button class="tab-button active" data-tab="description" onclick="showTab('description')">
            DESCRIPTION
        </button>
        <button class="tab-button" data-tab="additional" onclick="showTab('additional')">
            ADDITIONAL INFORMATION
        </button>
        <button class="tab-button" data-tab="vendor-profile" onclick="showTab('vendor-profile')">
            VENDOR CHAT
        </button>
        <button class="tab-button" data-tab="reviews" onclick="showTab('reviews')">
            REVIEWS (1)
        </button>
    </div>

    <div id="description" class="product-tab-content">
        <p>
            {{ $product->productDescription }}
        </p>
    </div>
    <div id="additional" class="hidden product-tab-content">
        <p>
        <h1> Dimenstions </h1>
        {{ $product->dimensions }}
        </p>
    </div>
    <div id="vendor-profile" class="hidden product-tab-content">
        @auth
            @if ($product->user_id && $product->user_id != auth()->id())
                @livewire('chat', ['receiverId' => $product->user_id])
            @endif
        @endauth
    </div>
    <div id="reviews" class="hidden product-tab-content">
        <p>
            Reviews content goes here.
        </p>
    </div>
</div>

<script>
    function showTab(tab) {
        const buttons = document.querySelectorAll('.tab-button');
        buttons.forEach(button => button.classList.remove('active'));

        const contents = document.querySelectorAll('.product-tab-content');
        contents.forEach(content => content.classList.add('hidden'));

        document.querySelector(`[data-tab="${tab}"]`).classList.add('active');
        document.getElementById(tab).classList.remove('hidden');
    }
</script>
