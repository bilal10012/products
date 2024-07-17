<?php

namespace App\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasSlug;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }    public function categories()
    {
        return $this->belongsToMany(Category::class,'product_category');
    }
    public function product_varients(){
        return $this->belongsToMany(ProductVarient::class);
    }
    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
