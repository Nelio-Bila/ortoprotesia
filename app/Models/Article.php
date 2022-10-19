<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Category;
use App\Models\HealthProfessional;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory, Uuids;

    protected $fillable = ['id', 'category_id', 'title', 'body', 'jsonData', 'postExcerpt', 'slug', 'featuredImage', 'metaDescription', 'health_professional_id', 'views', 'header_image_public_id'];

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

    public function views()
    {
        return $this->hasMany(ArticleView::class);
    }


    protected $dates = ['created_at', 'updated_at'];

    protected $appends = ['createdDateHumanReadable'];

    public function getCreatedDateHumanReadableAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}