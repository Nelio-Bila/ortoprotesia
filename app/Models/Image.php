<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory, Uuids;

    protected $fillable = ['id', 'name', 'article_id'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
