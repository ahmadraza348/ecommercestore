<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


class CategoryTest extends TestCase
{

    use RefreshDatabase;

    public function test_admin_can_create_category()
    {
        Storage::fake('public');

        $response = $this->post(route('category.store'), [
            'name' => 'Electronics',
            'slug' => 'electronics',
            'status' => 1,
            'parent_id' => null,
            'description' => 'Test description',
            'is_featured' => 1,
            'meta_title' => 'Meta title',
            'meta_keywords' => 'keywords',
            'meta_description' => 'meta description',
            'image' => UploadedFile::fake()->image('cat.png'),
        ]);

        $response->assertRedirect(route('category.index'));

        $this->assertDatabaseHas('categories', [
            'name' => 'Electronics',
            'slug' => 'electronics',
        ]);

        $this->assertDatabaseHas('meta_tags', [
            'meta_title' => 'Meta title',
        ]);

        Storage::disk('public')->assertExists('images/categories');
    }
}
