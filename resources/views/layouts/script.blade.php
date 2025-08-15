<script>
    $(document).ready(function() {
        $('.add-to-cart-btn').click(function() {
            var productId = $(this).data('id');
            var btn = $(this);
            $.ajax({
                url: '{{ route("cart.add") }}',
                type: 'POST',
                data: { product_id: productId },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    btn.text('Added').removeClass('btn-success').addClass('btn-secondary').prop('disabled', true);
                },
                error: function() {
                    alert('Failed to add to cart. Please try again.');
                }
            });
        });

        $('.remove-from-cart').click(function() {
            var productId = $(this).data('id');
            var btn = $(this);
            $.ajax({
                url: '{{ route("cart.remove") }}',
                type: 'POST',
                data: { product_id: productId },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    btn.closest('tr').remove();
                },
                error: function() {
                    alert('Failed to remove from cart. Please try again.');
                }
            });
        });

        $('.update-quantity').change(function() {
            var productId = $(this).closest('tr').find('.remove-from-cart').data('id');
            var quantity = $(this).val();
            $.ajax({
                url: '{{ route("cart.update") }}',
                type: 'POST',
                data: { product_id: productId, quantity: quantity },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    location.reload();
                },
                error: function() {
                    alert('Failed to update cart. Please try again.');
                }
            });
        });
    });
</script>