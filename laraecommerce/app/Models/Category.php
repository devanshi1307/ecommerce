<?php

namespace App\Models;
use App\Models\product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "categories";
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(product::class, 'category_id', 'id');
    }
    public function brands()
    {
        return $this->hasMany(Brand::class, 'category_id', 'id');
    }
}
