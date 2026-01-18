<?php
namespace App\Services\Admin;
use App\Models\Category;
use App\Imports\CategoriesImport;
use App\Models\RelationalCategory;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class  CategoryService
{
    public function create(array $data): Category
    {
        return DB::transaction(function () use ($data) {

            if (isset($data['image'])) {
                $data['image'] = $data['image']->store('images/categories', 'public');
            }

            $category = Category::create($data);

            $category->metaTag()->create([
                'meta_title' => $data['meta_title'] ?? null,
                'meta_keywords' => $data['meta_keywords'] ?? null,
                'meta_description' => $data['meta_description'] ?? null,
            ]);

            return $category;
        });
    }

    public function update(Category $category, array $data): Category
    {
        return DB::transaction(function () use ($category, $data) {

            if (isset($data['image'])) {
                $data['image'] = $data['image']->store('images/categories', 'public');
            }

            $category->update($data);

            $category->metaTag()->updateOrCreate(
                [],
                [
                    'meta_title' => $data['meta_title'] ?? null,
                    'meta_keywords' => $data['meta_keywords'] ?? null,
                    'meta_description' => $data['meta_description'] ?? null,
                ]
            );

            return $category;
        });
    }

    public function delete(Category $category): void
    {
        DB::transaction(function () use ($category) {
            RelationalCategory::where('category_id', $category->id)->delete();
            $category->delete();
        });
    }

    public function bulkDelete(array $categoryIds): void
    {
        DB::transaction(function () use ($categoryIds) {

            RelationalCategory::whereIn('category_id', $categoryIds)->delete();

            Category::whereIn('id', $categoryIds)->delete();
        });
    }
    public function importCategories($file): void
    {
        DB::transaction(function () use ($file) {
            Excel::import(new CategoriesImport, $file);
        });
    }
}
