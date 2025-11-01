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
        {{-- Attribute Tabs --}}
        <form method="post" class="" action="{{ route('store.pro.attribute') }}" enctype="">
            @csrf
            <div class="tab-pane" id="attributes-tab">
                <div class="card">
                    <div class="card-body">
                        <div class="field_wrapper">
                            {{-- Loop through attributes dynamically --}}
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (old('itemcode', ['']) as $rowIndex => $itemCode)
                                        <tr class="dynamic-field-row">
                                            <!-- Item Code -->
                                            <td>
                                                <input type="number" name="itemcode[]"
                                                    value="{{ old('itemcode.' . $rowIndex) }}" required
                                                    class="form-control" />
                                                <div class="text-danger">
                                                    @error('itemcode.' . $rowIndex)
                                                    {{ $message }}
                                                    @enderror
                                                </div>
                                            </td>

                                            <!-- Attribute selection -->
                                            @if (!empty($colors))
                                            <td>
                                                <select name="color" required class="form-select" style="width: 150px">
                                                    <option value="">Select Color</option>
                                                    @foreach ($colors->attributevalue as $color )
                                                    <option value="{{ $color->id }}"
                                                        {{ old('color') == $color->id ? 'selected' : '' }}>
                                                        {{ $color->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            @endif
                                            <!-- Attribute selection -->
                                            @if (!empty($attribute_data))
                                            <td>
                                                <select name="attribute_id" required class="form-select" style="width: 150px">
                                                    <option value="">Select</option>
                                                    @foreach ($attribute_data->attributevalue as $attr )
                                                    <option value="{{ $attr->id }}"
                                                        {{ old('attr') == $attr->id ? 'selected' : '' }}>
                                                        {{ $attr->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            @endif
                                            <!-- Stock -->
                                            <td>
                                                <input type="number" name="attribute_stock[]"
                                                    value="{{ old('attribute_stock.' . $rowIndex) }}" required
                                                    class="form-control" />
                                                <div class="text-danger">
                                                    @error('attribute_stock.' . $rowIndex)
                                                    {{ $message }}
                                                    @enderror
                                                </div>
                                            </td>

                                            <!-- Price -->
                                            <td>
                                                <input type="number" name="attribute_price[]"
                                                    value="{{ old('attribute_price.' . $rowIndex) }}" required
                                                    class="form-control" />
                                                <div class="text-danger">
                                                    @error('attribute_price.' . $rowIndex)
                                                    {{ $message }}
                                                    @enderror
                                                </div>
                                            </td>

                                            <!-- Remove button -->
                                            <td>
                                                <a href="javascript:void(0);" class="remove_button text-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Add button -->
                            <div class="form-group mt-3">
                                <button type="button" class="btn btn-sm btn-primary add_button">Add Row</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group m-2">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

    </div>
</div>
@endsection

{{-- Include JavaScript for dynamic field addition/removal --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fieldWrapper = document.querySelector('.field_wrapper tbody');
        const addButton = document.querySelector('.add_button');

        // Clone template for new rows
        addButton.addEventListener('click', function() {
            const newRow = fieldWrapper.querySelector('tr').cloneNode(true);

            // Reset inputs for the new row
            newRow.querySelectorAll('input, select').forEach(function(input) {
                input.value = '';
            });

            fieldWrapper.appendChild(newRow);
        });

        // Remove button functionality
        fieldWrapper.addEventListener('click', function(e) {
            if (e.target.closest('.remove_button')) {
                const row = e.target.closest('tr');
                if (fieldWrapper.querySelectorAll('tr').length > 1) {
                    row.remove();
                }
            }
        });
    });
</script>