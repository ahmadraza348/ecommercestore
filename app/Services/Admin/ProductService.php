<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\RelationalCategory;

class ProductService
{
    public function store(array $data): Product
    {
        DB::transaction(function () use ($data) {
            if (isset($data['video'])) {
            }
            $pro =   Product::create($data);
            $pro->save();
            if (isset($data['video'])) {
                $pro->image = $this->uploadVideo($data['video']);
            }

            $this->syncCategories($pro, $data);
            return $pro;
        });
    }

    protected function uploadVideo($file)
    {
        $videoName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $data['video'] = $file->storeAs('videos/products', $videoName, 'public');
    }

    protected function syncCategories(Product $attribute, array $data): void
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
                'metaable_type' => Product::class,
            ]);
        }
    }
}
