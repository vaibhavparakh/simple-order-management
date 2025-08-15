@extends('layouts.app')

@section('content')
<div class="container my-3">
    <!-- show session message here -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h2>Products List</h2>
    <div class="mb-3">
        <a href="{{ route('admin.products.create') }}" class="btn btn-success">Add New Product</a>
    </div>
    <table class="table table-bordered" id="products-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock Quantity</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr id="order-row-{{ $product->id }}">
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>Rs. {{ $product->price }}</td>
                <td>{{ $product->stock_quantity }}</td>
                <td class="order-status">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 100px;">
                </td>
                <td>
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection