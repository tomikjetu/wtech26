<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\sizes;

class product extends Model
{
    protected $table = 'product';

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'stock',
        'color',
        'sale_percent',
    ];

    public function category() {
    return $this->belongsTo(Category::class);
}


    public function sizes() {
    return $this->belongsToMany(sizes::class, 'product_size', 'product_id', 'size_id');
}

// Size.php
public function products() {
    return $this->belongsToMany(Product::class);
}
}