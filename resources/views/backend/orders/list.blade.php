@extends('layouts.app')

@section('content')
<div class="container my-3">
    <h2>Orders List</h2>
    <table class="table table-bordered" id="orders-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Product</th>
                <th>Total</th>
                <th>Status</th>
                <th>Update Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr id="order-row-{{ $order->id }}">
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>
                    @foreach($order->products as $product)
                        {{ $product->name }}<br>
                    @endforeach
                </td>
                <td>{{ $order->total_price }}</td>
                <td class="order-status">{{ $order->status }}</td>
                <td>
                    <select class="form-control status-select" data-id="{{ $order->id }}">
                        <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Confirmed" {{ $order->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="Shipped" {{ $order->status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.status-select').forEach(function(select) {
        select.addEventListener('change', function() {
            var orderId = this.getAttribute('data-id');
            var newStatus = this.value;
            var row = document.getElementById('order-row-' + orderId);
            fetch('/admin/orders/' + orderId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    row.querySelector('.order-status').textContent = newStatus;
                } else {
                    alert('Failed to update status');
                }
            })
            .catch(() => alert('Error updating status'));
        });
    });
});
</script>
@endsection