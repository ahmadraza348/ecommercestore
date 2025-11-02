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

        <form method="POST" action="{{ route('store.pro.attribute') }}">
            @csrf
<input type="hidden" name="product_id"value="{{ $product->id }}">
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
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>
                                        <input type="number" name="attributes[0][itemcode]" class="form-control" required placeholder="Item Code">
                                    </td>

                                    @if (!empty($colors))
                                    <td>
                                        <select name="attributes[0][color]" required class="form-select" style="width:150px">
                                            <option value="">Select Color</option>
                                            @foreach ($colors->attributevalue as $color)
                                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    @endif

                                    @if (!empty($attribute_data))
                                    <td>
                                        <select name="attributes[0][attribute_id]" required class="form-select" style="width:150px">
                                            <option value="">Select {{ $attribute_data->name }}</option>
                                            @foreach ($attribute_data->attributevalue as $attr)
                                            <option value="{{ $attr->id }}">{{ $attr->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    @endif

                                    <td>
                                        <input type="number" name="attributes[0][stock]" class="form-control" required placeholder="Stock">
                                    </td>

                                    <td>
                                        <input type="number" name="attributes[0][price]" class="form-control" required placeholder="Price">
                                    </td>

                                    <td>
                                        <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
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
    </div>
</div>

{{-- jQuery Script --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    let i = 0;

    $("#add").click(function() {
        ++i;

        let newRow = `
            <tr>
                <td>
                    <input type="number" name="attributes[${i}][itemcode]" class="form-control" required placeholder="Item Code">
                </td>

                @if (!empty($colors))
                <td>
                    <select name="attributes[${i}][color]" required class="form-select" style="width:150px">
                        <option value="">Select Color</option>
                        @foreach ($colors->attributevalue as $color)
                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                        @endforeach
                    </select>
                </td>
                @endif

                @if (!empty($attribute_data))
                <td>
                    <select name="attributes[${i}][attribute_id]" required class="form-select" style="width:150px">
                        <option value="">Select {{ $attribute_data->name }}</option>
                        @foreach ($attribute_data->attributevalue as $attr)
                        <option value="{{ $attr->id }}">{{ $attr->name }}</option>
                        @endforeach
                    </select>
                </td>
                @endif

                <td><input type="number" name="attributes[${i}][stock]" class="form-control" required placeholder="Stock"></td>
                <td><input type="number" name="attributes[${i}][price]" class="form-control" required placeholder="Price"></td>
                <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td>
            </tr>`;

        $("#dynamicTable").append(newRow);
    });

    $(document).on('click', '.remove-tr', function() {
        $(this).closest('tr').remove();
    });
</script>
@endsection
