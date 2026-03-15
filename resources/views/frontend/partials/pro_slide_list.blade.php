@forelse ($products as $item)
    <div class="col-lg-3 col-md-4 col-sm-6">
        @include('frontend.partials.pro_slide', ['item' => $item])
    </div>
@empty
    <div class="col-12">
        <div style="background-color:#d8373e; color:white" class="alert text-center" role="alert">
            <h5>No Products Found</h5>
        </div>
    </div>
@endforelse
