<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'jsonData', 'postExcerpt', 'slug', 'featuredImage', 'metaDescription', 'health_professional_id', 'views'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function hpro()
    {
        return $this->belongsTo(HealthProfessional::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}