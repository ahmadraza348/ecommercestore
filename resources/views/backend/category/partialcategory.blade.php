<?php $dash = isset($dash) ? $dash : '-- '; ?>

@if (isset($subcategory_data) && is_iterable($subcategory_data))
    @foreach ($subcategory_data as $item)
        <!-- Ensure current category is excluded and parent category is selected -->
        <option value="{{ $item->id }}" 
            {{ old('parent_id', $category->parent_id ?? '') == $item->id ? 'selected' : '' }}>
            {{ $dash }}{{ $item->name }}
        </option>
        
        @if (isset($item->subcategories) && count($item->subcategories))
            @include('backend.category.partialcategory', [
                'subcategory_data' => $item->subcategories,
                'dash' => $dash . '-- ',
                'category' => $category ?? null  // Pass the current category for preselection
            ])
        @endif
    @endforeach
@endif
