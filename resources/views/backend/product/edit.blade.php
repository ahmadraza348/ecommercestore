@extends('backend.layouts.layout')
@section('title', 'Edit Product')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Edit Product</h4>
            </div>
        </div>

        <form method="POST" action="{{ route('product.update', $pro_data->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="col-md-12">
                <!-- Tabs Navigation -->
                <ul class="nav nav-tabs nav-tabs-solid nav-justified">
                    <li class="nav-item"><a class="nav-link active" href="#basic-tab" data-bs-toggle="tab">Basic</a>
                    </li>
                    <li class="nav-item"><a class="nav-link " href="#description-tab"
                            data-bs-toggle="tab">Description</a></li>
                    <li class="nav-item"><a class="nav-link" href="#images-tab" data-bs-toggle="tab">Media</a></li>
                    <li class="nav-item"><a class="nav-link" href="#meta-tab" data-bs-toggle="tab">Meta Info</a>
                    </li>
                </ul>

                <!-- Tabs Content -->
                <div class="tab-content mt-4">

                    <!-- Basic Tab -->
                    <div class="tab-pane show active" id="basic-tab">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <label class="form-label" for="name"> Name*</label>
                                        <div class="form-control-wrap">
                                            <input type="text" required name="name" id="name"
                                                class="form-control focus" value="{{ old('name', $pro_data->name) }}">
                                            <div class="text-danger">
                                                @error('name')
                                                {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <label class="form-label" for="slug"> Slug*</label>
                                        <div class="form-control-wrap">
                                            <input type="text" required name="slug" id="slug"
                                                class="form-control" value="{{ old('slug', $pro_data->slug) }}">
                                            <div class="text-danger">
                                                @error('slug')
                                                {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <label class="form-label" for="sku"> SKU*</label>
                                        <div class="form-control-wrap">
                                            <input type="text" required name="sku" id="sku"
                                                class="form-control" value="{{ old('sku', $pro_data->sku) }}">
                                            <div class="text-danger">
                                                @error('sku')
                                                {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group mb-0">
                                            <label class="form-label" for="status">Status*</label>
                                            <select name="status" required class="form-select" id="status">
                                                <option value="active"
                                                    {{ old('status', $pro_data->status) == 'active' ? 'selected' : '' }}>
                                                    Active
                                                </option>
                                                <option value="inactive"
                                                    {{ old('status', $pro_data->status) == 'inactive' ? 'selected' : '' }}>
                                                    Blocked
                                                </option>
                                            </select>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <label class="form-label" for="categories">Product Categories</label>
                                        <ul class="categoryselectbox" data-bs-spy="scroll"
                                            style="max-height: 240px; max-width: 400px; overflow-y: auto; overflow-x: auto;">
                                            @foreach ($all_category_data as $category)
                                            <li>
                                                <input type="checkbox" name="category[]" value="{{ $category->id }}"
                                                    {{ in_array($category->id, $selected_categories) ? 'checked' : '' }}>
                                                {{ $category->name }}
                                                @if ($category->subcategories->count() > 0)
                                                <ul class="nested-list">
                                                    @foreach ($category->subcategories as $subCategory)
                                                    <li>
                                                        <input type="checkbox" name="category[]"
                                                            value="{{ $subCategory->id }}"
                                                            {{ in_array($subCategory->id, $selected_categories) ? 'checked' : '' }}>
                                                        {{ $subCategory->name }}
                                                        @if ($subCategory->subcategories->count() > 0)
                                                        <ul class="nested-list">
                                                            @foreach ($subCategory->subcategories as $childCategory)
                                                            <li>
                                                                <input type="checkbox"
                                                                    name="category[]"
                                                                    value="{{ $childCategory->id }}"
                                                                    {{ in_array($childCategory->id, $selected_categories) ? 'checked' : '' }}>
                                                                {{ $childCategory->name }}
                                                                @if ($childCategory->subcategories->count() > 0)
                                                                <ul class="nested-list">
                                                                    @foreach ($childCategory->subcategories as $superchild)
                                                                    <li>
                                                                        <input
                                                                            type="checkbox"
                                                                            name="category[]"
                                                                            value="{{ $superchild->id }}"
                                                                            {{ in_array($superchild->id, $selected_categories) ? 'checked' : '' }}>
                                                                        {{ $superchild->name }}

                                                                    </li>
                                                                    @endforeach
                                                                </ul>
                                                                @endif
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                        @endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12">
                                                <label class="form-label mt-2" for="sale_price">Sale Price*</label>
                                                <input type="number" name="sale_price" required class="form-control"
                                                    value="{{ old('sale_price', $pro_data->sale_price) }}">
                                                <div class="text-danger">
                                                    @error('sale_price')
                                                    {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-sm-12">
                                                <label class="form-label mt-2" for="previous_price">Previous
                                                    Price</label>
                                                <input type="number" name="previous_price" class="form-control"
                                                    value="{{ old('previous_price', $pro_data->previous_price) }}">
                                            </div>

                                            <div class="col-lg-6 col-sm-12">
                                                <label class="form-label mt-2" for="purchase_price">Purchase
                                                    Price</label>
                                                <input type="number" name="purchase_price" data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    data-bs-original-title="This will be hidden for users"
                                                    class="form-control"
                                                    value="{{ old('purchase_price', $pro_data->purchase_price) }}">
                                            </div>

                                            <div class="col-lg-6 col-sm-12">
                                                <label class="form-label mt-2" for="barcode">Barcode*</label>
                                                <input type="text" name="barcode" required class="form-control"
                                                    value="{{ old('barcode', $pro_data->barcode) }}">
                                                <div class="text-danger">
                                                    @error('barcode')
                                                    {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-sm-12">
                                                <label class="form-label mt-2" for="stock">Stock*</label>
                                                <input type="number" name="stock" required class="form-control"
                                                    value="{{ old('stock', $pro_data->stock) }}">
                                                <div class="text-danger">
                                                    @error('stock')
                                                    {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-sm-12">
                                                <label class="form-label mt-2" for="tags">Product Tags</label>
                                                <input type="text" name="tags" class="form-control"
                                                    value="{{ old('tags', $pro_data->tags) }}">
                                            </div>

                                            <div class="col-lg-6 col-sm-12">
                                                <label class="form-label mt-2" for="label">Product
                                                    Label</label>
                                                <select name="label" class="form-control">
                                                    <option value="">Select</option>
                                                    <option
                                                        value="new" {{ old('label', $pro_data->label) == 'new' ? 'selected' : '' }}>
                                                        New</option>
                                                    <option
                                                        value="hot" {{ old('label', $pro_data->label) == 'hot' ? 'selected' : '' }}>
                                                        Hot</option>
                                                    <option
                                                        value="sale" {{ old('label', $pro_data->label) == 'sale' ? 'selected' : '' }}>
                                                        Sale</option>
                                                </select>
                                            </div>

                                            <div class="col-lg-6 col-sm-12">
                                                <label class="form-label mt-2" for="label">Product
                                                    Brand</label>
                                                <select name="brand_id" class="form-control">
                                                    <option value="">Select</option>
                                                    @foreach ($brands as $brand)
                                                    <option
                                                        value="{{ $brand->id }}" {{ $pro_data->brand_id == $brand->id ? 'selected' : '' }}>
                                                        {{ $brand->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>



                                            
                                           <div class="col-lg-6 col-sm-12 ">
                                                <label class="form-label mt-2" for="label">Product Variation Type*
                                                </label>
                                                <select name="product_variation_type"disabled id="product_variation_type" class="form-control">
                                                    <option value="simple"{{ old('product_variation_type', $pro_data->product_variation_type) == 'simple' ? 'selected' : '' }}>Simple</option>
                                                    <option value="color_varient"{{ old('product_variation_type', $pro_data->product_variation_type) == 'color_varient' ? 'selected' : '' }}>Color varient</option>
                                                    <option value="color_attribute_varient"{{ old('product_variation_type', $pro_data->product_variation_type) == 'color_attribute_varient' ? 'selected' : '' }}>Color & attribute varient</option>
                                                </select>
                                            </div>

                                            <div class="col-lg-6 col-sm-12 attribute_input d-none ">
                                                <label class="form-label mt-2" for="label">Select Attribute
                                                </label>
                                                <select disabled name="attribute_id" class="form-control">
                                                    <option value="">None</option>
                                                    @php
                                                    $filteredAttributes = $attributes->where('slug', '!=', 'color');
                                                    @endphp

                                                    @foreach ($filteredAttributes as $item)
                                                    <option value="{{ $item->id }}" {{ old('attribute_id', $pro_data->attribute_id) == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}
                                                    </option>
                                                    @endforeach

                                                </select>
                                            </div>

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    const variationTypeSelect = document.querySelector('select[name="product_variation_type"]');
                                                    const attributeSelectDiv = document.querySelector('.attribute_input'); // FIXED

                                                    function toggleAttributeSelect() {
                                                        if (variationTypeSelect.value === 'color_attribute_varient') {
                                                            attributeSelectDiv.classList.remove('d-none');
                                                        } else {
                                                            attributeSelectDiv.classList.add('d-none');
                                                        }
                                                    }

                                                    variationTypeSelect.addEventListener('change', toggleAttributeSelect);

                                                    // run once on load
                                                    toggleAttributeSelect();
                                                });
                                            </script>






                                            {{-- <div class="col-lg-6 col-sm-12">
                                                    <label class="form-label mt-2" for="related_pro">Related
                                                        Products</label>
                                                    <select name="related_pro" id="related_pro"
                                                        class="form-control"multiple>
                                                        <option value="">Select</option>
                                                        @foreach ($related_pro as $item)
                                                            <option value="{{ $item->id }}"
                                            {{ old('related_pro') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                            </option>
                                            @endforeach
                                            </select>
                                        </div> --}}


                                        <div class="col-lg-12 col-sm-12">
                                            <label class="form-label mt-2" for="is_featured">Is Featured</label>
                                            <input type="checkbox" id="is_featured" name="is_featured"
                                                value="1"
                                                {{ old('is_featured', $pro_data->is_featured) == 1 ? 'checked' : '' }}>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- description Tab -->
                <div class="tab-pane" id="description-tab">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-4">
                                <div class="col-lg-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <label class="form-label" for="short_description"> Short
                                                Description</label>
                                            <textarea name="short_description" class="form-control">{{ old('short_description', $pro_data->short_description) }}</textarea>
                                            <label class="form-label mt-2" for="long_description"> Long
                                                Description</label>
                                            <textarea id="summernote" name="long_description" class="summernote-basic">{{ old('long_description', $pro_data->long_description) }}</textarea>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Images Tab -->
                <div class="tab-pane" id="images-tab">
                    <div class="card">
                        <div class="card-body">
                            <div class="mt-2">
                                <img id="imagePreview" src="#" alt="Image Preview"
                                    style="display: none; max-width: 200px; max-height: 200px;">
                            </div>

                            <div class="row g-4">
                                <div class="col-lg-4">
                                    <label for="featured_image">Featured Image*</label>
                                    <input type="file" name="featured_image" data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        data-bs-original-title="Only jpg, jpeg, and png files allowed"
                                        class="form-control" onchange="previewImage(event)">
                                    <small class="text-muted">Max 1200x1200px, 200KB</small>
                                    <div class="text-danger">
                                        @error('featured_image')
                                        {{ $message }}
                                        @enderror
                                    </div>


                                    <div class="mt-2">
                                        <label for="featured_image">Current Featured Image</label>
                                        <img id="featuredImagePreview"
                                            src="{{ asset('storage/' . $pro_data->featured_image ?? '') }}"
                                            alt="Featured Image"
                                            style="display: {{ $pro_data->featured_image ? 'block' : 'none' }}; max-width: 200px; max-height: 200px;">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label for="back_image">Back Image</label>
                                    <input type="file" name="back_image" class="form-control"
                                        onchange="previewImage(event)" data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        data-bs-original-title="Only jpg, jpeg, and png files allowed">
                                    <small class="text-muted">Max 1200x1200px, 200KB</small>
                                    <div class="text-danger">
                                        @error('back_image')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <img id="imagePreview" src="#" alt="Image Preview"
                                            style="display: none; max-width: 200px; max-height: 200px;">
                                    </div>
                                    <div class="mt-2">
                                        <label for="featured_image">Current Back Image</label>
                                        <img id="featuredImagePreview"
                                            src="{{ asset('storage/' . $pro_data->back_image ?? '') }}"
                                            alt="Featured Image"
                                            style="display: {{ $pro_data->back_image ? 'block' : 'none' }}; max-width: 200px; max-height: 200px;">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <label for="video">Product Video</label>
                                    <input type="file" name="video" class="form-control">
                                    <small class="text-muted">Only video files allowed</small>

                                    @if ($pro_data->video)
                                    <div class="mt-2">
                                        <label>Current Video:</label>
                                        <video width="320" height="240" controls>
                                            <source src="{{ asset('storage/' . $pro_data->video) }}"
                                                type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                    @endif
                                </div>

                                {{-- <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="gallery_images">Gallery Images*</label>
                                                <div class="image-upload">
                                                    <input type="file" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        data-bs-original-title="Only jpg, jpeg, and png files allowed"
                                                        id="gallery_images" name="gallery_images[]" multiple
                                                        onchange="validateAndPreviewGalleryImages(event)">
                                                    <small class="text-muted">Max 1200x1200px, 200KB per image</small>
                                                    <div class="image-uploads">
                                                        <img src="{{ asset('backend/assets/img/icons/upload.svg') }}"
                                alt="upload icon">
                                <h4>Drag and drop a file to upload</h4>
                            </div>
                        </div>
                        <div class="text-danger">
                            @error('gallery_images[]')
                            {{ $message }}
                            @enderror
                        </div>
                        <div id="galleryImagePreviewContainer"
                            style="display: flex; flex-wrap: wrap; margin-top: 10px;"></div>

                        <div class="mt-2">
                            <label for="gallery_images">Current Gallery Images</label>
                            @foreach ($pro_data->gallery_images as $image)
                            <div class="gallery-image" id="gallery-image-{{ $image->id }}"
                                style="display: inline-block;">
                                <img src="{{ asset('storage/' . $image->image) }}"
                                    alt="Gallery Image"
                                    style="max-width: 200px; max-height: 200px; margin-right: 10px;">

                                <button type="button" class="delete-gallery-image"
                                    data-id="{{ $image->id }}"
                                    style="border: none; background: none;">
                                    <img src="{{ asset('backend/assets/img/icons/delete.svg') }}"
                                        alt="delete">
                                </button>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div> --}}

                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="gallery_images">Gallery Images*</label>
                        <div class="image-upload">
                            <input type="file" data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                data-bs-original-title="Only jpg, jpeg, and png files allowed"
                                id="gallery_images" name="gallery_images[]" multiple
                                onchange="validateAndPreviewGalleryImages(event)">
                            <small class="text-muted">Max 1200x1200px, 200KB per image</small>
                            <div class="image-uploads">
                                <img src="{{ asset('backend/assets/img/icons/upload.svg') }}"
                                    alt="upload icon">
                                <h4>Drag and drop a file to upload</h4>
                            </div>
                        </div>
                        <div class="text-danger">
                            @error('gallery_images[]')
                            {{ $message }}
                            @enderror
                        </div>
                        <div id="galleryImagePreviewContainer"
                            style="display: flex; flex-wrap: wrap; margin-top: 10px;"></div>

                        <div class="mt-2">
                            <label for="current_gallery_images">Current Gallery Images</label>
                            @foreach ($pro_data->gallery_images as $image)
                            <div class="gallery-image" id="gallery-image-{{ $image->id }}"
                                style="display: inline-block; margin: 10px;">
                                <img src="{{ asset('storage/' . $image->image) }}"
                                    alt="Gallery Image"
                                    style="max-width: 200px; max-height: 200px; margin-bottom: 5px;">
                                <select name="existing_colors[{{ $image->id }}]"
                                    class="form-select" style="margin-top: 5px;">
                                    <option value="">Select Color</option>
                                    @foreach ($attribute_colors as $color)
                                    <option value="{{ $color->id }}"
                                        {{ $image->color_id == $color->id ? 'selected' : '' }}>
                                        {{ $color->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <button type="button"
                                    class="delete-gallery-image btn btn-danger btn-sm mt-2"
                                    data-id="{{ $image->id }}">
                                    Delete
                                </button>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
    </div>
</div>
</div>

<div class="tab-pane" id="meta-tab">

    @include('backend.partials.editmetatags', ['item' => $pro_data])
    <div class="form-group mt-3">
        <button type="submit" class="btn btn-primary">Reset</button>
    </div>

</div>

<div class="form-group mt-3">
    <button type="submit" class="btn btn-primary">Update Product</button>
</div>
<!-- Submit Button -->

</div>
</div>
</form>
</div>
</div>

<script>



    function validateAndPreviewGalleryImages(event) {
        const files = Array.from(event.target.files);
        const validImageTypes = ['image/jpeg', 'image/png'];
        const galleryImagePreviewContainer = document.getElementById('galleryImagePreviewContainer');
        galleryImagePreviewContainer.innerHTML = '';

        files.forEach((file, index) => {
            if (validImageTypes.includes(file.type)) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgContainer = document.createElement('div');
                    imgContainer.style.display = 'flex';
                    imgContainer.style.flexDirection = 'column';
                    imgContainer.style.alignItems = 'center';
                    imgContainer.style.margin = '10px';

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100px';
                    img.style.height = '100px';
                    img.style.borderRadius = '5px';
                    img.style.border = '1px solid #ddd';
                    img.style.objectFit = 'cover';

                    const colorSelect = document.createElement('select');
                    colorSelect.name = `colors[${index}]`;
                    colorSelect.style.marginTop = '5px';

                    const colors = @json($attribute_colors);
                    colorSelect.innerHTML = '<option value="">Select Color</option>';
                    colors.forEach(color => {
                        const option = document.createElement('option');
                        option.value = color.id;
                        option.text = color.name;
                        colorSelect.appendChild(option);
                    });

                    imgContainer.appendChild(img);
                    imgContainer.appendChild(colorSelect);
                    galleryImagePreviewContainer.appendChild(imgContainer);
                };
                reader.readAsDataURL(file);
            } else {
                alert('Please select valid image files (JPG, JPEG, PNG) for gallery images.');
                event.target.value = '';
                return;
            }
        });
    }

    // delete Galley Images
    $(document).on('click', '.delete-gallery-image', function(e) {
        e.preventDefault();
        let imageId = $(this).data('id');

        if (confirm('Are you sure you want to delete this image?')) {
            $.ajax({
                url: "{{ route('galleryimg.delete') }}", // Update with your route
                type: 'DELETE',
                data: {
                    id: imageId,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        $('#gallery-image-' + imageId).remove();
                        alert('Image deleted successfully.');
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr) {
                    alert('An error occurred while deleting the image.');
                }
            });
        }
    });
</script>
@endsection