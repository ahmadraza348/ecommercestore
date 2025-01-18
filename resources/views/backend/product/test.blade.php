                    Attribute Tabs
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
                                            @foreach ($pro_data->attributes->groupBy('pivot.itemcode') as $itemcode => $attributeGroup)
                                                <!-- Iterate over each group of attributes for the same itemcode -->
                                                @foreach ($attributeGroup->groupBy('pivot.attribute_value_id') as $index => $groupedAttributes)
                                                    <tr>
                                                        <!-- Item Code -->
                                                        <td>
                                                            <input type="number" name="itemcode[]"
                                                                value="{{ $itemcode }}" required
                                                                class="form-control"
                                                                {{ $loop->first ? '' : 'readonly' }} />
                                                        </td>

                                                        <!-- Attribute Values -->
                                                        @foreach ($attributes as $attribute)
                                                            <td>
                                                                <select
                                                                    name="attribute_value[{{ $attribute->id }}][{{ $itemcode }}]"
                                                                    class="form-select">
                                                                    <option value="">Select</option>
                                                                    @foreach ($attribute->attributevalue as $value)
                                                                        <option value="{{ $value->id }}"
                                                                            {{ in_array($value->id, $groupedAttributes->pluck('pivot.attribute_value_id')->toArray()) ? 'selected' : '' }}>
                                                                            {{ $value->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                        @endforeach

                                                        <!-- Stock -->
                                                        <td>
                                                            <input type="number"
                                                                name="attribute_stock[{{ $itemcode }}][{{ $index }}]"
                                                                value="{{ $groupedAttributes->first()->pivot->stock }}"
                                                                required class="form-control" />
                                                        </td>

                                                        <!-- Price -->
                                                        <td>
                                                            <input type="number"
                                                                name="attribute_price[{{ $itemcode }}][{{ $index }}]"
                                                                value="{{ $groupedAttributes->first()->pivot->price }}"
                                                                required class="form-control" />
                                                        </td>

                                                        <!-- Actions -->
                                                        <td>
                                                            <a href="javascript:void(0);"
                                                                class="remove_button text-danger">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>

                                    </table>
                                    <button type="button" class="btn btn-primary add_button mt-2">Add Item
                                        Code</button>
                                </div>
                            </div>
                        </div>
                    </div>

    $(document).ready(function() {
        var maxField = 100; // Max fields limit
        var addButton = $('.add_button'); // Add button selector
        var wrapper = $('.field_wrapper'); // Table body

        // Add a new item code with empty attributes
        $(addButton).click(function() {
            if ($(wrapper).children().length < maxField) {
                var newRow = `
            <tr>
                <td>
                    <input type="number" name="itemcode[]" class="form-control" required />
                </td>
                @foreach ($attributes as $attribute)
                    <td>
                        <select name="attribute_value[{{ $attribute->id }}][]" class="form-select" required>
                            <option value="">Select</option>
                            @foreach ($attribute->attributevalue as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </td>
                @endforeach
                <td>
                    <input type="number" name="attribute_stock[]" class="form-control" required />
                </td>
                <td>
                    <input type="number" name="attribute_price[]" class="form-control" required />
                </td>
                <td>
                    <a href="javascript:void(0);" class="remove_button text-danger"><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>`;
                $(wrapper).append(newRow);
            } else {
                alert('Maximum item codes limit reached.');
            }
        });

        // Remove the selected row
        $(wrapper).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).closest('tr').remove();
        });
    });
