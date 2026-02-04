<?php

namespace App\Services\Admin;

use App\Models\Attribute;
use App\Models\RelationalCategory;

class AttributeService
{
    public function storeAttribute(array $data)
    {
        $attribute = new Attribute;
        $attribute->fill($data);

        $attribute->save();
        $this->syncCategories($attribute, $data);

        return $attribute;
    }

    protected function syncCategories(Attribute $attribute, array $data): void
    {
        $categories = $data['category'] ?? [];
        $subcategories = $data['subcategory'] ?? [];
        $childcategories = $data['childcategory'] ?? [];
        $superchildcategory = $data['superchild'] ?? [];
        $allCategories = array_merge($categories, $subcategories, $childcategories, $superchildcategory);

        foreach ($allCategories as $categoryId) {
            RelationalCategory::create([
                'attribute_id' => $attribute->id,
                'category_id' => $categoryId,
                'metaable_id' => $attribute->id,
                'metaable_type' => Attribute::class,
            ]);
        }
    }
}
