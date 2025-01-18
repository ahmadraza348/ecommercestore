@foreach($attributes->unique('pivot.attribute_value_id') as $attribute)
    <div class="attribute-option">
        <h5>{{ ucfirst($attribute->name) }}:</h5>
        <select class="attribute-select nice-select" data-attribute-name="{{ $attribute->name }}">
            <option value="">Select {{ $attribute->name }}</option>
            @foreach($attribute->attributeValues as $value)
                <option value="{{ $value->id }}">{{ $value->name }}</option>
            @endforeach
        </select>
    </div>
@endforeach
