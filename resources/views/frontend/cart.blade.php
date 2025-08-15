@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="mb-3 text-end">
        <a href="{{ route('products.catalog') }}" class="btn btn-secondary">
            Back to Products
        </a>
    </div>
    <h2 class="mb-4">Shopping Cart</h2>
    @if(session('cart') && count(session('cart')) > 0)
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach(session('cart') as $id => $item)
                    @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>Rs.{{ number_format($item['price'], 2) }}</td>
                        <td>
                            <input type="number" value="{{ $item['quantity'] }}" min="1" class="form-control update-quantity" style="width:80px;">
                        </td>
                        <td>Rs.{{ number_format($subtotal, 2) }}</td>
                        <td>
                            <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}">Remove</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-between align-items-center">
            <h4>Total: Rs.{{ number_format($total, 2) }}</h4>
            <a href="{{ route('checkout.index') }}" class="btn btn-success">Proceed to Checkout</a>
        </div>
    @else
        <div class="alert alert-info">Your cart is empty.</div>
    @endif
</div>
@endsection