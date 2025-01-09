@extends('layouts.frontend')
@section('pages')
    <div class="breadcrumb-bar">
        <div class="breadcrumb-title">
            PRODUCT LIST
        </div>
        <div class="breadcrumb-nav">
            <a href="{{ route('welcome') }}">Home</a> &gt; <a href="{{ route('pages.shop') }}">Product List</a> &gt; <a
                href="{{ route('pages.product-display', ['id' => $product->id]) }}">Product Details</a>

        </div>
    </div>
    <br>

    <div class="container px-4 mx-auto">
        <x-product-details.product-detail :product="$product" />
        <x-product-details.product-info :product="$product" />
        {{-- @auth
            @if ($product->user_id && $product->user_id != auth()->id())
                @livewire('chat', ['receiverId' => $product->user_id])
            @endif
        @endauth --}}
    </div>
@endsection
