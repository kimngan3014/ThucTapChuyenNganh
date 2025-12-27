<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
      protected $table = 'products';

    protected $fillable = [
        'idCategory',
        'name',
        'image',
        'price',
        'description',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'idCategory');
    }
}
