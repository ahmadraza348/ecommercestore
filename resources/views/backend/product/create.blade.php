@extends('backend.layouts.layout')
@section('title', 'Create Product - Raza Mall')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Add Product</h4>
                </div>
            </div>

            <form method="post"class="" action="{{ route('product.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12">
                    <!-- Tabs Navigation -->
                    <ul class="nav nav-tabs nav-tabs-solid nav-justified">
                        <li class="nav-item"><a class="nav-link active" href="#basic-tab" data-bs-toggle="tab">Basic</a>
                        </li>
                        <li class="nav-item"><a class="nav-link " href="#description-tab"
                                data-bs-toggle="tab">Description</a></li>
                        <li class="nav-item"><a class="nav-link" href="#images-tab" data-bs-toggle="tab">Media</a></li>
                        <li class="nav-item"><a class="nav-link" href="#attributes-tab" data-bs-toggle="tab">Attributes</a>
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
                                                    class="form-control focus" value="{{ old('name') }}">
                                                <div class="text-danger">
                                                    @error('name')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>

                                            <label class="form-label" for="slug"> Slug*</label>
                                            <div class="form-control-wrap">
                                                <input type="text" required name="slug" id="slug"
                                                    class="form-control" value="{{ old('slug') }}">
                                                <div class="text-danger">
                                                    @error('slug')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>

                                            <label class="form-label" for="sku"> SKU*</label>
                                            <div class="form-control-wrap">
                                                <input type="text" required name="sku" id="sku"
                                                    class="form-control" value="{{ old('sku') }}">
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
                                                        {{ old('status') == 'active' ? 'selected' : '' }}>
                                                        Active</option>
                                                    <option value="inactive"
                                                        {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                                        Blocked</option>
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
                                                @foreach ($categories as $category)
                                                    <li>
                                                        <input type="checkbox" name="category[]" value="{{ $category->id }}"
                                                            {{ in_array($category->id, old('category', [])) ? 'checked' : '' }}>
                                                        {{ $category->name }}
                                                        @if ($category->subcategories->count() > 0)
                                                            <ul class="nested-list">
                                                                @foreach ($category->subcategories as $subCategory)
                                                                    <li>
                                                                        <input type="checkbox" name="subcategory[]"
                                                                            value="{{ $subCategory->id }}"
                                                                            {{ in_array($subCategory->id, old('subcategory', [])) ? 'checked' : '' }}>
                                                                        {{ $subCategory->name }}

                                                                        @if ($subCategory->subcategories->count() > 0)
                                                                            <ul class="nested-list">
                                                                                @foreach ($subCategory->subcategories as $childCategory)
                                                                                    <li>
                                                                                        <input type="checkbox"
                                                                                            name="childcategory[]"
                                                                                            value="{{ $childCategory->id }}"
                                                                                            {{ in_array($childCategory->id, old('childcategory', [])) ? 'checked' : '' }}>
                                                                                        {{ $childCategory->name }}

                                                                                        @if ($childCategory->subcategories->count() > 0)
                                                                                            <ul class="nested-list">
                                                                                                @foreach ($childCategory->subcategories as $superchild)
                                                                                                    <li>
                                                                                                        <input
                                                                                                            type="checkbox"
                                                                                                            name="superchild[]"
                                                                                                            value="{{ $superchild->id }}"
                                                                                                            {{ in_array($superchild->id, old('superchild', [])) ? 'checked' : '' }}>
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
                                                    <input type="number" name="sale_price"required class="form-control"
                                                        value="{{ old('sale_price') }}">
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
                                                        value="{{ old('previous_price') }}">
                                                </div>

                                                <div class="col-lg-6 col-sm-12">
                                                    <label class="form-label mt-2" for="purchase_price">Purchase
                                                        Price</label>
                                                    <input type="number" name="purchase_price"data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        data-bs-original-title="This will be hidden for users"
                                                        class="form-control" value="{{ old('purchase_price') }}">
                                                </div>

                                                <div class="col-lg-6 col-sm-12">
                                                    <label class="form-label mt-2" for="barcode">Barcode*</label>
                                                    <input type="text" name="barcode"required class="form-control"
                                                        value="{{ old('barcode') }}">
                                                    <div class="text-danger">
                                                        @error('barcode')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-sm-12">
                                                    <label class="form-label mt-2" for="stock">Stock*</label>
                                                    <input type="number" name="stock"required class="form-control"
                                                        value="{{ old('stock') }}">
                                                    <div class="text-danger">
                                                        @error('stock')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-sm-12">
                                                    <label class="form-label mt-2" for="tags">Product Tags</label>
                                                    <input type="text" name="tags" class="form-control"
                                                        value="{{ old('tags') }}">
                                                </div>

                                                <div class="col-lg-6 col-sm-12">
                                                    <label class="form-label mt-2" for="label">Product
                                                        Label</label>
                                                    <select name="label" class="form-control">
                                                        <option value="">Select</option>
                                                        <option
                                                            value="new"{{ old('label') == 'new' ? 'selected' : '' }}>
                                                            New</option>
                                                        <option
                                                            value="hot"{{ old('label') == 'hot' ? 'selected' : '' }}>
                                                            Hot</option>
                                                        <option
                                                            value="sale"{{ old('label') == 'sale' ? 'selected' : '' }}>
                                                            Sale</option>
                                                    </select>
                                                </div>


                                                <div class="col-lg-6 col-sm-12">
                                                    <label class="form-label mt-2" for="label">Product
                                                        Brand</label>
                                                    <select name="brand_id" class="form-control">
                                                        <option value="">Select</option>
                                                        @foreach ($brands as $item)
                                                            <option
                                                                value="{{ $item->id }}"{{ old('brand') == $item->id ? 'selected' : '' }}>
                                                                {{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>


                                                {{-- 
                                                <div class="col-lg-6 col-sm-12">
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
                                                    <input type="checkbox" name="is_featured" value="1"
                                                        {{ old('is_featured') ? 'checked' : '' }}>
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
                                                    <textarea name="short_description" class="form-control">{{ old('short_description') }}</textarea>

                                                    <label class="form-label mt-2" for="long_description"> Long
                                                        Description</label>

                                                    <textarea id="summernote" name="long_description" class="summernote-basic">{{ old('long_description') }}</textarea>

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
                                    <div class="row g-4">
                                        <div class="col-lg-4">
                                            <label for="featured_image">Featured Image*</label>
                                            <input type="file" required name="featured_image" data-bs-toggle="tooltip"
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
                                                <img id="imagePreview" src="#" alt="Image Preview"
                                                    style="display: none; max-width: 200px; max-height: 200px;">
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
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="video">Product Video</label>
                                            <input type="file" name="video" class="form-control">
                                            <small class="text-muted">Only video files allowed</small>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="gallery_images">Gallery Images*</label>
                                                <div class="image-upload">
                                                    <input type="file" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        data-bs-original-title="Only jpg, jpeg, and png files allowed"required
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Attribute Tabs --}}
                        {{-- <div class="tab-pane" id="attributes-tab">
                            <div class="card">
                                <div class="card-body">
                                    <div class="field_wrapper">
                                        @foreach (old('itemcode', ['']) as $index => $oldItemCode)
                                            <div class="d-flex" style="justify-content:space-between">
                                                <!-- Existing fields HTML -->
                                                <div class="form-group m-2">
                                                    <label for="">Item Code*</label>
                                                    <input type="number" name="itemcode[]"
                                                        value="{{ old('itemcode.' . $index) }}" required
                                                        class="form-control" />
                                                    <div class="text-danger">
                                                        @error('itemcode.' . $index)
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Attribute selection -->
                                                <div class="form-group m-2">
                                                    <label for="attribute-select">Select Attribute*</label>
                                                    <select name="attribute[]" required
                                                        class="form-select select-attribute"
                                                        data-old="{{ old('attribute.' . $index) }}" style="width:200px">
                                                        <option value="">Select</option>
                                                        @foreach ($attributes as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ old('attribute.' . $index) == $item->id ? 'selected' : '' }}>
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="text-danger">
                                                        @error('attribute.' . $index)
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Attribute values -->
                                                <div class="form-group m-2">
                                                    <label for="attribute-value">Select Value*</label>
                                                    <select name="attribute_value[]" required
                                                        class="form-select dynamic-attribute-value"
                                                        data-old="{{ old('attribute_value.' . $index) }}"
                                                        style="width:200px">
                                                        <option value="">Select</option>
                                                    </select>
                                                    <div class="text-danger">
                                                        @error('attribute_value.' . $index)
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Stock -->
                                                <div class="form-group m-2">
                                                    <label for="">Stock*</label>
                                                    <input type="number" name="attribute_stock[]"
                                                        value="{{ old('attribute_stock.' . $index) }}" required
                                                        class="form-control" />
                                                    <div class="text-danger">
                                                        @error('attribute_stock.' . $index)
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- Price -->
                                                <div class="form-group m-2">
                                                    <label for="">Price*</label>
                                                    <input type="number" name="attribute_price[]"
                                                        value="{{ old('attribute_price.' . $index) }}" required
                                                        class="form-control" />
                                                    <div class="text-danger">
                                                        @error('attribute_price.' . $index)
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Remove button -->
                                                <div class="form-group m-2">
                                                    <label for="">&nbsp;</label>
                                                    <a href="javascript:void(0);" class="remove_button text-danger">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach

                                        <!-- Add button -->
                                        <div class="form-group m-2">
                                            <button type="button" class="btn-sm btn-primary add_button mt-2">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="tab-pane" id="attributes-tab">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Item Code</th>
                                                    @foreach ($attributes as $attribute)
                                                        <th>{{ $attribute->name }}</th>
                                                    @endforeach
                                                    <th>Stock</th>
                                                    <th>Price</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="field_wrapper">
                                                @foreach (old('itemcode', ['']) as $index => $oldItemCode)
                                                    <tr>
                                                        <td>
                                                            <input type="number" name="itemcode[]"
                                                                value="{{ old('itemcode.' . $index) }}" required
                                                                class="form-control" />
                                                            <div class="text-danger">
                                                                @error('itemcode.' . $index)
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </td>
                                                        @foreach ($attributes as $attribute)
                                                            <td>
                                                                <select name="attribute_value[{{ $attribute->id }}][]"
                                                                    required class="form-select dynamic-attribute-value"
                                                                    data-attribute="{{ $attribute->id }}"
                                                                    data-old="{{ old('attribute_value.' . $attribute->id . '.' . $index) }}">
                                                                    <option value="">Select</option>
                                                                    @foreach ($attribute->attributevalue as $value)
                                                                        <option value="{{ $value->id }}"
                                                                            {{ old("attribute_value.{$attribute->id}.{$index}") == $value->id ? 'selected' : '' }}>
                                                                            {{ $value->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="text-danger">
                                                                    @error("attribute_value.{$attribute->id}.{$index}")
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                            </td>
                                                        @endforeach
                                                        <td>
                                                            <input type="number" name="attribute_stock[]"
                                                                value="{{ old('attribute_stock.' . $index) }}" required
                                                                class="form-control" />
                                                            <div class="text-danger">
                                                                @error('attribute_stock.' . $index)
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="attribute_price[]"
                                                                value="{{ old('attribute_price.' . $index) }}" required
                                                                class="form-control" />
                                                            <div class="text-danger">
                                                                @error('attribute_price.' . $index)
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="javascript:void(0);"
                                                                class="remove_button text-danger"><i
                                                                    class="fas fa-trash-alt"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <button type="button" class="btn btn-primary add_button mt-2">Add Row</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{-- Meta Tabs --}}
                        <div class="tab-pane" id="meta-tab">

                            @include('backend.partials.metatags')
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary">Reset</button>
                            </div>

                        </div>

                        {{-- Submission --}}
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </div>


                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // $(document).ready(function() {
        //     var maxField = 100;
        //     var addButton = $('.add_button');
        //     var wrapper = $('.field_wrapper');
        //     var fieldCounter = $('.field_wrapper .d-flex').length;

        //     function fetchAttributeValues(attributeId, targetSelect) {
        //         $.ajax({
        //             url: '/admin/get-attribute-values/' + attributeId,
        //             type: 'GET',
        //             success: function(response) {
        //                 targetSelect.empty().append('<option value="">Select</option>');
        //                 $.each(response, function(index, value) {
        //                     var selected = targetSelect.data('old') == value.id ? 'selected' :
        //                         '';
        //                     targetSelect.append('<option value="' + value.id + '" ' + selected +
        //                         '>' + value.name + '</option>');
        //                 });
        //             },
        //             error: function(xhr, status, error) {
        //                 console.error("AJAX Error:", error);
        //             }
        //         });
        //     }

        //     $(wrapper).on('change', '.select-attribute', function() {
        //         var attributeId = $(this).val();
        //         var targetSelect = $(this).closest('.d-flex').find('.dynamic-attribute-value');
        //         targetSelect.data('old', '');
        //         if (attributeId) {
        //             fetchAttributeValues(attributeId, targetSelect);
        //         } else {
        //             targetSelect.empty().append('<option value="">Select</option>');
        //         }
        //     });

        //     function generateFieldHTML(oldItemCode = '', oldAttribute = '', oldAttributeValue = '', oldStock = '',
        //         oldPrice = '') {
        //         return `
    //     <div class="d-flex" style="justify-content:space-between; margin-top: 10px;">
    //         <div class="form-group m-2">
    //             <input type="number" name="itemcode[]" value="${oldItemCode}" class="form-control" />
    //             <div class="text-danger">@error('itemcode[]'){{ $message }}@enderror</div>
    //         </div>
    //         <div class="form-group m-2">
    //             <select name="attribute[]" class="form-select select-attribute" data-old="${oldAttribute}" style="width:200px">
    //                 <option value="">Select</option>
    //                 @foreach ($attributes as $item)
    //                     <option value="{{ $item->id }}" ${oldAttribute == '{{ $item->id }}' ? 'selected' : ''}>{{ $item->name }}</option>
    //                 @endforeach
    //             </select>
    //             <div class="text-danger">@error('attribute[]'){{ $message }}@enderror</div>
    //         </div>
    //         <div class="form-group m-2">
    //             <select name="attribute_value[]" class="form-select dynamic-attribute-value" data-old="${oldAttributeValue}" style="width:200px">
    //                 <option value="">Select</option>
    //             </select>
    //             <div class="text-danger">@error('attribute_value[]'){{ $message }}@enderror</div>
    //         </div>
    //         <div class="form-group m-2">
    //             <input type="number" name="attribute_stock[]" value="${oldStock}" class="form-control" />
    //             <div class="text-danger">@error('attribute_stock[]'){{ $message }}@enderror</div>
    //         </div>
    //         <div class="form-group m-2">
    //             <input type="number" name="attribute_price[]" value="${oldPrice}" class="form-control" />
    //             <div class="text-danger">@error('attribute_price[]'){{ $message }}@enderror</div>
    //         </div>
    //         <div class="form-group m-2">
    //             <a href="javascript:void(0);" class="remove_button text-danger"><i class="fas fa-trash-alt"></i></a>
    //         </div>
    //     </div>`;
        //     }

        //     $(addButton).click(function() {
        //         if (fieldCounter < maxField) {
        //             fieldCounter++;
        //             $(wrapper).append(generateFieldHTML());
        //         } else {
        //             alert('A maximum of ' + maxField + ' fields are allowed.');
        //         }
        //     });

        //     $(wrapper).on('click', '.remove_button', function(e) {
        //         e.preventDefault();
        //         $(this).closest('.d-flex').remove();
        //         fieldCounter--;
        //     });

        //     $('.select-attribute').each(function() {
        //         var attributeId = $(this).data('old');
        //         if (attributeId) {
        //             var targetSelect = $(this).closest('.d-flex').find('.dynamic-attribute-value');
        //             fetchAttributeValues(attributeId, targetSelect);
        //         }
        //     });
        // });
        $(document).ready(function() {
            var maxField = 100; // Maximum number of fields allowed
            var addButton = $('.add_button'); // Add button selector
            var wrapper = $('.field_wrapper'); // Table body selector for dynamic rows
            var fieldCounter = $('.field_wrapper tr').length; // Initial count of rows


            // Add a new row
            $(addButton).click(function() {
                if (fieldCounter < maxField) {
                    fieldCounter++;
                    var rowHTML = `<tr>
                <td>
                    <input type="number" name="itemcode[]" value="" required class="form-control" />
                </td>`;
                    @foreach ($attributes as $attribute)
                        rowHTML += `<td>
                    <select name="attribute_value[{{ $attribute->id }}][]" required class="form-select dynamic-attribute-value" data-attribute="{{ $attribute->id }}">
                        <option value="">Select</option>
                        @foreach ($attribute->attributevalue as $value)
                                                <option value="{{ $value->id }}" {{ old("attribute_value.{$attribute->id}.{$index}") == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                            @endforeach
                    </select>
                </td>`;
                    @endforeach
                    rowHTML += `
                <td>
                    <input type="number" name="attribute_stock[]" value="" required class="form-control" />
                </td>
                <td>
                    <input type="number" name="attribute_price[]" value="" required class="form-control" />
                </td>
                <td>
                    <a href="javascript:void(0);" class="remove_button text-danger"><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>`;
                    $(wrapper).append(rowHTML);
                } else {
                    alert('A maximum of ' + maxField + ' rows are allowed.');
                }
            });

            // Remove a row
            $(wrapper).on('click', '.remove_button', function() {
                $(this).closest('tr').remove();
                fieldCounter--;
            });

        });


        function validateAndPreviewGalleryImages(event) {
            const files = Array.from(event.target.files);
            const validImageTypes = ['image/jpeg', 'image/png', 'image/webp', ];
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
                        colorSelect.name = `colors[${index}]`; // Ensure name is dynamic
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
    </script>
@endsection
