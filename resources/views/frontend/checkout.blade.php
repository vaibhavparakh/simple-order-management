@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Checkout</h2>
    <form method="POST" action="{{ route('checkout.store') }}">
        @csrf
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="mb-3">
            <label for="customer_name" class="form-label">Name</label>
            <input autofocus type="text" class="form-control" id="customer_name" name="customer_name" required>
            @if($errors->has('customer_name'))
                <div class="text-danger">{{ $errors->first('customer_name') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="customer_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="customer_email" name="customer_email" required>
            @if($errors->has('customer_email'))
                <div class="text-danger">{{ $errors->first('customer_email') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="customer_phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="customer_phone" name="customer_phone" required>
            @if($errors->has('customer_phone'))
                <div class="text-danger">{{ $errors->first('customer_phone') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Total Cart Value</label>
            <input type="text" class="form-control" value="{{ $totalCartValue ?? '0.00' }}" name="total_cart_value" readonly>
        </div>
        <button type="submit" class="btn btn-primary w-100">Place Order</button>
    </form>
</div>
@endsection