
<div class="modal" id="quick_view">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- Content will be populated dynamically -->
                <div id="quick-view-content"></div>
            </div>
        </div>
    </div>
</div>
   
   {{-- <div class="modal" id="quick_view">
       <div class="modal-dialog modal-lg modal-dialog-centered">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>

               
               <div class="modal-body">
                   <!-- product details inner end -->
                   <div class="product-details-inner">
                       <div class="row">
                           <div class="col-lg-5">
                               <div class="product-large-slider slick-arrow-style_2 mb-20">
                                   <div class="pro-large-img">
                                       <img src="{{ asset('frontend/assets/img/product/product-details-img1.jpg') }}"
                                           alt="" />
                                   </div>
                                 
                               </div>
                               <div class="pro-nav slick-padding2 slick-arrow-style_2">
                                   <div class="pro-nav-thumb"><img
                                           src="{{ asset('frontend/assets/img/product/product-details-img1.jpg') }}"
                                           alt="" /></div>
                                 
                               </div>
                           </div>
                           <div class="col-lg-7">
                               <div class="product-details-des mt-md-34 mt-sm-34">
                                   <h3><a href="product-details.html">external product 12</a></h3>
                                   <div class="ratings">
                                       <span class="good"><i class="fa fa-star"></i></span>
                                       <span class="good"><i class="fa fa-star"></i></span>
                                       <span class="good"><i class="fa fa-star"></i></span>
                                       <span class="good"><i class="fa fa-star"></i></span>
                                       <span><i class="fa fa-star"></i></span>
                                       <div class="pro-review">
                                           <span>1 review(s)</span>
                                       </div>
                                   </div>
                                   <div class="availability mt-10">
                                       <h5>Availability:</h5>
                                       <span>1 in stock</span>
                                   </div>
                                   <div class="pricebox">
                                       <span class="regular-price">$160.00</span>
                                   </div>
                                   <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                                       tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.<br>
                                       Phasellus id nisi quis justo tempus mollis sed et dui. In hac habitasse platea
                                       dictumst. Suspendisse ultrices mauris diam. Nullam sed aliquet elit. Mauris
                                       consequat nisi ut mauris efficitur lacinia.</p>
                                   <div class="quantity-cart-box d-flex align-items-center mt-20">
                                       <div class="quantity">
                                           <div class="pro-qty"><input type="text" value="1"></div>
                                       </div>
                                       <div class="action_link">
                                           <a class="buy-btn" href="#">add to cart<i
                                                   class="fa fa-shopping-cart"></i>
                                           </a>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <!-- product details inner end -->
               </div>
           </div>
       </div>
   </div> --}}



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.quick-view-btn').on('click', function (e) {
            e.preventDefault();
            let productId = $(this).data('id');

            // Show loading indicator
            $('#quick-view-content').html('<p>Loading...</p>');

            // Make AJAX call
            $.ajax({
                url: '/product/' + productId,
                method: 'GET',
                success: function (response) {
                    // Populate modal with product data
                    let html = `
                        <div class="row">
                            <div class="col-lg-5">
                                <img src="${response.featured_image ? '/storage/' + response.featured_image : '/backend/assets/img/noimage.png'}" class="img-fluid" alt="${response.name}">
                            </div>
                            <div class="col-lg-7">
                                <h3>${response.name}</h3>
                                <div class="pricebox">
                                    <span class="regular-price">${response.sale_price} PKR</span>
                                </div>
                                <p>${response.description}</p>
                                <div class="quantity-cart-box d-flex align-items-center mt-20">
                                    <div class="quantity">
                                        <input type="number" value="1" min="1">
                                    </div>
                                    <div class="action_link">
                                        <a class="buy-btn" href="#">Add to cart <i class="fa fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    $('#quick-view-content').html(html);
                },
                error: function () {
                    $('#quick-view-content').html('<p>Something went wrong. Please try again.</p>');
                }
            });
        });
    });
</script>

