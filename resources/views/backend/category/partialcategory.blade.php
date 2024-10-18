<?php $dash = isset($dash) ? $dash : '-- '; ?>
@foreach($subcategories as $subcategory)
    <option value="{{ $subcategory->id }}" {{ old('parent_id') == $subcategory->id ? 'selected' : '' }}>
        {{ $dash }}{{ $subcategory->name }}
    </option>
    @if(count($subcategory->subcategory))
        @include('backend.category.partialcategory', ['subcategories' => $subcategory->subcategory, 'dash' => $dash . '-- '])
    @endif
@endforeach
