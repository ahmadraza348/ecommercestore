<?php $dash = isset($dash) ? $dash : '-- '; ?>
@foreach ($subcategories as $subcategory)
    <!-- Ensure current category is excluded and parent category is selected -->
    <option value="{{ $subcategory->id }}" 
        {{ old('parent_id', $category->parent_id) == $subcategory->id ? 'selected' : '' }}>
        {{ $dash }}{{ $subcategory->name }}
    </option>
    
    @if (count($subcategory->subcategory))
        @include('backend.category.partialcategory', [
            'subcategories' => $subcategory->subcategory,
            'dash' => $dash . '-- ',
            'category' => $category  // Pass the current category for preselection
        ])
    @endif
@endforeach
