<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductVarientValues extends Model
{
    protected $fillable = ['varient_id', 'value'];

     public function product_varients()
     
    {
        return $this->belongsTo(ProductVarient::class);
    }
    public function variant()
    {
        return $this->belongsTo(ProductVarient::class, 'varient_id');
    }
}
