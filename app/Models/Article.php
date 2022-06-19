<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Category;
use App\Models\HealthProfessional;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'title', 'body', 'jsonData', 'postExcerpt', 'slug', 'featuredImage', 'metaDescription', 'health_professional_id', 'views'];

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id", "id");
    }

    public function hpro()
    {
        return $this->belongsTo(HealthProfessional::class, 'health_professional_id', 'id');
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