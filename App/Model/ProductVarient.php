<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class ProductVarient extends Model
{
    protected $fillable = ['name', 'product_id'];

    public function product_varient_values()
    {
        return $this->belongsToMany(ProductVarientValues::class);
    }
    public function products(){
        return $this->belongsTo(Product::class,"product_id",'id');
    }
    public function values()
{
    return $this->hasMany(ProductVarientValues::class, 'varient_id');
}

}
