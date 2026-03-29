                 <div class="ratings">
                                            @php
                                                // Get average rating (defaults to 0 if no reviews exist)
                                                $avgRating = $product->reviews->avg('rating');
                                                $totalReviews = $product->reviews->count();
                                            @endphp

                                            {{-- Loop 5 times to show stars --}}
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span class="{{ $i <= $avgRating ? 'good' : '' }}">
                                                    <i class="fa fa-star"></i>
                                                </span>
                                            @endfor

                                            <div class="pro-review">
                                                <span>{{ $totalReviews }} review(s)</span>
                                            </div>
                                        </div>
