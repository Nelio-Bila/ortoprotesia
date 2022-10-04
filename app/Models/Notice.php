<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'title', 'body', 'slug', 'featuredImage', 'header_image_public_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id", "id");
    }
}