<script>
    $(document).ready(function() {
        // 1. Global AJAX Setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // 2. Toastr Notification Helper
        function notify(response) {
            if (response.status === 'success') {
                toastr.success(response.message);
                if (response.cart_count !== undefined) $('.cart-count').text(response.cart_count);
                if (response.wishlist_count !== undefined) $('.wishlist-count').text(response.wishlist_count);
                if (response.compare_count !== undefined) $('.compare-count').text(response.compare_count);
            } else {
                toastr.error(response.message || "Something went wrong");
            }
        }

        // 3. Shop Filtering Logic
        function fetchFilteredProducts(page = 1) {
            let selectedBrands = [];
            let selectedColors = [];
            let selectedAttributes = [];
            let currentSlug = $('input[name="current_slug"]').val();

            $('.filter-brand:checked').each(function() { selectedBrands.push($(this).val()); });
            $('.filter-color:checked').each(function() { selectedColors.push($(this).val()); });
            $('.filter-attribute:checked').each(function() { selectedAttributes.push($(this).val()); });

            $.ajax({
                url: "{{ route('shop.filter') }}?page=" + page,
                method: "POST",
                data: {
                    brand_ids: selectedBrands,
                    attribute_values: selectedAttributes,
                    color_ids: selectedColors,
                    current_slug: currentSlug,
                    min_price: $('#min_price').val(),
                    max_price: $('#max_price').val(),
                    sortby: $('#sortby').val(),
                },
                beforeSend: function() {
                    $('#product-list').hide();
                    $('#skeleton-loader').show();
                },
                success: function(response) {
                    $('#product-list').html(response.html);
                    $('.paginatoin-area').html(response.pagination);
                },
                complete: function() {
                    $('#skeleton-loader').hide();
                    $('#product-list').show();
                }
            });
        }

        // Filter Events
        $('.filter-brand, .filter-attribute, .filter-color, #sortby').on('change', fetchFilteredProducts);
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            fetchFilteredProducts($(this).attr('href').split('page=')[1]);
        });
        
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            fetchFilteredProducts(page);
        });
        $('.price-range').on('slidechange', function(event, ui) {
            $('#min_price').val(ui.values[0]); // Update min price
            $('#max_price').val(ui.values[1]); // Update max price
            fetchFilteredProducts(); // Fetch products
        });

        // 4. E-commerce Actions (Cart, Wishlist, Compare)
        $(document).on('click', '.add-to-cart-btn', function(e) {
            e.preventDefault();
            $.post("{{ route('addToCart') }}", { product_id: $(this).data('id'), pro_qty: 1 }, notify);
        });

        $(document).on('click', '.add-to-wishlist', function(e) {
            e.preventDefault();
            $.post("{{ route('wishlist.add') }}", { product_id: $(this).data('id') }, notify);
        });

        $(document).on('click', '.add-to-compare', function(e) {
            e.preventDefault();
            $.post("{{ route('compare.add') }}", { product_id: $(this).data('id') }, notify);
        });
    });
</script>