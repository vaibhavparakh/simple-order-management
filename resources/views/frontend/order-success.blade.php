@extends('layouts.app')

@section('content')
    <style>
        .order-success-container {
            max-width: 500px;
            margin: 60px auto;
            padding: 40px;
            background: #f8f9fa;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        }
        .order-number {
            font-size: 1.5em;
            color: #28a745;
            margin-bottom: 20px;
        }
        .success-message {
            font-size: 1.2em;
            color: #333;
        }
    </style>
    <div class="order-success-container">
        <div class="order-number">
            Order Number: <strong>{{ $orderNumber }}</strong>
        </div>
        <div class="success-message">
            Your order has been placed successfully!
        </div>
        <div class="mt-4">
            <a href="{{ route('products.catalog') }}" class="btn btn-primary">Continue Shopping</a>
        </div>
    </div>
@endsection
