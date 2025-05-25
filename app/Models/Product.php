<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'price', 'quantity', 'featured_image'];

    public function list( string $searchTerm = '') {
        return $this
            ->with('images')
            ->where('title', 'LIKE', "%{$searchTerm}%")
            ->orderBy('id', 'desc')
            ->paginate(config('pagination.per_page'));
    }

    public function add(array $data = []) {
        $product =  $this->create($data);

        if (!empty($data['images'])) {
            foreach ($data['images'] as $image) {
                $path = $image->store('products', 'public');
                $product->images()->create(['path' => $path]);
            }
        }

        return $product;
    }

    public function edit(array $data = []) {
        $this->update($data);
        
        if (!empty($data['images'])) {
            foreach ($data['images'] as $image) {
                $path = $image->store('products', 'public');
                $this->images()->create(['path' => $path]);
            }
        }
        return $this;
    }

    public function remove() {
        // unlink the images
        foreach ($this->images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        // Delete from product_images table
        $this->images()->delete();

        return $this->delete();
    }

    public function images() {
        return $this->hasMany(ProductImage::class);
    }
}
