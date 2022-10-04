<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $fillable = ['name'];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function notices()
    {
        return $this->hasMany(Notice::class);
    }
}