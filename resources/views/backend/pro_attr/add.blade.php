@extends('backend.layouts.layout')
@section('title', 'Create Product - Raza Mall')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Add Product Attribute</h4>
                </div>
            </div>

            <form method="POST" id="attributeForm">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <input type="hidden" value="{{ $attribute_data->id }}" name="attribute_id" class="form-control"
                    placeholder="Attribute Id">

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dynamicTable">
                                <thead>
                                    <tr>
                                        <th>Item Code*</th>
                                        <th>Color*</th>
                                        @if (!empty($attribute_data))
                                            <th>{{ $attribute_data->name }}*</th>
                                        @endif
                                        <th>Stock*</th>
                                        <th>Price*</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="number" name="attributes[0][itemcode]" class="form-control"
                                                required placeholder="Item Code">
                                        </td>


                                        @if (!empty($colors))
                                            <td>
                                                <select name="attributes[0][color_id]" required class="form-select"
                                                    style="width:150px">
                                                    <option value="">Select Color</option>
                                                    @foreach ($colors->attributevalue as $color)
                                                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        @endif

                                        @if (!empty($attribute_data))
                                            <td>
                                                <select name="attributes[0][varient_id]" required class="form-select"
                                                    style="width:150px">
                                                    <option value="">Select {{ $attribute_data->name }}</option>
                                                    @foreach ($attribute_data->attributevalue as $attr)
                                                        <option value="{{ $attr->id }}">{{ $attr->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        @endif

                                        <td>
                                            <input type="number" name="attributes[0][stock]" class="form-control" required
                                                placeholder="Stock">
                                        </td>

                                        <td>
                                            <input type="number" name="attributes[0][price]" class="form-control" required
                                                placeholder="Price">
                                        </td>
                                        {{-- 
                                    <td>
                                        <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                                    </td> --}}
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="form-group m-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </div>
                </div>
            </form>

            <div class="page-header">
                <div class="page-title">
                    <h4>All Product Varients
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dynamicTable">
                            <thead>
                                <tr>
                                    <th>Item Code*</th>
                                    <th>Color*</th>
                                    @if (!empty($attribute_data))
                                        <th>{{ $attribute_data->name }}*</th>
                                    @endif
                                    <th>Stock*</th>
                                    <th>Price*</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($variants as $variant)
                                    <tr>
                                        <td>{{ $variant->itemcode }}</td>

                                        @if (!empty($colors))
                                            <td>{{ $variant->colorValue->name ?? '-' }}</td>
                                        @endif

                                        @if (!empty($attribute_data))
                                            <td>{{ $variant->attributeValue->name ?? '-' }}</td>
                                        @endif

                                        <td>{{ $variant->stock }}</td>
                                        <td>{{ $variant->price }}</td>

                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary editVariantBtn"
                                                data-id="{{ $variant->id }}">Edit</button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-danger deleteVariantBtn"
                                                data-id="{{ $variant->id }}">Delete</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No variants found for this product.</td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>

    {{-- jQuery Script --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#attributeForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                $.ajax({
                    url: "{{ route('admin.product.storeAttributes') }}", // define this route in web.php
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('button[type="submit"]').prop('disabled', true).text('Saving...');
                    },
                    success: function(response) {
                        $('button[type="submit"]').prop('disabled', false).text('Submit');

                        if (response.status === 'success') {
                            alert(response.message);
                            $('#attributeForm')[0].reset();
                            location.reload(); // or dynamically append to table if you want
                        } else {
                            alert('Something went wrong!');
                        }
                    },
                    error: function(xhr) {
                        $('button[type="submit"]').prop('disabled', false).text('Submit');
                        console.log(xhr.responseText);
                        alert('Error saving attributes!');
                    }
                });
            });

        });
    </script>

@endsection
