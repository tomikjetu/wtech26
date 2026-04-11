<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sizes extends Model
{
    public function sizes() {
    return $this->belongsToMany(Size::class);
}

// Size.php
public function products() {
    return $this->belongsToMany(Product::class);
}
}
