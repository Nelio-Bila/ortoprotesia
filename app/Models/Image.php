<?php

namespace App\Models;

use App\Models\Article;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory, Uuids;

    protected $fillable = ['id', 'name', 'article_id'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
