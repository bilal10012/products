<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{

    protected $fillable = ['product_id', 'variant_id', 'value_id', 'stock'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVarient::class);
    }

    public function value()
    {
        return $this->hasMany(ProductVarientValues::class, 'varient_id');
    }
}
