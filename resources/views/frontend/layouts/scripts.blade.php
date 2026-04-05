<script>
(function($) {
    "use strict";

    $(document).ready(function() {

        // Force reload on back button to sync cart/session
        if (window.performance && window.performance.navigation.type === 2) {
            location.reload(true);
        }

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
            let selectedBrands = $('.filter-brand:checked').map(function() { return $(this).val(); }).get();
            let selectedColors = $('.filter-color:checked').map(function() { return $(this).val(); }).get();
            let selectedAttributes = $('.filter-attribute:checked').map(function() { return $(this).val(); }).get();
            let currentSlug = $('input[name="current_slug"]').val();

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
        $('.filter-brand, .filter-attribute, .filter-color, #sortby').on('change', function() {
            fetchFilteredProducts(1);
        });

        // Pagination Click (Consolidated)
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            fetchFilteredProducts(page);
        });

        // Price Range Slider Debounce
        let priceTimer;
        $('.price-range').on('slidechange', function(event, ui) {
            $('#min_price').val(ui.values[0]);
            $('#max_price').val(ui.values[1]);
            
            clearTimeout(priceTimer);
            priceTimer = setTimeout(function() {
                fetchFilteredProducts(1);
            }, 500); 
        });

        // 4. E-commerce Actions
        $(document).on('click', '.add-to-cart-btn', function(e) {
            e.preventDefault();
            $.post("{{ route('addToCart') }}", {
                product_id: $(this).data('id'),
                pro_qty: 1
            }, notify);
        });

        $(document).on('click', '.add-to-wishlist', function(e) {
            e.preventDefault();
            $.post("{{ route('wishlist.add') }}", {
                product_id: $(this).data('id')
            }, notify);
        });

        $(document).on('click', '.add-to-compare', function(e) {
            e.preventDefault();
            $.post("{{ route('compare.add') }}", {
                product_id: $(this).data('id')
            }, notify);
        });

        // 5. Home Page Category Tabs
        const skeleton = `
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-30">
                <div class="skeleton-card">
                    <div class="skeleton skeleton-img"></div>
                    <div class="skeleton skeleton-text"></div>
                    <div class="skeleton skeleton-text small"></div>
                </div>
            </div>`.repeat(4);

        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            let tab = $(e.target);
            let categoryId = tab.data('id');
            let target = $(tab.attr('href'));
            let content = target.find('.ajax-content');

            if (content.data('loaded') == true) return;

            $.ajax({
                url: '/category-products/' + categoryId,
                type: 'GET',
                beforeSend: function() {
                    content.html(skeleton);
                },
                success: function(res) {
                    content.hide().html(res.html).fadeIn(300);
                    content.data('loaded', true);
                },
                error: function() {
                    content.html('<div class="col-12 text-center text-danger">Failed to load products</div>');
                }
            });
        });

    });
})(jQuery);
</script>