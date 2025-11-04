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
                <input type="hidden" name="id" id="edit_id" value="">


                @if (!empty($attribute_data))
                    <input type="hidden" value="{{ $attribute_data->id }}" name="attribute_id" class="form-control"
                        placeholder="Attribute Id">
                @endif

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
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
                                            <input type="number" name="itemcode" class="form-control" required
                                                placeholder="Item Code">
                                        </td>


                                        @if (!empty($colors))
                                            <td>
                                                <select name="color_id" required class="form-select" style="width:150px">
                                                    <option value="">Select Color</option>
                                                    @foreach ($colors->attributevalue as $color)
                                                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        @endif

                                        @if (!empty($attribute_data))
                                            <td>
                                                <select name="varient_id" required class="form-select" style="width:150px">
                                                    <option value="">Select {{ $attribute_data->name }}</option>
                                                    @foreach ($attribute_data->attributevalue as $attr)
                                                        <option value="{{ $attr->id }}">{{ $attr->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        @endif

                                        <td>
                                            <input type="number" name="stock" class="form-control" required
                                                placeholder="Stock">
                                        </td>

                                        <td>
                                            <input type="number" name="price" class="form-control" required
                                                placeholder="Price">
                                        </td>

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
                    <h4>All Product Attributes</h4>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Item Code</th>
                                    <th>Color</th>
                                    @if (!empty($attribute_data))
                                        <th>{{ $attribute_data->name }}</th>
                                    @endif
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                    <!-- <th>Delete</th> -->
                                </tr>
                            </thead>
                            <tbody id="attributeTableBody">
                                <!-- Filled by AJAX -->
                            </tbody>
                        </table>

                    </div>



                </div>
            </div>


        </div>
    </div>

    {{-- jQuery Script --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            let product_id = "{{ $product->id }}";

            // ✅ Fetch existing data when page loads
            fetchAttributes();

            // ✅ Function to load table data via AJAX
            function fetchAttributes() {
                $.ajax({
                    url: "{{ route('admin.product.fetchAttributes', ':id') }}".replace(':id', product_id),
                    method: "GET",
                    success: function(response) {
                        if (response.status === 'success') {
                            let rows = '';
                            if (response.data.length === 0) {
                                rows =
                                    '<tr><td colspan="7" class="text-center">No attributes found.</td></tr>';
                            } else {
                                $.each(response.data, function(index, item) {
                                    rows += `
<tr>
    <td>${item.itemcode ?? '-'}</td>
    <td>${item.color ? item.color.name : '-'}</td>
     @if (!empty($attribute_data))
    <td>${item.attribute_value ? item.attribute_value.name : '-'}</td>
    @endif
    <td>${item.stock ?? '-'}</td>
    <td>${item.price ?? '-'}</td>
    <td>
        <button class="btn btn-sm btn-secondary editAttrBtn" 
                data-id="${item.id}"
                data-itemcode="${item.itemcode}"
                data-color_id="${item.color_id}"
                 @if (!empty($attribute_data))
                data-varient_id="${item.attribute_value_id}"
                @endif
                data-stock="${item.stock}"
                data-price="${item.price}">
            Edit
        </button>
        <button class="btn btn-sm btn-danger deleteAttrBtn" 
                data-id="${item.id}">
            Delete
        </button>
    </td>
</tr>
`;


                                });
                            }
                            $('#attributeTableBody').html(rows);
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert('Error fetching attributes!');
                    }
                });
            }






            // Handle edit button click
            $(document).on('click', '.editAttrBtn', function() {
                let id = $(this).data('id');
                let itemcode = $(this).data('itemcode');
                let color_id = $(this).data('color_id');
                let varient_id = $(this).data('varient_id');
                let stock = $(this).data('stock');
                let price = $(this).data('price');

                // Fill the form fields
                $('#edit_id').val(id);
                $('input[name="itemcode"]').val(itemcode);
                $('select[name="color_id"]').val(color_id);
                $('select[name="varient_id"]').val(varient_id);
                $('input[name="stock"]').val(stock);
                $('input[name="price"]').val(price);

                // Change button text
                $('button[type="submit"]').text('Update');
            });


            $('#attributeForm').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let form = this;
                let editId = $('#edit_id').val();
                let url = editId ?
                    "{{ route('admin.product.updateAttribute') }}" // update
                    :
                    "{{ route('admin.product.store-attributes') }}"; // add

                $.ajax({
                    url: url,
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
                            $(form).find('input[type="number"], select').val('');
                            $(form).find('select').prop('selectedIndex', 0);
                            $('#edit_id').val('');
                            $('button[type="submit"]').text('Submit');
                            fetchAttributes(); // refresh table
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


            // Handle delete button click
            $(document).on('click', '.deleteAttrBtn', function() {
                let id = $(this).data('id');
                if (!confirm('Are you sure you want to delete this attribute?')) {
                    return;
                }

                $.ajax({
                    url: "{{ url('/admin/products/delete-attribute') }}/" + id,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            alert(response.message);
                            fetchAttributes(); // reload table
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert('Error deleting attribute!');
                    }
                });

            });

        });
    </script>


@endsection
