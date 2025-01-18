 <div class="modal" id="quick_view">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- Content populated dynamically -->
                <div class="product-details-inner" id="quick-view-content"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Trigger Quick View Modal
        $('.quick-view-btn').on('click', function (e) {
            e.preventDefault();

            // Get product ID from button
            let productId = $(this).data('id');

            // Display loading placeholder
            $('#quick-view-content').html('<p>Loading...</p>');

            // Fetch product data via AJAX
            $.ajax({
                url: `/quick-view-product/${productId}`,
                method: 'GET',
                success: function (response) {
                    // Generate product HTML dynamically
                    let galleryHtml = '';
                    let thumbnailsHtml = '';

                    // Loop through gallery images
                    if (response.gallery_images && response.gallery_images.length > 0) {
                        response.gallery_images.forEach(image => {
                            galleryHtml += `
                                <div class="pro-large-img">
                                    <img src="/storage/${image.image}" 
                                         class="img-fluid" alt="${response.name}">
                                </div>`;
                            thumbnailsHtml += `
                                <div class="pro-nav-thumb" style="width: 100px;">
                                    <img src="/storage/${image.image}" alt="Thumbnail">
                                </div>`;
                        });
                    } else {
                        galleryHtml = `
                            <div class="pro-large-img">
                                <img src="/backend/assets/img/noimage.png" 
                                     class="img-fluid" alt="No Image Available">
                            </div>`;
                        thumbnailsHtml = `
                            <div class="pro-nav-thumb" style="width: 100px;">
                                <img src="/backend/assets/img/noimage.png" alt="Thumbnail">
                            </div>`;
                    }

                    let productHtml = `
                        <div class="row">
                            <!-- Product Image Section -->
                            <div class="col-lg-5">
                                <div class="product-large-slider slick-arrow-style_2 mb-20">
                                    ${galleryHtml}
                                </div>
                                <div class="pro-nav slick-padding2 slick-arrow-style_2">
                                    ${thumbnailsHtml}
                                </div>
                            </div>

                            <!-- Product Details Section -->
                            <div class="col-lg-7">
                                <div class="product-details-des">
                                    <h3>${response.name}</h3>
                                    
                                    <!-- Ratings -->
                                    <div class="ratings">
                                        ${generateStars(response.rating)}
                                        <div class="pro-review">
                                            <span>${response.reviews_count} review(s)</span>
                                        </div>
                                    </div>

                                    <!-- Availability -->
                                    <div class="availability mt-10">
                                        <h5>Availability:</h5>
                                        <span>${response.stock > 0 ? `${response.stock} in stock` : 'Out of stock'}</span>
                                    </div>

                                    <!-- Price -->
                                    <div class="pricebox">
                                        <span class="regular-price">${response.sale_price} PKR</span>
                                    </div>

                                    <!-- Description -->
                                    <p>${response.short_description}</p>

                                    <!-- Quantity and Add to Cart -->
                                    <div class="quantity-cart-box d-flex align-items-center mt-20">
                                        <div class="quantity">
                                            <input type="number" value="1" min="1" class="form-control">
                                        </div>
                                        <div class="action_link">
                                            <a class="buy-btn" href="#">Add to cart <i class="fa fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;

                    // Populate modal with product HTML
                    $('#quick-view-content').html(productHtml);

                    // Reinitialize the sliders
                    $('.product-large-slider').slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                        fade: true,
                        asNavFor: '.pro-nav'
                    });
                    $('.pro-nav').slick({
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        asNavFor: '.product-large-slider',
                        dots: false,
                        centerMode: false,
                        focusOnSelect: true
                    });
                },
                error: function () {
                    // Handle error
                    $('#quick-view-content').html('<p>Something went wrong. Please try again later.</p>');
                }
            });
        });

        // Helper function to generate stars dynamically
        function generateStars(rating) {
            let starsHtml = '';
            for (let i = 1; i <= 5; i++) {
                starsHtml += `<span class="${i <= rating ? 'good' : ''}"><i class="fa fa-star"></i></span>`;
            }
            return starsHtml;
        }
    });
</script>
