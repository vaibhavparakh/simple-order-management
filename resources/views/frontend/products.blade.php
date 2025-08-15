@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="mb-3 text-end">
        <a href="{{ route('cart.index') }}" class="btn btn-primary">
            Go to Cart
        </a>
    </div>
    <h1 class="mb-4">Products</h1>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    @else
                        <img src="https://via.placeholder.com/300x200?text=No+Image" class="card-img-top" alt="No Image">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <div class="mt-auto">
                            <span class="fw-bold text-primary">₹{{ number_format($product->price, 2) }}</span>
                            <button class="btn btn-success btn-sm float-end add-to-cart-btn" data-id="{{ $product->id }}">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection